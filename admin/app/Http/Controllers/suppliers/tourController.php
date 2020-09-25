<?php

namespace App\Http\Controllers\suppliers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\SupplierInfo;
use DB;

class tourController extends Controller
{

    public function tour_list($supplier_id = '0') { 
        if($supplier_id == 0){
            $data['supplier_name'] = 'All';
            $data['holiday_list'] = DB::table('holiday_packages')
                                    ->where('supplier_id','>',$supplier_id)
                                    ->orderBy('id', 'desc')->get();
        } else {
            $data['supplier_name'] = SupplierInfo::where('id', $supplier_id)->first()->supplier_name;
            $data['holiday_list'] = DB::table('holiday_packages')
                                ->where('supplier_id',$supplier_id)
                                ->orderBy('id', 'desc')->get();
        }
        $data['supplier_id'] = $supplier_id;
        // echo '<pre>222'; print_r($data['holiday_list']);exit;
        return view('suppliers/tours/list')->with($data);
    }

    public function changestatus($id,$supplier_id,$status) {
        if(!empty($id)) {
            $data = array(
                'status'=>$status
            );
            DB::table('holiday_packages')->where('id', $id)->update($data);
        }

        if($status == 0){
            $StatusMsg = 'Tour De-activated!';
        } elseif($status == 1){
            $StatusMsg = 'Tour Re-activated!';
        } else{
            $StatusMsg = 'Updation failed!';
        }
        return redirect()->back()->with('success',$StatusMsg);
    }

    public function preview($holiday_id) {
        return redirect('../index.php/holiday/preview_holiday/'.$holiday_id);
    }

}