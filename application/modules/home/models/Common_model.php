<?php defined('BASEPATH') || exit('No direct script access allowed');

class Common_model extends CI_Model {
    private  $userAgent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36";
    private  $contentTypeURLENCODED = "application/x-www-form-urlencoded";
    private  $contentTypeJSON = "application/json";
    public function __construct() {
        parent::__construct();
        // $CI = &get_instance();
        // $this->read = $CI->load->database('read', true);
        $this->load->library('aws');
        // $this->load->helper('array');
        // $this->load->helper('common');
        // $this->load->helper('security');
    }

    function getImageAWSWhitelabel($file_name,$decodedId){
        $sql = "SELECT `s3_name`,`s3_region` FROM `white_label_solution` WHERE 1 AND `id`=?";
        $query = $this->db->query($sql,$decodedId);
        $result = $query->row_array();
        $s3_region = $this->read->query($sql)->row_array();
        if(empty($s3_region)){
            $s3_region = 'ap-southeast-1';
        }else{
            $s3_region = $s3_region['s3_region'];
        }
        $bucket =$result['s3_name'];
        try {
            $credentials = $this->aws-> getAwsCred();
    
            $s3Client = new Aws\S3\S3Client([
                'version'     => 'latest',
                'region'      => $s3_region,
                'credentials' => $credentials
            ]);
            // Get the object.
            $cmd = $s3Client->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key'    => $file_name
            ]);
        
            $request = $s3Client->createPresignedRequest($cmd, '+5   minutes');
            $presignedUrl = (string) $request->getUri();
            return $presignedUrl;
        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
    
    function get_image_aws($file_name,$s3_name) {
        try {
            $credentials = $this->aws->getAwsCred();
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
    }

    function delete_s3_file($filename,$s3_name) {
        @include_once 'sdk/sdk.class.php';
        $s3 = new AmazonS3();
        $bucket = $s3_name;
        // $bucket = S3_NAME;
        $a=$s3->delete_object($bucket, $filename);
        echo "909";
        return 1;
    }

    function s3Upload($tar_file,$s3_name) {
        $seg = explode("/", $tar_file);
        $bucket = $s3_name;
        $file_name = basename($tar_file);
        $file_path = $seg[1]."/".$file_name;
        
        $content_type= $this->mime_content_typealways($file_name);
        if(is_array($content_type)){
            $content_type = $content_type[0];
        }
        $file_resource = fopen($tar_file, 'r');
        $key = $file_path;
        try{
            //Create a S3Client
            $credentials = $this->aws->getAwsCred();
            $s3Client = new Aws\S3\S3Client($credentials);
            $params = [
                'Bucket'        => $bucket,
                'Key'           => $key,
                'Body'          => $file_resource,
                'ContentType'   => $content_type,
            ];
            $result = $s3Client->putObject($params); 
            return 1;
        } catch (S3Exception $e) {
            return $e->getMessage() . "\n";
        }             
    }

    function s3UploadZip($file,$destination,$s3_name) {

        $sql = 'select s3_region from white_label_solution where s3_name =?';
        $s3_region = $this->read->query($sql,$s3_name)->row_array();
        if(empty($s3_region)){
            $s3_region = 'ap-southeast-1';
        }else{
            $s3_region = $s3_region['s3_region'];
        }
        $bucket = $s3_name;
        $filename = $destination."/".$file;
        $contentType=$this->mime_content_typealways($file);
        $file_resource = fopen($file, 'r');
        //Create a S3Client
        $credentials = $this->aws-> getAwsCred();
        $s3Client = new Aws\S3\S3Client([
            'version'     => 'latest',
            'region'      => $s3_region,
            'credentials' => $credentials
        ]);
        try{
            
            $params = [
                'Bucket'        => $s3_name,
                'Key'           => $destination,
                'Body'          => $file_resource,
                'ContentType'   => $content_type,
            ];
            $result = $s3Client->putObject($params); 
            return 1;
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }        
    }

    function s3Upload_local($tar_file)
    {
        @include_once 'sdk/sdk.class.php';
        $s3 = new AmazonS3();
        @$s3->disable_ssl_verification();
        $seg = explode("/", $tar_file);            
        $bucket = S3_NAME;
        $file_location = basename($tar_file);
        $filename = $seg[2]."/".$file_location;
        $contentType=$this->mime_content_typealways($file_location);
        $fileResource = fopen($tar_file, 'r');
        $response = $s3->create_object($bucket, $filename, array('fileUpload' => $fileResource,'contentType' => $contentType));  
        return 1;
    }
}