<?php

declare(strict_types = 1);

namespace App\Model\Admin;

class AdminMenus
{
    /**
     * @var array<array<mixed>>
     */
    public static array $adminMenuTree = [
        'public_home_main' => [],
        'admin_home' => [],
        'user_index' => [
            'children' => [
                'pending_users' => [
                    'parent' => 'user_index',
                ],
                'verified_users' => [
                    'parent' => 'user_index',
                ],
                'candidate_users' => [
                    'parent' => 'user_index',
                ],
                'tournament_manager_users' => [
                    'parent' => 'user_index',
                ],
                'user_new' => [
                    'parent' => 'user_index',
                ],
            ],
        ],
    ];
}
