<?php

namespace App\Http\Controllers\b2c\hotels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\HotelBookingHotelsInfo;
use App\model\HotelBookingPassengersInfo;
use App\model\HotelBookingReports;
use DB;

class reportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index() {

        $data['fromdate'] = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
        $data['todate'] = isset($_GET['todate']) ? $_GET['todate'] : '';
        // $data['HotelBookingReport'] = HotelBookingReports::get();
        // $data['HotelBookingReport'] = HotelBookingReports::with(['Hotels', 'Passengers'])->orderBy('report_id', 'desc')->get();

        $data['HotelBookingReport'] = HotelBookingReports::with(['Hotels', 'Passengers'])
        ->whereHas('Hotels',  function($query)  {
            $query->whereNested(function ($query) {
                // $noDueDate = '0000-00-00 00:00:00';
                // $now = date('Y-m-d H:i:s');
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
                // $query->where('Booking_Date', '>=', $fromdate)->where('Booking_Date', '<=', $todate);

                    // ->orWhere('date_start', '<', $now)
                    // ->where('date_end', '>', $now)

                    // ->orWhere('date_start', $noDueDate)
                    // ->where('date_end', '>', $now)

                    // ->orWhere('date_start', '<', $now)
                    // ->where('date_end', $noDueDate);
            });
        })->orderBy('report_id','desc')->get();

        // echo '<pre>';print_r($data['HotelBookingReport']);exit;

        return view('b2c/hotel/reports', $data);
    }


    public function booking_reports($uniqueRefNo)
    {
        // echo 1;exit;
        
        $sendmail = $_GET['sendmail'];
        // echo $sendmail;exit;
        if($sendmail == 1){
            return redirect('../index.php/hotels/voucher?voucherId='.$uniqueRefNo);
        } else {
            return redirect('../index.php/hotels/voucher1?voucherId='.$uniqueRefNo);
        }
    }

    public function booking_cancel($uniqueRefNo,$Booking_RefNo) {
        return redirect('../index.php/b2c/cancel_voucher/prepare?voucherId='.$uniqueRefNo.'&bookRefId='.$Booking_RefNo.'&callbackId='.base64_encode('hotel_crs'));
    }
}
