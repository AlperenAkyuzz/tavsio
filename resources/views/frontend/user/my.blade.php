@extends('frontend.layouts.app')

@section('title', 'Profilim')

@section('content')
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">

                            @include('frontend.layouts.user.profile.banner', [$own = true])

                            <div class="col-lg-9 col-xs-12">
                                <div class="loadMore">
                                    @include('frontend.layouts.post.type.sponsor')
                                </div>
                            </div><!-- posts end -->
                            <div class="col-lg-3">
                                <aside class="sidebar static right">
                                    @include('frontend.widgets.user_summary')
                                    @include('frontend.widgets.user_badges')
                                    @include('frontend.widgets.ads')
                                    @include('frontend.widgets.popular_categories', [$title = 'Favori Kategorilerim'])
                                    @include('frontend.widgets.shortcuts')
                                </aside>
                            </div><!-- sidebar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- content -->
@endsection
@section('popup')
    {{-- @if(!user->auth() --}}
    @include('frontend.layouts.modals.send-message')
@endsection
