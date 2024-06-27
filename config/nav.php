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
        'icon' => 'bi bi-stickies',
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
        'icon' => 'bi bi-tags',
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
        'icon' => 'bi bi-receipt',
        'name' => 'Coupons',
        'route' => 'admin.coupon.index',
        'routeGroup' => 'admin.coupon.*',
        'prefix' => ['coupon'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.coupon.index',
            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.coupon.create',
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
        'icon' => 'bi bi-box-seam',
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
            [
                'icon' => '',
                'name' => 'Kho',
                'route' => 'admin.product.stock',

            ],
        ],
    ],
    [
        'icon' => 'bi bi-bar-chart-line',
        'name' => 'Analytics',
        'route' => 'admin.analytics.index',
        'routeGroup' => 'admin.analytics.*',
        'prefix' => ['analytics'],

    ],
    [
        'icon' => 'bi bi-basket3',
        'name' => 'Order',
        'route' => 'admin.order.index',
        'routeGroup' => 'admin.order.*',
        'prefix' => ['order'],

    ],
    [
        'icon' => 'bi bi-pip',
        'name' => 'Giao diện',
        'route' => 'admin.display.index',
        'routeGroup' => 'admin.display.*',
        'prefix' => ['display'],
    ],
    [
        'icon' => 'bi bi-shop',
        'name' => 'Nhà cung cấp',
        'route' => 'admin.supplier.index',
        'routeGroup' => 'admin.supplier.*',
        'prefix' => ['supplier'],
        'children' => [
            [
                'icon' => '',
                'name' => 'Danh sách',
                'route' => 'admin.supplier.index',

            ],
            [
                'icon' => '',
                'name' => 'Thêm mới',
                'route' => 'admin.supplier.create',

            ],
        ],
    ],
    [
        'icon' => 'bi bi-people',
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
