<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<section class="hero">
    TOP - First View
</section>

<main class="top">
    <?php include('inc/left_sidebar.php'); ?>

    <article>
        <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt="">新着情報</h3>
    
        <!-- <ul>
            <li class="cat-item"><a href="<?=$site_url;?>/posts">すべて</a></li>
            <?php 
                if (!is_page() && !is_home() && !is_single()){ 
                    $catsy = get_the_category();
                    $myCat = $catsy->cat_ID; $currentcategory = '&current_category='.$myCat; 
                } elseif (is_single()){ 
                    $catsy = get_the_category(); 
                    $myCat = $catsy[0]->cat_ID; $currentcategory = '&current_category='.$myCat; 
                } 
                wp_list_categories('depth=1&title_li='.$currentcategory); 
            ?>
        </ul> -->

        <section class="news">
            <div class="newsItems">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post(); ?>
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