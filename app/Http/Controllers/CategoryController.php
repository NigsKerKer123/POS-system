<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\Validator;
use Exception;

class CategoryController extends Controller
{
    function index(Request $request){
        try{
            $user = $request->session()->get('user');
            $category = category::paginate(25);
            $custom = $request->session()->get('customization');

            return view('home.category', compact('category', 'user', 'custom'));
        }catch(Exception $e){
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function add(Request $request){
        $user = $request->session()->get('user');

        if($user->subscription == "1"){
            $category = category::all()->count();

            if($category >= 2){
                return redirect()->back()->with('error', 'You have reached the maximum limit of categories please upgrade to premium!');
            }
        }

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $category = new category();
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('success', 'Category Added Sucessfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function edit(Request $request){
        $category = category::where('id', $request->id)->first();

        if(!$category){
            return redirect()->back()->with('error', 'Category not found!');
        }

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid input');
            };

            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('success', 'Category Updated Sucessfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error(500)');
        }
    }

    function delete(Request $request){
        try {
            $category = category::where('id', $request->id)->first();

            if (!$category) {
                return redirect()->back()->with('error', 'category not found');
            }

            $category->delete();

            return redirect()->back()->with('success', 'category deleted successfully');
        } catch (Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Server Error (500)');
        }
    }
}
