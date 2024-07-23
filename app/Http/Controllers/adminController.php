<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\tenant_user;
use App\Models\domain;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPassword;
use Illuminate\Support\Str;

class adminController extends Controller
{
    function login(Request $request){
        try {
            $user = User::where('email', $request->email)->first();
            
            if(!$user){
                return redirect()->back()->with('error', 'Admin not found!');
            }

            $tenant_user = tenant_user::where('user_id', $user->id)->first();
            $domain = domain::where('tenant_id', $tenant_user->tenant_id)->first();
            $subdomain = $domain->domain;
    
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                $request->session()->put('user', $user);
                return redirect()->to("http://" . $subdomain . ".javavibe.com:8000/products");
            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function logout(){
        try {
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'subscription' => 'required|string|in:1,2',
            'subdomain' => 'required|string|unique:domains,domain',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Invalid input');
        }
    
        try {
            $password = "javavibe" . Str::random(8);
    
            Mail::to($request->email)->send(new SendPassword($password));
    
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->subscription = $request->subscription;
            $user->save();
    
            $tenant = Tenant::create([
                'name' => $request->name,
            ]);
    
            $tenant->domains()->create(['domain' => $request->subdomain]);
    
            $user->tenants()->attach($tenant->id);
    
            Auth::login($user);
            $request->session()->put('user', $user);
    
            return redirect("http://" . $request->subdomain . ".javavibe.com:8000/products")->with('success', 'User registered successfully.');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error (500). Please try again.')->withErrors($e->getMessage());
        }
    }

    function registerIndex(){
        try {
            return view('register');
        } catch (Exception $e) {
            // return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function upgrade(Request $request){
        try {
            $user = $request->session()->get('user');
            
            if($user->subscription != "1"){
                return redirect()->back()->with('error', 'You are already in premium services');
            }
            
            else{
                $userDB = User::where('id', $user->id)->first();
                $userDB->subscription = '2';
                $userDB->save();

                $user->subscription = '2';
                return back()->with('success', 'Thank you for subcribing to premium services.'); 
            }
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
