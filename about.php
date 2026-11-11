<?php
$pageTitle       = 'About — Flavour & Co. Restaurants Management, Dubai';
$pageDescription = 'Learn about Flavour & Co Restaurants Management L.L.C, a Dubai-based restaurant management company, and the principles behind how we work.';
$pageClass       = 'page-about';
$pageKey         = 'about';

require __DIR__ . '/inc/header.php';
?>

<main id="main">
    <section class="page-hero" aria-labelledby="page-title">
        <div class="page-hero-media">
            <img src="assets/img/interior.jpg" srcset="assets/img/interior-800.jpg 800w, assets/img/interior.jpg 1600w" sizes="100vw" alt="" width="1600" height="1067" fetchpriority="high" decoding="async">
        </div>
        <div class="page-hero-shade"></div>
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="./" data-i18n="nav.home">Home</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page" data-i18n="about.breadcrumb">About</span>
            </nav>
            <p class="eyebrow eyebrow-light" data-i18n="about.hero.eyebrow">The company</p>
            <h1 id="page-title" data-i18n-html="about.hero.title">Close to the work,<br>and the people doing it.</h1>
            <p class="lede" data-i18n="about.hero.lede">
                Flavour &amp; Co Restaurants Management L.L.C is a restaurant management company
                based in Dubai, United Arab Emirates.
            </p>
        </div>
    </section>

    <section class="section" aria-labelledby="story-title">
        <div class="container about-grid">
            <div data-reveal>
                <p class="eyebrow" data-i18n="about.story.eyebrow">Who we are</p>
                <h2 id="story-title" data-i18n="about.story.title">A Dubai restaurant company, built around the everyday.</h2>
            </div>
            <div class="about-prose" data-reveal>
                <p data-i18n="about.story.p1">
                    Our business is restaurant management — the steady, practical work that lets a
                    restaurant do what it promises, service after service.
                </p>
                <p data-i18n="about.story.p2">
                    That means being close to the floor and the kitchen, not just the spreadsheet.
                    It means knowing how a busy Friday actually runs, where the delays start, how
                    the team speaks to a guest, and what the numbers look like at the end of the
                    week. We take responsibility for those details and keep improving them.
                </p>
                <p data-i18n="about.story.p3">
                    We work with restaurant owners and operators who want a management partner
                    involved in the day-to-day. An engagement can start before opening, or with a
                    fresh look at a restaurant that is already running. The starting point changes;
                    the standard does not.
                </p>
            </div>
        </div>
    </section>

    <section class="section-tight" aria-label="Company details">
        <div class="container">
            <dl class="facts" data-reveal>
                <div class="fact">
                    <dt data-i18n="about.facts.business">Business name</dt>
                    <dd><?= e(SITE_LEGAL_NAME) ?></dd>
                </div>
                <div class="fact">
                    <dt data-i18n="about.facts.based">Based in</dt>
                    <dd data-i18n="common.address">Dubai, United Arab Emirates</dd>
                </div>
                <div class="fact">
                    <dt data-i18n="about.facts.what">What we do</dt>
                    <dd data-i18n="common.restaurant_management">Restaurant management</dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="section section-cream" aria-labelledby="principles-title">
        <div class="container">
            <div class="section-head" data-reveal>
                <div>
                    <p class="eyebrow" data-i18n="about.principles.eyebrow">What we believe</p>
                    <h2 id="principles-title" data-i18n-html="about.principles.title">Principles before<br>playbooks.</h2>
                </div>
                <p data-i18n="about.principles.intro">
                    Every restaurant is different. The things worth protecting are not. These four
                    principles shape how we manage, hire, train and make decisions.
                </p>
            </div>

            <div class="principles">
                <?php foreach (PRINCIPLES as $index => $principle): ?>
                    <div class="principle" data-reveal data-reveal-delay="<?= $index * 70 ?>">
                        <span class="principle-index">0<?= $index + 1 ?></span>
                        <h3 data-i18n="principle.<?= $index + 1 ?>.title"><?= e($principle['title']) ?></h3>
                        <p data-i18n="principle.<?= $index + 1 ?>.copy"><?= e($principle['copy']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="work-title">
        <div class="container split split--reverse">
            <div class="split-media" data-reveal>
                <figure>
                    <div class="media-frame media-frame--wide media-frame--offset media-frame--zoom">
                        <img
                            src="assets/img/plated.jpg"
                            srcset="assets/img/plated-800.jpg 800w, assets/img/plated.jpg 1600w"
                            sizes="(max-width: 1020px) 90vw, 45vw"
                            alt="A plated main course being set down at a restaurant table"
                            data-i18n-alt="about.work.alt"
                            width="1600" height="1067" loading="lazy" decoding="async">
                    </div>
                    <figcaption class="media-caption">
                        <span data-i18n="about.work.caption">At the table</span>
                        <span data-i18n="common.illustrative">Illustrative image</span>
                    </figcaption>
                </figure>
            </div>

            <div class="split-copy" data-reveal>
                <p class="eyebrow" data-i18n="about.work.eyebrow">The work</p>
                <h2 id="work-title" data-i18n="about.work.title">Close to the floor, and to the numbers.</h2>
                <div class="prose">
                    <p data-i18n="about.work.p1">
                        Management is not a desk job in this business. The useful decisions are
                        usually made where the work happens: at the pass during service, on the
                        floor when a table is waiting, in the office when the month is closed.
                    </p>
                    <p data-i18n="about.work.p2">
                        We keep both views in frame — the experience the guest has, and the
                        commercial reality that allows it to continue. One without the other is
                        not management.
                    </p>
                </div>
                <p style="margin-top: 2rem;">
                    <a class="text-link" href="./services">
                        <span data-i18n="about.work.link">See what we do</span>
                        <?= icon('arrow-right', 16, 'icon-arrow') ?>
                    </a>
                </p>
            </div>
        </div>
    </section>

    <?php require __DIR__ . '/inc/cta.php'; ?>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
