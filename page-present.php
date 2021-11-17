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
                <li class="presentItem">
                    <a href="" class="leftPresent">
                        <img src="<?=$uri?>/img/common/dammy.jpg" class="presentImage" alt="">
                    </a>
                    <a href="" class="rightPresent">
                        <div class="title">
                            <h3><?=mb_substr('タイトルテキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,35); ?></h3>
                            <p><?=mb_substr('本文テキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,70); ?> ...</p>
                        </div>
                        <div class="text">
                            <span>
                                ●0名様<br />
                                ●0000/00/00
                            </span>
                            <div class="presentBtn">ご応募はこちら</div>
                        </div>
                    </a>
                </li>
                <li class="presentItem">
                    <a href="" class="leftPresent">
                        <img src="<?=$uri?>/img/common/dammy.jpg" class="presentImage" alt="">
                    </a>
                    <a href="" class="rightPresent">
                        <div class="title">
                            <h3><?=mb_substr('タイトルテキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,35); ?></h3>
                            <p><?=mb_substr('本文テキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,70); ?> ...</p>
                        </div>
                        <div class="text">
                            <span>
                                ●0名様<br />
                                ●0000/00/00
                            </span>
                            <div class="presentBtn">ご応募はこちら</div>
                        </div>
                    </a>
                </li>
                <li class="presentItem">
                    <a href="" class="leftPresent">
                        <img src="<?=$uri?>/img/common/dammy.jpg" class="presentImage" alt="">
                    </a>
                    <a href="" class="rightPresent">
                        <div class="title">
                            <h3><?=mb_substr('タイトルテキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,35); ?></h3>
                            <p><?=mb_substr('本文テキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,70); ?> ...</p>
                        </div>
                        <div class="text">
                            <span>
                                ●0名様<br />
                                ●0000/00/00
                            </span>
                            <div class="presentBtn">ご応募はこちら</div>
                        </div>
                    </a>
                </li>
                <li class="presentItem">
                    <a href="" class="leftPresent">
                        <img src="<?=$uri?>/img/common/dammy.jpg" class="presentImage" alt="">
                    </a>
                    <a href="" class="rightPresent">
                        <div class="title">
                            <h3><?=mb_substr('タイトルテキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,35); ?></h3>
                            <p><?=mb_substr('本文テキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,70); ?> ...</p>
                        </div>
                        <div class="text">
                            <span>
                                ●0名様<br />
                                ●0000/00/00
                            </span>
                            <div class="presentBtn">ご応募はこちら</div>
                        </div>
                    </a>
                </li>
                <li class="presentItem">
                    <a href="" class="leftPresent">
                        <img src="<?=$uri?>/img/common/dammy.jpg" class="presentImage" alt="">
                    </a>
                    <a href="" class="rightPresent">
                        <div class="title">
                            <h3><?=mb_substr('タイトルテキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,35); ?></h3>
                            <p><?=mb_substr('本文テキスト。この文章はダミーです。文字の大きさ、量をわかりやすくするため入れています。この文章はダミーです。この文章はダミーです。この文章はダミーです。',0,70); ?> ...</p>
                        </div>
                        <div class="text">
                            <span>
                                ●0名様<br />
                                ●0000/00/00
                            </span>
                            <div class="presentBtn">ご応募はこちら</div>
                        </div>
                    </a>
                </li>
            </ul>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php include('inc/ad_modal.php'); ?>

<?php get_footer(); ?>