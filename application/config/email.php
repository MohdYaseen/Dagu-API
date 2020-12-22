<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*email config array*/

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'orders@kaamit.com';
$config['smtp_pass'] = 'orders@#321';
$config['smtp_timeout'] = 20;
$config['mailtype'] = 'html';
$config['charset'] = 'UTF-8';
$config['wordwrap'] = '\r\n';
$config['newline'] = '\r\n';

/*$config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => smtp_user, 
            'smtp_pass' => smtp_pass, 
            'smtp_timeout'=>20,
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );*/