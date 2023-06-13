<?php
defined('ECMSAPI_MOD') or exit;

// 退出登陆
$api->load('user')->clearSession();

// 输出json数据
$api->load('fun')->json(1 , 'success');