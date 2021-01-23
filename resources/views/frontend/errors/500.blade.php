<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <title>Tavsio | 500 Error</title>
    <link rel="icon" href="{{ asset('frontend/images/fav.png') }}" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('frontend/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/weather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

</head>
<body>
<div class="www-layout">
    <section>
        <div class="gap no-gap ">
            <div class="eror eror500">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <div class="big-font">
                                <span>500</span>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9">
                            <div class="error-page500">
                                <div class="error-meta">
                                    <a href="#" title=""><img src="images/logo2.png" alt=""></a>
                                    <h1>Beklenmeyen Dahili Sunucu Hatası 500</h1>
                                    <p>
                                        Böyle bir hata ile karşılaştığınız için üzgünüz, lütfen sabırlı olun veya daha sonra tekrar deneyin.
                                    </p>
                                    <img src="{{ asset('frontend/images/resources/error500.gif') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('frontend/js/main.min.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>
</body>
</html>
