<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol'] = env('MAIL_DRIVER', 'smtp');
$config['smtp_host'] = env('MAIL_HOST');
$config['smtp_user'] = env('MAIL_USER');
$config['smtp_pass'] = env('MAIL_PASSWORD');
$config['smtp_port'] = env('MAIL_PORT', 25);
// $config['smtp_crypto'] = env('MAIL_ENCRYPTION', 'tls');

$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['crlf']     = "\r\n";
$config['newline']  = "\r\n";