@extends('frontend.layouts.app')

@section('title', $user->username.' Profili')

@section('content')
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">

                            @include('frontend.layouts.user.profile.banner')

                            <div class="col-lg-9 col-xs-12">
                                @if(count($posts))
                                    <div class="loadMore">
                                        @foreach($posts as $post)
                                            @include('frontend.layouts.post.type.'.\App\Models\Cms\Post\Post::POST_TYPE[$post->type]) <!-- Pass data to blade template -->
                                        @endforeach
                                    </div>
                                @else
                                    <h5>Henüz bir şey paylaşılmamış</h5>
                                @endif
                            </div><!-- posts end -->
                            <div class="col-lg-3">
                                <aside class="sidebar static right">
                                    @include('frontend.widgets.user_summary')
                                    @include('frontend.widgets.user_badges')
                                    @include('frontend.widgets.ads')
                                    @include('frontend.widgets.popular_categories', [$title = 'Favori Kategorileri'])
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
