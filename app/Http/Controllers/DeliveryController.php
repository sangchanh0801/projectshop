<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Feeship;
use App\Models\Province;
use App\Models\Wards;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function insertDelivery(){
        $city = City::orderBy('matp', 'ASC')->get();

        return view('admin.delivery.add_delivery', compact('city'));
    }
    public function selectDelivery(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action']=="city") {
                $select_province = Province::where('matp', $data['ma_id'])->get();
                $output.='<option>--Chọn quận huyện--</option>';
                foreach ($select_province as $key => $province){
                    $output .= '<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
            }else{
                $select_wards = Wards::where('maqh', $data['ma_id'])->get();
                $output.='<option>--Chọn xã phường--</option>';
                foreach ($select_wards as $key => $ward){
                    $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function addFeeship(Request $request){
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->fee_matp = $data['city'];
        $feeship->fee_maqh = $data['province'];
        $feeship->fee_xaid = $data['wards'];
        $feeship->fee_ship = $data['fee_ship'];
        $feeship->save();
    }
    public function selectFeeship(){
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output.= '<div class="table-responsive">

        <table id="row-select" class="display table table-borderd table-hover">
            <thead>
                <tr>
                    <th>Tên thành phố</th>
                    <th>Tên quận huyện</th>
                    <th>Tên xã phường<th>
                    <th>Phí ship</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>';
        foreach ($feeship as $key => $fee){
        $output.= '<tr>
                    <td>'.$fee->city->name_city.'</td>
                    <td>'.$fee->province->name_quanhuyen.'</td>
                    <td>'.$fee->ward->name_xaphuong.'<td>
                    <td contenteditable data-feeship_id = "'.$fee->fee_id.'" class = "fee_feeship_edit">'.number_format($fee->fee_ship,0,',','.').'<td>
                    <td></td>
                    </tr>';
            }
        $output.= '</tbody>
        </table>
    </div>';
            echo $output;

    }
    public function updateFeeship(Request $request){
        $data = $request->all();
        $feeship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['feeship_value'], '.');
        $feeship->fee_ship = $fee_value;
        $feeship->save();
    }





}
