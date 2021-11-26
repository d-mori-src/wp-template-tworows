<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();

    $args_features = [
        'post_type' => 'features', // カスタム投稿名
        'posts_per_page' => -1, // 表示する数
    ];
    $wp_query_features = new WP_Query($args_features);

    $args_interview = [
        'post_type' => 'interview', // カスタム投稿名
        'posts_per_page' => -1, // 表示する数
    ];
    $wp_query_interview = new WP_Query($args_interview);
?>

<?php get_header(); ?>

<main class="features">
    <article>
        <section class="featuresInterview">
            <ul class="featuresItems">
                <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt="">特集記事</h3>
                <?php if ($wp_query_features->have_posts()): ?>
                    <?php while ($wp_query_features->have_posts()): $wp_query_features->the_post(); ?>
                        <li class="featuresItem">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_field('image'); ?>" class="featuresItemImage" />
                            </a>
                            <a href="<?php the_permalink(); ?>" class="title">
                                <?=mb_substr(get_field('title_copy'),0,30); ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>まだ投稿がありません。</p>
                <?php endif; ?>
            </ul>
            <ul class="featuresItems interviewItems">
                <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt="">インタビュー</h3>
                <?php if ($wp_query_interview->have_posts()): ?>
                    <?php while ($wp_query_interview->have_posts()): $wp_query_interview->the_post(); ?>
                        <li class="featuresItem">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_field('image'); ?>" class="featuresItemImage" />
                            </a>
                            <a href="<?php the_permalink(); ?>" class="title">
                                <?=mb_substr(get_field('title_copy'),0,30); ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>まだ投稿がありません。</p>
                <?php endif; ?>
            </ul>
        </section>
        
    </article>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>