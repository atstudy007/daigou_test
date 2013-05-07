<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
$setting['menus']=array (
  0 => 
  array (
    'menu_id' => '1',
    'class_name' => 'system',
    'method_name' => 'home',
    'menu_name' => '系统',
    'sub_menus' => 
    array (
      0 => 
      array (
        'menu_id' => '2',
        'class_name' => 'system',
        'method_name' => 'home',
        'menu_name' => '后台首页',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '3',
            'class_name' => 'system',
            'method_name' => 'home',
            'menu_name' => '后台首页',
          ),
        ),
      ),
      1 => 
      array (
        'menu_id' => '4',
        'class_name' => 'setting',
        'method_name' => 'site',
        'menu_name' => '系统设置',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '5',
            'class_name' => 'setting',
            'method_name' => 'site',
            'menu_name' => '站点设置',
          ),
          1 => 
          array (
            'menu_id' => '6',
            'class_name' => 'setting',
            'method_name' => 'backend',
            'menu_name' => '后台设置',
          ),
          2 => 
          array (
            'menu_id' => '7',
            'class_name' => 'system',
            'method_name' => 'password',
            'menu_name' => '修改密码',
          ),
          3 => 
          array (
            'menu_id' => '8',
            'class_name' => 'system',
            'method_name' => 'cache',
            'menu_name' => '更新缓存',
          ),
        ),
      ),
      2 => 
      array (
        'menu_id' => '9',
        'class_name' => 'model',
        'method_name' => 'view',
        'menu_name' => '模型管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '10',
            'class_name' => 'model',
            'method_name' => 'view',
            'menu_name' => '内容模型管理',
          ),
          1 => 
          array (
            'menu_id' => '11',
            'class_name' => 'category',
            'method_name' => 'view',
            'menu_name' => '分类模型管理',
          ),
        ),
      ),
      3 => 
      array (
        'menu_id' => '12',
        'class_name' => 'plugin',
        'method_name' => 'view',
        'menu_name' => '插件管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '13',
            'class_name' => 'plugin',
            'method_name' => 'view',
            'menu_name' => '插件管理',
          ),
        ),
      ),
      4 => 
      array (
        'menu_id' => '14',
        'class_name' => 'role',
        'method_name' => 'view',
        'menu_name' => '权限管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '15',
            'class_name' => 'role',
            'method_name' => 'view',
            'menu_name' => '用户组管理',
          ),
          1 => 
          array (
            'menu_id' => '16',
            'class_name' => 'user',
            'method_name' => 'view',
            'menu_name' => '用户管理',
          ),
        ),
      ),
    ),
  ),
  1 => 
  array (
    'menu_id' => '17',
    'class_name' => 'content',
    'method_name' => 'view',
    'menu_name' => '内容管理',
    'sub_menus' => 
    array (
      0 => 
      array (
        'menu_id' => '18',
        'class_name' => 'content',
        'method_name' => 'view',
        'menu_name' => '内容管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'class_name' => 'content',
            'method_name' => 'view',
            'extra' => 'guide',
            'menu_name' => '说明书',
          ),
          1 => 
          array (
            'class_name' => 'content',
            'method_name' => 'view',
            'extra' => 'company',
            'menu_name' => '公司信息',
          ),
          2 => 
          array (
            'class_name' => 'content',
            'method_name' => 'view',
            'extra' => 'slider',
            'menu_name' => '轮显设置',
          ),
          3 => 
          array (
            'class_name' => 'content',
            'method_name' => 'view',
            'extra' => 'news',
            'menu_name' => '新闻',
          ),
          4 => 
          array (
            'class_name' => 'content',
            'method_name' => 'view',
            'extra' => 'articles',
            'menu_name' => '文章',
          ),
        ),
      ),
      1 => 
      array (
        'menu_id' => '19',
        'class_name' => 'category_content',
        'method_name' => 'view',
        'menu_name' => '分类管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'class_name' => 'category_content',
            'method_name' => 'view',
            'extra' => 'guide',
            'menu_name' => '说明书分类',
          ),
        ),
      ),
    ),
  ),
  2 => 
  array (
    'menu_id' => '20',
    'class_name' => 'module',
    'method_name' => 'run',
    'menu_name' => '工具',
    'sub_menus' => 
    array (
    ),
  ),
  3 => 
  array (
    'menu_id' => '21',
    'class_name' => 'taobao/setting',
    'method_name' => 'api',
    'menu_name' => '商城管理',
    'sub_menus' => 
    array (
      0 => 
      array (
        'menu_id' => '22',
        'class_name' => 'taobao/setting',
        'method_name' => 'api',
        'menu_name' => '商城配置',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '23',
            'class_name' => 'taobao/setting',
            'method_name' => 'api',
            'menu_name' => 'API设置',
          ),
          1 => 
          array (
            'menu_id' => '24',
            'class_name' => 'taobao/setting',
            'method_name' => 'category',
            'menu_name' => '栏目设置',
          ),
          2 => 
          array (
            'menu_id' => '25',
            'class_name' => 'taobao/setting',
            'method_name' => 'basic',
            'menu_name' => '全局设置',
          ),
          3 => 
          array (
            'menu_id' => '26',
            'class_name' => 'taobao/setting',
            'method_name' => 'view',
            'menu_name' => '页面设置',
          ),
          4 => 
          array (
            'menu_id' => '27',
            'class_name' => 'taobao/country',
            'method_name' => 'express',
            'menu_name' => '邮费设置',
          ),
          5 => 
          array (
            'menu_id' => '36',
            'class_name' => 'taobao/setting',
            'method_name' => 'email',
            'menu_name' => '邮件模板',
          ),
        ),
      ),
      1 => 
      array (
        'menu_id' => '28',
        'class_name' => 'taobao/member',
        'method_name' => 'view',
        'menu_name' => '会员管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '29',
            'class_name' => 'taobao/member',
            'method_name' => 'add',
            'menu_name' => '添加会员',
          ),
          1 => 
          array (
            'menu_id' => '30',
            'class_name' => 'taobao/member',
            'method_name' => 'view',
            'menu_name' => '会员管理',
          ),
        ),
      ),
      2 => 
      array (
        'menu_id' => '31',
        'class_name' => 'taobao/order',
        'method_name' => 'view',
        'menu_name' => '订单管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '32',
            'class_name' => 'taobao/order',
            'method_name' => 'view',
            'menu_name' => '购买订单',
          ),
          1 => 
          array (
            'menu_id' => '33',
            'class_name' => 'taobao/delivery',
            'method_name' => 'view',
            'menu_name' => '转运订单',
          ),
        ),
      ),
      3 => 
      array (
        'menu_id' => '34',
        'class_name' => 'taobao/inviter',
        'method_name' => 'view',
        'menu_name' => '推广管理',
        'sub_menus' => 
        array (
          0 => 
          array (
            'menu_id' => '35',
            'class_name' => 'taobao/inviter',
            'method_name' => 'view',
            'menu_name' => '推广员',
          ),
          1 => 
          array (
            'menu_id' => '37',
            'class_name' => 'taobao/inviter',
            'method_name' => 'cash',
            'menu_name' => '提现记录',
          ),
        ),
      ),
    ),
  ),
);