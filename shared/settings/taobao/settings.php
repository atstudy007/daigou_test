<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
$setting['taobao']=array (
  'credit' => 
  array (
    'register' => '100',
    'invite' => '1',
    'trade' => '1',
    'cash' => '0.03',
    'level' => 
    array (
      1 => 
      array (
        'name' => 'Member',
        'min' => '0',
        'max' => '999',
        'discount' => '0.8',
      ),
      2 => 
      array (
        'name' => 'VIP',
        'min' => '1000',
        'max' => '9999',
        'discount' => '0.6',
      ),
      3 => 
      array (
        'name' => 'SVIP',
        'min' => '10000',
        'max' => '9999999',
        'discount' => '0.5',
      ),
    ),
  ),
  'system' => 
  array (
    'rate' => '4.8',
    'invite' => '0.8',
    'tax' => '0.01',
    'service_min' => '10',
    'service' => '0.10',
  ),
  'taobao' => 
  array (
    'startscore' => '1goldencrown',
    'endscore' => '5goldencrown',
    'startcommission' => '200',
    'endcommission' => '5000',
  ),
  'contact' => 
  array (
    'email' => 'lingchao@65post.com',
    'phone' => '+65 66896312',
    'msn' => 'lingchao@65post.com',
    'address' => '9:00 am - 6:00 pm',
  ),
);