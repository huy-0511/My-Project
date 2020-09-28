<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Category;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;

class CategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }
    public function CateAll(){
    	$all = Category::all();
    	return view('backend/category/all',compact('all'));
    }
    public function getAdd(){
    	
    	return view('backend/category/add');
    }
    public function postAdd(Request $request){
    	$data = $request->all();
    	if(Category::create($data)){
		 	return redirect()->back()->with('success', __('Create category success.'));
		}else{
			return redirect()->back()->withErrors('Create category error.');
		}
    }
    public function delete($id){
    	// echo $request->id;
    	$delete = Category::where('id',$id)->delete();

    	if($delete){
            return redirect('admin/category/all')->with('success', __('Delete category success id='.$id));
		}else{
			return redirect()->back()->withErrors('Delete category error.');
		}
	}
	public function getEdit($id){
		// $data_edit = Category::where('category_id',$id)->get();
		$data_edit = Category::find($id);
		// dd($data_edit);
		return view('backend/category/edit',compact('data_edit'));
	}
	public function postEdit(Request $request,$id){
		$data = array(
			'category_name'=>$request->category_name,
			'category_desc'=>$request->category_desc,	
		);
		$update = Category::where('category_id',$id)->update($data);
		if($update){
            return redirect('admin/category/all')->with('success', __('Update category success id='.$id));
		}else{
			return redirect()->back()->withErrors('Update category error.');
		}
	}
	public function export_csv(Request $request){
		return Excel::download(new ExcelExports, 'category.xlsx');
	}
	public function import_csv(Request $request){
		$path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
	}
}
