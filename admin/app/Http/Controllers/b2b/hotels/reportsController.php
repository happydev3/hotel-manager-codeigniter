<?php

namespace App\Http\Controllers\b2b\hotels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\model\HotelBookingHotelsInfo;
use App\model\HotelBookingPassengersInfo;
use App\model\HotelBookingReports;

class reportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $HotelBookingReport=HotelBookingReports::where('agent_id', '!=', 0)->get();

        $data['fromdate'] = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
        $data['todate'] = isset($_GET['todate']) ? $_GET['todate'] : '';
        $data['HotelBookingReport'] = HotelBookingReports::with(['Hotels', 'Passengers'])
        ->whereHas('Hotels',  function($query)  {
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

        return view('b2b/hotel/reports', $data);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function booking_reports($uniqueRefNo)
    {
        // echo 1;exit;
        return redirect('../index.php/hotels/voucher1?voucherId='.$uniqueRefNo);
    }

    public function booking_cancel($uniqueRefNo,$Booking_RefNo) {
        return redirect('../index.php/b2c/cancel_voucher/prepare?voucherId='.$uniqueRefNo.'&bookRefId='.$Booking_RefNo.'&callbackId='.base64_encode('hotel_crs'));
    }
}
