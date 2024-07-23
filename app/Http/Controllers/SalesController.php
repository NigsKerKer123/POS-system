<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sales;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Validation\Rule;

class SalesController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $sales = sales::paginate(25);
            $custom = $request->session()->get('customization');

            return view('home.sales', compact('sales', 'user', 'custom'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }
}
