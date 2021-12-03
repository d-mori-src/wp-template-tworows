<?php
require_once '../../../wp-load.php';

$offset         = isset( $_POST['post_num_now'] ) ? $_POST['post_num_now'] : 1;
$posts_per_page = isset( $_POST['post_num_add'] ) ? $_POST['post_num_add'] : 0;

$ajax_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => $posts_per_page,
		'offset'         => $offset,
	)
);
?>
<?php if ( $ajax_query->have_posts() ) : ?>
	<?php while ( $ajax_query->have_posts() ) : ?>
		<?php $ajax_query->the_post(); ?>

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
<?php endif; ?>
<?php
wp_reset_postdata();
?>