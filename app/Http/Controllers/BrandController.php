<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
    }

    public function allBrands(){

        $brands = Brand::latest()->paginate(5);        
        //$categories = DB::table('categories')->latest()->paginate(5);
        $trash_brands = Brand::onlyTrashed()->latest()->paginate(3);

        return view('admin.brand.index')->with('brands', $brands)->with('trash_brands', $trash_brands);
    }

    public function addBrand(Request $request){

        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|unique:brands|mimes:jpeg,jpg,png'
        ],
        [
            'brand_name.required' => 'Please Input Brand Name'
        ]);  

        $brand_image = $request->file('brand_image');

        /* //make image name unique
        $name_generate = hexdec(uniqid());
        $img_extension = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_generate . '.' . $img_extension;
        $upload_location = 'image/brand/';
        //add to database
        $final_img = $upload_location . $img_name;
        //move to directory
        $brand_image->move($upload_location, $img_name); */

        $name_generate = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('image/brand/' . $name_generate);
        $final_img = 'image/brand/' . $name_generate;

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $final_img;   
        $brand->save();

        return redirect()->route('all.brand')->with('success', 'Brand Inserted Successfully!');
    }

    public function editBrand($id){

        $brand = Brand::find($id);
        return view('admin.brand.edit')->with('brand', $brand);
    }

    public function updateBrand(Request $request, $id){

        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands,brand_name,'. $id .'|max:255',
            'brand_image' => 'mimes:jpeg,jpg,png|nullable'
        ],
        [
            'brand_name.required' => 'Please Input Brand Name'
        ]);  

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if(isset($brand_image)){

            //make image name unique
            $name_generate = hexdec(uniqid());
            $img_extension = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_generate . '.' . $img_extension;
            $upload_location = 'image/brand/';
            //add to database
            $final_img = $upload_location . $img_name;
            //move to directory
            $brand_image->move($upload_location, $img_name);

            unlink($old_image);

            Brand::find($id)
            ->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $final_img
            ]);  
        }else{

            Brand::find($id)
            ->update([
                'brand_name' => $request->brand_name
            ]);  
        } 

        return redirect()->route('all.brand')->with('success', 'Brand Updated Successfully!');
    }

    public function deleteBrand($id){

        $image = Brand::find($id);

        //delete image
        unlink($image->brand_image);

        Brand::find($id)->delete();
        Brand::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('all.brand')->with('success', 'Brand has been permanently deleted!');
    }

    public function allMultipics(){

        $images = Multipic::all();
        return view('admin.multipic.index')->with('images', $images);
    }

    public function addMultipic(Request $request){

        $validatedData = $request->validate([
            'image' => 'required',
            'image.*' => 'mimes:jpeg,jpg,png'            
        ]);

        $images = $request->file('image');
        
        foreach ($images as $image){

            $name_generate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('image/multi/' . $name_generate);
            $final_img = 'image/multi/' . $name_generate;
    
            $multipic = new Multipic;
            $multipic->image = $final_img;        
            $multipic->save();
        }

        return redirect()->route('all.multipic')->with('success', 'Pics Inserted Successfully!');
    }
}
