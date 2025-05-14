<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('updated_at', function ($table) {
                $table->softDeletes();
                $table->foreignId('created_by')->nullable()->constrained('users');
                $table->foreignId('updated_by')->nullable()->constrained('users');
                $table->foreignId('deleted_by')->nullable()->constrained('users');
            });
            $table->uuid()->unique();
            $table->string('first_name');
            $table->string('initials');
            $table->string('last_name');
            $table->tinyInteger('gender');
            $table->date('date_of_birth');
            $table->string('street');
            $table->string('zipcode');
            $table->string('place');
            $table->foreignId('country_id')->constrained('countries');
            $table->string('phone_number')->nullable();
            $table->text('about_me')->nullable();
            $table->string('avatar')->nullable();

            $table->date('medical_check')->nullable();
            $table->integer('dives')->nullable();
            $table->tinyInteger('federation')->nullable();
            $table->string('federation_membership')->nullable();
            $table->string('ice_name')->nullable();
            $table->string('ice_phone_number')->nullable();
            $table->boolean('privacy_mode')->default(false);
            $table->boolean('display_userlist')->default(true);
            $table->date('accepted_terms')->nullable();
            $table->dateTime('last_online')->nullable();
            $table->string('last_visited')->nullable();
            $table->boolean('notify_push_admin')->default(true);
            $table->boolean('notify_push_news_added')->default(true);
            $table->boolean('notify_push_news_edited')->default(true);
            $table->boolean('notify_push_activity_added')->default(true);
            $table->boolean('notify_push_activity_edited')->default(true);
            $table->boolean('notify_push_activity_removed')->default(true);
            $table->boolean('notify_push_activity_reminder')->default(true);
            $table->integer('notify_push_activity_reminder_minutes_before')->default(60);
            $table->boolean('notify_push_subscription_added')->default(true);
            $table->boolean('notify_push_subscription_edited')->default(true);
            $table->boolean('notify_push_subscription_removed')->default(true);
            $table->boolean('notify_mail_admin')->default(true);
            $table->boolean('notify_mail_news_added')->default(true);
            $table->boolean('notify_mail_news_edited')->default(true);
            $table->boolean('notify_mail_activity_added')->default(true);
            $table->boolean('notify_mail_activity_edited')->default(true);
            $table->boolean('notify_mail_activity_removed')->default(true);
            $table->boolean('notify_mail_activity_reminder')->default(false);
            $table->boolean('notify_mail_subscription_added')->default(true);
            $table->boolean('notify_mail_subscription_edited')->default(true);
            $table->boolean('notify_mail_subscription_removed')->default(true);
            $table->integer('notify_mail_activity_reminder_minutes_before')->default(60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
            $table->dropConstrainedForeignId('deleted_by');
            $table->dropColumn('deleted_at');
            $table->dropColumn('first_name');
            $table->dropColumn('initials');
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('street');
            $table->dropColumn('zipcode');
            $table->dropColumn('place');
            $table->dropConstrainedForeignId('country_id');
            $table->dropColumn('phone_number');
            $table->dropColumn('about_me');
            $table->dropColumn('avatar');
            $table->dropConstrainedForeignId('certificate_id');
            $table->dropColumn('medical_check');
            $table->dropColumn('dives');
            $table->dropColumn('federation');
            $table->dropColumn('federation_membership');
            $table->dropColumn('sac');
            $table->dropColumn('ice_name');
            $table->dropColumn('ice_phone_number');
            $table->dropColumn('privacy_mode');
            $table->dropColumn('display_userlist');
            $table->dropColumn('accepted_terms');
            $table->dropColumn('last_online');
            $table->dropColumn('last_visited');
            $table->dropColumn('notify_push_admin');
            $table->dropColumn('notify_push_news_added');
            $table->dropColumn('notify_push_news_edited');
            $table->dropColumn('notify_push_activity_added');
            $table->dropColumn('notify_push_activity_edited');
            $table->dropColumn('notify_push_activity_removed');
            $table->dropColumn('notify_push_activity_reminder');
            $table->dropColumn('notify_push_subscription_added');
            $table->dropColumn('notify_push_subscription_edited');
            $table->dropColumn('notify_push_subscription_removed');
            $table->dropColumn('notify_push_activity_reminder_minutes_before');
            $table->dropColumn('notify_mail_admin');
            $table->dropColumn('notify_mail_news_added');
            $table->dropColumn('notify_mail_news_edited');
            $table->dropColumn('notify_mail_activity_added');
            $table->dropColumn('notify_mail_activity_edited');
            $table->dropColumn('notify_mail_activity_removed');
            $table->dropColumn('notify_mail_activity_reminder');
            $table->dropColumn('notify_mail_subscription_added');
            $table->dropColumn('notify_mail_subscription_edited');
            $table->dropColumn('notify_mail_subscription_removed');
            $table->dropColumn('notify_mail_activity_reminder_minutes_before');
        });
    }
};
