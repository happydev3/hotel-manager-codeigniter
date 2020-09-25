<?php

namespace App\Http\Controllers\b2c\holidays;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\HolidayBookingHolidayInfo;
use App\model\HolidayBookingPassengersInfo;
use App\model\HolidayBookingReports;

class reportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        // $data['HolidayBookingReport'] = HolidayBookingReports::with(['Holidays', 'Passengers'])->orderBy('holiday_booking_id', 'desc')->get();

        $data['fromdate'] = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
        $data['todate'] = isset($_GET['todate']) ? $_GET['todate'] : '';
        $data['HolidayBookingReport'] = HolidayBookingReports::with(['Holidays', 'Passengers'])
        ->whereHas('Holidays',  function($query)  {
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
        })->orderBy('holiday_booking_id','desc')->get();
        // echo '<pre>';print_r($data['HolidayBookingReport']);exit;

        return view('b2c/holiday/reports', $data);
    }

    public function booking_reports($uniqueRefNo) {
        $sendmail = $_GET['sendmail'];
        // echo $sendmail;exit;
        if($sendmail == 1){
            return redirect('../index.php/holiday/package_voucher1?referId='.$uniqueRefNo);
        } else {
            return redirect('../index.php/holiday/package_voucher?referId='.$uniqueRefNo);
        }
    }
}
