<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

// Admin
Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/', 'Admin\HomeController@index')->name('admin_home');
    Route::get('cro/create', 'Admin\CROController@create')->name('admin_cro_create');
    Route::post('cro/create', 'Admin\CROController@create_action')->name('admin_cro_create_action');
    Route::get('cro/list', 'Admin\CROController@list')->name('admin_cro_list');
    Route::get('cro/edit/{id}', 'Admin\CROController@edit')->name('admin_cro_edit');
    Route::post('cro/edit/{id}', 'Admin\CROController@edit_action')->name('admin_cro_edit_action');

    Route::get('smo/create', 'Admin\SMOController@create')->name('admin_smo_create');
    Route::post('smo/create', 'Admin\SMOController@create_action')->name('admin_smo_create_action');
    Route::get('smo/list', 'Admin\SMOController@list')->name('admin_smo_list');
    Route::get('smo/edit/{id}', 'Admin\SMOController@edit')->name('admin_smo_edit');
    Route::post('smo/edit/{id}', 'Admin\SMOController@edit_action')->name('admin_smo_edit_action');

    Route::get('cro/projects/{cro_id}', 'Admin\CROController@project_index')->name('admin_cro_projects');
});

// CRO
Route::prefix('cro')->middleware(['auth', 'auth.cro'])->group(function () {
    Route::get('/', 'CRO\HomeController@index')->name('cro_home');

    Route::middleware(['auth.cro.admin'])->group(function() {
        Route::get('member/create', 'CRO\MemberController@create')->name('cro_member_create');
        Route::post('member/create', 'CRO\MemberController@create_action')->name('cro_member_create_action');
        Route::get('member/list', 'CRO\MemberController@list')->name('cro_member_list');
        Route::get('member/edit/{id}', 'CRO\MemberController@edit')->name('cro_member_edit');
        Route::post('member/edit/{id}', 'CRO\MemberController@edit_action')->name('cro_member_edit_action');

        Route::get('profile/company', 'CRO\ProfileController@company')->name('cro_profile_company');
        Route::post('profile/company', 'CRO\ProfileController@company_action')->name('cro_profile_company_action');
        Route::get('profile/billing', 'CRO\ProfileController@billing')->name('cro_profile_billing');
        Route::post('profile/billing', 'CRO\ProfileController@billing_action')->name('cro_profile_billing_action');
    });

    Route::get('profile/user', 'CRO\ProfileController@user')->name('cro_profile_user');
    Route::post('profile/user', 'CRO\ProfileController@user_action')->name('cro_profile_user_action');

    Route::get('project/create', 'CRO\ProjectController@create')->name('cro_project_create');
    Route::post('project/create', 'CRO\ProjectController@create_action')->name('cro_project_create_action');

    Route::get('project/list', 'CRO\ProjectController@list')->name('cro_project_list');
    // post status
    Route::get('project/post/{project_id}', 'CRO\PostController@index')->name('cro_project_posts');
    Route::post('project/post/{project_id}', 'CRO\PostController@set_status')->name('set_project_status');

    // post status end1
    Route::get('project/edit/{id}', 'CRO\ProjectController@edit')->name('cro_project_edit');
    Route::post('project/edit/{id}', 'CRO\ProjectController@edit_action')->name('cro_project_edit_action');

    // jquery API
    Route::post('project/status/edit/{id}/{status}', 'CRO\ProjectController@status_edit_action')->name('cro_project_status_edit_action');
});

// SMO
Route::prefix('smo')->middleware(['auth', 'auth.smo'])->group(function () {
    Route::get('/', 'SMO\HomeController@index')->name('smo_home');

    Route::middleware(['auth.smo.admin'])->group(function() {
        Route::get('member/create', 'SMO\MemberController@create')->name('smo_member_create');
        Route::post('member/create', 'SMO\MemberController@create_action')->name('smo_member_create_action');
        Route::get('member/list', 'SMO\MemberController@list')->name('smo_member_list');
        Route::get('member/edit/{id}', 'SMO\MemberController@edit')->name('smo_member_edit');
        Route::post('member/edit/{id}', 'SMO\MemberController@edit_action')->name('smo_member_edit_action');

        Route::get('profile/company', 'SMO\ProfileController@company')->name('smo_profile_company');
        Route::post('profile/company', 'SMO\ProfileController@company_action')->name('smo_profile_company_action');
    });

    Route::get('profile/user', 'SMO\ProfileController@user')->name('smo_profile_user');
    Route::post('profile/user', 'SMO\ProfileController@user_action')->name('smo_profile_user_action');

    Route::get('projects', 'SMO\SMOProjectController@index')->name('smo_projects');
    Route::get('projects/{id}/posts', 'SMO\PostController@index')->name('smo_project_posts');
    Route::get('projects/{id}/posts/new', 'SMO\PostController@new')->name('new_smo_project_post');
    Route::post('projects/{project_id}/posts', 'SMO\PostController@create')->name('create_smo_project_post');
    Route::get('projects/{project_id}/posts/{post_id}/edit', 'SMO\PostController@edit')->name('edit_smo_project_post');
    Route::put('projects/{project_id}/posts/{post_id}', 'SMO\PostController@update')->name('update_smo_project_post');
    Route::delete('projects/{project_id}/posts/{post_id}', 'SMO\PostController@delete')->name('delete_smo_project_post');

    Route::get('posts/open', 'SMO\SubjectController@posts_open')->name('smo_posts_open');
    Route::get('posts/closed', 'SMO\SubjectController@posts_closed')->name('smo_posts_closed');
    Route::get('posts/{id}/subjects', 'SMO\SubjectController@post_subjects')->name('smo_post_subjects');

    Route::get('subjects/{id}', 'SMO\SubjectController@show')->name('show_smo_subject');

    // jquery API
    Route::post('subjects/{id}/status', 'SMO\SubjectController@update_status')->name('update_smo_subject_status');
    Route::post('subjects/{id}/exam_date', 'SMO\SubjectController@updateExamDate')->name('update_smo_exam_date');
    Route::post('subjects/{id}/notify', 'SMO\SubjectController@notify')->name('notify_smo_subject');

    // Debug
    if (env('APP_SMT_DEBUG')) {
        Route::post('posts/{post_id}/subjects', 'SMO\SubjectController@create')->name('create_smo_post_subject');
    }
});

Route::prefix('pro')->middleware(['auth', 'auth.pro'])->group(function() {
    Route::get('/', 'PRO\HomeController@index')->name('pro_home');

    Route::get('profile', 'PRO\ProfileController@show')->name('pro_profile_show');
    Route::post('profile', 'PRO\ProfileController@update')->name('pro_profile_update');

    Route::middleware(['auth.pro.admin'])->group(function() {
        Route::get('company', 'PRO\ProfileController@company')->name('pro_profile_company');
        Route::post('company', 'PRO\ProfileController@update_company')->name('pro_profile_update_company');

        Route::get('members', 'PRO\MemberController@index')->name('pro_members_index');
        Route::get('members/new', 'PRO\MemberController@new')->name('pro_members_new');
        Route::post('members', 'PRO\MemberController@create')->name('pro_members_create');
        Route::get('members/{id}/edit', 'PRO\MemberController@edit')->name('pro_members_edit');
        Route::post('members/{id}', 'PRO\MemberController@update')->name('pro_members_update');
    });

    Route::get('projects', 'PRO\PROProjectController@index')->name('pro_projects');
    Route::get('projects/{id}/posts', 'PRO\PostController@index')->name('pro_project_posts');
});
