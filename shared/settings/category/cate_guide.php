<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
$setting['cate_models']['guide']=array (
  'id' => '1',
  'name' => 'guide',
  'description' => '说明书分类',
  'perpage' => '10',
  'level' => '1',
  'hasattach' => '1',
  'built_in' => '0',
  'fields' => 
  array (
    1 => 
    array (
      'id' => '1',
      'name' => 'name',
      'description' => '分类名称',
      'model' => '1',
      'type' => 'float',
      'length' => '200',
      'values' => '',
      'width' => '200',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '0',
      'listable' => '1',
      'order' => '0',
      'editable' => '1',
    ),
    2 => 
    array (
      'id' => '2',
      'name' => 'alias',
      'description' => 'URL别名',
      'model' => '1',
      'type' => 'input',
      'length' => '100',
      'values' => '',
      'width' => '200',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '0',
      'listable' => '1',
      'order' => '2',
      'editable' => '1',
    ),
  ),
  'listable' => 
  array (
    0 => '1',
    1 => '2',
  ),
  'searchable' => 
  array (
  ),
);