<img src="<?php the_field('image'); ?>" class="specialMainImage" />

<section class="innerNewsDetail innerSpacialDetail">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <p class="timestamp">[記事投稿日] <?php echo get_the_date( 'Y年m月d日' ); ?></p>

            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php else: ?>
        <p>まだ投稿がありません。</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</section>