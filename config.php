<?php

error_reporting(E_ERROR);
ini_set('display_errors', 'On');

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "";
$config['db']['dbname'] = "";

// True se estiver em desenvolvimento
$sandbox = true;
// ------

if ($sandbox){
    define('PATH', "http://localhost/gereciador_whatsapp/");
    define('SOCKET', "http://localhost:45000/");
}else{
    define('PATH', "http://10.53.8.26/gereciador_whatsapp/");
    define('SOCKET', "http://10.53.8.26:45000/");
}
