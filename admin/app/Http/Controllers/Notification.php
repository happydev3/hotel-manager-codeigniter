<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\model\SupplierInfo;
use App\model\SupplierHotelInfo;
// use App\model\ApiPermanentHotels;

class notification extends Controller {

	public function notificationLists() {
        $data['notices'] = SupplierHotelInfo::where('notification_flag',1)->select('notification_time','supplier_id','hotel_name','hotel_code','notification_msg')->get();
        return view('notification')->with($data);
    }

    public function getSupplierNoticeCount(){
        $notifications = SupplierHotelInfo::where('notification_flag',1)->select('notification_time','supplier_id','hotel_name','hotel_code','notification_msg')->get();

        $total_note = count($notifications);
        // echo $total_note;
        // echo '<pre>';print_r($notifications);exit;
        $notes = '<li class="noti-header"><p>Notifications</p></li>';
        $noticeboard = '';
        $supp_id = 'list_pulse_';
		if($total_note>0){
			if($total_note>4) $totalnotes = 4;
			else $totalnotes = $total_note;
			for($j=0;$j<$total_note;$j++) {
				$supp_id = 'list_pulse_'.$notifications[$j]->supplier_id;
				$notification_msg = SupplierInfo::where('id', $notifications[$j]->supplier_id)->first()->supplier_name.' '.$notifications[$j]->notification_msg;
				if($total_note<4) {
		        	$notes .= '<li>
		                <a href="'.url('notification/lists').'" title="'.$notification_msg.'">
		                    <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
		                    <span>'.$notification_msg.'<br><small class="text-muted">'.time_elapsed_string($notifications[$j]->notification_time).' ('.$notifications[$j]->hotel_name.')</small></span>
		                </a>
		            </li>';
		        }

	            $noticeboard .= '<tr>
					<td width="10%">'.($j+1).'</td>
					<td width="10%"><label class="text text-info">Hotel</label></td>
					<td><b class="text text-success">'.$notification_msg.' <b class="text text-danger">'.$notifications[$j]->hotel_name.' ('.$notifications[$j]->hotel_code.')</b> - '.time_elapsed_string($notifications[$j]->notification_time).'</td>
				</tr>';
	        }
    	} else {
        	$notes .= '<li>
                <a><span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span><span style="top: 6px;position: relative;">No new notifications</span></a>
            </li>';

            $noticeboard .= '<tr><td colspan="100%">No Records found.</td></tr>';
        }
        if($total_note>4) {
        	$notes .= '<li>
                <p><a href="'.url('notification/lists').'" class="text-right">See all notifications</a></p>
            </li>';
        }
        $json_arr = array(
        	'supplier_id' => $supp_id,
        	'total_notice' => $total_note,
        	'notes' => $notes,
        	'noticeboard' => $noticeboard
        );
        echo json_encode($json_arr);
    }

}