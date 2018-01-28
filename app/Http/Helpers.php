<?php

namespace App\Helper;

use App\{
    CROUser, SMOUser
};

use Faker\Factory;

use Illuminate\Support\Facades\Auth;

class Address
{
    public static function display($address_json)
    {
        if (empty($address_json)) return '';
        $result = '';
        $result .= json_decode($address_json)->address_1;
        $result .= ' ' . json_decode($address_json)->address_2;
        $result .= ' ' . json_decode($address_json)->building_information;
        return $result;
    }
}

function currentSMOUser()
{
    return SMOUser::get(Auth::id());
}

function currentCROUser()
{
    return CROUser::get(Auth::id());
}

function breadcrumb($menu)
{
    $category_divide = 100;
    $category = floor($menu / $category_divide);
    if ($category == floor(config('menu.admin.main') / $category_divide)) {
        return __('admin/home.header-breadcrumb-top');
    }
    if ($category == floor(config('menu.cro.main') / $category_divide)) {
        $cro_user = currentCROUser();
        $cro_type = $cro_user->attribute->cro->type;
        if ($cro_type == config('enum.cro_type.cro')) {
            return __('cro/home.header-breadcrumb-top');
        } else if ($cro_type == config('enum.cro_type.maker')) {
            return __('cro/home.header-breadcrumb-top-maker');
        } else {
            return '';
        }
    }
    if ($category == floor(config('menu.smo.main') / $category_divide)) {
        return __('smo/home.header-breadcrumb-top');
    }
}

function inputDefaultName()
{
    return env('APP_DEBUG') ? Factory::create()->name() : '';
}

function inputDefaultZipCode()
{
    return env('APP_DEBUG') ? '150-0013' : '';
}

function inputDefaultAddress()
{
    return env('APP_DEBUG') ? '東京都渋谷区恵比寿' : '';
}

function inputDefaultAddressSup()
{
    return env('APP_DEBUG') ? '1-2-3' : '';
}

function inputDefaultNumber()
{
    return env('APP_DEBUG') ? '1' : '';
}

function changeLocaleDisplayToModel($dateTimeStr)
{
    $tokyo_datetime = new \DateTime($dateTimeStr, new \DateTimeZone('Asia/Tokyo'));
    $utc_datetime = $tokyo_datetime->setTimezone(new \DateTimeZone('UTC'));
    return $utc_datetime->format('Y/m/d H:i:s');
}

function changeLocaleModelToDisplay($dateTimeStr)
{
    $utc_datetime = new \DateTime($dateTimeStr, new \DateTimeZone('UTC'));
    $tokyo_datetime = $utc_datetime->setTimezone(new \DateTimeZone('Asia/Tokyo'));
    return $tokyo_datetime->format('Y/m/d H:i:s');
}

