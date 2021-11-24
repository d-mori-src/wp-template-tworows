<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="present_detail">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="presentContents">
            <h3 class="headTitle"><img src="<?=$uri?>/img/common/precent.svg" class="presentIcon" alt="">プレゼント</h3>
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <h1><?php the_field('title_copy'); ?></h1>
                    <div class="presentFlexWrappwer">
                        <div class="leftWrappwer">
                            <div class="winning">
                                <p><?php the_field('people'); ?>名様</p>
                                <p><?php the_field('application_deadline'); ?>まで</p>
                            </div>
                            <p class="lead"><?php the_field('sentence1'); ?></p>
                        </div>
                        <div class="RightWrappwer">
                            <?php if(get_field('image2')): ?>
                                <img src="<?php the_field('image1'); ?>" class="presentImage harf" />
                                <img src="<?php the_field('image2'); ?>" class="presentImage harf" />
                            <?php else: ?>
                                <img src="<?php the_field('image1'); ?>" class="presentImage" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="howto">
                        <ul>
                            <li>＜利用方法＞</li>
                            <li><?php the_field('howto'); ?></li>
                            <li>&emsp;</li>
                            <li>＜店舗＞</li>
                            <li><?php the_field('shop'); ?></li>
                        </ul>
                    </div>
                    <div class="deadline">
                        <h4>こちらのプレゼントに応募する際は、アンケート欄にKiss PRESSへのご意見・ご感想などをご記入下さい。</h4>
                        <p>
                            応募締め切り：<?php the_field('application_deadline'); ?><br />
                            ※当選者は、商品の発送をもって発表とかえさせていただきます。<br />
                            ※ご応募頂いた住所・氏名・電話番号等の個人情報は､プレゼント発送以外には使用致しません。
                        </p>
                    </div>
                    <a href="<?=$site_url;?>/present_apply?id=<?php the_id(); ?>&shop_name=<?php the_field('shop_name'); ?>" class="btn">プレゼントに応募する</a>
                <?php endwhile; ?>
            <?php else: ?>
                <p>まだ投稿がありません。</p>
            <?php endif; ?>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php include('inc/ad_modal.php'); ?>

<?php get_footer(); ?>