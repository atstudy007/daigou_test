<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
$setting['models']['company']=array (
  'id' => '2',
  'name' => 'company',
  'description' => '公司信息',
  'perpage' => '10',
  'hasattach' => '1',
  'built_in' => '0',
  'fields' => 
  array (
    7 => 
    array (
      'id' => '7',
      'name' => 'title',
      'description' => '标题',
      'model' => '2',
      'type' => 'input',
      'length' => '200',
      'values' => '',
      'width' => '0',
      'height' => '0',
      'rules' => '',
      'ruledescription' => '',
      'searchable' => '1',
      'listable' => '1',
      'order' => '1',
      'editable' => '1',
    ),
    8 => 
    array (
      'id' => '8',
      'name' => 'content',
      'description' => '内容',
      'model' => '2',
      'type' => 'wysiwyg',
      'length' => '0',
      'values' => '',
      'width' => '0',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '0',
      'listable' => '0',
      'order' => '2',
      'editable' => '1',
    ),
  ),
  'listable' => 
  array (
    0 => '7',
  ),
  'searchable' => 
  array (
    0 => '7',
  ),
);