<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\inventory;
use App\Models\customization;
use App\Models\category;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class productsController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            
            $customization = customization::where("id", 1)->first();
            $request->session()->put('customization', $customization);
            $custom = $request->session()->get('customization');

            $products = products::paginate(25);
            $inventory = inventory::all();
            $category = category::all();

            return view('home.products', compact('products', 'user', 'custom', 'inventory', 'category'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        try {
            $data = $request->all();
            $data['price'] = (float) $data['price'];
            
            $validator = Validator::make($data, [
                'inventory_id' => 'required|integer|max:99999999999', // Ensure it's an integer and within a sensible range
                'category_id' => 'required|integer|max:99999999999', // Ensure it's an integer and within a sensible range
                'price' => 'required|numeric|max:99999999.99', // Ensure it's numeric and within a sensible value range
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $product = new products();
            $inventory = inventory::where('id', $request->inventory_id)->first();
            $category = category::where('id', $request->category_id)->first();

            if(!$inventory){
                return redirect()->back()->with('error', 'Inventory not found');
            }

            if(!$category){
                return redirect()->back()->with('error', 'category not found');
            }

            $product->inventory_id = $inventory->id;
            $product->name = $inventory->name;
            $product->category_id = $category->id;
            $product->category_name = $category->name;
            $product->price = $data['price'];
            $product->save();

            return redirect()->back()->with('success', 'Product Added Sucessfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        try {
            $data = $request->all();
            $data['price'] = (float) $data['price'];
            
            $validator = Validator::make($data, [
                'inventory_id' => 'required|integer|max:99999999999',
                'category_id' => 'required|integer|max:99999999999',
                'price' => 'required|numeric|max:99999999.99',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $product = products::where('id', $request->id)->first();
            $inventory = inventory::where('id', $request->inventory_id)->first();
            $category = category::where('id', $request->category_id)->first();

            if(!$product){
                return redirect()->back()->with('error', 'product not found');
            }

            if(!$inventory){
                return redirect()->back()->with('error', 'Inventory not found');
            }

            if(!$category){
                return redirect()->back()->with('error', 'category not found');
            }

            $product->inventory_id = $inventory->id;
            $product->name = $inventory->name;
            $product->category_id = $category->id;
            $product->category_name = $category->name;
            $product->price = $data['price'];
            $product->save();

            return redirect()->back()->with('success', 'Product Updated Sucessfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function delete(Request $request){
        try {
            $product = products::where('id', $request->id)->first();

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error (500)');
        }
    }
}
