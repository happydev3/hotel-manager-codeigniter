<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\admin\AdminRequestedit;
use App\Http\Requests\admin\PasswordRequestedit;
use App\model\Country;
use DB;
use Hash;
use Carbon\Carbon;
use App\model\HotelBookingReports;
use App\model\VillaBookingReports;
use App\model\HolidayBookingReports;

class dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // $data['hotel_reports'] = DB::table('hotel_booking_reports')
            // ->select(DB::raw('*', false))
            // ->orderBy('Booking_Date','ASC')
            // ->get();

        $data['HotelBookingReport'] = HotelBookingReports::with(['Hotels', 'Passengers'])->orderBy('report_id', 'desc')->get();
        $data['VillaBookingReport'] = VillaBookingReports::with(['Villas', 'Passengers'])->orderBy('report_id', 'desc')->get();
        $data['HolidayBookingReport'] = HolidayBookingReports::with(['Holidays', 'Passengers'])->orderBy('holiday_booking_id', 'desc')->get();

        // echo '<pre>ewds';print_r($data['hotel_reports']);exit;

        $dataWeekly = $this->bookingReports(7);
        $dataMotnhly = $this->bookingReports(30);
        // echo '<pre>ewds';print_r($dataWeekly);exit;
        $data['dataWeekly'] = rtrim($dataWeekly, ',');
        $data['dataMotnhly'] = rtrim($dataMotnhly, ',');
        // echo '<pre>ewds';print_r($data['jsonStr']);exit;
        return view('dashboard/index')->with($data);
    }

    public function bookingReports($type) {
        $dataJson = '';
        $myObect = array();
        for($i=0;$i<$type;$i++){
            $todate = Carbon::now()->subDays($type)->addDays($i)->toDateString();
            // echo '<br>'.$todate;//exit;
            // exit;
            $hotel_reportsW = DB::table('hotel_booking_reports')
                ->select(DB::raw('COUNT(report_id) AS hotel_count, Booking_Date', false))
                ->where('Booking_Date',$todate)
                ->groupBy('Booking_Date')
                ->first();

            $villa_reportsW = DB::table('villa_booking_reports')
                ->select(DB::raw('COUNT(report_id) AS villa_count, Booking_Date', false))
                ->where('Booking_Date',$todate)
                ->groupBy('Booking_Date')
                ->first();

            $tour_reportsW = DB::table('holiday_booking_reports')
                ->select(DB::raw('COUNT(holiday_booking_id) AS tour_count, Booking_Date', false))
                ->where('Booking_Date',$todate)
                ->groupBy('Booking_Date')
                ->first();
            // echo '<pre>ewds';print_r($hotel_reportsW);//exit;
            // echo $todate.'<br>';//exit;
            
            if(!empty($hotel_reportsW))
                $hotel_count = $hotel_reportsW->hotel_count;
            else
                $hotel_count = 0;

            if(!empty($villa_reportsW))
                $villa_count = $villa_reportsW->villa_count;
            else
                $villa_count = 0;

            if(!empty($tour_reportsW))
                $tour_count = $tour_reportsW->tour_count;
            else
                $tour_count = 0;

            $myObect[$i] = array(
                'hotel_count' => $hotel_count,
                'villa_count' => $villa_count,
                'tour_count' => $tour_count,
                'Booking_Date' => $todate,
            );
            $dataJson .= '{ y: "'.$todate.'", a: "'.$hotel_count.'",  b: "'.$villa_count.'" , c: "'.$tour_count.'" },';
        }

        return $dataJson;
    }

    public function dashboard() {
        $villa_reports = DB::table('villa_booking_reports')
            ->select(DB::raw('Currency, IF(agent_id=0, "B2B Villa", "B2C Villa") AS title, Booking_Date as start, Booking_Date as end, COUNT(report_id) AS count, SUM(total_cost) as total_cost', false))
            ->groupBy('Booking_Date')
            ->get();

        $hotel_reports = DB::table('hotel_booking_reports')
            ->select(DB::raw('Currency, IF(agent_id=0, "B2B Hotel", "B2C Hotel") AS title, Booking_Date as start, Booking_Date as end, COUNT(report_id) AS count, SUM(total_cost) as total_cost', false))
            ->groupBy('Booking_Date')
            ->get();

        $holiday_reports = DB::table('holiday_booking_reports')
            ->select(DB::raw('Currency, IF(agent_id=0, "B2B Tour", "B2C Tour") AS title, Booking_Date as start, Booking_Date as end, COUNT(holiday_booking_id) AS count, SUM(total_cost) as total_cost', false))
            ->groupBy('Booking_Date')
            ->get();
        
        $jsonHotel = '';$jsonVilla = '';$jsonTour = '';
        if(!empty($hotel_reports)) {
            foreach ($hotel_reports as $value) {
                $jsonHotel .= '{
                    title: "Hotel Booking: - '.$value->count.'",
                    start: "'.$value->start.'",
                    end: "'.$value->end.'",
                    cost: "'.$value->Currency.' '.number_format($value->total_cost).'"
                },';
            }
        }
        if(!empty($villa_reports)) {
            foreach ($villa_reports as $value2) {
                $jsonVilla .= '{
                    title: "Villa Booking: - '.$value2->count.'",
                    start: "'.$value2->start.'",
                    end: "'.$value2->end.'",
                    cost: "'.$value2->Currency.' '.number_format($value2->total_cost).'"
                },';
            }
        }
        if(!empty($holiday_reports)) {
            foreach ($holiday_reports as $value3) {
                $jsonTour .= '{
                    title: "Tour Booking: - '.$value3->count.'",
                    start: "'.$value3->start.'",
                    end: "'.$value3->end.'",
                    cost: "'.$value3->Currency.' '.number_format($value3->total_cost).'"
                },';
            }
        }
        $data['jsonHotel'] = rtrim($jsonHotel, ',');
        $data['jsonVilla'] = rtrim($jsonVilla, ',');
        $data['jsonTour'] = rtrim($jsonTour, ',');
        // echo '<pre>ewds';print_r($data['jsonStr']);exit; 
        return view('dashboard/index');
    }

    public function my_profile($status = '') {
        $user = Auth::user();
        // Session::put('admin_id', $user->id);
        // $admin_id = Session::get('admin_id');
        $data['admin_info'] = $user;
        // $data['apiinfo']=ApiInfo::where('service_type',1)->get();
        // $data['country_list'] = $this->country->get();
        $data['country_list'] = Country::all();
        // echo '<pre>ewds';print_r($data['admin_info']);exit;  
        return view('dashboard/profile')->with($data);
    }

    public function profile_update(AdminRequestedit $request, $id) {

        $dataupdate = array(
            'name'=>$request->input('name'),
            'mobile_no'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'pin_code'=>$request->input('pin_code'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'country'=>$request->input('country')
        );
        DB::table('admin')
            ->where('id', $id)
            ->update($dataupdate);
        return redirect()->back()->with('success','Updated');
    }

    public function change_password() {
        $user = Auth::user();
        $data['admin_info'] = $user;
        return view('dashboard/change_password')->with($data);
    }

    public function password_update(PasswordRequestedit $request, $id) {
        $user = Auth::user();
        $admin_info = $user;
        $current_password = $request->input('cpassword');
        $new_password = $request->input('password');
        $old_password = $admin_info->password;

        if ($request->input('password') != $request->input('passconf')) {
            $data = 'New Password doesn\'t match to Confirm Password';
            $status = 'error';
        } else {
            if (Hash::check($current_password, $old_password)) {
                $password = array(
                    'password' => Hash::make($new_password)
                );
                $return = DB::table('admin')
                    ->where('id', $id)
                    ->update($password);

                if ($return) {
                    $data = 'Password Successfully Updated.....';
                    $status = 'success';
                } else {
                    $data = 'Your Password not Updated. Please try after some time...';
                    $status = 'error';
                }
            } else {
                $data = 'Current Password is wrong. Please enter correct Current Password...';
                $status = 'error';
            }
        }
        return redirect()->back()->with(''.$status.'', $data);
    }
}
