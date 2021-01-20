<div class="col-lg-3 col-xs-12">
    <aside class="sidebar static right">
        @include('frontend.widgets.forum')

        {{-- Foreach Widgets Forum Database --}}


        <!--
        <div class="widget">
            <h4 class="widget-title">Explor Events <a title="" href="#" class="see-all">See All</a></h4>
            <div class="rec-events bg-purple">
                <i class="ti-gift"></i>
                <h6><a href="" title="">Ocean Motel good night event in columbia</a></h6>
                <img src="images/clock.png" alt="">
            </div>
            <div class="rec-events bg-blue">
                <i class="ti-microphone"></i>
                <h6><a href="" title="">2016 The 3rd International Conference</a></h6>
                <img src="images/clock.png" alt="">
            </div>
        </div>-->


        @include('frontend.widgets.popular_categories', [$title = 'Popüler Kategoriler'])
        @include('frontend.widgets.ads')
    </aside>
</div><!-- sidebar -->
