@extends('frontend.layouts.app')

@section('title', 'Anasayfa')

@section('content')
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">
                            {{-- @include('frontend.layouts.home.sidebar-left') --}}
                            <div class="col-lg-9 col-xs-12">
                                @include('frontend.layouts.post.modules.add-post')
                                {{-- @include('frontend.layouts.post.modules.stories') --}}
                                <div class="loadMore">
                                    <!--
                                    Types: album, video, sponsor, external, map
                                    -->
                                    <!-- foreach posts -->
                                    @include('frontend.layouts.post.type.sponsor') <!-- Pass data to blade template -->
                                    @include('frontend.layouts.post.type.video')
                                    <!-- endforeach posts -->
                                </div>
                            </div><!-- content -->
                            @include('frontend.layouts.home.sidebar-right')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('popup')
    @include('frontend.layouts.modals.type.image-comments')
@endsection
