<section class="innerNewsDetail">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php $cat = get_the_category(); $cat = $cat[0]; ?>
            <h1 class="<?=$cat->category_nicename; ?>"><?php the_field('title_copy'); ?></h1>
            <div class="imageEdge">
                <img src="<?php the_field('image'); ?>" class="newsItemImage" />
            </div>
            <p class="lead"><?php the_field('sentence1'); ?></p>
            <p class="timestamp">掲載日: <?php the_time(get_option('date_format')); ?></p>
        <?php endwhile; ?>
    <?php else: ?>
        <p>まだ投稿がありません。</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</section>