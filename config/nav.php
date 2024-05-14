<?php

return [
    [
        'icon' => 'icon-grid',
        'name' => 'Home',
        'route' => 'admin.home.index',
        'routeGroup' => 'admin.home.*',
        'prefix' => [''],
    ],
    [
        'icon' => 'shopping-cart',
        'name' => 'Sản phẩm',
        'route' => 'admin.product.index',
        'routeGroup' => 'admin.product.*',
        'prefix' => ['product'],
    ],
    [
        'icon' => 'users',
        'name' => 'Thành viên',
        'route' => 'admin.user.index',
        'routeGroup' => 'admin.user.*',
        'prefix' => ['user'],
    ],
    [
        'icon' => 'layers',
        'name' => 'Danh mục',
        'route' => 'admin.category.index',
        'routeGroup' => 'admin.category.*',
        'prefix' => ['category'],
    ],
    [
        'icon' => 'mdi mdi-account-key',
        'name' => 'Role',
        'route' => 'admin.role.index',
        'routeGroup' => 'admin.role.*',
        'prefix' => ['role'],
    ],
];