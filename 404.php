<?php
$pageTitle       = 'Page not found — Flavour & Co.';
$pageDescription = 'The page you are looking for could not be found.';
$pageClass       = 'page-404';
$pageKey         = '404';

require __DIR__ . '/inc/header.php';
?>

<main id="main">
    <section class="page-hero" aria-labelledby="page-title">
        <div class="container">
            <p class="eyebrow eyebrow-light" data-i18n="notfound.eyebrow">404</p>
            <h1 id="page-title" data-i18n="notfound.title">Page not found.</h1>
            <p class="lede" data-i18n="notfound.copy">The link you followed may be broken, or the page may have moved.</p>
            <p style="margin-top: 2rem;">
                <a class="btn btn-solid" href="./">
                    <span data-i18n="notfound.cta">Back to home</span>
                    <?= icon('arrow-right', 18, 'icon-arrow') ?>
                </a>
            </p>
        </div>
    </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
