<?php

namespace App\Http\Controllers\b2c\hotels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\ApiInfo;
use App\model\B2cMarkupInfo;
use App\model\ApiPermanentHotels;
use App\Http\Requests\b2c\hotels\MarkupRequest;

class markupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $data['apiinfo'] = ApiInfo::where('service_type',1)->get();
        $data['markup_info'] = B2cMarkupInfo::where('service_type',1)->get();

        $data['hotels_info'] = ApiPermanentHotels::all();
        // echo '<pre>';print_r($data['markup_info']);exit;
        return view('b2c/hotel/markuplist')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarkupRequest $request)
    {
        //echo '<pre>';print_r($_POST);exit;
        $markup = B2cMarkupInfo::where('api_name',$request->input('apiname'))->where('service_type',1);
        $markup->delete();


        $profile = new B2cMarkupInfo;
        $dataupdate=array(
            'service_type'=>1,
            'api_name'=>$request->input('apiname'),
            'hotel'=>$request->input('hotelname'),
            'markup_process'=>$request->input('markupprocess'),
            'markup'=>$request->input('markupvalue'),
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
    public function update(MarkupRequest $request)
    {
       $action=$request->input('action');
       $id=$request->input('id');
       if($action=='edit'){
         $profile = B2cMarkupInfo::findOrFail($request->input('id'));        
         $dataupdate=array(
            'markup_process'=>$request->input('markup_type'),
            'status'=>$request->input('status'),
            'markup'=>$request->input('markup_value')
        );
         $profile->fill($dataupdate);
         $profile->save(); 
         return response()->json(["message" => "Success","action" => "edit","id" => $id]);       
     }else{
        
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id=$request->input('id');
        $markup = B2cMarkupInfo::find($id);
        $markup->delete();        
        return response()->json(["message" => "Success","action" => "delete","id" => $id]);
    }
}
