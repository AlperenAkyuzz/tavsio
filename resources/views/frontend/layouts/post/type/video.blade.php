@extends('frontend.layouts.post.type.type')

@php
    $author = "Alperen AKYUZ";
    $author_image = "frontend/images/resources/nearly1.jpg";
    $profile_link = "alperenakyuz";
    $post_type = "Video Tavsiye";
    $post_date = "20 Ocak 2021 Pazartesi 10:50";
@endphp
@section('post-meta')
    <figure>
        <a href="https://www.youtube.com/watch?v=fF382gwEnG8" title="" data-strip-group="mygroup" class="strip vdeo-link" data-strip-options="width: 700,height: 450,youtube: { autoplay: 1 }">
            <img src="{{ asset('frontend/images/resources/user-post.jpg') }}" alt="">
            <i>
                <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="55px" width="55px"
                     viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                                  <path class="stroke-solid" fill="none" stroke=""  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                    C97.3,23.7,75.7,2.3,49.9,2.5"/>
                    <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"/>
                                                                    </svg>
            </i>
            <h2>Canada tourist spots you must visit in 2020</h2>
        </a>
        <ul class="like-dislike">
            <li><a class="bg-blue" href="#" title="Like Post"><i class="fa fa-thumbs-up"></i></a></li>
            <li><a class="bg-red" href="#" title="dislike Post"><i class="fa fa-thumbs-down"></i></a></li>
        </ul>

    </figure>
    <div class="description">
        <p>
            Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc.
        </p>
    </div>
@overwrite
