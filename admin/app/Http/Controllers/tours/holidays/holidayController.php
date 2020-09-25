<?php

namespace App\Http\Controllers\tours\holidays;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use File;
use URL;
use App\Http\Requests\tours\holidays\HolidayRequest;
use App\Http\Requests\tours\holidays\ActivityRequest;
use App\Http\Requests\tours\holidays\MeetingRequest;

class holidayController extends Controller
{

    public function index() {

    }
    public function theme($id='') {
        $data['theme_list'] = DB::table('holiday_theme')->get();
        $data['theme_id'] = $id;
        // echo '<pre>';print_r($aa);exit;
        return view('tours/holidays/theme')->with($data);
    }
    public function updateTheme() {
        // echo '<pre>';print_r($data['theme_list']);exit;
        $data = array(
            'theme_name' => $_POST['theme_name'],
        );
        if(!empty($_POST['theme_id'])){
            DB::table('holiday_theme')->where('theme_id', $_POST['theme_id'])->update($data);
            $status = 'Updated';
        } else{
            DB::table('holiday_theme')->insert($data);
            $status = 'Added';
        }
        return redirect('tours/holidays/theme')->with('success', $status);
    }

    public function getThemeStatus($theme_id,$status) {
        if(!empty($theme_id)) {
            $data = array(
                'status'=>$status
            );
            DB::table('holiday_theme')->where('theme_id', $theme_id)->update($data);
            return redirect()->back()->with('success','Updated');
        }
        return redirect()->back()->with('success','Fail');
    }

    public function getHolidayStatus($holiday_id,$status) {
        // echo 1;exit;
        if(!empty($holiday_id)) {
            $data = array(
                'status'=>$status
            );
            DB::table('holiday_packages')->where('id', $holiday_id)->update($data);
            return redirect()->back()->with('success','Updated');
        }
        return redirect()->back()->with('success','Fail');
    }

    public function itinerary($id='') {
        $data['theme_list'] = DB::table('holiday_theme')->get();
        $data['holicitylist'] = DB::table('holiday_city')
                                    ->leftJoin('holiday_country', 'holiday_city.country_id', '=', 'holiday_country.country_id')
                                    ->get();

        // echo '<pre>';print_r($data['holicitylist']);exit;
        if(!empty($id)){
            $data['holiday_id'] = $id;
            $data['holiday_list'] = DB::table('holiday_packages')->where('id', $id)->first();
            $data['holiday_images'] = DB::table('holiday_images')->where('holiday_list_id', $id)->get();
            // echo '<pre>2';print_r($data['holiday_images']);exit;
            return view('tours/holidays/edit')->with($data);
        } else{
            $data['holiday_list'] = DB::table('holiday_packages')->get();
            return view('tours/holidays/add')->with($data);
        }
        
    }

    function addHoliday(HolidayRequest $request) {
        // echo '<pre>';print_r($request);exit;
        $holiday_id = $request->input('holiday_id');
        $package_title = $request->input('package_title');
        $package_code = $request->input('package_code');
        $destination = $request->input('desti');
        // $destination = implode(",", $desti);        
        // $continentid=array();
        // $countryid=array();
        // $stateid=array();
        // $i=$j=$k=0;
        // foreach($desti as $destcityid) {
            $continentStr = DB::table('holiday_city as hct')
                                ->join('holiday_country as hco', 'hct.country_id', '=', 'hco.country_id')
                                ->join('holiday_continent as hcn', 'hco.continent_id', '=', 'hcn.continent_id')
                                ->where('hct.city_id', $destination)->value('hcn.continent_id');

            $countryStr = DB::table('holiday_city')->where('city_id', $destination)->value('country_id');
            $stateStr = DB::table('holiday_city')->where('city_id', $destination)->value('state_id');
        // }
        // $continentStr=implode(",",array_unique($continentid));
        // $countryStr=implode(",",array_unique($countryid));
        // $stateStr=implode(",",array_unique($stateid)); 
        // $package_popularity = $request->input('package_popularity');
        $package_rating = $request->input('package_rating');
        $theme = $request->input('holiday_theme');
        $hol_theme = implode(",", $theme);
        // $category = $request->input('category');
        // $categoryarray = implode(",", $category);
        $duration = $request->input('duration');
        // $month = $request->input('month');
        // $montharray = implode(",", $month);
        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['checkIn'])));
        $end_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['checkOut'])));
        $short_desc = $request->input('short_desc');
        $package_desc=addslashes($request->input('package_desc'));
        $package_good=addslashes($request->input('additional_info'));
        // $comfort=addslashes($request->input('comfort'));
        // $quality=addslashes($request->input('quality'));
        // $luxury=addslashes($request->input('luxury'));
        $highlight=addslashes($request->input('highlight'));
        $inclusion = addslashes($request->input('inclusion'));
        $exclusion = addslashes($request->input('exclusion'));
        $price = $request->input('price_ad');
        $terms = $request->input('terms');

        $child_allowed = $request->input('child_allowed');
        $minChildAge = $request->input('minChildAge');
        $maxChildAge = $request->input('maxChildAge');
        $minAdultAge = $request->input('minAdultAge');
        $minPaxOperating = $request->input('minPaxOperating');
        $maxPaxOperating = $request->input('maxPaxOperating');

        $insertdata = array(
            'package_title'=>$package_title,
            'package_code'=>$package_code,
            // 'package_popularity'=>$package_popularity,
            'package_rating'=>$package_rating,
            'theme_id'=>$hol_theme,
            // 'category'=>$categoryarray,
            'destination'=>$destination,
            'continent'=>$continentStr,
            'country'=>$countryStr,
            'state'=>$stateStr,
            'duration'=>$duration,
            // 'month_dur'=>$montharray,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'short_desc'=>$short_desc,
            'package_desc'=>$package_desc,
            'package_good'=>$package_good,
            // 'comfort'=>$comfort,
            // 'quality'=>$quality,
            // 'luxury'=>$luxury,
            'highlights'=>$highlight,
            'inclusion'=>$inclusion,
            'exclusion'=>$exclusion,
            'price'=>$price,
            'terms'=>$terms,

            'child_allowed' => $child_allowed,
            'minChildAge' => $minChildAge,
            'maxChildAge' => $maxChildAge,
            'minAdultAge' => $minAdultAge,
            'minPaxOperating' => $minPaxOperating,
            'maxPaxOperating' => $maxPaxOperating,
            'status'=>1
        );
        // echo '<pre>';print_r($insertdata);exit;
        if(!empty($holiday_id)){
            // echo 1;exit;
            DB::table('holiday_packages')->where('id', $holiday_id)->update($insertdata);
            $this->uploadimage($request,$holiday_id);
        } else {
            // echo 2;exit;
            $id = DB::table('holiday_packages')->insertGetId($insertdata);
            $this->uploadimage($request,$id);
        }
        return redirect('tours/holidays/list')->with('success','Success');
        
    }

    public function uploadimage($request,$id){
       if ($request->file('thumb_image')) {
            $file = $request->file('thumb_image');
            $destinationPath = 'public/uploads/holidays/'.$id.'/thumbnail';
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            $file->move($destinationPath,$file->getClientOriginalName());
            $fileName = $file->getClientOriginalName();

            $dataupdate = array(
                'holiday_list_id'=>$id,
                'holiday_images'=>$destinationPath.'/'.$fileName,
                'img_type'=>1
            );
            // echo '<pre>';print_r($dataupdate);exit;
            DB::table('holiday_images')->insert($dataupdate);

        }
        if ($request->file('holiday_gallery_image')) {
            $file = $request->file('holiday_gallery_image');
            $destinationPath = 'public/uploads/holidays/'.$id.'/gallery';
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            // echo '<pre>';print_r($file);exit;
            for($i=0;$i<count($file);$i++){
                $file[$i]->move($destinationPath,$file[$i]->getClientOriginalName());
                $fileName = $file[$i]->getClientOriginalName();
                $dataupdate = array(
                    'holiday_list_id'=>$id,
                    'holiday_images'=>$destinationPath.'/'.$fileName,
                    'img_type'=>2
                );
                // echo '<pre>';print_r($dataupdate);exit;
                DB::table('holiday_images')->insert($dataupdate);
            }
        }
    }

    public function delete_image() {
        // print_r($_POST['holiid']);exit;
        $holiid=$_POST['holiid'];
        $imgid=$_POST['imgid'];
        if (!empty($imgid)) {
            $path = '';
            $res = DB::table('holiday_images')->where('holi_image_id', $imgid)->first();
            // print_r($res);//exit;
            $path .= $res->holiday_images;
            // echo $path;exit;
            unlink($path);
            DB::table('holiday_images')->where('holi_image_id', $imgid)->delete();
        }
        echo json_encode(array(
            'success' => 'success'
        ));
        die();
    }

    public function holidayList() {
        $data['holiday_list'] = DB::table('holiday_packages')->orderBy('id', 'desc')->get();
        return view('tours/holidays/list')->with($data);
    }

    function activities($id) {
        // echo '<pre>';print_r($id);exit;
        $data['holiday_id'] = $id;
        $data['holiday_list'] = DB::table('holiday_packages')->where('id', $id)->first();
        $data['activity_list'] = $activity_list = DB::table('holiday_activity')->where('holiday_id', $id)->orderBy('id', 'asc')->get();

        if(!empty($activity_list)){
            $data['total_acti'] = count($activity_list);
        } else{
             $data['total_acti'] = 1;
        }
        // echo '<pre>';print_r($data['activity_list']);exit;
        return view('tours/holidays/activities')->with($data);
    }

    function addActivity(ActivityRequest $request) {
        // echo '<pre>';print_r($request);exit;
        $holiday_id = $request->input('holiday_id');
        $activity_code = $request->input('activity_code');
        $activity_title = $request->input('activity_title');
        $operating_hours = $request->input('operating_hours');
        $duration = $request->input('duration');

        $pickup_location = $request->input('pickup_location');
        $pickup_time = $request->input('pickup_time');
        // $child_allowed_1 = $request->input('child_allowed_1');
        $minChildAge = $request->input('minChildAge');
        $maxChildAge = $request->input('maxChildAge');
        $minAdultAge = $request->input('minAdultAge');
        $minPaxOperating = $request->input('minPaxOperating');
        $maxPaxOperating = $request->input('maxPaxOperating');

        // $start_date = $request->input('start_date');
        // $end_date = $request->input('end_date');
        $price_adt = $request->input('price_adt');
        $price_chd = $request->input('price_chd');
        $price_sen = $request->input('price_sen');
        $activity_desc = $request->input('activity_desc');
        $cancel_policy = $request->input('cancel_policy');

        DB::table('holiday_activity')->where('holiday_id', $holiday_id)->delete();
        for($a=0;$a<count($activity_title);$a++){
            // $child_allowed = $child_allowed_.$a.[$a];
            // $ch = $a+1;
            // $child_allowed_str = "child_allowed_$ch";
            // $child_allowed = $request->input("$child_allowed_str");

            $insertdata = array(
                'activity_code'=>$activity_code,
                'holiday_id'=>$holiday_id,
                'activity_title'=>$activity_title[$a],
                'operating_hours'=>$operating_hours[$a],
                'duration'=>$duration[$a],

                'pickup_location' => $pickup_location[$a],
                'pickup_time' => $pickup_time[$a],
                // 'child_allowed' => $child_allowed,
                // 'minChildAge' => $minChildAge[$a],
                // 'maxChildAge' => $maxChildAge[$a],
                // 'minAdultAge' => $minAdultAge[$a],
                // 'minPaxOperating' => $minPaxOperating[$a],
                // 'maxPaxOperating' => $maxPaxOperating[$a],

                // 'start_date'=>date('Y-m-d', strtotime(str_replace('/', '-', $start_date[$a]))),
                // 'end_date'=>date('Y-m-d', strtotime(str_replace('/', '-', $end_date[$a]))),
                'price_adt'=>$price_adt[$a],
                'price_chd'=>$price_chd[$a],
                'price_sen'=>$price_sen[$a],
                'activity_desc'=>$activity_desc[$a],
                'cancel_policy'=>$cancel_policy[$a]
            );
            // echo '<pre>';print_r($insertdata);//exit;
            DB::table('holiday_activity')->insert($insertdata);
        }
        
        
        return redirect('tours/holidays/list')->with('success','Success');
        
    }

    function meeting_points($id) {
        // echo '<pre>';print_r($id);exit;
        $data['holiday_id'] = $id;
        $data['holiday_list'] = DB::table('holiday_packages')->where('id', $id)->first();
        $data['meeting_list'] = $meeting_list = DB::table('meeting_points')->where('holiday_id', $id)->orderBy('id', 'asc')->get();

        if(!empty($meeting_list)){
            $data['total_points'] = count($meeting_list);
        } else{
             $data['total_points'] = 1;
        }
        // echo '<pre>';print_r($data['meeting_list']);exit;
        return view('tours/holidays/meeting_points')->with($data);
    }

    function addMeetingPoints(MeetingRequest $request) {
        // echo '<pre>';print_r($request);exit;
        $holiday_id = $request->input('holiday_id');
        $pickup_location = $request->input('pickup_location');
        $pickup_type = $request->input('pickup_type');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        DB::table('meeting_points')->where('holiday_id', $holiday_id)->delete();
        for($a=0;$a<count($pickup_location);$a++){
            $insertdata = array(
                'holiday_id'=>$holiday_id,
                'pickup_location'=>$pickup_location[$a],
                'pickup_type'=>$pickup_type[$a],
                'latitude'=>$latitude[$a],
                'longitude'=>$longitude[$a],
            );
            // echo '<pre>';print_r($insertdata);exit;
            DB::table('meeting_points')->insert($insertdata);
        }
        return redirect('tours/holidays/list')->with('success','Success');
    }


}
