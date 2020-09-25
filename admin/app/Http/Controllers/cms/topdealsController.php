<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\TopDeals;
use File;
class topdealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topdeals=TopDeals::all();
        $data=array('topdeals'=>$topdeals);
        return view('cms/topdeals/topdeals')->with($data);
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
        $profile = new TopDeals;
        $dataupdate=array(
            'name'=>$request->input('name'),
            'description'=>$request->input('desription'),
            'status'=>1
        );
        $profile->fill($dataupdate);
        $profile->save();
        $id=$profile->id;
        $this->uploadimage($request,$id);
        return redirect()->back();
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
        $topdeals=TopDeals::find($id);
        $data=array('topdeals'=>$topdeals);
        return view('cms/topdeals/topdealsedit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = TopDeals::findOrFail($id);        
        $dataupdate=array(
            'name'=>$request->input('name'),
            'description'=>$request->input('desription'),
            'status'=>1
        );
        $profile->fill($dataupdate);
        $profile->save();
        $this->uploadimage($request,$id);
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
        $markup = TopDeals::find($id);
         $markup->delete();   
        return redirect()->back()->with('success','success'); 
    }
    public function getStatus($id,$status)
    {
       $profile = TopDeals::findOrFail($id);        
       $dataupdate=array(
        'status'=>$status
    );
       $profile->fill($dataupdate);
       $profile->save();
       return redirect()->back()->with('success','success');

   }

    public function uploadimage($request,$id){
       if ($request->file('topdealsimage')) {
        $file = $request->file('topdealsimage');
        $destinationPath = 'public/uploads/cms/topdeals/'.$id;
        File::makeDirectory($destinationPath, $mode = 0777, true, true);
        $file->move($destinationPath,$file->getClientOriginalName());
        $fileName = $file->getClientOriginalName();

        $profile = TopDeals::findOrFail($id);        
        $dataupdate=array('image'=>$destinationPath.'/'.$fileName);
        $profile->fill($dataupdate);
        $profile->save();
    }
}
}
