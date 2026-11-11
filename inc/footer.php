<footer class="site-footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <a class="brand brand-footer" href="./">
                    <span class="brand-mark" aria-hidden="true">F</span>
                    <span class="brand-text">
                        <span class="brand-name" dir="ltr">Flavour <em>&amp;</em> Co.</span>
                        <span class="brand-sub" data-i18n="brand.sub">Restaurants Management</span>
                    </span>
                </a>
                <p class="footer-note" data-i18n="footer.note">A restaurant management company based in Dubai, United Arab Emirates.</p>
                <p class="footer-address">
                    <?= icon('pin', 18) ?>
                    <span data-i18n="address"><?= e(SITE_ADDRESS) ?></span>
                </p>
            </div>

            <nav class="footer-col" aria-label="Footer">
                <h2 class="footer-heading" data-i18n="footer.explore">Explore</h2>
                <ul>
                    <?php foreach (NAV_ITEMS as $route => $label): ?>
                        <li><a href="<?= e($route) ?>" data-i18n="<?= e(NAV_KEYS[$route]) ?>"><?= e($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="footer-col">
                <h2 class="footer-heading" data-i18n="footer.focus">Focus</h2>
                <ul>
                    <?php foreach (array_slice(SERVICES, 0, 4) as $item): ?>
                        <li><a href="./services#<?= e($item['slug']) ?>" data-i18n="service.<?= e($item['slug']) ?>.title"><?= e($item['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-col">
                <h2 class="footer-heading" data-i18n="footer.contact">Contact</h2>
                <ul>
                    <li><a href="tel:<?= e(SITE_PHONE_LINK) ?>"><span dir="ltr"><?= e(SITE_PHONE) ?></span></a></li>
                    <li><a href="mailto:<?= e(SITE_EMAIL) ?>"><span dir="ltr"><?= e(SITE_EMAIL) ?></span></a></li>
                    <li><a href="./contact" data-i18n="footer.send">Send an enquiry</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= SITE_YEAR ?> <span dir="ltr"><?= e(SITE_LEGAL_NAME) ?></span></p>
            <p class="footer-credit">
                <span data-i18n="footer.credit.prefix">Photography via</span>
                <a href="https://unsplash.com" rel="noopener" target="_blank">Unsplash</a>.
                <span data-i18n="footer.credit.suffix">Images are illustrative.</span>
            </p>
        </div>
    </div>
</footer>

<script src="assets/js/i18n.js" defer></script>
<script src="assets/js/main.js" defer></script>
</body>
</html>
