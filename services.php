<?php
$pageTitle       = 'Services — Flavour & Co. Restaurants Management';
$pageDescription = 'Dubai restaurant management: operations, concept and menu, kitchen, people and training, guest experience and commercial oversight.';
$pageClass       = 'page-services';
$pageKey         = 'services';

require __DIR__ . '/inc/header.php';
?>

<main id="main">
    <section class="page-hero" aria-labelledby="page-title">
        <div class="page-hero-media">
            <img src="assets/img/grill.jpg" srcset="assets/img/grill-800.jpg 800w, assets/img/grill.jpg 1600w" sizes="100vw" alt="" width="1600" height="1067" fetchpriority="high" decoding="async">
        </div>
        <div class="page-hero-shade"></div>
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="./" data-i18n="nav.home">Home</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page" data-i18n="services.breadcrumb">Services</span>
            </nav>
            <p class="eyebrow eyebrow-light" data-i18n="services.hero.eyebrow">What we do</p>
            <h1 id="page-title" data-i18n-html="services.hero.title">The work behind<br>a restaurant that works.</h1>
            <p class="lede" data-i18n="services.hero.lede">
                Six areas of focus, managed together. Each one affects the others — which is why
                we keep the whole restaurant in view.
            </p>
        </div>
    </section>

    <section class="section" aria-labelledby="services-intro">
        <div class="container about-grid">
            <div data-reveal>
                <p class="eyebrow" data-i18n="services.intro.eyebrow">Our scope</p>
                <h2 id="services-intro" data-i18n="services.intro.title">Management, end to end.</h2>
            </div>
            <div class="about-prose" data-reveal>
                <p data-i18n="services.intro.p1">
                    A restaurant is a collection of systems that have to work at the same time:
                    the kitchen, the floor, the team, the suppliers, the numbers and the guest.
                </p>
                <p data-i18n="services.intro.p2">
                    We manage across all of them. Some engagements need a full management
                    handover. Others begin with one specific problem — an inconsistent kitchen, a
                    menu that is not earning its place, or a service standard that has slipped.
                    The scope is agreed around what the restaurant actually needs.
                </p>
            </div>
        </div>
    </section>

    <section class="section-tight" aria-label="Service areas">
        <div class="container">
            <?php foreach (SERVICES as $index => $item): ?>
                <article class="service-detail" id="<?= e($item['slug']) ?>">
                    <div class="service-detail-head" data-reveal>
                        <span class="service-detail-icon"><?= icon($item['icon'], 26) ?></span>
                        <div>
                            <h3 data-i18n="service.<?= e($item['slug']) ?>.title"><?= e($item['title']) ?></h3>
                            <p>0<?= $index + 1 ?> — <span data-i18n="service.<?= e($item['slug']) ?>.short"><?= e($item['short']) ?></span></p>
                        </div>
                    </div>

                    <div class="service-detail-body" data-reveal>
                        <p data-i18n="service.<?= e($item['slug']) ?>.copy"><?= e($item['copy']) ?></p>
                        <ul class="service-list">
                            <?php foreach ($item['items'] as $pointIndex => $point): ?>
                                <li>
                                    <?= icon('check', 15) ?>
                                    <span data-i18n="service.<?= e($item['slug']) ?>.item<?= $pointIndex + 1 ?>"><?= e($point) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section section-dark" aria-labelledby="start-title">
        <div class="container">
            <div class="section-head section-head-light" data-reveal>
                <div>
                    <p class="eyebrow eyebrow-light" data-i18n="services.engagement.eyebrow">Getting started</p>
                    <h2 id="start-title" data-i18n-html="services.engagement.title">Conversations usually start<br>in one of three places.</h2>
                </div>
                <p data-i18n="services.engagement.intro">
                    There is no standard package. We agree the scope together, based on the
                    restaurant, its stage and what needs to change first.
                </p>
            </div>

            <div class="engagement">
                <div class="engagement-item" data-reveal>
                    <span class="approach-num">01</span>
                    <h3 data-i18n="services.engagement.1.title">Taking over the day-to-day</h3>
                    <p data-i18n="services.engagement.1.copy">
                        An existing restaurant needs a management team to run operations, lead the
                        staff and report clearly to the owner.
                    </p>
                </div>
                <div class="engagement-item" data-reveal data-reveal-delay="80">
                    <span class="approach-num">02</span>
                    <h3 data-i18n="services.engagement.2.title">Opening or relaunching</h3>
                    <p data-i18n="services.engagement.2.copy">
                        A concept is being built or refreshed, and the operational foundations need
                        to be in place before the doors open.
                    </p>
                </div>
                <div class="engagement-item" data-reveal data-reveal-delay="160">
                    <span class="approach-num">03</span>
                    <h3 data-i18n="services.engagement.3.title">A closer look at the numbers</h3>
                    <p data-i18n="services.engagement.3.copy">
                        The restaurant is running, but costs, pricing or reporting need an honest
                        review and a practical plan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php require __DIR__ . '/inc/cta.php'; ?>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
