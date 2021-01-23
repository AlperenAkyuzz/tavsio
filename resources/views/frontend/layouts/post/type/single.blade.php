@extends('frontend.layouts.post.type.type')

@php
    $author = "Hepsiburada";
    $author_image = "frontend/images/resources/nearly1.jpg";
    $profile_link = "https://hepsiburada.com";
    $post_type = "Test";
    $post_date = "20 Ocak 2021 Pazartesi 10:50";
    $bookmark = "active";
    $notify = "off";

    $image = json_decode($post->meta->images);

@endphp
@section('post-meta')
    <figure>
        <img src="{{ asset('uploads/'.$image[0]) }}" alt="">
        <ul class="like-dislike">
            <li><a class="bg-blue" href="#" title="Beğen" data-toggle="tooltip"><i class="fa fa-thumbs-up"></i></a></li>
            <li><a class="bg-red" href="#" title="Beğenme" data-toggle="tooltip"><i class="fa fa-thumbs-down"></i></a></li>
        </ul>
    </figure>
    <div class="description">
        <p>
            {{ $post->meta->content }}
        </p>
    </div>
@endsection
