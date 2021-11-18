<?php

declare(strict_types = 1);

namespace App\Model\Front;

class FrontMenus
{
    /**
     * @var array<array<mixed>>
     */
    public static array $frontMainMenuTree = [
        'route_name_1' => [],
        'route_name_2' => [],
        'route_name_3' => [
            'children' => [
                'route_name_4' => [
                    'parent' => 'route_name_3',
                ],
            ],
        ],
        'admin_home_route_name' => [
            'role' => 'ROLE_ADMIN',
        ],
    ];

    /**
     * @var array<array<mixed>>
     */
    public static array $frontSecondMenuTree = [];
}
