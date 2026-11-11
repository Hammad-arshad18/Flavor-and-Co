<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
?>
<section class="cta-band" aria-labelledby="cta-title">
    <div class="cta-media" aria-hidden="true">
        <img src="assets/img/interior-800.jpg" alt="" width="800" height="533" loading="lazy" decoding="async">
    </div>
    <div class="container cta-inner">
        <div class="cta-copy" data-reveal>
            <p class="eyebrow eyebrow-light" data-i18n="cta.eyebrow">Enquiries</p>
            <h2 id="cta-title" data-i18n-html="cta.title">Tell us about<br>your restaurant.</h2>
            <p class="cta-lede" data-i18n="cta.lede">Whether you are opening, relaunching or looking for a steadier hand on the day-to-day, a short conversation is the best place to start.</p>
        </div>
        <div class="cta-actions" data-reveal>
            <a class="btn btn-solid" href="./contact">
                <span data-i18n="cta.button">Start a conversation</span>
                <?= icon('arrow-right', 18, 'icon-arrow') ?>
            </a>
            <a class="cta-link" href="mailto:<?= e(SITE_EMAIL) ?>">
                <?= icon('mail', 18) ?>
                <span dir="ltr"><?= e(SITE_EMAIL) ?></span>
            </a>
        </div>
    </div>
</section>
