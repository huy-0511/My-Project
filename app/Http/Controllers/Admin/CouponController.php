<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\Coupon;
class CouponController extends Controller
{
    public function getCoupon(){
    	$coupon = Coupon::orderby('id','DESC')->get();
    	return view('backend/coupon/list-coupon',compact('coupon'));
    }
    public function getAdd(){
    	
    	return view('backend/coupon/add');
    }
    public function postAdd(Request $request){
    	$data = $request->all();
    	if (Coupon::create($data)){
    		return redirect()->back()->with('success', __('Create Coupon success.'));
		}else{
			return redirect()->back()->withErrors('Create Coupon error.');
		}
    	
    }
    public function getDelete($id){
    	$delete = Coupon::find($id);
    	$delete->delete();
    	if($delete){
            return redirect('admin/coupon/all')->with('success', __('Delete coupon success id='.$id));
        }else{
            return redirect()->back()->withErrors('Delete coupon error.');
        }
    }
}
