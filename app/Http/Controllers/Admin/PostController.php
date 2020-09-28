<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CatePost;
use App\Models\Post;
class PostController extends Controller
{
    public function getAll(){
    	$all_post = Post::orderBy('id','DESC')->get();
    	$cate_post = CatePost::orderBy('id','DESC')->get();
    	return view('backend/post/all',compact('all_post','cate_post'));
    }		
   public function getAdd(){
   		$cate_post = CatePost::orderBy('id','DESC')->get();
   	   return view('backend/post/add',compact('cate_post'));
   }
   public function postAdd(Request $request){
   		$data_add = $request->all();
   		// dd($data_add);
    	 // dd($data_add);
        if ($request->hasFile('post_image')) {
            $file = $request->post_image;
            $data_add['post_image'] = $file->getClientOriginalName();// lấy tên của hình ảnh
        }else{
            $data_add['post_image'] = ' ';
        }
       
        if (Post::create($data_add)) {
            if ($request->hasFile('post_image')){
                $file->move('baiviet',$file->getClientOriginalName());
            }
            return redirect('admin/post/add')->with('success', __('Create post success.'));
        } else {
            return redirect()->back()->withErrors('Create post error.');
        }
   }
 	public function getEdit($id){
    	// $getProduct = Product::where('product_id',$id)->get();
        $getPost = Post::find($id);
        $cate_post = CatePost::all();
    	return view('backend/post/edit',compact('getPost','cate_post'));
    }
    public function postEdit(Request $request, $id){
    	$Post = Post::find($id);
    	$data_edit = $request->all();
        
        if ($request->hasFile('post_image')){
        	$path = 'baiviet/'.$data_edit->post_image;
        	unlink($path);
            $file = $request->product_image;
            $data_edit['post_image'] = $file->getClientOriginalName();
        }
       
        if ($Post->update($data_edit)) {
            if ($request->hasFile('post_image')) {
                $file->move('baiviet',$file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update post success id='.$id));
        } else {
            return redirect()->back()->withErrors('Update post error id='.$id);
        }
    }
   public function getDelete($id){
		$delete = Post::find($id);
		$path = 'baiviet/'.$delete->post_image;
        if(file_exists($path)){
            unlink($path);
        }
		$delete->delete();	
   	   if($delete){
            return redirect('admin/post/all')->with('success', __('Delete post success id='.$id));
		}else{
			return redirect()->back()->withErrors('Delete post error.');
		}
   }
}
