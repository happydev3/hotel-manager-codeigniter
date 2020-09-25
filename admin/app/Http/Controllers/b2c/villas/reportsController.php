<?php

namespace App\Http\Controllers\b2c\Villas;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\VillaBookingVillasInfo;
use App\model\VillaBookingPassengersInfo;
use App\model\VillaBookingReports;
use DB;

class reportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index() {

        // $data['VillaBookingReport'] = VillaBookingReports::with(['Villas', 'Passengers'])->orderBy('report_id', 'desc')->get();

        $data['fromdate'] = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
        $data['todate'] = isset($_GET['todate']) ? $_GET['todate'] : '';
        $data['VillaBookingReport'] = VillaBookingReports::with(['Villas', 'Passengers'])
        ->whereHas('Villas',  function($query)  {
            $query->whereNested(function ($query) {
                $fromdate = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
                $todate = isset($_GET['todate']) ? $_GET['todate'] : '';

                if($fromdate != ''){
                    $fromdate = isset($_GET['fromdate']) ? Date('Y-m-d', strtotime(str_replace('/', '-', $_GET['fromdate']))) : '';
                    $query->where('Booking_Date', '>=', $fromdate);
                }
                if($todate != ''){
                    $todate = isset($_GET['todate']) ? Date('Y-m-d', strtotime(str_replace('/', '-', $_GET['todate']))) : '';
                    $query->where('Booking_Date', '<=', $todate);
                }
            });
        })->orderBy('report_id','desc')->get();

        // echo '<pre>';print_r($data['VillaBookingReport']);exit;

        return view('b2c/villa/reports', $data);
    }

    public function booking_reports($uniqueRefNo)
    {
        // echo 1;exit;
        
        $sendmail = $_GET['sendmail'];
        // echo $sendmail;exit;
        if($sendmail == 1){
            return redirect('../index.php/villa/voucher1?voucherId='.$uniqueRefNo);
        } else {
            return redirect('../index.php/villa/voucher?voucherId='.$uniqueRefNo);
        }
    }

    public function booking_cancel($uniqueRefNo,$Booking_RefNo) {
        return redirect('../index.php/b2c/cancel_voucher/prepare?voucherId='.$uniqueRefNo.'&bookRefId='.$Booking_RefNo.'&callbackId='.base64_encode('villa_crs'));
    }
}
