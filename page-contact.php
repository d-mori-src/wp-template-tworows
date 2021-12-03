<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="contact">
    <article>
        <section class="intro">
            <h3 class="headTitle"><img src="<?=$uri?>/img/contact/contact.svg" class="contactIcon" alt="">広告掲載のお問い合わせ</h3>
        </section>

        <section class="contents">
            <form action="" method="POST">
                <div class="anyForm">
                    <dl class="first">
                        <dt>ご連絡先<span class="require">必須</span></dt>
                    </dl>
                    <dl>
                        <dt>お名前</dt>
                        <dd><input type="text" class="input" name="fullname" placeholder="例　神戸太郎" /></dd>
                    </dl>
                    <dl>
                        <dt>お電話番号</dt>
                        <dd><input type="tel" class="input" name="phone" placeholder="例　078123456 ※ハイフン不要" /></dd>
                    </dl>
                    <dl class="lastForm">
                        <dt>希望する連絡方法</dt>
                        <dd>
                            <div class="radio">
                                <input type="radio" id="phone" class="" name="contact" value="phone" />
                                <label for="phone">電話</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="mail" class="" name="contact" value="mail" />
                                <label for="mail" class="nextLabel">メール</label>
                            </div>
                        </dd>
                    </dl>
                </div>

                <div class="requiredForm">
                    <dl class="lastForm">
                        <dt>内容<span>必須</span></dt>
                        <dd>
                            <textarea class="input" name="inquiry" placeholder="お問い合わせの詳細をご記入ください。"></textarea>
                        </dd>
                    </dl>
                </div>

                <div class="privacyCheck">
                    <input type="checkbox" id="agreebtn" class="visuallyHidden" name="agree" value="agree" />
                    <label for="agreebtn"><a href="https://www.src-japan.net/privacy/src_management/" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>に同意する</label>
                </div>
                <input type="submit" class="submit" value="確認" />
            </form>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>