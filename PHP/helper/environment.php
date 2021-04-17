<?php


function is_cli(){
    return preg_match("/cli/i", php_sapi_name()) ? true : false;
}