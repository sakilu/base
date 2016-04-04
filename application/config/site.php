<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2015/10/21
 */
$config['backend_title'] = '';
$config['backend_author'] = '';

$config['front_title'] = '';
$config['front_description'] = '';
$config['front_keywords'] = '';

$config['administrator'] = [
    '107185968711650606534'
];

/**
 * crud
 */
$config['crud'] = [
    'prefix' => 'general_mgr/'
];

$config['auth'] = [
    'table' => 'admin',
    'session_key' => 'auth_admin_id',
    'db_column_key' => 'admin_id',
    'db_column_user' => 'admin_mail',
    'db_column_password' => 'admin_password',
    'db_column_name' => 'admin_name',
    'db_column_role' => 'admin_role',
    'db_column_google' => 'admin_google_id',
    'db_column_fb' => 'admin_fb_id'
];


$config['form'] = [

];

$config['layout'] = [
];

$config['sidebar'] = [
    'menu' => [
        'dashboard' => [
            'icon' => 'glyphicon glyphicon-home',
            'url' => '/general_mgr/dashboard',
            'name' => 'Dashboard',
            'role' => '',
            'children' => null
        ],
        'admin' => [
            'icon' => 'glyphicons glyphicons-keys',
            'url' => '/general_mgr/admin',
            'name' => '管理者',
            'role' => 'admin',
            'children' => null
        ],
    ]
];

$config['pagination'] = [
    'full_tag_open' => '<ul class="paging">',
    'full_tag_close' => '</ul>',
    'first_link' => false,
    'last_link' => false,
    'next_link' => '&nbsp;',
    'next_tag_open' => '<li class="arrowright">',
    'next_tag_close' => '</li>',
    'prev_link' => '&nbsp;',
    'prev_tag_open' => '<li class="arrowleft">',
    'prev_tag_close' => '</li>',
    'cur_tag_open' => '<li class="active"><a href="#">',
    'cur_tag_close' => '</a></li>',
    'num_tag_open' => '<li>',
    'num_tag_close' => '</li>',
];

$config['ckeditor'] = [
    'filebrowserBrowseUrl' => '/vendor/plugins/ckfinder/ckfinder.html',
    'filebrowserImageBrowseUrl' => '/vendor/plugins/ckfinder/ckfinder.html?Type=Images',
    'filebrowserUploadUrl' => '/vendor/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    'filebrowserImageUploadUrl' => '/vendor/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
];

$config['role'] = [
    'admin' => '使用者'
];;