<?php

return [
    [
        'icon' => 'icon-grid',
        'name' => 'Home',
        'route' => 'admin.home.index',
        'routeGroup' => 'admin.home.*',
        'prefix' => ['home'],
    ],
    [
        'icon' => 'shopping-cart',
        'name' => 'Sản phẩm',
        'route' => 'admin.product.index',
        'routeGroup' => 'admin.product.*',
        'prefix' => ['product'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.product.index',

            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.product.create',

            ],
        ],
    ],
    [
        'icon' => 'layers',
        'name' => 'Danh mục',
        'route' => 'admin.category.index',
        'routeGroup' => 'admin.category.*',
        'prefix' => ['category'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.category.index',
                // 'routeGroup' => 'admin.category.*',
                // 'prefix' => ['category', 'list'],
            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.category.create',
                // 'routeGroup' => 'admin.category.*',
                // 'prefix' => ['category', 'create'],
            ],
        ],
    ],
    [
        'icon' => '',
        'name' => 'Thương hiệu',
        'route' => 'admin.brand.index',
        'routeGroup' => 'admin.brand.*',
        'prefix' => ['brand'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.brand.index',

            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.brand.create',

            ],
        ],
    ],
    [
        'icon' => 'users',
        'name' => 'Thành viên',
        'route' => 'admin.user.index',
        'routeGroup' => 'admin.user.*',
        'prefix' => ['user'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.user.index',

            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.user.create',

            ],
        ],
    ],
    [
        'icon' => 'mdi mdi-account-key',
        'name' => 'Role',
        'route' => 'admin.role.index',
        'routeGroup' => 'admin.role.*',
        'prefix' => ['role'],

    ],
];
