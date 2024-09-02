<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManagerStatic as Image;

// نمایش صفحه اصلی
Route::get('/', function () {
    return view('welcome');
});

// تغییر اندازه تصویر و افزودن متن و واترمارک
Route::get('/', function() {
    $img = Image::make(public_path('upload/dates.jpg'))->resize(700, 500);
    $img->text('this is photo of dates', 150, 100, function($font) {
        // تنظیمات متن
        // $font->size(100); // اندازه بزرگتر متن
        // $font->color('#000000'); // تغییر رنگ متن به سیاه
        // $font->align('right'); // تنظیم تراز متن به راست
        // $font->valign('middle'); // تنظیم تراز عمودی متن به وسط
        // $font->file(null); // عدم استفاده از فایل فونت خارجی
        // $font->angle(0); // عدم چرخش متن
        // افزودن واترمارک (کامنت شده)
        // $watermark = Image::make(public_path('upload/dates.jpg'))->resize(100, 100);
    });
    $watermark = Image::make(public_path('upload/cinnamon.jpg'))->resize(500, 100);
    $img->insert($watermark, 'bottom-right', 20, 20); // قرار دادن واترمارک در گوشه پایین سمت راست با حاشیه 20 پیکسل

    $img->blur(0); // اعمال اثر تاری (بلور)
    // $img->resizeCanvas(500, 220, 'center', false, '#000000'); // افزودن قاب سیاه (کامنت شده)

    return $img->response('jpg');
});

// ایجاد تصویر مستطیلی
Route::get('/rectangle', function() {
    // ایجاد بوم مستطیلی با اندازه 600x300 پیکسل و پس‌زمینه سفید
    $img = Image::canvas(600, 300, '#ffffff');

    // افزودن مستطیل در وسط تصویر
    $img->rectangle(50, 50, 550, 250, function ($draw) {
        $draw->background('#0000ff'); // مستطیل با رنگ آبی
    });

    // افزودن متن در وسط تصویر
    $img->text('صورة مستطيلة', 300, 150, function($font) {
        $font->size(24); // اندازه متن
        $font->color('#ff0000'); // رنگ متن قرمز
        $font->align('center'); // تراز متن به مرکز
        $font->valign('middle'); // تراز عمودی متن به وسط
    });

    return $img->response('jpg');
});

// ایجاد تصویر مربعی
Route::get('/square', function() {
    // ایجاد بوم مربعی با اندازه 400x400 پیکسل و پس‌زمینه سفید
    $img = Image::canvas(400, 400, '#ffffff');

    // افزودن مستطیل در وسط تصویر
    $img->rectangle(50, 50, 350, 350, function ($draw) {
        $draw->background('#0000ff'); // مستطیل با رنگ آبی
    });

    // افزودن متن در وسط تصویر
    $img->text('صورة مربعة', 200, 200, function($font) {
        $font->size(24); // اندازه متن
        $font->color('#ff0000'); // رنگ متن قرمز
        $font->align('center'); // تراز متن به مرکز
        $font->valign('middle'); // تراز عمودی متن به وسط
    });

    return $img->response('jpg');
});

// ایجاد تصویر پیش‌فرض
Route::get('/default', function() {
    // ایجاد بوم با اندازه 300x300 پیکسل و پس‌زمینه سفید
    $img = Image::canvas(300, 300, '#ffffff');

    // افزودن دایره در وسط تصویر
    $img->circle(200, 150, 150, function ($draw) {
        $draw->background('#0000ff'); // دایره با رنگ آبی
    });

    // افزودن متن در وسط تصویر
    $img->text('نص وهمی', 150, 150, function($font) {
        $font->size(24); // اندازه متن
        $font->color('#ff0000'); // رنگ متن قرمز
        $font->align('center'); // تراز متن به مرکز
        $font->valign('middle'); // تراز عمودی متن به وسط
    });

    return $img->response('jpg');
});

// ایجاد تصویر پیش‌فرض با اندازه خاص
Route::get('/default-image', function() {
    // تعیین ابعاد تصویر پیش‌فرض
    $width = 400;
    $height = 300;

    // ایجاد بوم جدید با اندازه مشخص و پس‌زمینه رنگی (مثل سفید)
    $img = Image::canvas($width, $height, '#cccccc');

    // افزودن متن پیش‌فرض به تصویر
    $img->text('hello', $width / 2, $height / 2, function($font) {
        $font->size(24); // اندازه متن
        $font->color('#000000'); // رنگ متن سیاه
        $font->align('center'); // تراز متن به مرکز
        $font->valign('middle'); // تراز عمودی متن به وسط
    });

    return $img->response('jpg');
});
