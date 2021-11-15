<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="advertisement">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="intro">
            <h3 class="headTitle"><img src="<?=$uri?>/img/common/check.svg" alt="">広告掲載のご案内</h3>
            <h4>毎月100万ユーザーが利用する兵庫専門のお出かけ情報メディアを様々なPRにご活用ください！</h4>
            <p>Kiss PRESS（キッスプレス）は兵庫県各地のイベントやグルメ・ショッピング・街ネタなどのおでかけ情報を独自に取材。お馴染みの人気イベントから地元の人でも知らないようなローカル情報まで、兵庫県の様々な魅力を届けている毎月100万ユーザーが利用するおでかけ情報メディアです。</p>
            <div class="adPublish">そんなKiss PRESSに広告を掲載しませんか？</div>
        </section>
        <section class="explan">
            <h2 class="strengths">Kiss PRESSの強み</h2>
            <ul class="">
                <li class="">
                    <h5>集客につながるユーザー層</h5>
                    <p>県内・近隣府県のユーザーが多く、お出かけ先を探すなど実際に行動を起こすことが前提での利用が多いため、集客につながります。</p>
                </li>
                <li class="">
                    <h5>興味関心を得やすい広告スタイル</h5>
                    <p>広告記事は記者が読者目線で作成するため、普通の広告媒体とは異なり興味・関心を得やすく信頼度が高いPRが可能です。</p>
                </li>
                <li class="">
                    <h5>隅々まで届くメディア展開</h5>
                    <p>WebだけでなくSNSやLINEでも積極的に情報を発信しており、様々なユーザーに隅々まで情報をお届けしています。</p>
                </li>
            </ul>

            <h2 class="pr">Kiss PRESSを様々なPRにご活用ください</h2>
            <ul class="">
                <li class="">
                    <h5>WebサイトやLPのアクセスアップに</h5>
                    <p>バナー掲載や記事広告でお客様のWebサイトやLPにユーザーを誘導します。</p>
                </li>
                <li class="">
                    <h5>店舗・イベント集客や認知拡大に</h5>
                    <p>記事広告でお店や商品・イベントの魅力を紹介します。</p>
                </li>
                <li class="">
                    <h5>SNSやWeb広告を使った情報拡散</h5>
                    <p>掲載記事をTwitterやFacebook・Lineで配信。Web広告を使った更なる拡散も。</p>
                </li>
            </ul>
            <h2 class="plan">Kiss PRESS　広告プラン</h2>
            <ul class="planList">
                <li class="">
                    <a href="" class="js-modal-open" data-target="modal01">バナー広告<span>￥18,000〜</span></a>
                </li>
                <li class="">
                    <a href="" class="js-modal-open" data-target="modal02">記事広告<span>¥75,000～</span></a>
                </li>
            </ul>
        </section>
        <section class="contactWrapper">
            <h3>お気軽にお問い合わせください</h3>
            <div class="contactLink">
                <div class="phone">
                    <a href="tel:0783221001" class="phoneNumber">078-322-1001</a>
                    <p>広告掲載のお問い合わせ窓口(Kiss FM KOBE内)<br />電話受付／平日10:00～18:00</p>
                </div>
                <div class="form">
                    <a href="">お問い合わせはこちら</a>
                </div>
            </div>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php include('inc/ad_modal.php'); ?>

<?php get_footer(); ?>