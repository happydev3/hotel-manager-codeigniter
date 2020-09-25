<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\model\PopularHotel;
use App\model\PopularCityHotel;
use App\model\ApiPermanentHotels;
use File; 
class popularhotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularhotel=PopularHotel::all();
        $data=array('popularhotel'=>$popularhotel,'code'=>'');
        return view('cms/popularhotel/popularhotel')->with($data);
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

    public function add($id)
    {       
           if(isset($id))
            {
                // echo $id.'1233224';  
                $popularcityhotel=PopularCityHotel::find($id);
                if(!empty($popularcityhotel))
                {
                    $hotellist = (new PopularHotel)->newQuery();
                    $hotellist->where('city_code',$popularcityhotel->code);
                    if(!$hotellist->get()->isEmpty())
                    { 
                        $data['popularhotel']=$hotellist->get();
                        $data['code']=$id;
                        $data['cityname']=$popularcityhotel->name;
                        return view('cms/popularhotel/popularhotel')->with($data);
                    }
                    else
                    {   
                        $popularhotel=PopularHotel::all();
                        $data=array('popularhotel'=>$popularhotel,'code'=>$id,'cityname'=>$popularcityhotel->name);
                        return view('cms/popularhotel/popularhotel')->with($data); 
                    }
              }
             else
             {   
                $popularhotel=PopularHotel::all();
                $data=array('popularhotel'=>$popularhotel,'code'=>'','cityname'=>'');
                return view('cms/popularhotel/popularhotel')->with($data); 
             }
         }
         else
         {
             redirect('cms/popularcityhotel');
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $hotelDetails=explode('|',$request->input('name'));
        $hotellist = (new PopularHotel)->newQuery();
        $hotellist->where('hotel_code',$hotelDetails[0]);
        $hotellist->where('city_code',$hotelDetails[3]);
        $hotellist->where('api',$hotelDetails[2]);
        if($hotellist->get()->isEmpty())
        {
            $profile = new PopularHotel;
            $dataupdate=array(
                'hotel_code'=>$hotelDetails[0],
                'hotel_name'=>$hotelDetails[1], 
                'api'=>$hotelDetails[2],
                'city_code'=>$hotelDetails[3],
                'city_name'=>$hotelDetails[4],
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
           return redirect()->back()->with('warning',$hotelDetails[1].' Hotel is Already Exist');
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
         
        $popularhotel=PopularHotel::find($id);
        $data=array('popularhotel'=>$popularhotel);
        return view('cms/popularhotel/popularhoteledit')->with($data);
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
        // $profile = PopularHotel::findOrFail($id);        
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
        $popularhotel = PopularHotel::find($id);
        $image=$popularhotel->image;
        $popularhotel->delete(); 
        File::delete(url($image));      
        return redirect()->back()->with('success','success'); 
    }
    public function getStatus($id,$status)
    {
       $profile = PopularHotel::findOrFail($id);        
       $dataupdate=array(
        'status'=>$status
    );
       $profile->fill($dataupdate);
       $profile->save();
       return redirect()->back()->with('success','success');

   }

   

 

public function getHotelList($id)
{  
  if(isset($_GET['term'])&&$id!=''){          
            $return_arr = array();
            $search = $_GET['term']; 
            $popularcityhotel=PopularCityHotel::find($id); 
            if(!empty($popularcityhotel))
            {         
            $hotellist = (new ApiPermanentHotels)->newQuery();
            $hotellist->where('hotel_name', 'like', '%' .$search. '%');
            $hotellist->where('city_code', $popularcityhotel->code);
            $hotel_list=$hotellist->get();
           
              if (!empty($hotel_list)) 
                 {
                    for ($i = 0; $i < count($hotel_list); $i++)
                    {
                        $hotel = $hotel_list[$i]['hotel_name'] . '( ' . $hotel_list[$i]['api'].' - '.$hotel_list[$i]['hotel_code'].' )';
                       $hotelid = $hotel_list[$i]['hotel_code'].'|'.$hotel_list[$i]['hotel_name'].'|'.$hotel_list[$i]['api'].'|'.$hotel_list[$i]['city_code'].'|'.$popularcityhotel->name;
                        $return_arr[] = array(
                            'tag_value' => ucfirst($hotel),
                            'tag_id'=>$hotelid
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
