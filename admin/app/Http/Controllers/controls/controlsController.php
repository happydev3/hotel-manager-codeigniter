<?php

namespace App\Http\Controllers\controls;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller; 
use DB;
use File;

class controlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['popularCityHotel'] = DB::table('popularcities')->where('module_type', 1)->get();
        $data['popularCityVilla'] = DB::table('popularcities')->where('module_type', 2)->get();
        $data['popularCityTour'] = DB::table('popularcities')->where('module_type', 3)->get();
        return view('controls/popularcities')->with($data);
    }

    public function add() {
        $city_arr = explode('|', $_POST['name']);
        $popCity = DB::table('popularcities')
                    ->where('code', $city_arr[0])
                    ->where('module_type', $_POST['module_type'])
                    ->get();
        if(empty($popCity)) {
            $insertdata = array(
                'code'=>$city_arr[0],
                'name'=>$city_arr[1],
                'country'=>$city_arr[2],
                'module_type'=>$_POST['module_type'],
                'status' => 1
            );

            // echo '<pre>';print_r($insertdata);exit;
            $id = DB::table('popularcities')->insertGetId($insertdata);
            if(!empty($id)) {
                return redirect()->back()->with('success','Success');
            } else{
                return redirect()->back()->with('warning','Fail');
            }
        } else{
           return redirect()->back()->with('warning','City already present!'); 
        }
    }

    public function getStatus($id,$status) {
        if(!empty($id)) {
            $data = array(
                'status'=>$status
            );
            DB::table('popularcities')->where('id', $id)->update($data);
            return redirect()->back()->with('success','Updated');
        }
        return redirect()->back()->with('warning','Fail');
    }
 
    public function getCityList() {
        // echo '<pre>';print_r($_GET);exit;
        if (isset($_GET['term'])) {
            $return_arr = array();
            $search = $_GET['term'];          
            $city_list = DB::table('jamaican_city_list')
                        ->where('city_name', 'like', '%' .$search. '%')
                        ->orWhere('country_name', 'like', '%' .$search. '%')
                        ->limit(20)
                        ->get();
            

            // echo '<pre>';print_r($city_list);exit;
            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $city = $city_list[$i]->city_name . ', ' . $city_list[$i]->country_name;
                    $cityid = $city_list[$i]->id.'|'.$city_list[$i]->city_name.'|'.$city_list[$i]->country_name;
                    $return_arr[] = array(
                        'tag_value' => ucfirst($city),
                        'tag_id'=>$cityid
                    );
                }
            } else {
                $return_arr[] = array(
                    'tag_value' => "No Results Found",
                    'tag_id' => ""
                );
            }
        } else {
            $return_arr[] = array(
                'tag_value' => "No Results Found",
                'tag_id' => ""
            );
        }
        echo json_encode($return_arr);
    }

    public function getCityListTour() {
        // echo '<pre>';print_r($_GET);exit;
        if (isset($_GET['term'])) {
            $return_arr = array();
            $search = $_GET['term'];          
            $city_list = DB::table('holiday_city')
                        ->where('city_name', 'like', '%' .$search. '%')
                        ->limit(20)
                        ->get();
            
            // echo '<pre>';print_r($city_list);exit;
            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $country_name = DB::table('holiday_country')->where('country_id', $city_list[$i]->country_id)->value('country_name');
                    $city = $city_list[$i]->city_name . ', ' . $country_name;
                    $cityid = $city_list[$i]->city_id.'|'.$city_list[$i]->city_name.'|'.$country_name;
                    $return_arr[] = array(
                        'tag_value' => ucfirst($city),
                        'tag_id'=>$cityid
                    );
                }
            } else {
                $return_arr[] = array(
                    'tag_value' => "No Results Found",
                    'tag_id' => ""
                );
            }
        } else {
            $return_arr[] = array(
                'tag_value' => "No Results Found",
                'tag_id' => ""
            );
        }
        echo json_encode($return_arr);
    }

    public function banners($id='') {
        $data['editBanners'] = '';
        if(!empty($id)){
            $data['editBanners'] = DB::table('banners')->where('id', $id)->first();
        }
        $data['banners'] = DB::table('banners')->get();
        return view('controls/banners')->with($data);
    }

    public function addBanner(Request $request) {
        
        // echo '<pre>';print_r($result);exit;
        // if(empty($id)){
            $module_type = $request->input('module_type');
            $banner_id = $request->input('banner_id');

            $isCheck = DB::table('banners')->where('module_type', $module_type)->first();
            // echo '<pre>';print_r($isCheck);exit;
            if(!empty($isCheck) && empty($banner_id)) {
                return redirect()->back()->with('warning','Banner already present!'); 
            }
            
            $insertdata = array(
                'module_type'=>$module_type
            );
            if(empty(!$banner_id)) {
                DB::table('banners')->where('id', $banner_id)->update($insertdata);
                $insertId = $banner_id;
            } else {
                $insertId = DB::table('banners')->insertGetId($insertdata);
            }
            
            if(!empty($insertId)) {
                if($module_type == 1){
                    $module = 'Hotel';
                }elseif($module_type == 2){
                    $module = 'Villa';
                }elseif($module_type == 3){
                    $module = 'Tour';
                } else{
                    $module = 'All';
                }
                $destinationPath = 'public/uploads/banners/'.$module;
                $table_name = 'banners';
                $this->uploadimage($request,$insertId,$destinationPath,$table_name);
                return redirect()->back()->with('success','Success');
            } else{
                return redirect()->back()->with('warning','Fail');
            }
        /*}
        else {
            $banners = DB::table('banners')->where('id', $id)->first();
            if(!empty($banners)) {
                $updatedata = array(
                    'module_type'=>$module_type,
                    'status'=>1
                );

                $insertId = DB::table('banners')->insertGetId($updatedata);
                if(!empty($insertId)) {
                    if($module_type == 1){
                        $module = 'Hotel';
                    }elseif($module_type == 2){
                        $module = 'Villa';
                    }elseif($module_type == 3){
                        $module = 'Tour';
                    }
                    $this->uploadimage($request,$insertId,$module);
                    return redirect()->back()->with('success','Success');
                } else{
                    return redirect()->back()->with('warning','Fail');
                }
            } else{
               return redirect()->back()->with('warning','Fail');
            }
        }
        */
        
    }

    public function popularDestination($id='') {
        $data['editDeals'] = '';$data['popularCityHotel'] = '';
        if(!empty($id)){
            $data['editDeals'] = DB::table('popular_destination')->where('id', $id)->first();
            $data['popularCityHotel'] = DB::table('popularcities')->where('module_type', 1)->get();
        }
        $data['deals'] = DB::table('popular_destination')->get();
        return view('controls/popular_destination')->with($data);
    }

    public function addPopularDestination(Request $request) {
        $topic = $request->input('topic');
        $city_name = $request->input('city_name');
        $title = $request->input('title');
        $description = $request->input('description');
        $deal_id = $request->input('deal_id');
        $city_arr = explode('|', $city_name);

        $insertdata = array(
            'topic'=>'Today\'s Popular Destinations',
            'city_name'=>$city_name,
            'city_code'=>$city_arr[0],
            'city_name'=>$city_arr[1],
            'city_country'=>$city_arr[2],
            'title'=>$title,
            'description'=>$description,
            // 'status'=>1,
        );
        // echo '<pre>';print_r($insertdata);exit;
        if(empty(!$deal_id)) {
            DB::table('popular_destination')->where('id', $deal_id)->update($insertdata);
            $insertId = $deal_id;
        } else {
            $insertId = DB::table('popular_destination')->insertGetId($insertdata);
        }
        
        if(!empty($insertId)) {
            $destinationPath = 'public/uploads/popular_destination';
            $table_name = 'popular_destination';
            $this->uploadimage($request,$insertId,$destinationPath,$table_name);
            return redirect()->back()->with('success','Success');
        } else{
            return redirect()->back()->with('warning','Fail');
        }
    }

    public function topDeals($id='') {
        $data['editDeals'] = '';
        if(!empty($id)){
            $data['editDeals'] = DB::table('top_deals')->where('id', $id)->first();
        }
        $data['deals'] = DB::table('top_deals')->get();
        return view('controls/top_deals')->with($data);
    }

    public function addDeals(Request $request) {
        // echo '<pre>';print_r($result);exit;
        $topic = $request->input('topic');
        $url = $request->input('url');
        $title = $request->input('title');
        $description = $request->input('description');
        $deal_id = $request->input('deal_id');
        
        $insertdata = array(
            'topic'=>$topic,
            'url'=>$url,
            'title'=>$title,
            'description'=>$description,
            // 'status'=>1,
        );
        if(empty(!$deal_id)) {
            DB::table('top_deals')->where('id', $deal_id)->update($insertdata);
            $insertId = $deal_id;
        } else {
            $insertId = DB::table('top_deals')->insertGetId($insertdata);
        }
        
        if(!empty($insertId)) {
            $destinationPath = 'public/uploads/top_deals';
            $table_name = 'top_deals';
            $this->uploadimage($request,$insertId,$destinationPath,$table_name);
            return redirect()->back()->with('success','Success');
        } else{
            return redirect()->back()->with('warning','Fail');
        }
    }

    public function subscription($id='') {
        // $data['editSubs'] = DB::table('subscription')->where('id', 1)->first();
        // echo '<pre>'; print_r($data['editSubs']);exit;
        $array = array(
            'id' => '',
            'module_type' => '',
            'top_text' => '',
            'bottom_text' => '',
            'status' => '',
            'updated_at' => '',
            'created_at' => ''
        );
        $data['editSubs'] =  (object) $array;
        if(!empty($id)){
            $data['editSubs'] = DB::table('subscription')->where('id', $id)->first();
        }
        $data['subscription'] = DB::table('subscription')->get();
        return view('controls/subscription')->with($data);
    }

    public function addSubs(Request $request) {
        // echo '<pre>';print_r($result);exit;
        $top_text = $request->input('top_text');
        $bottom_text = $request->input('bottom_text');
        $module_type = $request->input('module_type');
        $subs_id = $request->input('subs_id');
        $insertdata = array(
            'top_text'=> trim($top_text),
            'bottom_text'=> trim($bottom_text),
            // 'module_type'=>$module_type,
        );
        $insertId = '';
        if(empty(!$subs_id)) {
            DB::table('subscription')->where('id', $subs_id)->update($insertdata);
            $insertId = $subs_id;
        } else {
            // $insertId = DB::table('subscription')->insertGetId($insertdata);
        }
        
        if(!empty($insertId)) {
            return redirect()->back()->with('success','Success');
        } else{
            return redirect()->back()->with('warning','Fail');
        }
    }

    public function addDiscounts(Request $request) {
        // echo '<pre>';print_r($request->input('module'));exit;
        $discount_type = trim($request->input('discount_type'));
        $discount_value = trim($request->input('discount_value'));
        $upd_data = array(
            'discount_type'=> trim($request->input('discount_type')),
            'discount_value'=> trim($request->input('discount_value')),
        );
        $module_type = trim($request->input('module'));
        $codes = explode(',', $request->input('codes'));
        if(!empty($codes[0])) {
            if($module_type == 'hotel') {
                for($c=0; $c<count($codes); $c++) {
                    DB::table('supplier_hotel_list')->where('hotel_code', $codes[$c])->update($upd_data);
                }
            } elseif($module_type == 'villa') {
                for($c=0; $c<count($codes); $c++) {
                    DB::table('villa_list')->where('property_code', $codes[$c])->update($upd_data);
                }
            } elseif($module_type == 'tour') {
                for($c=0; $c<count($codes); $c++) {
                    DB::table('holiday_packages')->where('package_code', $codes[$c])->update($upd_data);
                }
            } else{
                return redirect()->back()->with('success','Fail');
            }
        } else{
            return redirect()->back()->with('success','Fail');
        }
        return redirect()->back()->with('success','Success');
        
    }

    public function setStatus($id,$status,$table) {
        if(!empty($id)) {
            $data = array(
                'status'=>$status
            );
            DB::table($table)->where('id', $id)->update($data);
            return redirect()->back()->with('success','Updated');
        }
        return redirect()->back()->with('warning','Fail');
    }

    public function deleteStatus($id,$table) {
        if(!empty($id)) {
            DB::table($table)->where('id', $id)->delete();
            return redirect()->back()->with('success','Deleted');
        }
        return redirect()->back()->with('warning','Fail');
    }

    public function uploadimage($request,$id,$destinationPath,$table_name){
        if ($request->file('banner_image')) {
            $data = $request->all();
            $fileUpload = $data['banner_image'];
            $originalFileName = $fileUpload->getClientOriginalName();
            \Storage::disk('uploads')->put($originalFileName, file_get_contents($fileUpload));

            // $file = $request->file('banner_image');
            // File::makeDirectory($destinationPath, $mode = 0777, true, true);
            // $file->move($destinationPath,$file->getClientOriginalName());
            // $originalFileName = $file->getClientOriginalName();

            $result = DB::table($table_name)->where('id', $id)->first();   
            $dataupdate = array('banner_path'=>$destinationPath.'/'.$originalFileName);
            DB::table($table_name)->where('id', $id)->update($dataupdate);

            s3Upload($destinationPath.'/'.$originalFileName);
            // unset($file);
            // unlink($destinationPath.'/'.$fileName);
        }
    }


}
