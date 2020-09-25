<?php
if (!function_exists('s3Upload')) {
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
            // $file_resource = fopen($tar_file, 'r');
    	    $file_resource = fopen(public_path().'/uploads/'.$file_name, 'r');
    	    $key = $file_path;
    	    try{
    	        //Create a S3Client
    	        $credentials = getAwsCred();
    	        $s3Client = new Aws\S3\S3Client($credentials);
    	        $params = [
    	            'Bucket'        => $bucket,
    	            'Key'           => $key,
    	            'Body'          => $file_resource,
    	            'ContentType'   => $content_type,
    	        ];
    	        $result = $s3Client->putObject($params);
    	        fclose($file_resource);
    	        unlink(public_path().'/uploads/'.$file_name);
    	        return 1;
    	    } catch (S3Exception $e) {
    	        return $e->getMessage() . "\n";
    	    }          
    	} else {
            return 0;
        }
    }
}

if (!function_exists('get_image_aws')) {
	function get_image_aws($file_name,$s3_name='vacaymenow.com') {
        if($file_name!=''){
    	    try {
    	        $credentials = getAwsCred();
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

if (!function_exists('getAwsCred')) {
	function getAwsCred(){
    	$cred = new Aws\Credentials\Credentials(env('OBJECT_STORAGE_KEY', 'AKIA3NGXKBBPWLE7CMGP'), env('OBJECT_STORAGE_SECRET', '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'));
        $credentials = [
			'version'     => 'latest',
			'region'      => env('OBJECT_STORAGE_REGION', 'us-east-2'),
			'credentials' => $cred
    	];
        return $credentials;
    }
}

if (!function_exists('mime_content_typealways')) {
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

if (!function_exists('getSupplierNotice')) {
    function getSupplierNotice(){
        $supplier_info = App\model\SupplierInfo::where('notification_flag',1)->count(['notification_flag']);
        return $supplier_info;
    }
}

if (!function_exists('getSupplierHotelNotice')) {
    function getSupplierHotelNotice(){
        $hotel_info = App\model\SupplierHotelInfo::where('notification_flag',1)->select('notification_time','supplier_id','hotel_name','notification_msg')->get();
        // echo '<pre>';print_r($hotel_info);exit;
        return $hotel_info;
    }
}

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        // $timezone = date_default_timezone_get();
        // date_default_timezone_set("$timezone");
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

?>