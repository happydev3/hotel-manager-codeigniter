<?php

namespace App\Http\Controllers\suppliers\users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\SupplierInfo;
use App\model\Country;
use App\Http\Requests\suppliers\user\SupplierRequest;
use App\Http\Requests\suppliers\user\SupplierRequestedit;
use App\Http\Requests\suppliers\user\PasswordRequestedit;
use File;
// use Mail;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {          
        // $usersinfo = (new SupplierInfo)->newQuery();
        // if($request->has('mobile')){
        //     $usersinfo->where('mobile_no',$request->input('mobile'));
        // }
        // if($request->has('email')){
        //     $usersinfo->where('supplier_email',$request->input('email'));
        // }
        // if($request->has('no')){
        //     $usersinfo->paginate($request->input('no'));
        // }
        // $data['supplier_info']=$usersinfo->get();
        $data['supplier_info']=SupplierInfo::all();
        return view('suppliers/users/list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country_list']=Country::all();
        return view('suppliers/users/add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $mod_permission = '';
        if(!empty($request->input('module_permission'))){
            $mod_permission = implode(',', $request->input('module_permission'));
        }
        $supplier_email = $request->input('supplier_email');
        $supplier_name = $request->input('supplier_name');
        $supplier_password = $request->input('supplier_password');
        $password = password_hash($supplier_password, PASSWORD_BCRYPT);
        $profile = new SupplierInfo;
        $dataupdate=array(
            'supplier_email'=>$supplier_email,
            'supplier_password'=>$password,
            'supplier_no'=> date('ym').'VMNS'.rand(0000,1111),
            'supplier_name'=>$request->input('supplier_name'),
            'title'=>$request->input('title'),
            'first_name'=>$request->input('first_name'),
            'middle_name'=>$request->input('middle_name'),
            'last_name'=>$request->input('last_name'),
            'module_permission'=>$mod_permission,
            'mobile_no'=>$request->input('mobile_no'),
            'office_phone_no'=>$request->input('office_phone_no'),
            'address'=>$request->input('address'),
            'pin_code'=>$request->input('pin_code'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'country'=>$request->input('country'),
        );
        // echo '<pre>';print_r($dataupdate);exit;
        $profile->fill($dataupdate);
        $profile->save();
        $insert_id = $profile->id;
        if($insert_id) {
            // $msgbody = 'Dear '.$supplier_name.',<br>We have created an account for you.<br>Thank you!';
            $dataemail = array(
                'from_email' => 'booking@vacaymenow.com',
                'from_name' => 'Vacaymenow',
                'to_email' => $supplier_email,
                'to_name' => $supplier_name,
                'company_name' => $supplier_name,
                'company_email' => $supplier_email,
                'company_pwd' => $supplier_password,
                'subject' => 'Welcome to Vacaymenow!',
                // 'msgbody' => $msgbody,
            );
            $this->sendEmail($dataemail);
            // $this->uploadimage($request,$insert_id);
        }
        return redirect('suppliers/users');
    }

    public function sendEmail($data) {
        try {
            \Mail::send('suppliers/users/partner_welcome_email', $data, function($message) use ($data) {

                $message->from($data['from_email'],$data['from_name']);
                $message->bcc('partner@vacaymenow.com',$data['from_name']);
                $message->to($data['to_email'], $data['company_name'])->subject($data['subject']);
                
                // $message->to('akgupta.nit@gmail.com', 'Abhishek Kumar')->subject('Welcome to Vacaymenow!');
                // $message->setBody($data['msgbody'], 'text/html');
                // if (\Mail::failures()) {
                //     // dd($message);
                //     echo '<br>fail<br>';dd(\Mail::failures());
                // } else {
                //     dd($message);
                //     echo 'in1';
                // }
            });
        } catch (\Swift_TransportException $e) {
            // dd($e->getMessage());
        }
    }

    /*public function sendEmail($data) {
        try {
            \Mail::send([], [], function($message) use ($data) {

                $message->from($data['from_email'],$data['from_name']);
                $message->to($data['to_email'], $data['to_name'])->subject($data['subject']);
                // $message->to('abhishek@travelpd.com', $data['to_name'])->subject($data['subject']);

                $message->setBody($data['msgbody'], 'text/html');

                // if (\Mail::failures()) {
                //     // dd($message);
                //     echo '<br>fail<br>';dd(\Mail::failures());
                // } else {
                //     echo 'in1';
                // }
            });
        } catch (\Swift_TransportException $e) {
            // dd($e->getMessage());
        }
    }*/


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
    public function edit($id) {
        $data['SupplierInfo']=SupplierInfo::find($id);
        $data['country_list']=Country::all();
        // $data['status']=2;
        // echo '<pre>';print_r($data['SupplierInfo']);exit;
        return view('suppliers/users/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequestedit $request,$id)
    {
        $mod_permission = '';
        if(!empty($request->input('module_permission'))){
            $mod_permission = implode(',', $request->input('module_permission'));
        }      
        $profile = SupplierInfo::findOrFail($id);        
        $dataupdate=array(
            'title'=>$request->input('title'),
            'supplier_name'=>$request->input('supplier_name'),
            'first_name'=>$request->input('first_name'),
            'middle_name'=>$request->input('middle_name'),
            'last_name'=>$request->input('last_name'),
            'module_permission'=>$mod_permission,
            'mobile_no'=>$request->input('mobile_no'),
            'office_phone_no'=>$request->input('office_phone_no'),
            'address'=>$request->input('address'),
            'pin_code'=>$request->input('pin_code'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'country'=>$request->input('country'),
        );
        $profile->fill($dataupdate);
        $profile->save();
        // $this->uploadimage($request,$id);
        return redirect()->back()->with('success','Updated');
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
    public function getStatus($id,$status) {
        $profile = SupplierInfo::findOrFail($id);        
        $dataupdate=array(
            'status'=>$status
        );
        $profile->fill($dataupdate);
        $profile->save();
        return redirect()->back()->with('success','success');
    }

    public function change_password($id) {
        $data['supplier_info'] = SupplierInfo::find($id);
        // echo '<pre>'; print_r($data['supplier_info']);exit;
        return view('suppliers/users/change_password')->with($data);
    }

    public function password_update(PasswordRequestedit $request, $id) {
        $supplier_info = SupplierInfo::find($id);
        // $current_password = $request->input('cpassword');
        $new_password = $request->input('password');
        $passconf = $request->input('passconf');
        $old_password = $supplier_info->supplier_password;
        // echo '<pre>'; print_r($id);exit;
        if ($new_password != $passconf) {
            $data = 'New Password doesn\'t match to Confirm Password';
            $status = 'error';
        } else {
            if(password_verify($new_password, $old_password)===true) {
                $password = array(
                    'supplier_password' => password_hash($new_password, PASSWORD_BCRYPT)
                );
                $return = \DB::table('supplier_info')
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
                $data = 'Password is wrong. Please enter correct password...';
                $status = 'error';
            }
        }
        return redirect()->back()->with(''.$status.'', $data);
    }

    public function uploadimage($request,$id){
        if ($request->file('supplier_logo')) {
            $file = $request->file('supplier_logo');
            $destinationPath = 'public/uploads/suppliers/'.$id;
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            $file->move($destinationPath,$file->getClientOriginalName());
            $fileName = $file->getClientOriginalName();

            $profile = SupplierInfo::findOrFail($id);        
            $dataupdate=array('supplier_logo'=>$destinationPath.'/'.$fileName);
            $profile->fill($dataupdate);
            $profile->save();
        }
    }

}