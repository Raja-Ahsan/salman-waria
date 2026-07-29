<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use Illuminate\Database\Seeder;

class CmsModuleSeeder extends Seeder
{
    /**
     * Sidebar modules for Salman Waria site admin (Dashboard + Blog CMS only).
     */
    public function run(): void
    {
        CmsModule::updateOrCreate(
            ['route_name' => 'admin.dashboard'],
            [
                'name' => 'Dashboard',
                'icon' => 'fa-solid fa-gauge-high',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $blogs = CmsModule::updateOrCreate(
            ['route_name' => 'blogs-module'],
            [
                'name' => 'Blog',
                'icon' => 'fa-solid fa-pen-nib',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'blogs.index'],
            [
                'name' => 'All Posts',
                'icon' => 'fa-solid fa-newspaper',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => $blogs->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'blog-categories.index'],
            [
                'name' => 'Categories',
                'icon' => 'fa-solid fa-folder-tree',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => $blogs->id,
            ]
        );

        $allowed = [
            'admin.dashboard',
            'blogs-module',
            'blogs.index',
            'blog-categories.index',
        ];

        CmsModule::query()
            ->where(function ($q) use ($allowed) {
                $q->whereNotIn('route_name', $allowed)
                    ->orWhereNull('route_name');
            })
            ->delete();
    }
}
