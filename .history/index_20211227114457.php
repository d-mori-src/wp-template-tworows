<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = [
        'post_type' => 'post', // カスタム投稿名
        'paged' => $paged,
        'posts_per_page' => -1, // 表示する数 -1 = 全件表示
    ];
    $wp_query = new WP_Query($args);
?>

<?php get_header(); ?>

<section class="hero">
    <!-- ファーストビュー -->
</section>

<!-- <section class="sp-tab-contents">
    <?php // include('inc/new_shop.php'); ?>
</section>

<section class="sp-tab-contents">
    <?php // include('inc/special.php'); ?>
</section> -->

<main class="top">
    <article>
        <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt="">新着情報</h3>

        <div class="wrap"></div>

        <!-- WPの定番の表示 -->
        <!-- <section class="news">
            <div class="newsItems topNewsItems">
                <?php if ($wp_query->have_posts()): ?>
                    <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                        <?php $cat = get_the_category(); $cat = $cat[0]; ?>
                        <div class="newsItem">
                            <div class="titleWrapper">
                                <a href="<?php the_permalink(); ?>" class="title <?=$cat->category_nicename; ?>">
                                    <?=get_field('title_copy'); ?>
                                </a>
                                <a href="<?php the_permalink(); ?>" class="lead">
                                    <?=mb_substr(get_field('sentence1'),0,62); ?> ...
                                </a>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="newsItemImageWrapper">
                                <img src="<?php the_field('image'); ?>" class="newsItemImage" />
                            </a>
                            <div class="newsItemText">
                                <div class="pcTitleWrapper">
                                    <a href="<?php the_permalink(); ?>" class="title <?=$cat->category_nicename; ?>">
                                        <?=mb_substr(get_field('title_copy'),0,30); ?>
                                    </a>
                                    <a href="<?php the_permalink(); ?>" class="lead">
                                        <?=mb_substr(get_field('sentence1'),0,62); ?> ...
                                    </a>
                                </div>
                                <div class="newsItemUnder">
                                    <div class="left-newsItemUnder">
                                        <p class="<?=$cat->category_nicename; ?>"><?php the_category(' '); ?></p>
                                    </div>
                                    <div class="right-newsItemUnder">
                                        <p class="timestamp"><?=human_time_diff(get_the_time('U'),current_time('timestamp')).'前'; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>まだ投稿がありません。</p>
                <?php endif; ?>
            </div>

            <?php get_template_part( 'infinite-scroll' ); ?>

            <div class="pagenation">
                <?php previous_posts_link(''); ?>
                <?php
                    if ($wp_query->max_num_pages > 1) {
                        $limitnum = 999999999;
                        echo paginate_links(
                            [
                                'base'         => str_replace($limitnum, '%#%', esc_url(get_pagenum_link($limitnum))),
                                'format'       => '',
                                'current'      => max(1, get_query_var('paged')),
                                'total'        => $wp_query->max_num_pages,
                                'prev_next'    => false,
                                'type'         => 'plain',
                            ]
                        );
                    }
                ?>
                <?php next_posts_link(''); ?>
            </div>
        </section> -->
        
    </article>
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>