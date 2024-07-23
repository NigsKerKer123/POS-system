<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\add_user;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AddUserController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $custom = $request->session()->get('customization');

            $add_user = add_user::paginate(25);

            return view('home.add_users', compact('add_user', 'user', 'custom'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $admin = $request->session()->get('user');

        if($admin->subscription == "1"){
            $add_user = add_user::all()->count();

            if($add_user >= 2){
                return redirect()->back()->with('error', 'You have reached the maximum limit of users please upgrade to premium!');
            }
        }

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|string',
                'email' => 'required|string|email|unique:users,email'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $password = "javavibe" . Str::random(8);

            Mail::to($request->email)->send(new SendPassword($password));

            $user = new add_user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->subscription = $admin->subscription;
            $user->password = Hash::make($password);
            $user->save();
            return redirect()->back()->with('success', 'User added successfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        $admin = $request->session()->get('user');
        $user = add_user::where('id', $request->id)->first();

        if(!$user){
            return redirect()->back()->with('error', 'user not found!');
        }

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|string',
                'email' => [
                    'required',
                    'string',
                    'email',
                    Rule::unique('users', 'email')->ignore($user->id)
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $password = "javavibe" . Str::random(8);

            Mail::to($request->email)->send(new SendPassword($password));

            $user->name = $request->name;
            $user->email = $request->email;
            $user->subscription = $admin->subscription;
            $user->password = Hash::make($password);
            $user->save();
            return redirect()->back()->with('success', 'User Updated successfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error (500)');
        }
    }

    function delete(Request $request){
        try {
            $user = add_user::where('id', $request->id)->first();

            if (!$user) {
                return redirect()->back()->with('error', 'user not found');
            }

            $user->delete();

            return redirect()->back()->with('success', 'user deleted successfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error (500)');
        }
    }
}
