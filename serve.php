<?php
if(!isset($argv[1])){
    echo "Please specify a mode (local or network)";
    exit;
}
if($argv[1] == "local"){
    exec("php -S localhost:8080");
}else if($argv[1] == "network") {
    $ip = getHostByName(getHostName());
    exec("php -S {$ip}:8080");
}
