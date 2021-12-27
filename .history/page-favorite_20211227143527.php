<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="favorite">
    <article>
        <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt="">お気に入り記事</h3>

        <div class="wrap"></div>
    </article>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>