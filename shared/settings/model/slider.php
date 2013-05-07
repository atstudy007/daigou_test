<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
$setting['models']['slider']=array (
  'id' => '3',
  'name' => 'slider',
  'description' => '轮显设置',
  'perpage' => '10',
  'hasattach' => '1',
  'built_in' => '0',
  'fields' => 
  array (
    10 => 
    array (
      'id' => '10',
      'name' => 'title',
      'description' => '标题',
      'model' => '3',
      'type' => 'input',
      'length' => '100',
      'values' => '',
      'width' => '200',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '1',
      'listable' => '1',
      'order' => '0',
      'editable' => '1',
    ),
    11 => 
    array (
      'id' => '11',
      'name' => 'image',
      'description' => '图片地址',
      'model' => '3',
      'type' => 'input',
      'length' => '100',
      'values' => '',
      'width' => '200',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '0',
      'listable' => '0',
      'order' => '0',
      'editable' => '1',
    ),
    12 => 
    array (
      'id' => '12',
      'name' => 'link',
      'description' => '链接地址',
      'model' => '3',
      'type' => 'input',
      'length' => '100',
      'values' => '',
      'width' => '200',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '0',
      'listable' => '0',
      'order' => '0',
      'editable' => '1',
    ),
    14 => 
    array (
      'id' => '14',
      'name' => 'status',
      'description' => '是否启用',
      'model' => '3',
      'type' => 'select',
      'length' => '1',
      'values' => 
      array (
        1 => '是',
        2 => '否',
      ),
      'width' => '0',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '1',
      'listable' => '1',
      'order' => '0',
      'editable' => '1',
    ),
  ),
  'listable' => 
  array (
    0 => '10',
    1 => '14',
  ),
  'searchable' => 
  array (
    0 => '10',
    1 => '14',
  ),
);