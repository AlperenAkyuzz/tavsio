@extends('frontend.layouts.post.type.type')

@php
    $author = "Alperen AKYUZ";
    $author_image = "frontend/images/resources/nearly1.jpg";
    $profile_link = "alperenakyuz";
    $post_type = "Tavsiye";
    $post_date = "20 Ocak 2021 Pazartesi 10:50";
    $bookmark = "false";
    $notify = "on";
@endphp
@section('post-meta')
    <p>
        {{ $post->meta->content  }}
    </p>
    <figure>
        <div class="img-bunch">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <figure>
                        <a href="#" title="" data-toggle="modal" data-target="#main-modal">
                            <img src="{{ asset('frontend/images/resources/album1.jpg') }}" alt="">
                        </a>
                    </figure>
                    <figure>
                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            <img src="{{ asset('frontend/images/resources/album2.jpg') }}" alt="">
                        </a>
                    </figure>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <figure>
                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            <img src="{{ asset('frontend/images/resources/album6.jpg') }}" alt="">
                        </a>
                    </figure>
                    <figure>
                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            <img src="{{ asset('frontend/images/resources/album5.jpg') }}" alt="">
                        </a>
                    </figure>
                    <figure>
                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            <img src="{{ asset('frontend/images/resources/album4.jpg') }}" alt="">
                        </a>
                        <div class="more-photos">
                            <span>+15</span>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
        <ul class="like-dislike">
            <li><a class="bg-blue" href="#" title="Like Post"><i class="fa fa-thumbs-up"></i></a></li>
            <li><a class="bg-red" href="#" title="dislike Post"><i class="fa fa-thumbs-down"></i></a></li>
        </ul>
    </figure>
@overwrite
