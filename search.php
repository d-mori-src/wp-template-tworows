<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="top search">
    <?php include('inc/left_sidebar.php'); ?>

    <article>
        <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt=""><?php the_search_query(); ?> の検索結果</h3>
        <section class="news">
            <div class="newsItems">
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

                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_field('image'); ?>" class="newsItemImage" />
                            </a>
                            <div class="newsItemText">
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
        </section>  
    </article>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>