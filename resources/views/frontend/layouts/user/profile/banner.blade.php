<div class="user-profile">
    <figure>
        @if(isset($own) && $own === true)
        <div class="edit-pp">
            <label class="fileContainer">
                <i class="fa fa-camera"></i>
                <input type="file">
            </label>
        </div>
        @endif
        <img src="{{ asset('frontend/images/resources/profile-image.jpg') }}" alt="">
        <ul class="profile-controls">
            @if(isset($own) && $own === true)
                <li><a href="{{ url('hesabim/duzenle') }}" title="Profilimi Düzenle" data-toggle="tooltip"><i class="fa fa-user-edit"></i></a></li>
            @else
                <li><a href="#" title="Arkadaş Ekle" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></li>
                <li><a href="#" title="Takip Et" data-toggle="tooltip"><i class="fas fa-user-tag"></i></a></li>
                <li><a class="send-mesg" href="#" title="Mesaj Gönder" data-toggle="tooltip" data-username="alperenakyuz"><i class="fa fa-comment"></i></a></li>
            @endif
        </ul>
        <ol class="pit-rate">
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class=""><i class="fa fa-star"></i></li>
            <li><span>4.7/5</span></li>
        </ol>
    </figure>

    <div class="profile-section">
        <div class="row">
            <div class="col-lg-2 col-md-3">
                <div class="profile-author">
                    <div class="profile-author-thumb">
                        <img alt="author" src="{{ asset('frontend/images/resources/author.jpg') }} ">
                        @if(isset($own) && $own === true)
                        <div class="edit-dp">
                            <label class="fileContainer">
                                <i class="fa fa-camera"></i>
                                <input type="file">
                            </label>
                        </div>
                        @endif
                    </div>

                    <div class="author-content">
                        <a class="h4 author-name" href="about.html">{{ $user->firstname }} {{ $user->lastname }}</a>
                        <div class="user-rank">{{ $user->rank }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-9">
                <ul class="profile-menu">
                    <li>
                        <a class="active" href="timeline.html">Tavsiyeler</a>
                    </li>
                    <li>
                        <a class="" href="about.html">Yorumlar</a>
                    </li>
                    @if(isset($own) && $own === true)
                        <li>
                            <a class="" href="about.html">Kaydedilenler</a>
                        </li>
                    @endif
                    <li>
                        <a class="" href="timeline-friends.html">Hakkında</a>
                    </li>
                </ul>
                <ol class="folw-detail">
                    <li><span>Posts</span><ins>101</ins></li>
                    <li><span>Followers</span><ins>1.3K</ins></li>
                    <li><span>Following</span><ins>22</ins></li>
                </ol>
            </div>
        </div>
    </div>
</div><!-- user profile banner  -->
