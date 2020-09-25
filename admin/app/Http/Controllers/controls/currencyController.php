<?php

namespace App\Http\Controllers\controls;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Currency;

class currencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $data['currencyinfo']=Currency::all();
        return view('controls/currency')->with($data);
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
    public function update($id,$status)
    {
      
    }
    public function status($id,$status) {
        $profile = Currency::findOrFail($id);        
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

    public function currencyUpdate() {
        $currency_list = Currency::all();
        $currency_val = $this->currencyImport();
        $quotes = isset($currency_val->quotes)?$currency_val->quotes:'';
        // echo '<pre>';print_r($quotes);exit;
        if(!empty($quotes)) {
            foreach ($quotes as $key => $value) {
                foreach($currency_list as $curlist) {
                    $currtype = explode('USD', $key);
                    $currencytype = $currtype[1];
                    $currency_code = $curlist->currency_code;
                    $currency_id = $curlist->currency_id;
                    $currency_val = $value;                       
                    if($currency_code == $currencytype && $currency_code != 'USD') { 
                       $profile = Currency::findOrFail($currency_id); 
                       $dataupdate['value'] = $currency_val;
                       $dataupdate['updated_datetime'] = Date('Y-m-d H:i:s');
                       $profile->fill($dataupdate);
                       $profile->save();
                    }
                }
            }
        }
        echo json_encode(array('msg'=>'success'));
    }

    public function currencyImport() {
       $request = "http://www.apilayer.net/api/live?access_key=3c4f611e156f2ff297aa5f84af975745&format=1";
        $httpHeader = array(
            "Accept-Language: en-us,en;q=0.5"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
        $response = curl_exec($ch);
        $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response);
        return $data;
       
    }
}
