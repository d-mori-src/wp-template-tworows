<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="favorite">
    <article>
        <p id="sample00-html"></p>
    </article>

    <?php get_sidebar(); ?>
</main>

<script>
    document.getElementById("sample00-html").innerText = json_sample00;

    var json_sample01 = json_sample_data[1].name;
    // var json_sample = json_sample_data[1]["name"];


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
            return res.json();
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