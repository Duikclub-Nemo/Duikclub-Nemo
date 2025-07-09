<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // Users
    case USER_VIEWANY = 'user.viewAny';
    case USER_CREATE = 'user.create';
    case USER_ACTIVATE = 'user.activate';
    case USER_EDIT = 'user.edit';
    case USER_DELETE = 'user.delete';
    case USER_RESTORE = 'user.restore';

    // News
    case NEWS_VIEWANY = 'news.viewAny';
    case NEWS_CREATE = 'news.create';
    case NEWS_EDIT = 'news.edit';
    case NEWS_DELETE = 'news.delete';
    case NEWS_RESTORE = 'news.restore';

    // NewsCategory
    case NEWS_CATEGORY_VIEWANY = 'news_category.viewAny';
    case NEWS_CATEGORY_CREATE = 'news_category.create';
    case NEWS_CATEGORY_EDIT = 'news_category.edit';
    case NEWS_CATEGORY_DELETE = 'news_category.delete';
    case NEWS_CATEGORY_RESTORE = 'news_category.restore';

    // Activity
    case ACTIVITY_VIEWANY = 'activity.viewAny';
    case ACTIVITY_CREATE = 'activity.create';
    case ACTIVITY_EDIT = 'activity.edit';
    case ACTIVITY_DELETE = 'activity.delete';
    case ACTIVITY_RESTORE = 'activity.restore';

    // ActivityCategory
    case ACTIVITY_CATEGORY_VIEWANY = 'activity_category.viewAny';
    case ACTIVITY_CATEGORY_CREATE = 'activity_category.create';
    case ACTIVITY_CATEGORY_EDIT = 'activity_category.edit';
    case ACTIVITY_CATEGORY_DELETE = 'activity_category.delete';
    case ACTIVITY_CATEGORY_RESTORE = 'activity_category.restore';

    // Subscription
    case SUBSCRIPTION_VIEWANY = 'subscription.viewAny';
    case SUBSCRIPTION_CREATE = 'subscription.create';
    case SUBSCRIPTION_EDIT = 'subscription.edit';
    case SUBSCRIPTION_DELETE = 'subscription.delete';
    case SUBSCRIPTION_RESTORE = 'subscription.restore';

    // Blog
    case BLOG_VIEWANY = 'blog.viewAny';
    case BLOG_CREATE = 'blog.create';
    case BLOG_EDIT = 'blog.edit';
    case BLOG_DELETE = 'blog.delete';
    case BLOG_RESTORE = 'blog.restore';

    // BlogCategory
    case BLOG_CATEGORY_VIEWANY = 'blog_category.viewAny';
    case BLOG_CATEGORY_CREATE = 'blog_category.create';
    case BLOG_CATEGORY_EDIT = 'blog_category.edit';
    case BLOG_CATEGORY_DELETE = 'blog_category.delete';
    case BLOG_CATEGORY_RESTORE = 'blog_category.restore';

    // Profile
    case PROFILE_VIEW = 'profile.view';
    case PROFILE_EDIT = 'profile.edit';
    case PROFILE_DELETE = 'profile.delete';

    // Member Certificate
    case MEMBER_CERTIFICATE_LIST = 'member.certificate.list';
    case MEMBER_CERTIFICATE_VIEW = 'member.certificate.view';
    case MEMBER_CERTIFICATE_CREATE = 'member.certificate.create';
    case MEMBER_CERTIFICATE_EDIT = 'member.certificate.edit';
    case MEMBER_CERTIFICATE_DELETE = 'member.certificate.delete';

    // Member User
    case MEMBER_USERS_LIST = 'member.user.list';
    case MEMBER_USERS_VIEW = 'member.user.view';

    // Member Activity
    case MEMBER_ACTIVITY_LIST = 'member.activity.list';
    case MEMBER_ACTIVITY_VIEW = 'member.activity.view';
    case MEMBER_ACTIVITY_CREATE = 'member.activity.create';
    case MEMBER_ACTIVITY_EDIT = 'member.activity.edit';
    case MEMBER_ACTIVITY_DELETE = 'member.activity.delete';

    // Member Activity
    case MEMBER_SUBSCRIPTION_LIST = 'member.subscription.list';
    case MEMBER_SUBSCRIPTION_VIEW = 'member.subscription.view';
    case MEMBER_SUBSCRIPTION_CREATE = 'member.subscription.create';
    case MEMBER_SUBSCRIPTION_EDIT = 'member.subscription.edit';
    case MEMBER_SUBSCRIPTION_DELETE = 'member.subscription.delete';

    // Member Download
    case MEMBER_DOWNLOAD_LIST = 'member.download.list';
    case MEMBER_DOWNLOAD_VIEW = 'member.download.view';

    // Member Setting
    case MEMBER_SETTING_LIST = 'member.setting.list';
    case MEMBER_SETTING_EDIT = 'member.setting.edit';

    // General
    case AVATAR_STORE = 'avatar.store';
    case AVATAR_DELETE = 'avatar.delete';

}
