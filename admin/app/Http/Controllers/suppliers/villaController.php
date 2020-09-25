<?php

namespace App\Http\Controllers\suppliers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\SupplierInfo;
use DB;

class villaController extends Controller
{

    public function villa_list($supplier_id = '0') { 
        if($supplier_id == 0){
            $data['supplier_name'] = 'All';
            $data['villa_list'] = DB::table('villa_list')
                                    ->where('supplier_id','>',$supplier_id)
                                    ->orderBy('id', 'desc')->get();
        } else {
            $data['supplier_name'] = SupplierInfo::where('id', $supplier_id)->first()->supplier_name;
            $data['villa_list'] = DB::table('villa_list')
                                ->where('supplier_id',$supplier_id)
                                ->orderBy('id', 'desc')->get();
        }
        $data['supplier_id'] = $supplier_id;
        // echo '<pre>222'; print_r($data['villa_list']);exit;
        return view('suppliers/villas/list')->with($data);
    }

    public function changestatus($id,$supplier_id,$status) {
        if(!empty($id)) {
            $data = array(
                'status'=>$status
            );
            DB::table('villa_list')->where('id', $id)->update($data);
        }

        if($status == 0){
            $StatusMsg = 'Villa De-activated!';
        } elseif($status == 1){
            $StatusMsg = 'Villa Re-activated!';
        } else{
            $StatusMsg = 'Updation failed!';
        }
        return redirect()->back()->with('success',$StatusMsg);
    }

    public function preview($villaCode) {
        return redirect('../index.php/villa/preview/'.$villaCode);
    }

}