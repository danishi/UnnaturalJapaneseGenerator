<?php
/**
 * Routing
 * @author danishi
 */
$uri = $_SERVER['REQUEST_URI'];
if(empty($uri) || $uri == '/ujg/') {
    $uri = '/ujg/index';
}

$array_parse_uri = explode('/', $uri);

$last_uri = end($array_parse_uri);
$call = substr($last_uri, 0, strcspn($last_uri,'?'));   // remove query string

if(file_exists('../app/controller/' . $call . '.php')) {

    include('../app/controller/' . $call . '.php');

    $class = 'app\controller\\' . $call;
    $obj   = new $class();

    if($_SERVER["REQUEST_METHOD"] != "POST"){
        $response = $obj->index();
    }else{
        $response = $obj->post();
    }
    echo $response;

    exit;
}else{
    header("HTTP/1.0 404 Not Found");
    exit;
}
