<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="favorite">
    <article>
        
    </article>

    <?php get_sidebar(); ?>
</main>

<script>



    const favorites = localStorage.getItem("favorite_article");
    const favObj = JSON.parse(favorites);
    const dataId = favObj.map(value => {
        return Number(value);
    });

    dataId.map(value => {
        getDetail(value);
    });

    function getDetail(id) {
        let baseURL = "https://api.kisspress.jp/beta/articles/";
        let url = baseURL + id + "/";

        const res = fetch(url)
        .then(res => {
            return res.JSON.parse;
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.log("失敗しました");
        });
    }
</script>

<?php get_footer(); ?>