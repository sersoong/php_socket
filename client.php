<?php

error_reporting(E_ALL);
set_time_limit(0);

echo "<h2>TCP/IP Connection</h2>\n";

$ip = '127.0.0.1';
$port = 8099;

//创建socket
if(($socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() failed:".socket_strerror($socket)."\n";
    exit();
}
echo "OK. \n";

echo "try to connect '$ip' port '$port'...\n";

//连接socket
if(($result = socket_connect($socket, $ip, $port)) < 0){
    echo "socket_connect() failed:".socket_strerror($sock)."\n";
    exit();
}
echo "connect ok\n";

$in = "hello sersoong\r\n";
$out = '';

//写数据到socket缓存
if(!socket_write($socket, $in, strlen($in))) {
    echo "socket_write() failed:".socket_strerror($sock)."\n";
    exit();
}
echo "send msg success!\n";
echo "sended msg:$in \n";

//读取指定长度的数据
while($out = socket_read($socket, 2048)) {
    echo "received msg\n";
    echo "msg:",$out;
}

echo "close socket...\n";
socket_close($socket);
echo "shutdown ok\n";
?>