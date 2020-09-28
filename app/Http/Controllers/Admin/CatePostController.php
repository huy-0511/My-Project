<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CatePost;
class CatePostController extends Controller
{
   public function getAll(){
    	$all = CatePost::orderBy('id','DESC')->paginate(5);
    	return view('backend/catePost/all',compact('all'));
    }		
   public function getAdd(){
   	   return view('backend/catePost/add');
   }
   public function postAdd(Request $request){
   		$data = $request->all();
    	if(CatePost::create($data)){
		 	return redirect()->back()->with('success', __('Create cate_post success.'));
		}else{
			return redirect()->back()->withErrors('Create cate_post error.');
		}
   }
   public function getEdit($id){
		$data_edit = CatePost::find($id);	
   	   return view('backend/catePost/edit',compact('data_edit'));
   }
   public function postEdit(Request $request, $id){
   		$data = array(
			'cate_post_name'=>$request->cate_post_name,
			'cate_post_slug'=>$request->cate_post_slug,
			'cate_post_desc'=>$request->cate_post_desc,	
		);
		$update = CatePost::where('id',$id)->update($data);
		if($update){
            return redirect()->back()->with('success', __('Update category success id='.$id));
		}else{
			return redirect()->back()->withErrors('Update category error.');
		}
   }
   public function getDelete($id){
		$delete = CatePost::find($id);
		$delete->delete();	
   	   if($delete){
            return redirect('admin/cate_post/all')->with('success', __('Delete category post success id='.$id));
		}else{
			return redirect()->back()->withErrors('Delete category post error.');
		}
   }
}
