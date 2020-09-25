<?php

namespace App\Http\Controllers\controls;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\PromoManager;

class promoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $data['promoinfo']=PromoManager::all();
        return view('controls/promotion')->with($data);
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
        $profile = new PromoManager;
        $dataupdate=array(
            'service_type'=>$request->input('service_type'),
            'promo_name'=>$request->input('promo_name'),
            'promo_code'=>$request->input('promo_code'),
            'discount_type'=>$request->input('discount_type'),
            'discount'=>$request->input('discount'),
            'promo_expire'=>$request->input('promo_expire'),
            'status'=>1
        );
        $profile->fill($dataupdate);
        $profile->save();
        return redirect()->back()->with('success','Updated');
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
    public function update($id,$status)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        if($action=='edit'){
            $profile = PromoManager::findOrFail($id);        
            $dataupdate=array(
                'discount_type'=>$request->input('discount_type'),
                'status'=>$request->input('status'),
                'discount'=>$request->input('discount'),
                'service_type'=>$request->input('service_type'),
                'promo_expire'=>$request->input('promo_expire')
            );
            $profile->fill($dataupdate);
            $profile->save(); 
            return response()->json(["message" => "Success","action" => "edit","id" => $id]);       
        }else{

        }
    }


    public function status($id,$status) {
        $profile = PromoManager::findOrFail($id);        
        $dataupdate=array(
            'status'=>$status
        );
        $profile->fill($dataupdate);
        $profile->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function promoUpdate() {
        $promo_list = PromoManager::get();
        echo '<pre>';print_r($promo_list);exit;

    }
}
