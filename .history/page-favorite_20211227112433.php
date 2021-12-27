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
    const json_sample_data = [
    {
        "name" : "sample-00",
        "age" : 30
    },
    {
        "name" : "sample-01",
        "age" : 23
    }
    ];
    const json_sample00 = json_sample_data[0].name;
    document.getElementById("sample00-html").innerText = json_sample00;

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
        .then((res, data) => {
            console.log(data);
            return res.json();
        })
        .catch(error => {
            console.log("失敗しました");
        });
    }
    getDetail(33965);
</script>

<?php get_footer(); ?>