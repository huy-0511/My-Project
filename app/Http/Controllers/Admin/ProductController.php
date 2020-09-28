<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
class ProductController extends Controller
{
    public function productAll(){
    	$product = Product::all();
    	$category = Category::all();
    	$brand = Brand::all();
    	$count_product = Product::all()->count();
    	return view('backend/product/all',compact('category','brand','product','count_product'));
    }
    public function getAdd(){
    	$category = Category::all();
    	$brand = Brand::all();
    	return view('backend/product/add',compact('category','brand'));
    }
    public function postAdd(Request $request){
    	 $data_add = $request->all();
    	 // dd($data_add);
        if ($request->hasFile('product_image')) {
            $file = $request->product_image;
            $data_add['product_image'] = $file->getClientOriginalName();
        }else{
            $data_add['product_image'] = ' ';
        }
       
        if (Product::create($data_add)) {
            if ($request->hasFile('product_image')) {
                $file->move('product',$file->getClientOriginalName());
            }
            return redirect('admin/product/add')->with('success', __('Create product success.'));
        } else {
            return redirect()->back()->withErrors('Create product error.');
        }
    }
    public function getEdit($id){
    	// $getProduct = Product::where('product_id',$id)->get();
        $getProduct = Product::find($id);
        // dd($getProduct);
    	$category = Category::all();
    	$brand = Brand::all();
    	return view('backend/product/edit',compact('category','brand','getProduct'));
    }
    public function postEdit(Request $request, $id){
    	$getProduct = Product::findOrFail($id);
    	$data_edit = $request->all();
        
        if ($request->hasFile('product_image')){
            $file = $request->product_image;
            $data_edit['product_image'] = $file->getClientOriginalName();
        }
       
        if ($getProduct->update($data_edit)) {
            if ($request->hasFile('product_image')) {
                $file->move('product',$file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update product success.'));
        } else {
            return redirect()->back()->withErrors('Update product error.');
        }
    }
     public function delete($id){
        // echo $request->id;
        $delete = Product::find($id);
        $path = 'product/'.$delete->product_image;
        if(file_exists($path)){
            unlink($path);
        }
        $delete->delete();
        if($delete){
            return redirect('admin/product/all')->with('success', __('Delete product success id='.$id));
        }else{
            return redirect()->back()->withErrors('Delete product error.');
        }
    }
}
