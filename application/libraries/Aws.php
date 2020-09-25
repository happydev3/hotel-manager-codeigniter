<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require 'aws/aws-autoloader.php';
class Aws {
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
// ./application/libraries