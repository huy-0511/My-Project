<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Wards;
use App\Models\District;
use App\Models\Feeship;
class DeliveryController extends Controller
{
	public function getAdd(){
		$city = City::orderby('id','ASC')->get();
    	return view('backend/delivery/add',compact('city'));
    }
    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action'] == 'city'){
    			$select_district = District::where('id_matp',$data['ma_id'])->orderby('id','ASC')->get();
    			
    			$output.= '<option>--Chọn quận huyện--</option>';
    			foreach ($select_district as $key => $district) {
    				$output.='<option value="'.$district['id'].'">'.$district['name_quan'].'</option>';
    			}
    			
    		}else{	
    			$select_wards = Wards::where('id_maqh',$data['ma_id'])->orderby('id','ASC')->get();
    			$output.= '<option>--Chọn xã phường--</option>';
    			foreach ($select_wards as $key => $wards) {
    				$output.='<option value="'.$wards['id'].'">'.$wards['name_phuong'].'</option>';
    			}
    		}
    		
    	}
    	echo $output;
    }
    public function insert_delivery(Request $request){
    	$data = $request->all();
    	$fee_ship = new Feeship;
    	$fee_ship->fee_matp = $data['city'];
    	$fee_ship->fee_maqh = $data['district'];
    	$fee_ship->fee_xaid = $data['wards'];
    	$fee_ship->fee_feeship = $data['fee_ship'];
    	$fee_ship->save();
    }
    public function feeship(Request $request){
    	$feeship = Feeship::orderby('id','DESC')->get();
    	$output = ' ';
    	$output.='<div class="table-responsive">
    		<table class="table table-bordered">
    			<thread>
    				<tr>
    					<th>Tên thành phố</th>
    					<th>Tên quận huyện</th>
    					<th>Tên xã phường</th>
    					<th>Phí ship</th>
    				</tr>	
    			</thread>
    			<tbody>
    			';
    			foreach ($feeship as $key => $fee) {
    				$output.='
    				<tr>
    					<td>'.$fee->city->name_city.'</td>
    					<td>'.$fee->district->name_quan.'</td>
    					<td>'.$fee->wards->name_phuong.'</td>
    					<td contenteditable data-feeship_id="'.$fee->id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship).'</td>
    				</tr>
    				';
    			}
    				
    			$output.='
    			</tbody>
    		</table>
    		</div>	
    	';
    	echo $output;
    }
    public function update_feeship(Request $request){
    	$data = $request->all();
    	$update_feeship = Feeship::find($data['feeship_id']);
    	$fee_value = rtrim($data['fee_value']);
    	$update_feeship->fee_feeship = $fee_value;
    	$update_feeship->save();
    }
}
