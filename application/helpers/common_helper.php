<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('s3Upload')) {
	function s3Upload($tar_file='',$s3_name='vacaymenow.com') {
        if($tar_file!=''){
    	    $seg = explode("/", $tar_file);
    	    $bucket = $s3_name;
    	    $file_name = basename($tar_file);
    	    // $file_path = $seg[1]."/".$file_name;
    	    $file_path = $tar_file;
    	    // echo $tar_file;
    	    // exit;
    	    $content_type = mime_content_typealways($file_name);
    	    if(is_array($content_type)){
    	        $content_type = $content_type[0];
    	    }
    	    $file_resource = fopen($tar_file, 'r');
    	    $key = $file_path;
    	    try{
    	        //Create a S3Client
                $CI =& get_instance();
                $CI->load->library('aws');
    	        $credentials = $CI->aws->getAwsCred();
    	        $s3Client = new Aws\S3\S3Client($credentials);
    	        $params = [
    	            'Bucket'        => $bucket,
    	            'Key'           => $key,
    	            'Body'          => $file_resource,
    	            'ContentType'   => $content_type,
    	        ];
    	        $result = $s3Client->putObject($params);
    	        fclose($file_resource);
    	        unlink(base_url().'public/uploads/'.$file_name);
    	        return 1;
    	    } catch (S3Exception $e) {
    	        return $e->getMessage() . "\n";
    	    }          
        } else {
            return 0;
        }
	}
}

if(!function_exists('get_image_aws')) {
	function get_image_aws($file_name='',$s3_name='vacaymenow.com') {
        if($file_name!=''){
    	    try {
                $CI =& get_instance();
                $CI->load->library('aws');
                $credentials = $CI->aws->getAwsCred();
    	        $s3Client = new Aws\S3\S3Client($credentials);
    	        // Get the object.
    	        $cmd = $s3Client->getCommand('GetObject', [
    	            'Bucket' => $s3_name,
    	            'Key'    => $file_name
    	        ]);
    	    
    	        $request = $s3Client->createPresignedRequest($cmd, '+5   minutes');
    	        $presignedUrl = (string) $request->getUri();
    	        return $presignedUrl;
    	    } catch (S3Exception $e) {
    	        echo $e->getMessage() . PHP_EOL;
    	    }
        } else {
            return '';
        }
	}
}

function getLogoImage($filename) {
    return getCloudfrontImage($filename, ["width" => 206, "height" => 54, "fit" => "outside"]);
}

function getLandingPageBackgroundImage($filename) {
    return getCloudfrontImage($filename, ["width" => 1500, "height" => 848, "fit" => "outside"]);
}

function getResultsThumbnail($filename) {
    return getCloudfrontImage($filename, ["width" => 257, "height" => 257, "fit" => "cover"]);
}

function getPopularDestinationImage($filename) {
    return getCloudfrontImage($filename, ["width" => 372, "height" => 209, "fit" => "cover"]);
}

function getRoomsThumbnail($filename) {
    return getCloudfrontImage($filename, ["width" => 160, "height" => 90, "fit" => "cover"]);
}

function getRoomsImage($filename) {
    return getCloudfrontImage($filename, ["height" => 798, "fit" => "outside"]);
}

function getNearbyHotelImage($filename) {
    return getCloudfrontImage($filename, ["width" => 351, "height" => 200, "fit" => "cover"]);
}

function getGalleryImage($filename) {
    return getCloudfrontImage($filename, ["width" => 992, "height" => 657, "fit" => "cover"]);
}

function getHolidayGalleryImage($filename) {
    return getCloudfrontImage($filename, ["width" => 654, "height" => 420, "fit" => "cover"]);
}

function getHolidayGalleryThumbnail($filename) {
    return getCloudfrontImage($filename, ["width" => 156, "height" => 90, "fit" => "cover"]);
}

function getAmenitiesIcon($filename) {
    return getCloudfrontImage($filename, ["width" => 24, "height" => 24, "fit" => "cover"]);
}

function getCloudfrontImage($filename, $resize = []) {
    $resizeDefaults = [
        "width" => 200,
        "fit" => "inside"
    ];
    $options = [
        "resize" => array_merge($resizeDefaults, $resize),
        "normalise" => true,
    ];
    $config = [
        "bucket" => "vacaymenow.com",
        "key" => $filename,
        "edits" => $options
    ];
    return sprintf('https://d1b2szyitz6nlt.cloudfront.net/%s', base64_encode(json_encode($config, JSON_UNESCAPED_SLASHES)));
}

if(!function_exists('mime_content_typealways')) {
	function mime_content_typealways($filename) {

        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            'csv' => array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'),
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc'	=>	array('application/msword', 'application/vnd.ms-office','text/plain'),
	        'docx'	=>	array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip','text/plain'),
            'rtf' => 'application/rtf',
            'xls' => array('application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/x-xls', 'application/excel', 'application/download', 'application/vnd.ms-office', 'application/msword'),
            'xlsx' => array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
            'ppt' => 'application/vnd.ms-powerpoint',
            'xlsb'=>'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
            'xlsm'=>'application/vnd.ms-excel.sheet.macroEnabled.12',
            'xlam'=>'application/vnd.ms-excel.addin.macroEnabled.12',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
        $exploded = explode('.', $filename);
        $array_pop = array_pop($exploded);
        $ext = strtolower($array_pop);
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }
}

if(!function_exists('checkLogin')) {
    function checkLogin(){
        $CI =& get_instance();
        if ($CI->session->userdata('user_logged_in')){
            $arr = array(
                'is_logged' => true,
                'logged_class' => 'loggedin',
                'logged_eye' => 'logged_show',
            );
        } else {
            $arr = array(
                'is_logged' => false,
                'logged_class' => 'loggedout',
                'logged_eye' => 'logged_hide',
            );
        }
        return $arr;
    }
}

if(!function_exists('currencyChange')) {
    function currencyChange($from, $to='USD', $amount){
        // $CI =& get_instance();
        // $from = 'USD';
        // $set_currency = $CI->session->userdata('default_currency');
        // $set_curr_val = $CI->session->userdata('currency_val');
        $flag=1;
        if($from != 'USD'){
            $ROE = getROE($from);
            $raw_amt = $amount*$ROE;
            $format_amt = number_format($raw_amt,2);
            $currency_icon = '$';
        } else{
            $raw_amt = $amount;
            $format_amt = number_format($raw_amt);
            $currency_icon = '$';
        }
        return array(
            'raw_amt' => $raw_amt,
            'format_amt' => $format_amt,
            'currency_icon' => $currency_icon,
            'amount_rep' => $currency_icon.' '.$format_amt,
        );
    }
}

if(!function_exists('getROE')) {
    function getROE($from, $to='USD', $ROE=1){
        if($from != 'USD'){
            $CI =& get_instance();
            $CI->db->select('value as from_val');
            $CI->db->from('currency');
            $CI->db->where('currency_code', $from);
            $CI->db->limit('1');
            $query = $CI->db->get();
            if ($query->num_rows() > 0) {
                $res = $query->row();
                $from_curr = $res->from_val;
            } else {
                $from_curr = 0;
            }
            $CI->db->select('value as to_val');
            $CI->db->from('currency');
            $CI->db->where('currency_code', $to);
            $CI->db->limit('1');
            $query1 = $CI->db->get();
            if ($query1->num_rows() > 0) {
                $res1 = $query1->row();
                $to_curr = $res1->to_val;
            } else {
                $to_curr = 0;
            }
            $ROE = ($to_curr / $from_curr) * $ROE;
        } else {
            $ROE = 1;
        }
        return $ROE;
    }
}

if(!function_exists('dicountCalculation')) {
    function dicountCalculation($amount,$discount_value,$type){
        // $ROE = getROE($from);
        $discount = 0;
        if($type==2) {
            if($discount_value > 0){
                $discount = ($amount*$discount_value)/100;
            }
        } else {
            $discount = $discount_value;
        }
        return $discount;
    }
}

if(!function_exists('getRoomsPromotion')) {
    function getRoomsPromotion($total_cost,$nights=1,$promo_data=array(),$admin_data=array(),$taxes=0,$search_idss='') {
        $CI =& get_instance();
        $promo_id = $promo_data['promo_id'];
        $room_code = $promo_data['room_code'];
        $checkIn = $promo_data['checkIn'];
        $checkOut = $promo_data['checkOut'];
        if($promo_id!=''){
            $promotions = getPromoByPromoId($promo_id,$checkIn,$checkOut);
        } else {
            $promotions = getPromoByRoomCode($room_code,$checkIn,$checkOut);
        }
        // $promotions = $result;
        // echo '<pre>';print_r($promo_id);//exit;
        // echo '<pre>sss';print_r($promotions);exit;
        $discount_badge=''; $disc_msg=''; $disc_msg2=''; $supplier_discount=0; $promo_href = '';
        $total_discount=0; $org_cost_class=''; $disc_cost_class='';
        $promo_parent_class=''; $audience='public'; $admin_discount=0; $target='';

        if($admin_data != '' && $admin_data['discount_value'] > 0) {
            $admin_discount = $admin_data['discount_value'];
            $discount_type = $admin_data['discount_type'];
            if($discount_type==2){
              $disc_msg = $admin_data['member_discount'].'% off';
            } else {
              $disc_msg = '$'.$admin_data['member_discount'].' off';
            }
            $data_type = 'member';
            $audience = 'private';
        } else {
            if(!empty($promotions) && $promotions != '') {
                $promo_id = $promotions->id;
                $audience = $promotions->promo_audience;
                $discount = $promotions->discount;
                $supplier_discount = ($total_cost*$discount)/100;
                $data_type = 'promotions';
                $promo_href = 'promo_href';
                $disc_msg = $discount.'% off';

                $disc_msg2 = 'This property has a discount of '.$discount.'% or more on some rooms from '.date('M. d', strtotime($promotions->fromdate)).' to '.date('M. d', strtotime($promotions->todate));
            }
        }
        // echo '<pre>';print_r($promotions);//exit;
        // echo '<pre>';print_r($supplier_discount);//exit;
        $member_discount = $supplier_discount+$admin_discount;
        if (!$CI->session->userdata('user_logged_in')){
            if($audience == 'private') {
                $target = '#modalLogin';
                $member_discount = 0;
                // $total_discount = 0;
                $disc_msg = 'Member Price Available';
            }
        }

        $total_discount = $supplier_discount+$admin_discount;
        // echo '<pre>';print_r($supplier_discount);//exit;
        // echo '<pre>';print_r($admin_discount);//exit;
        // echo '<pre>';print_r($total_discount);exit;
        $member_cost = round(($total_cost-$member_discount)/$nights);
        $disc_cost = round(($total_cost-$total_discount)/$nights);
        $org_cost = round($total_cost/$nights);

        if($total_discount > 0) {
            $discount_badge = '<a href="javascript:void(0)" data-toggle="modal" data-target="'.$target.'" class="member_href '.$promo_href.'" data-searchid="'.$search_idss.'" data-type="'.$data_type.'" style="color: #fff;text-decoration: none;" promo-night="'.$nights.'">'.$disc_msg.'</a>';
        }

        $discountbadge = '';$disc_msgs = '';
        if($discount_badge != '') {
            if($disc_msg2 != '') {
                $disc_msgs = '<div class="pop-content from-right-top"><p>'.$disc_msg2.'</p></div>';
            }
            $discountbadge = '<div class="pophover2"><label class="badge badge-offer pop-i">'.$discount_badge.'</label>'.$disc_msgs.'</div>';
        }
        $org_price_div = '';
        if($org_cost > $member_cost){
            $org_price_div = '<small class="org_cost_div" style="text-decoration: line-through;"><i class="fa fa-dollar"></i> <span class="org_cost_amt">'.number_format($org_cost,2).'</span> USD</small>';
        }
        // echo '<pre>sss';print_r($supplier_discount);exit;
        return array(
            'org_cost' => $org_cost,
            'disc_cost' => $disc_cost,
            'total_discount' => $total_discount,
            'discount' => $member_discount,
            'discount_badge' => $discountbadge,
            'member_cost' => $member_cost,
            'total_cost' => $member_cost,
            'member_discount' => $member_discount,
            'disc_msg' => $disc_msgs,
            'org_price_div' => $org_price_div,
            'promo_id' => $promo_id,
            'taxes' => $total_taxes,
        );
    }

    function getPromoByRoomCode($room_code,$checkIn,$checkOut) {
        $CI =& get_instance();
        // $cin = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));
        // $cout = date('Y-m-d', strtotime(str_replace('/', '-', $checkOut)));
        $nights = dateDifference($checkIn, $checkOut);

        $sql = "SELECT *,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y') AS `fromdate`,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y') AS `todate`  FROM promotion_ota WHERE status=1 AND FIND_IN_SET(?,room_code) AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y')<=? AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y')>=? AND minimum_night <=? ORDER BY discount ASC";
        $query = $CI->db->query($sql,[$room_code,$checkIn,$checkOut,$nights]);
        // echo $CI->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function getPromoByPromoId($promo_id,$checkIn='',$checkOut='') {
        $CI =& get_instance();

        if($checkIn != '' && $checkOut != '') {
            // $cin = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));
            // $cout = date('Y-m-d', strtotime(str_replace('/', '-', $checkOut)));
            $nights = dateDifference($checkIn, $checkOut);
            $sql = "SELECT *,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y') AS `fromdate`,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y') AS `todate`  FROM promotion_ota WHERE status=1 AND id=? AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y')<=? AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y')>=? AND minimum_night <=? ORDER BY discount ASC";
            $query = $CI->db->query($sql,[$promo_id,$checkIn,$checkOut,$nights]);
        } else {
            $sql = "SELECT *,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y') AS `fromdate`,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y') AS `todate` AND minimum_night >=? FROM promotion_ota WHERE id=?";
            $query = $CI->db->query($sql,[$promo_id]);
        }
            
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function dateDifference($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
}
?>