<?php

namespace App\Http\Controllers\suppliers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\SupplierInfo;
use App\model\SupplierHotelInfo;
use App\model\ApiPermanentHotels;

class hotelController extends Controller
{

    public function hotellist($supplier_id = '0') {
        if(isset($_GET['supplier_id'])){
            $supplier_id = $_GET['supplier_id'];
        }
        if($supplier_id == 0){
            $data['supplier_name'] = 'All';
            $data['hotel_infos'] = SupplierHotelInfo::where('supplier_id','>',$supplier_id)->get();
        } else {
            $data['supplier_name'] = SupplierInfo::where('id', $supplier_id)->first()->supplier_name;
            $data['hotel_infos'] = SupplierHotelInfo::where('supplier_id', $supplier_id)->get();
        }
        $data['supplier_info']=SupplierInfo::all();
        $data['supplier_id'] = $supplier_id;
        // echo '<pre>222'; print_r($data['hotel_infos']);exit;
        return view('suppliers/hotels/list')->with($data);
    }

    public function changestatus($id,$supplier_id,$status) {

        SupplierHotelInfo::where('supplier_hotel_list_id', $id)
          ->where('supplier_id', $supplier_id)
          ->update(['admin_status' => $status]);

        if($status == 0){
            $hotelStatus = 'Hotel De-activated';
        } else{
            $hotelStatus = 'Hotel Re-activated';
        }
        return redirect()->back()->with('success',$hotelStatus);
    }

    public function refresh_hotels($supplier_id){
        $sup_hotels = SupplierHotelInfo::where('supplier_id', $supplier_id)->get();
        ApiPermanentHotels::where('supplier_id', $supplier_id)->where('api', 'hotel_crs')->delete();
        // echo '<pre>456';print_r($sup_hotels);//exit;
        foreach($sup_hotels as $key=>$val){
            $data=array(
                'supplier_id'=>$supplier_id,
                'api'=>'hotel_crs',
                'city_code'=>$val->cityid,
                'city_name'=>$val->hotel_city,
                'country_name'=>$val->hotel_country,
                'hotel_code'=>$val->hotel_code,
                'hotel_name'=>$val->hotel_name,
                'star'=>$val->hotel_star_rating,
                'location'=>$val->address,
                'latitude'=>$val->latitude,
                'longitude'=>$val->longitude,
                'address'=>$val->address,
                'phone'=>$val->hotel_phone,
                'fax'=>$val->hotel_fax,              
                'email'=>$val->hotel_email,
                'hotel_facilities'=>$val->hotel_facilities,
                // 'created_at'=> date('Y-m-d H:i:s'),
                // 'updated_at'=> date('Y-m-d H:i:s')
            );
            // echo '<pre>';print_r($data);//exit;
            ApiPermanentHotels::insert($data);
        }
        SupplierHotelInfo::where('supplier_id', $supplier_id)->update(['notification_flag' => 0]);
        SupplierInfo::where('id', $supplier_id)->update(['notification_flag' => 0]);
        return redirect()->back()->with('success','Hotel Refreshed');
    }

    public function preview($hotelCode) {
        return redirect('../index.php/hotels/preview/'.$hotelCode);
    }
}