<div class="glob-modal send-message-modal">
    <div class="popup direct-mesg">
        <span class="popup-closed"><i class="ti-close"></i></span>
        <div class="popup-meta">
            <div class="popup-head">
                <h5>Mesaj Gönder</h5>
            </div>
            @auth
            <div class="send-message">
                <form method="post" class="c-form">
                    <input name="username" type="text" disabled>
                    <textarea placeholder="Mesajınız" rows="5"></textarea>
                    <button type="submit" class="main-btn">Gönder</button>
                </form>
            </div>
            @else
                Lütfen giriş yapınız
            @endauth
        </div>
    </div>
</div><!-- send message popup -->
