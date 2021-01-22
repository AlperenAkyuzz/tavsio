@extends('frontend.layouts.post.type.type')

@php
    $author = "Alperen AKYUZ";
    $author_image = "frontend/images/resources/nearly1.jpg";
    $profile_link = "alperenakyuz";
    $post_type = "Harici";
    $post_date = "20 Ocak 2021 Pazartesi 10:50";
    $bookmark = "false";
    $notify = "on";

@endphp
@section('post-meta')
    <div class="linked-image align-left">
        <a title="" href="#"><img alt="" src="images/resources/page1.jpg"></a>
    </div>
    <div class="detail">
        <span>Love Maid - HighChill</span>
        <p>{{ $post->content }}</p>
        <a title="" href="#">www.sample.com</a>
    </div>

    <ul class="like-dislike">
        <li><a class="bg-blue" href="#" title="Like Post"><i class="fa fa-thumbs-up"></i></a></li>
        <li><a class="bg-red" href="#" title="dislike Post"><i class="fa fa-thumbs-down"></i></a></li>
    </ul>
@overwrite
