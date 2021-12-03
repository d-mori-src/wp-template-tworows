<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();

    $args_present = [
        'post_type' => 'presents', // カスタム投稿名
        'posts_per_page' => -1, // 表示する数
    ];
    $wp_query_present = new WP_Query($args_present);

    $today = date('Y-m-d');
?>

<?php get_header(); ?>

<main class="present">
    <article>
        <section class="presentContents">
            <h3 class="headTitle"><img src="<?=$uri?>/img/common/precent.svg" class="presentIcon" alt="">プレゼント</h3>
            
            <ul class="presentItems">
                <?php if ($wp_query_present->have_posts()): ?>
                    <?php while ($wp_query_present->have_posts()): $wp_query_present->the_post(); ?>
                        <?php 
                            $application_deadline = get_field('application_deadline');
                            $application_deadline2 = date('Y年n月j日', strtotime($application_deadline));
                        ?>
                        <?php if ($application_deadline >= $today): ?>
                        <li class="presentItem">
                            <a href="<?php the_permalink(); ?>" class="leftPresent">
                                <img src="<?php the_field('image1'); ?>" class="presentImage" alt="">
                            </a>
                            <a href="<?php the_permalink(); ?>" class="rightPresent">
                                <div class="title">
                                    <h3><?=mb_substr(get_field('title_copy'),0,35); ?></h3>
                                    <p><?=mb_substr(get_field('sentence1'),0,75); ?> ...</p>
                                </div>
                                <div class="text">
                                    <span>
                                        ●<?php the_field('people'); ?>名様<br />                          
                                        ●<?=$application_deadline2; ?>まで
                                    </span>
                                    <div class="presentBtn">ご応募はこちら</div>
                                </div>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>まだ投稿がありません。</p>
                <?php endif; ?>
            </ul>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php include('inc/ad_modal.php'); ?>

<?php get_footer(); ?>