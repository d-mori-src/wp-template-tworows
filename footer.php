<?php 
    $uri = get_theme_file_uri(); // ルートpath
    global $post;
    $slug = $post->post_name;
    $site_url = site_url(); // サイトURL
    $server_uri = $_SERVER['REQUEST_URI'];
    $server_uri_trimed = substr($server_uri, 0, strcspn($server_uri,'?')); 
?>
            <footer>
                <div class="innerFooter">
                    <ul class="pc-footerNavi">
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
    </body>
</html>