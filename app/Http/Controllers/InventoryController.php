<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventory;
use Illuminate\Support\Facades\Validator;
use Exception;

class InventoryController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $inventory = inventory::paginate(25);
            $custom = $request->session()->get('customization');

            return view('home.inventory', compact('inventory', 'user', 'custom'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == "1"){
            $inventory = inventory::all()->count();

            if($inventory >= 5){
                return redirect()->back()->with('error', 'You have reached the maximum limit of inventory items please upgrade to premium!');
            }
        }

        try {
            $data = $request->all();
            $data['quantity'] = (int) $data['quantity'];

            $validator = Validator::make($data, [
                'name' => 'required|max:255',
                'quantity' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $stack = new inventory();
            $stack->name = $request->name;
            $stack->quantity = $data['quantity']; 
            $stack->save();

            return redirect()->back()->with('success', 'Stack Added Sucessfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        $stack = inventory::where('id', $request->id)->first();

        if(!$stack){
            return redirect()->back()->with('error', 'Stack not found!');
        }

       try {
            $data = $request->all();
            $data['quantity'] = (int) $data['quantity'];

            $validator = Validator::make($data, [
                'name' => 'required|max:255',
                'quantity' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $stack->name = $request->name;
            $stack->quantity = $data['quantity']; 
            $stack->save();

            return redirect()->back()->with('success', 'Stack Updated Sucessfully');
       } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
       }
    }

    function delete(Request $request) {
        try {
            $stack = inventory::where('id', $request->id)->first();

            if (!$stack) {
                return redirect()->back()->with('error', 'Item not found');
            }

            $stack->delete();

            return redirect()->back()->with('success', 'Item deleted successfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error (500)');
        }
    }
}
