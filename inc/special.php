<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();

    $args_special = [
        'post_type' => 'special', // カスタム投稿名
        'posts_per_page' => 3, // 表示する数
    ];
    $wp_query_special = new WP_Query($args_special);
?>

<section class="special">
    <h3 class="sideHeadTitle"><img src="<?=$uri?>/img/common/star.svg" alt="">特集記事</h3>
    <div class="specialItems">
        <?php if ($wp_query_special->have_posts()): ?>
            <?php while ($wp_query_special->have_posts()): $wp_query_special->the_post(); ?>
                <div class="specialItem">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_field('eyecatch'); ?>" class="specialItemEyecatch" />
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>まだ投稿がありません。</p>
        <?php endif; ?>
    </div>
</section>
