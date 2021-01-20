<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <title>Üye Giriş & Üye Ol | Tavsio.com</title>
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
        <div class="gap no-gap signin whitish medium-opacity">
            <div class="bg-image" style="background-image:url(images/resources/theme-bg.jpg)"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="big-ad">
                            <figure><img src="images/logo2.png" alt=""></figure>
                            <h1>Tekrar Merhaba</h1>
                            <p>
                                Tavsio'ya giriş yaparak tavsiyeler alabilir, yorum yapabilirsiniz...
                            </p>

                            <div class="fun-fact">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <div class="fun-box">
                                            <i class="ti-check-box"></i>
                                            <h6>Tavsiye de Bulunuldu</h6>
                                            <span>1,01,242</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <div class="fun-box">
                                            <i class="ti-layout-media-overlay-alt-2"></i>
                                            <h6>Yorum Yapıldı</h6>
                                            <span>21,03,245</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <div class="fun-box">
                                            <i class="ti-user"></i>
                                            <h6>Kayıtlı Kullanıcı</h6>
                                            <span>145</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="barcode">
                                <figure><img src="images/resources/Barcode.jpg" alt=""></figure>
                                <div class="app-download">
                                    <span>Download Mobile App and Scan QR Code to login</span>
                                    <ul class="colla-apps">
                                        <li><a title="" href="https://play.google.com/store?hl=en"><img src="images/android.png" alt="">android</a></li>
                                        <li><a title="" href="https://www.apple.com/lae/ios/app-store/"><img src="images/apple.png" alt="">iPhone</a></li>
                                        <li><a title="" href="https://www.microsoft.com/store/apps"><img src="images/windows.png" alt="">Windows</a></li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="we-login-register">
                            <div class="form-title">
                                <i class="fa fa-key"></i>giriş
                                <span></span>
                            </div>
                            <form class="we-form" id="form-login">
                                <div id="login-response" class="response-message"></div>
                                {{ csrf_field() }}
                                <input type="email" placeholder="Email" name="email" required="required">
                                <input type="password" placeholder="Şifre" name="password" required="required">
                                <button type="submit" data-ripple="" id="login-button">giriş</button>
                                <a class="forgot underline" href="#" title="">şifremi unuttum?</a>
                            </form>
                            <!--
                            <a class="with-smedia facebook" href="#" title="" data-ripple=""><i class="fa fa-facebook"></i></a>
                            <a class="with-smedia twitter" href="#" title="" data-ripple=""><i class="fa fa-twitter"></i></a>
                            <a class="with-smedia instagram" href="#" title="" data-ripple=""><i class="fa fa-instagram"></i></a>
                            <a class="with-smedia google" href="#" title="" data-ripple=""><i class="fa fa-google-plus"></i></a>-->
                            <span>hesabın yok mu? <a class="we-account underline" href="{{ url('kayit-ol') }}" title="">Hemen Kayıt Ol</a></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

<script src="{{ asset('frontend/js/main.min.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script src="{{ asset('frontend/js/user/auth.js') }}"></script>
</body>
</html>
