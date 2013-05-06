<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
$setting['models']['articles']=array (
  'id' => '5',
  'name' => 'articles',
  'description' => '文章',
  'perpage' => '10',
  'hasattach' => '1',
  'built_in' => '0',
  'fields' => 
  array (
    18 => 
    array (
      'id' => '18',
      'name' => 'title',
      'description' => '文章标题',
      'model' => '5',
      'type' => 'input',
      'length' => '300',
      'values' => '',
      'width' => '300',
      'height' => '0',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '1',
      'listable' => '1',
      'order' => '0',
      'editable' => '1',
    ),
    19 => 
    array (
      'id' => '19',
      'name' => 'content',
      'description' => '文章内容',
      'model' => '5',
      'type' => 'wysiwyg',
      'length' => '0',
      'values' => '',
      'width' => '600',
      'height' => '300',
      'rules' => 'required',
      'ruledescription' => '',
      'searchable' => '0',
      'listable' => '0',
      'order' => '0',
      'editable' => '1',
    ),
  ),
  'listable' => 
  array (
    0 => '18',
  ),
  'searchable' => 
  array (
    0 => '18',
  ),
);