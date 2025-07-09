<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createSuperAdminRole();

        $generalPermissions = [
            PermissionEnum::AVATAR_STORE->value,
            PermissionEnum::AVATAR_DELETE->value,
        ];

        $userPermissions = [
            // Profile
            PermissionEnum::PROFILE_VIEW,
            PermissionEnum::PROFILE_EDIT,
            PermissionEnum::PROFILE_DELETE,

            // Member Certificate
            PermissionEnum::MEMBER_CERTIFICATE_LIST,
            PermissionEnum::MEMBER_CERTIFICATE_VIEW,
            PermissionEnum::MEMBER_CERTIFICATE_CREATE,
            PermissionEnum::MEMBER_CERTIFICATE_EDIT,
            PermissionEnum::MEMBER_CERTIFICATE_DELETE,

            // Member User
            PermissionEnum::MEMBER_USERS_LIST,
            PermissionEnum::MEMBER_USERS_VIEW,

            // Member Activity
            PermissionEnum::MEMBER_ACTIVITY_LIST,
            PermissionEnum::MEMBER_ACTIVITY_VIEW,
            PermissionEnum::MEMBER_ACTIVITY_CREATE,
            PermissionEnum::MEMBER_ACTIVITY_EDIT,
            PermissionEnum::MEMBER_ACTIVITY_DELETE,

            // Member Activity
            PermissionEnum::MEMBER_SUBSCRIPTION_LIST,
            PermissionEnum::MEMBER_SUBSCRIPTION_VIEW,
            PermissionEnum::MEMBER_SUBSCRIPTION_CREATE,
            PermissionEnum::MEMBER_SUBSCRIPTION_EDIT,
            PermissionEnum::MEMBER_SUBSCRIPTION_DELETE,

            // Member Download
            PermissionEnum::MEMBER_DOWNLOAD_LIST,
            PermissionEnum::MEMBER_DOWNLOAD_VIEW,

            // Member Setting
            PermissionEnum::MEMBER_SETTING_LIST,
            PermissionEnum::MEMBER_SETTING_EDIT,
        ];

        $instructorPermissions = [
            // User
            PermissionEnum::USER_VIEWANY,
            PermissionEnum::USER_EDIT,

            // News
            PermissionEnum::NEWS_CREATE,
            PermissionEnum::NEWS_EDIT,
            PermissionEnum::NEWS_DELETE,

            // Activity
            PermissionEnum::ACTIVITY_CREATE,
            PermissionEnum::ACTIVITY_EDIT,
            PermissionEnum::ACTIVITY_DELETE,

            // Subscription
            PermissionEnum::SUBSCRIPTION_VIEWANY,
            PermissionEnum::SUBSCRIPTION_CREATE,
            PermissionEnum::SUBSCRIPTION_EDIT,
            PermissionEnum::SUBSCRIPTION_DELETE,
            PermissionEnum::SUBSCRIPTION_RESTORE,

            // Blog
            PermissionEnum::BLOG_CREATE,
            PermissionEnum::BLOG_EDIT,
            PermissionEnum::BLOG_DELETE,
        ];

        $adminPermissions = [
            // User
            PermissionEnum::USER_CREATE,
            PermissionEnum::USER_ACTIVATE,
            PermissionEnum::USER_DELETE,
            PermissionEnum::USER_RESTORE,

            // News
            PermissionEnum::NEWS_VIEWANY,
            PermissionEnum::NEWS_RESTORE,

            // NewsCategory
            PermissionEnum::NEWS_CATEGORY_VIEWANY,
            PermissionEnum::NEWS_CATEGORY_CREATE,
            PermissionEnum::NEWS_CATEGORY_EDIT,
            PermissionEnum::NEWS_CATEGORY_DELETE,
            PermissionEnum::NEWS_CATEGORY_RESTORE,

            // Activity
            PermissionEnum::ACTIVITY_VIEWANY,
            PermissionEnum::ACTIVITY_RESTORE,

            // ActivityCategory
            PermissionEnum::ACTIVITY_CATEGORY_VIEWANY,
            PermissionEnum::ACTIVITY_CATEGORY_CREATE,
            PermissionEnum::ACTIVITY_CATEGORY_EDIT,
            PermissionEnum::ACTIVITY_CATEGORY_DELETE,
            PermissionEnum::ACTIVITY_CATEGORY_RESTORE,

            // Blog
            PermissionEnum::BLOG_VIEWANY,
            PermissionEnum::BLOG_RESTORE,

            // BlogCategory
            PermissionEnum::BLOG_CATEGORY_VIEWANY,
            PermissionEnum::BLOG_CATEGORY_CREATE,
            PermissionEnum::BLOG_CATEGORY_EDIT,
            PermissionEnum::BLOG_CATEGORY_DELETE,
            PermissionEnum::BLOG_CATEGORY_RESTORE,
        ];

        $this->createRole(RoleEnum::ADMIN,
            array_merge(
                $adminPermissions,
                $instructorPermissions,
                $userPermissions,
                $generalPermissions
            )
        );

        $this->createRole(RoleEnum::INSTRUCTOR,
            array_merge(
                $instructorPermissions,
                $userPermissions,
                $generalPermissions
            )
        );

        $this->createRole(RoleEnum::USER,
            array_merge(
                $userPermissions,
                $generalPermissions
            )
        );

    }

    private function createRole(RoleEnum $role, array|Collection $permissions): void
    {
        Role::create(['name' => $role->value])
            ->givePermissionTo($permissions);
    }

    /* Add all permissions to Super Admin */
    private function createSuperAdminRole(): void
    {
        $this->createRole(RoleEnum::SUPER_ADMIN, Permission::all());
    }

}
