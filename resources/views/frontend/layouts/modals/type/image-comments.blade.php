@extends('frontend.layouts.modals.modal')
@section('modal-body')
<div class="row">
    <div class="col-lg-8">
        <div class="pop-image">
            <div class="pop-item">
                <figure><img src="images/resources/blog-detail.jpg" alt=""></figure>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="user">
            <figure><img src="images/resources/user1.jpg" alt=""></figure>
            <div class="user-information">
                <h4><a href="#" title="">Danile Walker</a></h4>
                <span>2 hours ago</span>
            </div>
            <a href="#" title="Follow" data-ripple="">Follow</a>
        </div>
        <div class="we-video-info">
            <ul>
                <li>
                    <div title="Like/Dislike" class="likes heart">❤ <span>2K</span></div>
                </li>
                <li>
									<span title="Comments" class="comment">
										<i class="fa fa-commenting"></i>
										<ins>52</ins>
									</span>
                </li>

                <li>
									<span>
										<a title="Share" href="#" class="">
											<i class="fa fa-share-alt"></i>
										</a>
										<ins>20</ins>
									</span>
                </li>
            </ul>
            <div class="users-thumb-list">
                <a href="#" title="" data-toggle="tooltip" data-original-title="Anderw">
                    <img src="images/resources/userlist-1.jpg" alt="">
                </a>
                <a href="#" title="" data-toggle="tooltip" data-original-title="frank">
                    <img src="images/resources/userlist-2.jpg" alt="">
                </a>
                <a href="#" title="" data-toggle="tooltip" data-original-title="Sara">
                    <img src="images/resources/userlist-3.jpg" alt="">
                </a>
                <a href="#" title="" data-toggle="tooltip" data-original-title="Amy">
                    <img src="images/resources/userlist-4.jpg" alt="">
                </a>
                <span><strong>You</strong>, <b>Sarah</b> and <a title="" href="#">24+ more</a> liked</span>
            </div>
        </div>
        <div style="display: block;" class="coment-area">
            <ul class="we-comet">
                <li>
                    <div class="comet-avatar">
                        <img alt="" src="images/resources/nearly3.jpg">
                    </div>
                    <div class="we-comment">
                        <h5><a title="" href="time-line.html">Jason borne</a></h5>
                        <p>we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel</p>
                        <div class="inline-itms">
                            <span>1 year ago</span>
                            <a title="Reply" href="#" class="we-reply"><i class="fa fa-reply"></i></a>
                            <a title="" href="#"><i class="fa fa-heart"></i><span>20</span></a>
                        </div>
                    </div>

                </li>
                <li>
                    <div class="comet-avatar">
                        <img alt="" src="images/resources/comet-4.jpg">
                    </div>
                    <div class="we-comment">
                        <h5><a title="" href="time-line.html">Sophia</a></h5>
                        <p>we are working for the dance and sing songs. this video is very awesome for the youngster.
                            <i class="em em-smiley"></i>
                        </p>
                        <div class="inline-itms">
                            <span>1 year ago</span>
                            <a title="Reply" href="#" class="we-reply"><i class="fa fa-reply"></i></a>
                            <a title="" href="#"><i class="fa fa-heart"></i><span>20</span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="comet-avatar">
                        <img alt="" src="images/resources/comet-4.jpg">
                    </div>
                    <div class="we-comment">
                        <h5><a title="" href="time-line.html">Sophia</a></h5>
                        <p>we are working for the dance and sing songs. this video is very awesome for the youngster.
                            <i class="em em-smiley"></i>
                        </p>
                        <div class="inline-itms">
                            <span>1 year ago</span>
                            <a title="Reply" href="#" class="we-reply"><i class="fa fa-reply"></i></a>
                            <a title="" href="#"><i class="fa fa-heart"></i><span>20</span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="showmore underline" title="" href="#">more comments+</a>
                </li>
                <li class="post-comment">
                    <div class="comet-avatar">
                        <img alt="" src="images/resources/nearly1.jpg">
                    </div>
                    <div class="post-comt-box">
                        <form method="post">
                            <textarea placeholder="Post your comment"></textarea>
                            <div class="add-smiles">
                                <div class="uploadimage">
                                    <i class="fa fa-image"></i>
                                    <label class="fileContainer">
                                        <input type="file">
                                    </label>
                                </div>
                                <span title="add icon" class="em em-expressionless"></span>
                                <div class="smiles-bunch">
                                    <i class="em em---1"></i>
                                    <i class="em em-smiley"></i>
                                    <i class="em em-anguished"></i>
                                    <i class="em em-laughing"></i>
                                    <i class="em em-angry"></i>
                                    <i class="em em-astonished"></i>
                                    <i class="em em-blush"></i>
                                    <i class="em em-disappointed"></i>
                                    <i class="em em-worried"></i>
                                    <i class="em em-kissing_heart"></i>
                                    <i class="em em-rage"></i>
                                    <i class="em em-stuck_out_tongue"></i>
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
@endsection
