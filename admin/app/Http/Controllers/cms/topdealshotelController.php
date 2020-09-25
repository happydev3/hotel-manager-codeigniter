<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\model\TopDealsHotel;
use App\model\TopDeals; 
use App\model\FitruumsHotelDetails;
use File; 
class topdealshotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topdealshotel=TopDealsHotel::all();
        $data=array('topdealshotel'=>$topdealshotel,'code'=>'');
        return view('cms/topdeals/topdealshotel')->with($data);
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
                $topdealshotel=TopDeals::find($id);
                if(!empty($topdealshotel))
                {
                    $hotellist = (new TopDealsHotel)->newQuery();
                    $hotellist->where('topdealscode',$topdealshotel->id);
                    if(!$hotellist->get()->isEmpty())
                    { 
                        $data['topdealshotel']=$hotellist->get();
                        $data['code']=$id;
                        $data['topdeals']=$topdealshotel->name;
                        return view('cms/topdeals/topdealshotel')->with($data);
                    }
                    else
                    {   
                        $topdeals=TopDealsHotel::all();
                        $data=array('topdealshotel'=>$topdeals,'code'=>$id,'topdeals'=>$topdealshotel->name);
                        return view('cms/topdeals/topdealshotel')->with($data); 
                    }
              }
             else
             {   
                $topdealshotel=TopDealsHotel::all();
                $data=array('topdealshotel'=>$topdealshotel,'code'=>'','topdeals'=>'');
                return view('cms/topdeals/topdealshotel')->with($data); 
             }
         }
         else
         {
             redirect('cms/topdeals');
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
        $hotellist = (new TopDealsHotel)->newQuery();
        $hotellist->where('hotel_code',$hotelDetails[0]);
        $hotellist->where('city_code',$hotelDetails[3]);
        $hotellist->where('api',$hotelDetails[2]);
        if($hotellist->get()->isEmpty())
        {
            $profile = new TopDealsHotel;
            $dataupdate=array(
                'hotel_code'=>$hotelDetails[0],
                'hotel_name'=>$hotelDetails[1], 
                'api'=>$hotelDetails[2],
                'city_code'=>$hotelDetails[3],
                'city_name'=>$hotelDetails[4],
                'country'=>$hotelDetails[5],                
                'star'=>$hotelDetails[6],                
                'topdealscode'=>$hotelDetails[7],                
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
         
        $topdealshotel=TopDealsHotel::find($id);
        $data=array('topdealshotel'=>$topdealshotel);
        return view('cms/topdeals/topdealshoteledit')->with($data);
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
        // $profile = TopDealsHotel::findOrFail($id);        
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
        $topdealshotel = TopDealsHotel::find($id);
        $image=$topdealshotel->image;
        $topdealshotel->delete(); 
        File::delete(url($image));      
        return redirect()->back()->with('success','success'); 
    }
    public function getStatus($id,$status)
    {
       $profile = TopDealsHotel::findOrFail($id);        
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
            $topdealshotel=TopDeals::find($id); 
            if(!empty($topdealshotel))
            {         
            $hotellist = (new FitruumsHotelDetails)->newQuery();
            $hotellist->where('city', 'like', '%' .$search. '%');
            $hotellist->orWhere('country', 'like', '%' .$search. '%');
            $hotellist->orWhere('hotel_code', 'like', '%' .$search. '%');            
            $hotellist->orWhere('hotel_name', 'like', '%' .$search. '%');
            $hotellist->limit(20);
            $hotel_list=$hotellist->get();
           
              if (!empty($hotel_list)) 
                 {
                    for ($i = 0; $i < count($hotel_list); $i++)
                    {
                        $hotel = $hotel_list[$i]['hotel_name'] . '( fitruums - '.$hotel_list[$i]['hotel_code'].' ) '.$hotel_list[$i]['city'].', '.$hotel_list[$i]['country'];
                       $hotelid = $hotel_list[$i]['hotel_code'].'|'.$hotel_list[$i]['hotel_name'].'|fitruums|'.$hotel_list[$i]['city_code'].'|'.$hotel_list[$i]['city'].'|'.$hotel_list[$i]['country'].'|'.$hotel_list[$i]['classification'].'|'.$topdealshotel->id;
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
