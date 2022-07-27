<?php

require_once "DotEnv.php";

class Config{

    public function __construct(){
        (new DotEnv( $_SERVER['DOCUMENT_ROOT'].'/.env'))->load();
    }

    public function getHost(){
        return getenv('host');
    }

    public function getUser(){
        return getenv('user');
    }

    public function getPass(){
        return getenv('pass');
    }


    public function getDB(){
        return getenv('db');
    }

}