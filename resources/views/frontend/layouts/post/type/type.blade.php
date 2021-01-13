<div class="central-meta item">
    <div class="user-post">
        <div class="friend-info">
            <figure>
                <img src="{{ asset($author_image) }}" alt=""> <!-- Post Author Image -->
            </figure>
            <div class="friend-name">
                <div class="more">
                    <div class="more-post-optns"><i class="ti-more-alt"></i>
                        <ul>
                            <li><i class="fa fa-pencil-square-o"></i>Düzenle</li>
                            <li><i class="fa fa-trash-o"></i>Sil</li>
                            <li class="bad-report"><i class="fa fa-flag"></i>Kötüye Kullanım Bildir</li>
                            <li><i class="fa fa-bell-o"></i>Bildirimleri Aç</li>
                            <li><i class="fa fa-bell-slash-o"></i>Bildirimleri Kapat</li>
                        </ul>
                    </div>
                </div>
                <ins><a href="{{ $profile_link }}" title="">{{ $author }}</a> {{ $post_type }}</ins>
                <span><i class="fa fa-globe"></i> {{ $post_date }} </span>
            </div>
            <div class="post-meta">
                @yield('post-meta')
                <div class="we-video-info">
                    <ul>
                        <li>
                            <span class="views" title="views">
                                <i class="fa fa-eye"></i>
                                <ins>1.2k</ins> <!-- Comment Count -->
                            </span>
                        </li>
                        <li>
                            <span class="comment" title="Comments">
                                <i class="fa fa-thumbs-up"></i>
                                <ins>52</ins> <!-- Like Count -->
                            </span>
                        </li>
                        <li>
                            <span class="comment" title="Comments">
                                <i class="fa fa-thumbs-down"></i>
                                <ins>51</ins> <!-- Dislike Count -->
                            </span>
                        </li>
                        <li>
                            <span class="comment" title="Comments">
                                <i class="fa fa-commenting"></i>
                                <ins>52</ins> <!-- Comment Count -->
                            </span>
                        </li>
                        <li>
                            <span>
                                 <a class="share-pst" href="#" title="Share">
                                     <i class="fa fa-share-alt"></i>
                                </a>
                                <ins>20</ins><!-- Share Count -->
                            </span>
                        </li>
                    </ul>
                    <div class="users-thumb-list">
                        <!-- if auth user liked then echo "Sen" and display likes count -->
                        <span><strong>Sen</strong> <b>ve</b> <span class="color-orange">24+ kişi</span>  beğendi</span>
                    </div>
                </div>
            </div>
            <div class="coment-area">
                <ul class="we-comet">
                    <!-- Foreach Post Comments -->
                    <li>
                        <div class="comet-avatar">
                            <img src="{{ asset('frontend/images/resources/nearly3.jpg') }}" alt="">
                        </div>
                        <div class="we-comment">
                            <h5><a href="time-line.html" title="">!! username !!</a></h5>
                            <p>!! content !!</p>
                            <div class="inline-itms">
                                <span>!! date !!</span>
                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                <!-- Reply butonuna tıklandığında jQuery ile data username'i al ve commentbox'a @ işareti ile birlikte kullanıcı adını ekle. -->
                                <a href="#" data-username="username" title="!!username!! kullanıcısına cevap ver"><i class="fa fa-heart"></i><span>20</span></a>
                            </div>
                        </div>
                    </li>
                    <!-- Endforeach Post Comments -->
                    <li>
                        <a href="/post/detay" title="" class="showmore underline">daha fazlası+</a>
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
