<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="contact">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="intro">
            <h3 class="headTitle"><img src="<?=$uri?>/img/contact/contact.svg" class="contactIcon" alt="">Kiss PRESS 情報提供フォーム</h3>
            <p>
                Kiss PRESSでは、兵庫県内の情報を随時募集しております。掲載してほしいイベントやスポットをご紹介ください。
                <span>ご紹介いただきました情報を元に取材を行い、Kiss PRESS(当サイト)・Kiss FM KOBE(ラジオ放送)・その他関連サービスで使用します。ご紹介者様の個人情報は一切公開しません。</span>
            </p>
        </section>

        <section class="contents">
            <form action="" method="POST">
                <div class="requiredForm">
                    <dl>
                        <dt>紹介内容<span>必須</span></dt>
                        <dd><textarea class="input" name="introduction" placeholder="紹介内容をご記入ください"></textarea></dd>
                    </dl>
                </div>
                <div class="anyForm">
                    <dl class="first">
                        <dt>連絡先<span>任意</span></dt>
                    </dl>
                    <dl>
                        <dt>お名前</dt>
                        <dd><input type="text" class="input" name="fullname" placeholder="例　神戸太郎" /></dd>
                    </dl>
                    <dl>
                        <dt>メールアドレス</dt>
                        <dd><input type="email" class="input" name="email" placeholder="例　kobe@domain.jp" /></dd>
                    </dl>
                    <dl class="lastForm">
                        <dt>お電話番号</dt>
                        <dd><input type="tel" class="input" name="phone" placeholder="例　078123456 ※ハイフン不要" /></dd>
                    </dl>
                    <p>取材の為ご連絡を差し上げる場合がございます。</p>
                </div>

                <div class="privacyCheck">
                    <input type="checkbox" id="agreebtn" class="visuallyHidden" name="agree" value="agree" />
                    <label for="agreebtn"><a href="">プライバシーポリシー</a>に同意する</label>
                </div>
                <input type="submit" class="submit" value="確認" />
            </form>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>