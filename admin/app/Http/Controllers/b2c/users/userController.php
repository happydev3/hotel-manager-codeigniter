<?php

namespace App\Http\Controllers\b2c\users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\UserInfo;
use App\model\Country;
use App\Http\Requests\b2c\user\UserRequest;
use App\Http\Requests\b2c\user\UserRequestedit;
use File;

class userController extends Controller
{
   
    public function index(Request $request)
    {          
        $data['users_info']=UserInfo::all();
        return view('b2c/users/list')->with($data);
    }

    public function create()
    {
        $data['country_list']=Country::all();
        return view('b2c/users/add')->with($data);
    }

    public function store(UserRequest $request)
    {
        $profile = new UserInfo;
        $password = password_hash($request->input('user_password'), PASSWORD_BCRYPT);
        $dataupdate=array(
            'user_email'=>$request->input('user_email'),
            'user_password'=>$password,
            'title'=>$request->input('title'),
            'user_no'=>date('ym').'VMNU'.rand(0000,1111),
            'first_name'=>$request->input('first_name'),
            'middle_name'=>$request->input('middle_name'),
            'last_name'=>$request->input('last_name'),
            'mobile_no'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'pin_code'=>$request->input('pin_code'),
            'city'=>$request->input('city'),
            'state' => $request->input('state'),
            'country'=>$request->input('country'),
            // 'currency_type' => 'INR',
        );
        $profile->fill($dataupdate);
        $profile->save();
        $id=$profile->id;
        // $user_email = $profile->user_email;
        // $this->uploadimage($request,$id,$user_email);
        return redirect('b2c/users')->back()->with('success','Updated');
    }

    public function edit($id)
    {
        $data['UsersInfo']=UserInfo::find($id);
        $data['country_list']=Country::all();
        // $data['status']=2;
        // echo '<pre>';print_r($data['UsersInfo']);exit;
        return view('b2c/users/edit')->with($data);
    }

    public function update(UserRequestedit $request,$id)
    {         
        $profile = UserInfo::findOrFail($id);
        $dataupdate=array(
            'title'=>$request->input('title'),
            'first_name'=>$request->input('first_name'),
            'middle_name'=>$request->input('middle_name'),
            'last_name'=>$request->input('last_name'),
            'mobile_no'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'pin_code'=>$request->input('pin_code'),
            'city'=>$request->input('city'),
            'state' => $request->input('state'),
            'country'=>$request->input('country'),
        );
        $profile->fill($dataupdate);
        $profile->save();
        // $user_email = $profile->user_email;
        // $this->uploadimage($request,$id,$user_email);
        return redirect()->back()->with('success','Updated');
    }

    public function getStatus($id,$status)
    {
       $profile = UserInfo::findOrFail($id);        
       $dataupdate=array(
            'status'=>$status
        );
       $profile->fill($dataupdate);
       $profile->save();
       return redirect()->back()->with('success','Updated');

   }

    public function email_subscribers() {
       $data['subscribers'] = \DB::table('email_subscribers')->get();      
       return view('b2c/users/subscribers')->with($data);
    }

    public function setStatus($id,$status,$table) {
        if(!empty($id)) {
            $data = array(
                'status'=>$status
            );
            \DB::table($table)->where('id', $id)->update($data);
            return redirect()->back()->with('success','Updated');
        }
        return redirect()->back()->with('warning','Fail');
    }

    public function uploadimage($request,$id,$user_email){
        $imgfolder_name = str_replace('.', '_', str_replace('@', '_', $user_email));
       if ($request->file('userprofile')) {
            $file = $request->file('userprofile');
            $destinationPath = 'public/uploads/b2c/'.$imgfolder_name;
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            // $fileName = $file->getClientOriginalName();
            $fileName = 'user_logo.png';
            $file->move($destinationPath,$fileName);
            $profile = UserInfo::findOrFail($id);        
            $dataupdate = array('profilepicture'=>$destinationPath.'/'.$fileName);
            $profile->fill($dataupdate);
            $profile->save();
        }
    }
}