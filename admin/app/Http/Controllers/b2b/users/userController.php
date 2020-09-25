<?php

namespace App\Http\Controllers\b2b\users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AgentInfo;
use App\model\Country;
use App\Http\Requests\b2b\user\UserRequest;
use App\Http\Requests\b2b\user\UserRequestedit;
use File;

class userController extends Controller
{
    
    public function index()
    {
        $data['users_info']=AgentInfo::all();
        return view('b2b/users/list')->with($data);
    }

  
    public function create()
    {
        $data['country_list']=Country::all();
        return view('b2b/users/add')->with($data);
    }

   
    public function store(UserRequest $request)
    {

        $profile = new AgentInfo;
        $password = password_hash($request->input('user_password'), PASSWORD_BCRYPT);
        $dataupdate=array(
            'agent_email'=>$request->input('agent_email'),
            'agent_type' => 1,
            'agent_password'=>$password,
            'title'=>$request->input('title'),
            'agent_no'=>date('ym').'VMNA'.rand(0000,1111),
            'agency_name'=>$request->input('agency_name'),
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'mobile_no'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'pin_code'=>$request->input('pin_code'),
            'city'=>$request->input('city'),
            'country'=>$request->input('country'),
        );
        $profile->fill($dataupdate);
        $profile->save();
        $id=$profile->id;
        $agent_email = $profile->agent_email;
        $this->uploadimage($request,$id,$agent_email);
        return redirect('b2b/users')->with('success','Updated');
    }

    public function edit($id)
    {
        $data['UsersInfo']=AgentInfo::find($id);
        $data['country_list']=Country::all();
        // $data['status']=2;
        // echo '<pre>';print_r($data['UsersInfo']);exit;
        return view('b2b/users/edit')->with($data);
    }


    public function update(UserRequestedit $request,$id)
    {         
        $profile = AgentInfo::findOrFail($id);        
        $dataupdate=array(
            'title'=>$request->input('title'),
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'mobile_no'=>$request->input('mobile_no'),
            'agency_name'=>$request->input('agency_name'),
            'address'=>$request->input('address'),
            'pin_code'=>$request->input('pin_code'),
            'city'=>$request->input('city'),
            'country'=>$request->input('country'),
        );
        $profile->fill($dataupdate);
        $profile->save();
        $agent_email = $profile->agent_email;
        $this->uploadimage($request,$id,$agent_email);
        return redirect()->back()->with('success','Updated');
    }

    public function change_password($id) {
        $data['UsersInfo'] = AgentInfo::find($id);
        // echo '<pre>'; print_r($data['UsersInfo']);exit;
        return view('b2b/users/change_password')->with($data);
    }

    public function password_update(PasswordRequestedit $request, $id) {
        $UsersInfo = AgentInfo::find($id);
        // $current_password = $request->input('cpassword');
        $new_password = $request->input('password');
        $passconf = $request->input('passconf');
        $old_password = $UsersInfo->agent_password;
        // echo '<pre>'; print_r($id);exit;
        if ($new_password != $passconf) {
            $data = 'New Password doesn\'t match to Confirm Password';
            $status = 'error';
        } else {
            if(password_verify($new_password, $old_password)===true) {
            // if (md5($new_password) != $old_password) {
                $password = array(
                    'agent_password' => password_hash($new_password, PASSWORD_BCRYPT)
                );
                $return = \DB::table('agent_info')
                    ->where('agent_id', $id)
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

    public function getStatus($id,$status)
    {
       $profile = AgentInfo::findOrFail($id);        
       $dataupdate=array(
        'status'=>$status
        );
       $profile->fill($dataupdate);
       $profile->save();
       return redirect()->back()->with('success','Updated');

   }

    public function uploadimage($request,$id,$email){
        $imgfolder_name = str_replace('.', '_', str_replace('@', '_', $email));
       if ($request->file('agency_logo')) {
            $file = $request->file('agency_logo');
            $destinationPath = 'public/uploads/b2b/'.$imgfolder_name;
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            // $fileName = $file->getClientOriginalName();
            $fileName = 'agent_logo.png';

            $file->move($destinationPath,$fileName);

            $profile = AgentInfo::findOrFail($id);        
            $dataupdate = array('agent_logo'=>$destinationPath.'/'.$fileName);
            $profile->fill($dataupdate);
            $profile->save();
        }
    }

    public function deposit() {
        $data['agent_acc_summary'] = Agent_acc_summary::where('status','Pending')->get();
        return view('b2b/users/deposits')->with($data);
    }

    public function deposit_approve($acc_id,$agent_no) {
        $data['agentno'] = $agent_no;
        $data['depositno'] = $acc_id;
        // $avail_bal = Agent_acc_summary::where('agent_no',$agent_no)->first();
        $avail_bal = Agent_acc_summary::where('agent_no',$agent_no)->orderBy('transaction_datetime', 'desc')->first();
        // $balance = $avail_bal->available_balance;
        $balance = isset($avail_bal->available_balance) ? $avail_bal->available_balance : 0;
        // $balance = empty($balance) ? 0 : $balance;
        // echo '<pre>';print_r($balance);exit;
        $data['available_balance'] = $balance;
        $data['deposite'] = Agent_acc_summary::where('acc_id',$acc_id)->where('status','Pending')->first();
        return view('b2b/users/approve_page')->with($data);
    }

    function approve_amount() {
        $agent_no = $_POST['agent_no'];
        $available_balance = empty($_POST['available_balance']) ? 0 : $_POST['available_balance'];
        $dep_amt = $_POST['dep_amt'];
        $depositno = $_POST['depositno'];
        $total = $available_balance + $dep_amt;
        $updata = array(
            "status" => "Accepted",
            "approve_date" => date("Y-m-d h:m:s", strtotime("now")),
            "available_balance" => $total,
        );
        // echo '<pre>';print_r($updata);exit;
        $agent_info = AgentInfo::where('agent_no',$agent_no)->first();
        $msgbody = 'Dear '.$agent_info->agency_name.',<br><br>Your Vacaymenow Account has been credited with USD '.$dep_amt.' on '.date('d-m-Y').' .<br><br>Thank you!';

        $data = array(
            'from_email' => 'booking@vacaymenow.com',
            'from_name' => 'Vacaymenow',
            'to_email' => $agent_info->agent_email,
            'to_name' => $agent_info->agency_name,
            'subject' => 'Your Vacaymenow Account has been Credited!',
            'msgbody' => $msgbody,
        );

        $this->sendEmail($data);
        Agent_acc_summary::where('acc_id',$depositno)->update($updata);
        return redirect('b2b/users/deposit')->with('success','Approved!');
    }

    public function deposit_decline($acc_id,$agent_no) {
        $updata = array(
            "status" => "Declined",
            "decline_date" => date("Y-m-d h:m:s", strtotime("now")),
        );
        // echo '<pre>';print_r($updata);exit;
        $deposite = Agent_acc_summary::where('acc_id',$acc_id)->where('status','Pending')->first();
        $agent_info = AgentInfo::where('agent_no',$agent_no)->first();

        $msgbody = 'Dear '.$agent_info->agency_name.',<br><br>
        Your deposit of USD '.$deposite->deposit_amount.' on '.date('d-m-Y').' for Vacaymenow Account has been declined. Kindly ensure that you enter the right amount and date of deposit before sending a request again. For any clarification, submit the deposit request and email us again at <a target="_blank" href="mailto:booking@vacaymenow.com">booking@vacaymenow.com</a> .<br><br>Thank you!';
        $data = array(
            'from_email' => 'booking@vacaymenow.com',
            'from_name' => 'Vacaymenow',
            'to_email' => $agent_info->agent_email,
            'to_name' => $agent_info->agency_name,
            'subject' => 'Your Vacaymenow Account has been Declined!',
            'msgbody' => $msgbody,
        );
        $this->sendEmail($data);
        Agent_acc_summary::where('acc_id',$acc_id)->update($updata);
        return redirect('b2b/users/deposit')->with('success','Declined!');
    }

    public function view_account_stmt($agent_id='') {   
        $data['agent_id'] = $agent_id;
        $data['agent_info'] = AgentInfo::where('agent_id',$agent_id)->first();
        $data['agent_acc_summary'] = Agent_acc_summary::where('agent_id',$agent_id)->orderby('acc_id','desc')->get();

        $data['available_balance'] = isset($data['agent_acc_summary']->available_balance) ? $data['agent_acc_summary']->available_balance : 0;
        // echo '<pre>';print_r($data['agent_acc_summary']);exit;
        return view('b2b/users/view_account_stmt')->with($data);
    }

    function update_transaction_info(UserRequestDeposit $request) {
        $data['agent_id'] = $agent_id = $request->input('agent_id');
        $agent_info = AgentInfo::where('agent_id',$agent_id)->first();
        // echo '<pre/>';print_r($_POST);exit;
        $transaction_type = $request->input('transaction_type');
        $amount = $request->input('amount');
        $value_date = $request->input('value_date');
        $transaction_mode = $request->input('transaction_mode');
        $bank = $request->input('bank'); 
        $branch = $request->input('branch');
        $city = $request->input('city');
        $transaction_id = $request->input('transaction_id');
        $remarks = $request->input('remarks');
        $agent_no = $agent_info->agent_no;
        $agency_name = $agent_info->agency_name;
        $agent_email = $agent_info->agent_email;

        $desc = 'Admin_'.$transaction_type.'-'.$transaction_mode . '-' . $transaction_id . ', ' . $bank;
        // $value_date = date('Y-m-d', strtotime($value_date));
        $value_date = Date('Y-m-d', strtotime(str_replace('/', '-', $value_date)));

        $avail_bal = Agent_acc_summary::where('agent_id',$agent_id)->orderBy('transaction_datetime', 'desc')->first();
        $balance = isset($avail_bal->available_balance) ? $avail_bal->available_balance : 0;

        $dep_amount = 0;$with_amount = 0;$status = '';$transactiontype = '';
        if ($transaction_type == 'deposit') {
            $dep_amount = $amount;
            $status = 'Accepted';
            $available_balance = $balance + $dep_amount;
            $transactiontype = 'credited';
        } else if ($transaction_type == 'withdraw') {
            $with_amount = $amount;
            $status='Accepted';
            $available_balance = $balance - $with_amount;
            $transactiontype = 'debited';
        }
        $datainsert = array(
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'transaction_summary' => $desc,
            'deposit_amount' => $dep_amount,
            'withdraw_amount' => $with_amount,
            'transaction_id' => $transaction_id,
            'bank' => $bank,
            'branch' => $branch,
            'city' => $city,
            'value_date' => $value_date,
            'remarks' => $remarks,
            'status'=>$status,
            'transaction_datetime'=> date("Y-m-d h:m:s", strtotime("now")),
            'available_balance'=>$available_balance
        );

        $profile = new Agent_acc_summary;
        $profile->fill($datainsert);
        $profile->save();
        $insert_id = $profile->acc_id;
        // echo '<pre/>';print_r($datainsert);exit;
        if($insert_id) {
            $msgbody = 'Dear '.$agency_name.',<br><br>Your Vacaymenow Account has been '.$transactiontype.' with USD '.$amount.' on '.date('d-m-Y').' .<br><br>Thank you!';
            $data = array(
                'from_email' => 'booking@vacaymenow.com',
                'from_name' => 'Vacaymenow',
                'to_email' => $agent_email,
                'to_name' => $agency_name,
                'subject' => 'Your Vacaymenow Account has been '.$transactiontype.'!',
                'msgbody' => $msgbody,
            );
            $this->sendEmail($data);
        } else{                
            $transactiontype = 'Permission Denied';
        } 
        return redirect('b2b/users/view_account_stmt/'.$agent_id)->with('success',$transactiontype);   
    }

    public function sendEmail($data) {
        
        try {
            \Mail::send([], [], function($message) use ($data) {

                $message->from($data['from_email'],$data['from_name']);
                // $message->to($data['to_email'], $data['to_name'])->subject($data['subject']);
                $message->to('abhishek@travelpd.com', $data['to_name'])->subject($data['subject']);

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
    }
}
