<?php

namespace App\Http\Controllers\b2b\Villas;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\model\VillaBookingVillasInfo;
use App\model\VillaBookingPassengersInfo;
use App\model\VillaBookingReports;

class reportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $VillaBookingReport = VillaBookingReports::where('agent_id', '!=', 0)->get();        

        $data['fromdate'] = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
        $data['todate'] = isset($_GET['todate']) ? $_GET['todate'] : '';
        $data['VillaBookingReport'] = VillaBookingReports::with(['Villas', 'Passengers'])
        ->whereHas('Villas',  function($query)  {
            $query->where('agent_id', '!=', 0);
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

        return view('b2b/villa/reports', $data);    
    }

    public function booking_reports($uniqueRefNo)
    {
        $sendmail = $_GET['sendmail'];
        // echo $sendmail;exit;
        if($sendmail == 1){
            return redirect('../index.php/villa/voucher?voucherId='.$uniqueRefNo);
        } else {
            return redirect('../index.php/villa/voucher1?voucherId='.$uniqueRefNo);
        }
    }

    public function booking_cancel($uniqueRefNo,$Booking_RefNo) {
        return redirect('../index.php/b2c/cancel_voucher/prepare?voucherId='.$uniqueRefNo.'&bookRefId='.$Booking_RefNo.'&callbackId='.base64_encode('villa_crs'));
    }
}
