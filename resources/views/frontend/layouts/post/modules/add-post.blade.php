<div class="central-meta add-post-box">
    <div class="add-post-button">
        <a href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Tavsiye veya yorumunu paylaş</a>
    </div>
</div>
{{--
<div class="central-meta postbox">
    <!--
    <div class="row">
        <div class="col-md-6 col-lg-6" style="border-bottom: 1px solid #e6ecf5;">
            <span class="create-post"><button class="btn btn-link">Yeni Bir Tavsiye</button></span>
        </div>
        <div class="col-md-6 col-lg-6" style="border-bottom: 1px solid #e6ecf5;">
            <span class="create-post"><button class="btn btn-link">Yeni Bir Yorum</button></span>
        </div>
    </div>-->
    <span class="create-post">Yeni Gönderi</span>


    <div class="tab-content">
        <div class="tab-pane fade active show" id="advice">
            <div class="new-postbox">
                <figure>
                    <img src="{{ asset('frontend/images/resources/admin.jpg') }}" alt="">
                </figure>
                <div class="newpst-input">
                    <form method="post">
                        <textarea rows="2" placeholder="Düşündüklerinizi yazın :)"></textarea>
                    </form>
                </div>
                <div class="attachments">
                    <ul>
                        <li>
							<span class="add-loc">
								<i class="fa fa-map-marker"></i>
							</span>
                        </li>
                        <li>
                            <i class="fa fa-image"></i>
                            <label class="fileContainer">
                                <input type="file">
                            </label>
                        </li>
                        <li>
                            <i class="fa fa-video-camera"></i>
                            <label class="fileContainer">
                                <input type="file">
                            </label>
                        </li>
                        <!--
                        <li class="preview-btn">
                            <button class="post-btn-preview" type="submit" data-ripple="">Önizle</button>
                        </li>-->
                    </ul>
                    <button class="post-btn" type="submit" data-ripple="">Oluştur</button>
                </div>
                <div class="add-location-post">
                    <span>Tavsiyede bulunmak istediğiniz konumu seçin.</span>
                    <div class="row">

                        <div class="col-lg-6">
                            <label class="control-label">Enlem :</label>
                            <input type="text" class="" id="us3-lat" />
                        </div>
                        <div class="col-lg-6">
                            <label>Boylam :</label>
                            <input type="text" class="" id="us3-lon" />
                        </div>
                    </div>

                    <div id="us3"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="comment">
            Yorumda bulun içeriği
        </div>
    </div>

    <!--
    <div class="new-postbox">
        <figure>
            <img src="{{ asset('frontend/images/resources/admin.jpg') }}" alt="">
        </figure>
        <div class="newpst-input">
            <form method="post">
                <textarea rows="2" placeholder="Share some what you are thinking?"></textarea>
            </form>
        </div>
        <div class="attachments">
            <ul>
                <li>
													<span class="add-loc">
														<i class="fa fa-map-marker"></i>
													</span>
                </li>
                <li>
                    <i class="fa fa-music"></i>
                    <label class="fileContainer">
                        <input type="file">
                    </label>
                </li>
                <li>
                    <i class="fa fa-image"></i>
                    <label class="fileContainer">
                        <input type="file">
                    </label>
                </li>
                <li>
                    <i class="fa fa-video-camera"></i>
                    <label class="fileContainer">
                        <input type="file">
                    </label>
                </li>
                <li>
                    <i class="fa fa-camera"></i>
                    <label class="fileContainer">
                        <input type="file">
                    </label>
                </li>
                <li class="preview-btn">
                    <button class="post-btn-preview" type="submit" data-ripple="">Preview</button>
                </li>
            </ul>
            <button class="post-btn" type="submit" data-ripple="">Post</button>
        </div>
        <div class="add-location-post">
            <span>Drag map point to selected area</span>
            <div class="row">

                <div class="col-lg-6">
                    <label class="control-label">Lat :</label>
                    <input type="text" class="" id="us3-lat" />
                </div>
                <div class="col-lg-6">
                    <label>Long :</label>
                    <input type="text" class="" id="us3-lon" />
                </div>
            </div>

            <div id="us3"></div>
        </div>
    </div>-->
</div><!-- add post new box -->
--}}
