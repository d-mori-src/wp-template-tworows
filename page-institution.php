<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="institution">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="intro">
            <h3 class="headTitle"><img src="<?=$uri?>/img/common/building.svg" class="institutionIcon" alt="">施設紹介</h3>
            <div class="institutionSearch">
                <p>施設検索</p>
                <div class="cp_ipselect cp_sl01">
                    <select name="categorySearch">
                        <option hidden>ジャンル</option>
                        <option value="cinema">映画館</option>
                    </select>
                </div>
                <div class="cp_ipselect cp_sl01">
                    <select name="areaSearch">
                        <option hidden>エリア</option>
                        <option value="chuouku_kobe">神戸市中央区</option>
                    </select>
                </div>
            </div>
        </section>

        <section class="contents">
            <ul>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
                <li>
                    <a href="https://109cinemas.net/hatkobe/" target="_blank" rel="noopener noreferrer">
                        109シネマズHAT神戸
                        <span>兵庫県神戸市中央区脇浜海岸通2-2-2 ブルメールHAT神戸2F</span>
                    </a>
                </li>
            </ul>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>