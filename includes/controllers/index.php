<?php

require_once __DIR__. '/AuthController.php';
require_once __DIR__. '/../../core/bootstap.php';
$auth=new AuthController();
$uri=$_GET['page'] ?? 'login';
if ($uri=='login') {
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $auth->login();

    }else{
        $auth->showLogin();
    }
}elseif ($uri=='register') {
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $auth->register();
    }else{
        $auth->showRegister();
    }
}elseif ($uri=='logout') {
    $auth->logout();
}
