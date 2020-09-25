<?php
require_once 'Facebook/autoload.php';
 $fb = new Facebook\Facebook([
  // 'app_id' => '214079779048644', // Replace {app-id} with your app id
  // 'app_secret' => 'd74f2c74cc68ea877fbd8effceb4f137', 
  'app_id' => '1755701414753512', // Replace {app-id} with your app id
  'app_secret' => 'd5b4d0ce649e909b463a77130f0e01ea',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper(); 
$permissions = ['email','user_photos'];
 ?>

 