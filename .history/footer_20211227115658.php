<?php 
    $uri = get_theme_file_uri(); // ルートpath
    global $post;
    $slug = $post->post_name;
    $site_url = site_url(); // サイトURL
    $server_uri = $_SERVER['REQUEST_URI'];
    $server_uri_trimed = substr($server_uri, 0, strcspn($server_uri,'?')); 
?>
            <input type="hidden" class="article_page">
            <input type="hidden" id="history_count" value="1">
            
            <footer>
                <div class="innerFooter">
                    <ul class="pc-footerNavi">
                        <li><a href="<?=$site_url;?>/facilities">施設検索</a></li>
                        <li><a href="<?=$site_url;?>/presents">プレゼント応募</a></li>
                        <li><a href="<?=$site_url;?>/questionnaire">ご意見・ご要望</a></li>
                        <li><a href="<?=$site_url;?>/contribute">情報提供</a></li>
                        <li><a href="<?=$site_url;?>/mail_magazine">メルマガ登録・解除</a></li>
                        <li><a href="<?=$site_url;?>/advertisement">広告掲載のご案内</a></li>
                    </ul>
                    <p class="copyright">Copyright<span>©</span><?=date("Y"); ?> KissPress</p>
                </div>
            </footer>
        </div>
    <?php wp_footer(); ?>

    <script src="<?= $uri ?>/js/jquery.3.4.1.js"></script>
    <script type="text/javascript" src="<?= $uri ?>/js/slick.min.js"></script>
    <script src="<?= $uri ?>/js/thumb_slide.js"></script>
    <script src="<?= $uri ?>/js/main.js"></script>
    <?php if ($server_uri === '/' || $slug === 'favorite'): ?>
        <script src="<?= $uri ?>/js/infinite_scroll.js"></script>
    <?php endif; ?>
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script><!-- 住所自動入力プラグイン -->
    </body>
</html>