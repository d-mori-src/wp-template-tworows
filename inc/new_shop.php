<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();

    $args_newShop = [
        'post_type' => 'newshop', // カスタム投稿名
        'posts_per_page' => 10, // 表示する数
    ];
    $wp_query_newShop = new WP_Query($args_newShop);
?>

<section class="newShop">
    <h3 class="sideHeadTitle"><img src="<?=$uri?>/img/common/new_shop.svg" alt="">NEW OPEN</h3>

    <div class="shopItems">
        <?php if ($wp_query_newShop->have_posts()): ?>
            <?php while ($wp_query_newShop->have_posts()): $wp_query_newShop->the_post(); ?>
                <div class="shopItem">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_field('image'); ?>" class="shopItemImage" />
                    </a>
                    <div class="shopItemText">
                        <a href="<?php the_permalink(); ?>" class="title">
                            <?=mb_substr(get_field('title_copy'),0,15); ?> ...
                        </a>

                        <div class="shopItemUnder">
                            <div class="left-shopItemUnder">
                                <?php $cat = get_the_category(); $cat = $cat[0]; ?>
                                <p class="<?=$cat->category_nicename; ?>"><?php the_category(' '); ?></p>
                            </div>
                            <div class="right-shopItemUnder">
                                <p class="timestamp"><?php echo get_the_date( 'Fd日' ); ?></p>
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
