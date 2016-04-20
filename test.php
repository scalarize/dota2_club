<?php

$redis = new Redis();
$redis->connect('localhost', 6379);
$redis->select(0);

$redis->set('TS', time());

echo $redis->get('TS');

