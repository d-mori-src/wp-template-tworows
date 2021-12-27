<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="favorite">
    <article>
        <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt="">お気に入り記事</h3>

        <div class="wrap"></div>
        <?php // get_template_part( 'infinite-scroll' ); ?>
    </article>

    <?php get_sidebar(); ?>
</main>

<script>
    // const favorites = localStorage.getItem("favorite_article");
    // const favObj = JSON.parse(favorites);
    // const dataId = favObj.map(value => {
    //     return Number(value);
    // });

    // dataId.map(value => {
    //     getDetail(value);
    // });

    // function getDetail(id) {
    //     let baseURL = "https://api.kisspress.jp/beta/articles/";
    //     let url = baseURL + id + "/";

    //     const res = fetch(url)
    //     .then(res => {
    //         return res.json();
    //     })
    //     .then(data => {
    //         console.log(data);
    //     })
    //     .catch(error => {
    //         console.log("失敗しました");
    //     });
    // }
</script>

<?php get_footer(); ?>