<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function allCategories() {

        $categories = Category::latest()->paginate(5);        
        //$categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index')->with('categories', $categories);
    }
    
    public function addCategory(Request $request) {

        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ],
        [
            'category_name.required' => 'Please Input Category Name'
        ]);

        /* Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]); */        

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        /* $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data); */

        return redirect()->back()->with('success', 'Category Inserted Successfully!');
    }
}
