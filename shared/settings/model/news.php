<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
$setting['models']['news']=array (
  'id' => '4',
  'name' => 'news',
  'description' => '新闻',
  'perpage' => '10',
  'hasattach' => '1',
  'built_in' => '0',
  'fields' => 
  array (
    16 => 
    array (
      'id' => '16',
      'name' => 'title',
      'description' => '新闻标题',
      'model' => '4',
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
    17 => 
    array (
      'id' => '17',
      'name' => 'content',
      'description' => '新闻内容',
      'model' => '4',
      'type' => 'wysiwyg',
      'length' => '0',
      'values' => '',
      'width' => '600',
      'height' => '300',
      'rules' => '',
      'ruledescription' => '',
      'searchable' => '0',
      'listable' => '0',
      'order' => '0',
      'editable' => '1',
    ),
  ),
  'listable' => 
  array (
    0 => '16',
  ),
  'searchable' => 
  array (
    0 => '16',
  ),
);