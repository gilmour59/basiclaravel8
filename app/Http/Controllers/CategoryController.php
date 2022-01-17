<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
    }

    public function allCategories() {

        $categories = Category::latest()->paginate(5);        
        //$categories = DB::table('categories')->latest()->paginate(5);
        $trash_categories = Category::onlyTrashed()->latest()->paginate(3);

        return view('admin.category.index')->with('categories', $categories)->with('trash_categories', $trash_categories);
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

    public function editCategory($id){

        $category = Category::find($id);
        return view('admin.category.edit')->with('category', $category);
    }

    public function updateCategory(Request $request, $id){

        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories,category_name,'. $id .'|max:255'
        ],
        [
            'category_name.required' => 'Please Input Category Name'
        ]);
        
        $category = Category::find($id)
            ->update([
                'category_name' => $request->category_name
            ]);        

        return redirect()->route('all.category')->with('success', 'Category Updated Successfully!');
    }

    public function trashCategory($id){
        
        $trash = Category::find($id)->delete();

        return redirect()->route('all.category')->with('success', 'Category has been trashed!');

    }

    public function restoreCategory($id){

        $restore = Category::withTrashed()->find($id)->restore();

        return redirect()->route('all.category')->with('success', 'Category has been restored!');

    }

    public function deleteCategory($id){

        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('all.category')->with('success', 'Category has been permanently deleted!');
    }
}
