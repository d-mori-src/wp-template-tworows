<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="contact">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="intro">
            <h3 class="headTitle"><img src="<?=$uri?>/img/contact/contact.svg" class="contactIcon" alt="">Kiss PRESS ご意見・ご要望フォーム</h3>
            <p>Kiss PRESSに対するご意見やご要望をお寄せください。</p>
        </section>

        <section class="contents">
            <form action="" method="POST">
                <div class="requiredForm">
                    <dl>
                        <dt>ご意見・ご要望フォーム<span>必須</span></dt>
                        <dd><textarea class="input" name="introduction" placeholder="ご意見・ご要望フォームをご記入ください"></textarea></dd>
                    </dl>
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