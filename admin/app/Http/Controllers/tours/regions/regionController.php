<?php

namespace App\Http\Controllers\tours\regions;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class regionController extends Controller
{

    public function index() {

    }
    public function country($id='') {
        $data['country_list'] = DB::table('holiday_country')->get();
        $data['continent_list'] = DB::table('holiday_continent')->get();
        $data['country_id'] = $id;
        // echo '<pre>';print_r($aa);exit;
        return view('tours/regions/country')->with($data);
    }
    public function updateCountry() {
        // echo '<pre>';print_r($_POST);exit;
        $data = array(
            'continent_id' => $_POST['continent_name'],
            'country_name' => $_POST['country_name'],
        );
        if(!empty($_POST['country_id'])){
            DB::table('holiday_country')->where('country_id', $_POST['country_id'])->update($data);
        } else{
            DB::table('holiday_country')->insert($data);
        }
        return redirect('tours/regions/country')->with('success', 'Updated');
    }
    public function state($id='') {
        $data['country_list'] = DB::table('holiday_country')->get();
        $data['state_id'] = '';
        $data['edit_state'] = (object)[];
        if(!empty($id)){
            $data['state_id'] = $id;
            $data['edit_state'] = DB::table('holiday_state')->where('state_id', $id)->first();
        }
        $data['state_list'] = DB::table('holiday_state')
                                    ->join('holiday_country', 'holiday_country.country_id', '=', 'holiday_state.country_id')
                                    ->get();
        // echo '<pre>w';print_r($data['edit_state']);exit;
        return view('tours/regions/state')->with($data);
    }
    public function updateState() {
        // echo '<pre>';print_r($_POST);exit;
        $data = array(
            'country_id' => $_POST['country_name'],
            'state_name' => $_POST['state_name']
        );
        if(!empty($_POST['state_id'])){
            DB::table('holiday_state')->where('state_id', $_POST['state_id'])->update($data);
        } else{
            DB::table('holiday_state')->insert($data);
        }
        return redirect('tours/regions/state')->with('success', 'Updated');
    }
    public function city($id='') {
        $data['state_list'] = DB::table('holiday_state')->get();
        $data['country_list'] = DB::table('holiday_country')->get();
        
        $data['city_list'] = DB::table('holiday_city')
                                    ->join('holiday_country', 'holiday_country.country_id', '=', 'holiday_city.country_id')
                                    ->join('holiday_state', 'holiday_state.state_id', '=', 'holiday_city.state_id')
                                    ->get();
        $data['city_id'] = $id;
        $data['edit_city'] = '';
        if(!empty($id)) {
            $data['edit_city'] = DB::table('holiday_city')->where('city_id', $id)->first();
        }
        // echo '<pre>';print_r($data['city_list']);exit;
        return view('tours/regions/city')->with($data);
    }

    public function updateCity() {
        // echo '<pre>';print_r($_POST);exit;
        $data = array(
            'country_id' => $_POST['country_name'],
            'state_id' => $_POST['state_name'],
            'city_name' => $_POST['city_name'],
        );
        if(!empty($_POST['city_id'])){
            DB::table('holiday_city')->where('city_id', $_POST['city_id'])->update($data);
        } else{
            DB::table('holiday_city')->insert($data);
        }
        return redirect('tours/regions/city')->with('success', 'Updated');
    }

    public function getStatus($city_id,$status) {
        if(!empty($city_id)) {
            $data = array(
                'status'=>$status
            );
            DB::table('holiday_city')->where('city_id', $city_id)->update($data);
            return redirect()->back()->with('success','Updated');
        }
        return redirect()->back()->with('success','Fail');
    }

}
