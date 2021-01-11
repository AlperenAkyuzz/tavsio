<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'lesson-child-categories/ajax',
        'categories/ajax',
        'kayit-ol/districtsAjax',
        'ogretmen-ol/doRegister',
        'ogrenci-ol/doRegister',
        'ogrenci-ol/saveLessonAjax',
        'ogrenci-ol/lessonLevelsAjax',
        'type-child-categories/ajax',
        'type-categories/ajax',
        'kurumsal-uyelik/doRegister',
        'lesson-request/searchLessonAjax',
        'lesson-request/doCreateAjax'
    ];
}
