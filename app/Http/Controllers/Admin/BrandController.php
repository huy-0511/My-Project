<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
class BrandController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }
    public function BrandAll(){
    	$all = Brand::all();
    	return view('backend/brand/all',compact('all'));
    }
    public function getBrandAdd(){
    	return view('backend/brand/add');
    }
    public function postBrandAdd(Request $request){
    	$data = $request->all();
    	if(Brand::create($data)){
		 	return redirect()->back()->with('success', __('Create Brand success.'));
		}else{
			return redirect()->back()->withErrors('Create Brand error.');
		}
    }
    public function getBrandEdit($id_brand){
		// $data_edit = Brand::where('brand_id',$id_brand)->get();
		$data_edit = Brand::find($id_brand);
		// dd($data_edit);
		return view('backend/brand/edit',compact('data_edit'));
	}
	public function postBrandEdit(Request $request,$id_brand){
		$data = array(
			'brand_name'=>$request->brand_name,
			'brand_desc'=>$request->brand_desc,	
		);
		$update = Brand::where('brand_id',$id_brand)->update($data);
		if($update){
            return redirect('admin/brand/edit')->with('success', __('Update Brand success id='.$id_brand));
		}else{
			return redirect()->back()->withErrors('Update Brand error.');
		}
	}
	 public function Branddelete($id_brand){
    	// echo $request->id;
    	$delete = Brand::where('id',$id_brand)->delete();

    	if($delete){
            return redirect('admin/brand/all')->with('success', __('Delete category success id='.$id_brand));
		}else{
			return redirect()->back()->withErrors('Delete category error.');
		}
	}
}
