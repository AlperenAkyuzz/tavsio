<div class="central-meta item">
    <div class="user-post">
        <div class="friend-info">
            <figure>
                <img src="{{ asset($author_image) }}" alt=""> <!-- Post Author Image -->
            </figure>
            <div class="friend-name">
                <div class="row">
                    <div class="col-lg-6 col-xs-12 post-info">
                        <ins><a href="{{ url($post->user->username) }}" title="">{{ $post->user->username }}</a><span class="post-type advice-brush"> {{ \App\Models\Cms\Post\Post::POST_TYPE[$post->type] }}</span></ins>
                        <span class="post-date"><a href="{{ url('detay/'.$post->slug) }}"><i class="fa fa-globe"></i> {{ $post->created_at }}</a> </span>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="more">
                            {{-- @if($post->type == \App\Tavsio\Tavsio::POST_COMMENT) --}}
                            <!--
                            <ol class="pit-rate">
                                <li class="rated"><i class="fa fa-star"></i></li>
                                <li class="rated"><i class="fa fa-star"></i></li>
                                <li class="rated"><i class="fa fa-star"></i></li>
                                <li class="rated"><i class="fa fa-star"></i></li>
                                <li class=""><i class="fa fa-star"></i></li>
                                <li><span>4.7/5</span></li>
                            </ol>
                            -->
                                {{-- @endif --}}
                                <span class="label label-default">New</span></h1>
                            <div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
                                <ul>

                                    @if(Auth::id() === $post->user->id)
                                        <li><i class="fa fa-pencil-square-o"></i>Düzenle</li>
                                        <li><i class="fa fa-trash"></i>Sil</li>
                                    @endif

                                    @if(Auth::id() !== $post->user->id)
                                        <li class="bad-report"><i class="fa fa-flag"></i>Kötüye Kullanım Bildir</li>
                                    @endif
                                    @if($notify == 'on')
                                        <li><i class="fa fa-bell-slash"></i>Bildirimleri Kapat</li>
                                    @else
                                        <li><i class="fa fa-bell"></i>Bildirimleri Aç</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="post-meta">
                @yield('post-meta')
                <div class="we-video-info">
                    <ul>
                        <li>
                            <span class="views" title="Görüntülenme" data-toggle="tooltip">
                                <i class="fa fa-eye"></i>
                                <ins>1.2k</ins> <!-- Comment Count -->
                            </span>
                        </li>
                        <li>
                            <span class="comment" title="Beğen" data-toggle="tooltip">
                                <i class="fa fa-thumbs-up"></i>
                                <ins>52</ins> <!-- Like Count -->
                            </span>
                        </li>
                        <li>
                            <span class="comment" title="Yorum Yap" data-toggle="tooltip">
                                <i class="fa fa-commenting"></i>
                                <ins>52</ins> <!-- Comment Count -->
                            </span>
                        </li>
                        <li>
                            <span>
                                 <a class="share-pst" href="#" title="Paylaş" data-toggle="tooltip">
                                     <i class="fa fa-share-alt"></i>
                                </a>
                                <ins>20</ins><!-- Share Count -->
                            </span>
                        </li>
                        <li>
                            <span class="bookmark-box mr-3">
                                <a href="#" title="Kaydet">
                                    <i class="fa fa-bookmark @if($bookmark == 'active') active @endif"></i>
                                </a>
                            </span>
                        </li>
                    </ul>
                    <div class="users-thumb-list">
                        <!-- if auth user liked then echo "Sen" and display likes count -->
                        <strong><span class="color-red">Kategori</span></strong>
                    </div>
                </div>
            </div>
            <div class="coment-area">
                <ul class="we-comet">

                    <!-- Foreach Post Comments -->
                    @foreach($post->comments as $comment)
                        <li>
                            <div class="comet-avatar">
                                <img src="{{ asset('uploads/profiles/'.$comment->user->username) }}" alt="">
                            </div>
                            <div class="we-comment">
                                <h5><a href="{{ url($comment->user->username) }}" title="">{{ $comment->user->username }}</a></h5>
                                <p>{{ $comment->comment }}</p>
                                <div class="inline-itms">
                                    <span>{{ $comment->created_at}}</span>
                                    <a class="we-reply" href="#" title="Cevapla" data-username="{{ $comment->user->username }}"><i class="fa fa-reply"></i></a>
                                    <!-- Reply butonuna tıklandığında jQuery ile data username'i al ve commentbox'a @ işareti ile birlikte kullanıcı adını ekle. -->
                                    <a href="#" data-username="{{ $comment->user->username }}" title="{{ $comment->user->username }} yorumunu beğen"><i class="fa fa-heart"></i><span>20</span></a>
                                </div>
                            </div>
                        </li>
                    @endforeach

                    <!-- Endforeach Post Comments -->
                    <li>
                        <a href="detay/{{ $post->slug }}" title="" class="showmore underline">daha fazlası+</a>
                    </li>
                    <li class="post-comment">
                        <div class="comet-avatar">
                            <img src="{{ asset('frontend/images/resources/nearly1.jpg') }}" alt="">
                        </div>
                        <div class="post-comt-box">
                            <form method="post">
                                <textarea placeholder="Yorumunuzu yazın.."></textarea>
                                <div class="add-smiles">
                                    <div class="uploadimage">
                                        <i class="fa fa-image"></i>
                                        <label class="fileContainer">
                                            <input type="file">
                                        </label>
                                    </div>
                                </div>
                                <button type="submit"></button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- post  end -->
