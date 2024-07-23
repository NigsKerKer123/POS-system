<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\customization;
use App\Models\products;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class SettingsController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $custom = $request->session()->get('customization');
            $products = products::paginate(25);

            return view('home.settings', compact('products', 'user', 'custom'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
    
    function customize(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == '1'){
            return redirect()->back()->with('error', 'Please upgrade to Premium'); 
        }

        $validator = Validator::make($request->all(), [
            'company_name' => 'nullable|string|max:100',
            'logo' => 'image|mimes:jpeg,png,jpg',
            'color' => 'string|in:1,2,3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid input');
        }

        try {
            $customization = customization::where("id", 1)->first();
            
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');

                $subdomain = explode('.', $request->getHost())[0];
                $imageName = 'logo' . $subdomain . '.' . $image->getClientOriginalExtension();
                
                $image->move(public_path('images'), $imageName);
                $customization->logo_pic = $imageName;
            }

            if($request->company_name != null){
                $customization->company_name = $request->company_name;
            }
            
            $customization->color = $request->color;
            $customization->save();

            $request->session()->put('customization', $customization);

            return redirect()->route('settings.index')->with('success', 'Updated successfully.');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function changePass(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            }

            $user = $request->session()->get('user');
            $userChange = User::where('id', $user->id)->first();
            
            if (!Hash::check($request->current_password, $userChange->password)) {
                return redirect()->back()->with('error', 'Incorrect Current Password'); 
            }
    
            $userChange->password = Hash::make($request->new_password);
            $userChange->save();
    
            return redirect()->back()->with('success', 'Password changed successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
