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
        'icon' => 'fa-brands fa-blogger-b',
        'name' => 'Bài viết',
        'route' => 'admin.blog.index',
        'routeGroup' => 'admin.blog.*',
        'prefix' => ['blog'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.blog.index',

            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.blog.create',

            ],
            [
                'icon' => '',
                'name' => 'Phản hồi',
                'route' => 'admin.blog.cmt',

            ],
        ],
    ],
    [
        'icon' => 'fa-solid fa-shirt',
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
            [
                'icon' => '',
                'name' => 'Phản hồi',
                'route' => 'admin.product.cmt',

            ],
        ],
    ],
    [
        'icon' => 'bi bi-list-nested',
        'name' => 'Danh mục',
        'route' => 'admin.category.index',
        'routeGroup' => 'admin.category.*',
        'prefix' => ['category'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.category.index',
            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.category.create',
            ],
        ],
    ],
    [
        'icon' => 'fa-brands fa-shirtsinbulk',
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
        'icon' => 'bi bi-people-fill',
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
        'icon' => 'bi bi-shield-lock-fill',
        'name' => 'Role',
        'route' => 'admin.role.index',
        'routeGroup' => 'admin.role.*',
        'prefix' => ['role'],

    ],
];
