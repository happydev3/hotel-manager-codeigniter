<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\model\PopularCityHotel;
use App\model\FitruumsCityList;
use File; 
class popularcityhotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularcityhotel=PopularCityHotel::all();
        $data=array('popularcityhotel'=>$popularcityhotel);
        return view('cms/popularhotel/popularcityhotel')->with($data);
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
        $cityDetails=explode('|',$request->input('name'));
        $citylist = (new PopularCityHotel)->newQuery();
        $citylist->where('code',$cityDetails[0]);
        if($citylist->get()->isEmpty())
        {
            $profile = new PopularCityHotel;
            $dataupdate=array(
                'code'=>$cityDetails[0],
                'name'=>$cityDetails[1],
                'country'=>$cityDetails[2],
                'status'=>1
            );
            $profile->fill($dataupdate);
            $profile->save();
            // $id=$profile->id;
            // $this->uploadimage($request,$id);
            return redirect()->back();
      }
      else
      {
           return redirect()->back()->with('warning',$cityDetails[1].' City is Already Exist');
      }
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
         
        $popularcityhotel=PopularCityHotel::find($id);
        $data=array('popularcityhotel'=>$popularcityhotel);
        return view('cms/popularhotel/popularcityhoteledit')->with($data);
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
        // $profile = PopularCityHotel::findOrFail($id);        
        // $dataupdate=array(
        //     'description'=>$request->input('desription'),
        //     'status'=>1
        // );
        // $profile->fill($dataupdate);
        // $profile->save();
        // $this->uploadimage($request,$id);
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
        $popularcityhotel = PopularCityHotel::find($id);
        $image=$popularcityhotel->image;
        $popularcityhotel->delete(); 
        File::delete(url($image));      
        return redirect()->back()->with('success','success'); 
    }
    public function getStatus($id,$status)
    {
       $profile = PopularCityHotel::findOrFail($id);        
       $dataupdate=array(
        'status'=>$status
    );
       $profile->fill($dataupdate);
       $profile->save();
       return redirect()->back()->with('success','success');

   }

    public function uploadimage($request,$id){
       if ($request->file('popularcityhotelimage')) {
        $file = $request->file('popularcityhotelimage');
        $destinationPath = 'public/uploads/cms/popularhotel/'.$id;
        File::makeDirectory($destinationPath, $mode = 0777, true, true);
        $file->move($destinationPath,$file->getClientOriginalName());
        $fileName = $file->getClientOriginalName();

        $profile = PopularCityHotel::findOrFail($id);        
        $dataupdate=array('image'=>$destinationPath.'/'.$fileName);
        $profile->fill($dataupdate);
        $profile->save();
    }
}

 

public function getCityList()
{  
  if (isset($_GET['term'])){          
            $return_arr = array();
            $search = $_GET['term'];          
            $citylist = (new FitruumsCityList)->newQuery();
            $citylist->where('cityname', 'like', '%' .$search. '%');
            $citylist->orWhere('countryname', 'like', '%' .$search. '%');
            $city_list=$citylist->get();
           
              if (!empty($city_list)) 
                 {
                    for ($i = 0; $i < count($city_list); $i++)
                    {
                        $city = $city_list[$i]['cityname'] . ', ' . $city_list[$i]['countryname'];
                        $cityid = $city_list[$i]['cityid'].'|'.$city_list[$i]['cityname'].'|'.$city_list[$i]['countryname'];
                        $return_arr[] = array(
                            'tag_value' => ucfirst($city),
                            'tag_id'=>$cityid
                        );
                    }
                  }         
                else 
                {
                    $return_arr[] = array(
                        'tag_value' => "No Results Found",
                        'tag_id' => ""
                    );
                }
            }
            else 
            {
                $return_arr[] = array(
                    'tag_value' => "No Results Found",
                    'tag_id' => ""
                );
            }
            /* Toss back results as json encoded array. */
            echo json_encode($return_arr);
 } 
}
