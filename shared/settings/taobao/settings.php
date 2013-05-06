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
    'rate' => '6.2',
    'invite' => '0.8',
    'tax' => '0.01',
    'service_min' => '30',
    'service' => '0.06',
  ),
  'taobao' => 
  array (
    'startscore' => '1heart',
    'endscore' => '5goldencrown',
    'startcommission' => '200',
    'endcommission' => '5000',
  ),
  'contact' => 
  array (
    'email' => 'test@163.com',
    'phone' => '+0000000000000',
    'msn' => 'test@163.com',
    'address' => '9:00 am - 6:00 pm  (UTC, Mountain Time, US&Canada)',
  ),
);