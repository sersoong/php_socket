<?php

set_time_limit(0);

$ip = '127.0.0.1';
$port = 8099;

if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) <0){
    echo "socket_create() failed:".socket_strerror($sock)."\n";
    exit();
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() failed:".socket_strerror($ret)."\n";
    exit();
}

if(($ret = socket_listen($sock,4))<0) {
    echo "socket_listen() failed:".socket_strerror($ret)."\n";
    exit();
}

$count = 0;

do{
    if (($msgsock = socket_accept($sock))<0) {
        echo "socket_accept() failed:" . socket_strerror($msgsock) . "\n";
        break;
    } else {
        $msg = "test success! \n";
        socket_write($msgsock,$msg,strlen($msg));

        echo "test success!\n";
        $buf = socket_read($msgsock,2048);
        $talkback = "收到的信息:$buf\n";
        echo $talkback;
        if(++$count>=5){
            break;
        }
    }
    socket_close($msgsock);
}
while(true);

?>