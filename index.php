<?php
$pageTitle       = 'Flavour & Co. — Restaurant Management in Dubai, UAE';
$pageDescription = 'Flavour & Co Restaurants Management L.L.C is a restaurant management company in Dubai, United Arab Emirates. Operations, kitchens, people, guest experience and commercial oversight.';
$pageClass       = 'page-home';
$pageKey         = 'home';

require __DIR__ . '/inc/header.php';
?>

<main id="main">
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-media">
            <picture>
                <source media="(max-width: 760px)" srcset="assets/img/hero-dining-mobile-600.jpg 600w, assets/img/hero-dining-mobile.jpg 1200w" sizes="100vw">
                <img
                    src="assets/img/hero-dining.jpg"
                    srcset="assets/img/hero-dining-800.jpg 800w, assets/img/hero-dining.jpg 1600w"
                    sizes="100vw"
                    alt="A warmly lit restaurant dining room with dark wood tables, leather seating and brass pendant lights"
                    data-i18n-alt="home.hero.alt"
                    width="1600" height="1067" fetchpriority="high" decoding="async">
            </picture>
        </div>
        <div class="hero-shade"></div>

        <div class="container hero-inner">
            <p class="eyebrow" data-i18n="home.hero.eyebrow">Restaurants Management · Dubai</p>
            <h1 id="hero-title" data-i18n-html="home.hero.title">Restaurants,<br>run with <em>care.</em></h1>
            <p class="hero-sub" data-i18n="home.hero.sub">
                We manage the details that make a restaurant feel effortless — from the
                kitchen line to the last table of the night.
            </p>
            <div class="hero-actions">
                <a class="btn btn-solid" href="./services">
                    <span data-i18n="home.hero.cta1">Explore our services</span>
                    <?= icon('arrow-right', 18, 'icon-arrow') ?>
                </a>
                <a class="btn btn-outline-light" href="./contact" data-i18n="home.hero.cta2">Talk to us</a>
            </div>

            <div class="hero-foot">
                <span class="hero-fact" data-i18n="home.hero.fact1">Based in Dubai, UAE</span>
                <span class="hero-fact" data-i18n="home.hero.fact2">Restaurant management</span>
                <span class="hero-fact" data-i18n="home.hero.fact3">Enquiries welcome</span>
            </div>
        </div>
    </section>

    <div class="ticker" aria-hidden="true">
        <div class="ticker-track">
            <div class="ticker-group">
                <span data-i18n="home.ticker.operations">Operations</span>
                <span data-i18n="home.ticker.kitchens">Kitchens</span>
                <span data-i18n="home.ticker.service">Service</span>
                <span data-i18n="home.ticker.people">People</span>
                <span data-i18n="home.ticker.standards">Standards</span>
                <span data-i18n="home.ticker.dubai">Dubai</span>
            </div>
            <div class="ticker-group">
                <span data-i18n="home.ticker.operations">Operations</span>
                <span data-i18n="home.ticker.kitchens">Kitchens</span>
                <span data-i18n="home.ticker.service">Service</span>
                <span data-i18n="home.ticker.people">People</span>
                <span data-i18n="home.ticker.standards">Standards</span>
                <span data-i18n="home.ticker.dubai">Dubai</span>
            </div>
        </div>
    </div>

    <section class="section" aria-labelledby="intro-title">
        <div class="container split">
            <div class="split-media" data-reveal>
                <figure>
                    <div class="media-frame media-frame--tall media-frame--offset media-frame--zoom">
                        <img
                            src="assets/img/chef.jpg"
                            srcset="assets/img/chef-800.jpg 800w, assets/img/chef.jpg 1600w"
                            sizes="(max-width: 1020px) 90vw, 42vw"
                            alt="A chef plating a dish under warm pendant lights in a professional kitchen"
                            data-i18n-alt="home.intro.alt"
                            width="1600" height="2463" loading="lazy" decoding="async">
                    </div>
                    <figcaption class="media-caption">
                        <span data-i18n="home.caption.pass">The pass</span>
                        <span data-i18n="common.illustrative">Illustrative image</span>
                    </figcaption>
                </figure>
            </div>

            <div class="split-copy" data-reveal>
                <p class="eyebrow" data-i18n="home.intro.eyebrow">Who we are</p>
                <h2 id="intro-title" data-i18n="home.intro.title">A steady hand for restaurants that care about the details.</h2>
                <div class="prose">
                    <p data-i18n="home.intro.p1">
                        Flavour &amp; Co Restaurants Management L.L.C is a restaurant management
                        company based in Dubai, United Arab Emirates.
                    </p>
                    <p data-i18n="home.intro.p2">
                        We work behind the scenes of a restaurant — shaping how it runs, how it
                        feels, and how it holds up night after night. Good hospitality is rarely
                        an accident. It comes from clear standards, a kitchen in rhythm, a team
                        that knows what good looks like, and numbers that are watched closely.
                    </p>
                </div>
                <div class="split-sign">
                    <span class="brand-mark" aria-hidden="true">F</span>
                    <p data-i18n-html="home.sign">Flavour &amp; Co.<br>Restaurants Management</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="services-title">
        <div class="container">
            <div class="section-head" data-reveal>
                <div>
                    <p class="eyebrow" data-i18n="home.services.eyebrow">What we do</p>
                    <h2 id="services-title" data-i18n-html="home.services.title">Six areas of focus.<br>One standard.</h2>
                </div>
                <p data-i18n="home.services.intro">
                    Restaurant management is a wide brief. We keep it grounded in the parts that
                    decide whether a guest comes back — and whether the business works.
                </p>
            </div>

            <div class="services-grid">
                <?php foreach (SERVICES as $index => $item): ?>
                    <article class="service-card" data-reveal data-reveal-delay="<?= min($index * 60, 300) ?>">
                        <div class="service-top">
                            <span class="service-num">0<?= $index + 1 ?></span>
                            <span class="service-icon"><?= icon($item['icon'], 30) ?></span>
                        </div>
                        <h3>
                            <a class="service-card-link" href="./services#<?= e($item['slug']) ?>" data-i18n="service.<?= e($item['slug']) ?>.title"><?= e($item['title']) ?></a>
                        </h3>
                        <p data-i18n="service.<?= e($item['slug']) ?>.short"><?= e($item['short']) ?></p>
                        <span class="service-more" data-i18n="common.explore">
                            Explore
                            <?= icon('arrow-right', 15, 'icon-arrow') ?>
                        </span>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section-dark" aria-labelledby="approach-title">
        <div class="container">
            <div class="section-head section-head-light" data-reveal>
                <div>
                    <p class="eyebrow eyebrow-light" data-i18n="home.approach.eyebrow">How we work</p>
                    <h2 id="approach-title" data-i18n="home.approach.title">A simple way of working, held to a high standard.</h2>
                </div>
                <p data-i18n="home.approach.intro">
                    No theatre and no borrowed playbooks. We learn the business, set what good
                    looks like, then stay close enough to keep it there.
                </p>
            </div>

            <div class="approach-grid">
                <?php foreach (APPROACH as $index => $step): ?>
                    <div class="approach-item" data-reveal data-reveal-delay="<?= $index * 90 ?>">
                        <span class="approach-num">0<?= $index + 1 ?></span>
                        <h3 data-i18n="approach.<?= $index + 1 ?>.title"><?= e($step['title']) ?></h3>
                        <p data-i18n="approach.<?= $index + 1 ?>.copy"><?= e($step['copy']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section-cream" aria-labelledby="place-title">
        <div class="container place">
            <div class="place-media" data-reveal>
                <div class="media-frame media-frame--tall media-frame--zoom">
                    <img
                        src="assets/img/dubai.jpg"
                        srcset="assets/img/dubai-800.jpg 800w, assets/img/dubai.jpg 1600w"
                        sizes="(max-width: 1020px) 90vw, 45vw"
                        alt="The Dubai skyline at golden hour, with the Burj Khalifa rising above the city"
                        data-i18n-alt="home.place.alt"
                        width="1600" height="1067" loading="lazy" decoding="async">
                </div>
                <div class="place-card">
                    <p class="eyebrow eyebrow-light" data-i18n="home.place.card.eyebrow">Our city</p>
                    <p data-i18n-html="home.place.card.city">Dubai,<br>United Arab Emirates</p>
                </div>
            </div>

            <div class="place-copy" data-reveal>
                <p class="eyebrow" data-i18n="home.place.eyebrow">Where we are</p>
                <h2 id="place-title" data-i18n-html="home.place.title">Based in Dubai.<br>Built for the everyday.</h2>
                <p class="lede" data-i18n="home.place.lede">
                    Our office is in Dubai, United Arab Emirates. From here we support restaurant
                    owners and operators who want a management partner involved in the detail —
                    not just the opening night.
                </p>

                <dl class="place-meta">
                    <div>
                        <dt data-i18n="home.place.business">Business</dt>
                        <dd><?= e(SITE_LEGAL_NAME) ?></dd>
                    </div>
                    <div>
                        <dt data-i18n="home.place.focus">Focus</dt>
                        <dd data-i18n="common.restaurant_management">Restaurant management</dd>
                    </div>
                    <div>
                        <dt data-i18n="home.place.address">Address</dt>
                        <dd data-i18n="common.address"><?= e(SITE_ADDRESS) ?></dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    <?php require __DIR__ . '/inc/cta.php'; ?>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
