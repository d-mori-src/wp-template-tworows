<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="present">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="presentContents">
            <h3 class="headTitle"><img src="<?=$uri?>/img/common/precent.svg" class="presentIcon" alt="">プレゼント</h3>
            <ul class="presentItems">
                <!-- カスタム投稿必要 -->
                <li class="presentItem">
                    <a href="" class="leftPresent">
                        <img src="<?=$uri?>/img/common/dammy.jpg" class="presentImage" alt="">
                        <div class="number">00名様</div>
                    </a>
                    <a href="" class="rightPresent">
                        本文テキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。
                        <span>申込締切: 0000/00/00</span>
                    </a>
                </li>
                <li class="presentItem">
                    <a href="" class="leftPresent">
                        <img src="<?=$uri?>/img/common/dammy.jpg" class="presentImage" alt="">
                        <div class="number">00名様</div>
                    </a>
                    <a href="" class="rightPresent">
                        本文テキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。
                        <span>申込締切: 0000/00/00</span>
                    </a>
                </li>
            </ul>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php include('inc/ad_modal.php'); ?>

<?php get_footer(); ?>