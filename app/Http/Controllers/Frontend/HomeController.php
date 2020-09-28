<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\CatePost;
use App\Models\Post;
class HomeController extends Controller
{
    public function baiviet($post_slug){
        $cate_post = CatePost::orderBy('id','DESC')->get(); 
        $category = Category::all();
        $brand = Brand::all();
        $post = Post::where('post_slug',$post_slug)->get();
         
          foreach ($post as $key => $value) {
               $meta_desc = $value['post_meta_desc'];
               $meta_keywords = $value['post_meta_keywords'];
               $meta_title = $value['post_title'];
               $post_id = $value['id'];
               $cate_post_id = $value['cate_post_id'];
            } 
        $related = Post::where('cate_post_id',$cate_post_id)->whereNotIn('post_slug',[$post_slug])->get();// trừ cái bài viết mình đang xem và hiện những bài viết khác liên quan tới
        return view('frontend/baiviet/baiviet',compact('category','brand','cate_post','post','meta_desc','meta_keywords','meta_title','related')); 
    }
    public function danhmucbaiviet($post_slug){
        $cate_post = CatePost::orderBy('id','DESC')->get(); 
        $category = Category::all();
        $brand = Brand::all();
        $category_post = CatePost::where('cate_post_slug',$post_slug)->get();
         
          foreach ($category_post as $key => $value) {
               $meta_desc = $value['cate_post_desc'];
               $meta_keywords = $value['cate_post_slug'];
               $meta_title = $value['cate_post_name'];
               $cate_id = $value['id'];
            } 

        $post = Post::where('cate_post_id',$cate_id)->paginate(4);  
        return view('frontend/baiviet/danhmucbaiviet',compact('category','brand','cate_post','post','meta_desc','meta_keywords','meta_title'));
    }
	public function index(){
       //post danh mục bài viết
        $cate_post = CatePost::orderBy('id','DESC')->get(); 
		$category = Category::all();
		$brand = Brand::all();
		$all_product = Product::all();
		return view('frontend/trangchu',compact('category','brand','all_product','cate_post'));
	}
	public function Show_category($category_id)
    {
        $cate_post = CatePost::orderBy('id','DESC')->get(); 
    	$category = Category::all();
		$brand = Brand::all();
    	// $category_by_id = DB::table('product')->join('category','product.category_id','=','category.id')->where('product.category_id',$category_id)->get();
        $product = Product::where('category_id',$category_id)->get();
         // dd($category_by_id);
    	$category_name = Category::where('id',$category_id)->get();	
    	// nhận và giả mã chuôi đã mã hóa json
    	return view('frontend/category/show_category',compact('category','brand','category_name','product','cate_post'));
    }
    public function Show_brand($brand_id)
    {
    	$category = Category::all();
		$brand = Brand::all();
        $product = Product::where('brand_id',$brand_id)->get();
    	$brand_name = Brand::where('id',$brand_id)->get();
    
    	return view('frontend/brand/show_brand',compact('category','brand','product','brand_name'));
    }
    public function Details_product($product_id)
    {
        $category = Category::all();
		$brand = Brand::all();
        $all_product = Product::all();
        $product_detail = Product::where('id',$product_id)->get(); 
        return view('frontend/sanpham/show_details',compact('category','brand','product_detail','all_product'));

    }
    public function search(Request $request){
        $category = Category::all();
        $brand = Brand::all();
    
        $key = $request->keywords_submit;
        $search_product = Product::where('product_name', 'LIKE', '%'.$key.'%')->get();    
        
        return view('frontend/sanpham/search',compact('search_product','brand','category'));
    }
}
