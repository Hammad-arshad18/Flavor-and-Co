<?php
declare(strict_types=1);

session_start();

$pageTitle       = 'Contact — Flavour & Co. Restaurants Management, Dubai';
$pageDescription = 'Contact Flavour & Co Restaurants Management L.L.C in Dubai, United Arab Emirates. Phone, email and enquiry form.';
$pageClass       = 'page-contact';
$pageKey         = 'contact';

require __DIR__ . '/inc/config.php';
require __DIR__ . '/inc/functions.php';
require __DIR__ . '/inc/mailer.php';

$errors = [];
$errorKeys = [];
$values = [
    'name'     => '',
    'email'    => '',
    'phone'    => '',
    'company'  => '',
    'message'  => '',
];

$sent = !empty($_SESSION['contact_sent']);
unset($_SESSION['contact_sent']);

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf'] ?? '';

    if (!is_string($token) || !hash_equals($_SESSION['csrf'], $token)) {
        $errors['form'] = 'Your session expired before the form was sent. Please try again.';
        $errorKeys['form'] = 'form.error.session';
    }

    // Honeypot: real visitors never fill this field.
    if (!empty($_POST['website'])) {
        $errors['form'] = 'Your message could not be sent. Please email us directly.';
        $errorKeys['form'] = 'form.error.honeypot';
    }

    foreach ($values as $key => $unused) {
        if (isset($_POST[$key]) && is_string($_POST[$key])) {
            $values[$key] = trim($_POST[$key]);
        }
    }

    if ($values['name'] === '') {
        $errors['name'] = 'Please enter your name.';
        $errorKeys['name'] = 'form.error.name_required';
    } elseif (mb_strlen($values['name']) > 100) {
        $errors['name'] = 'Please keep your name under 100 characters.';
        $errorKeys['name'] = 'form.error.name_long';
    }

    if ($values['email'] === '') {
        $errors['email'] = 'Please enter your email address.';
        $errorKeys['email'] = 'form.error.email_required';
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
        $errorKeys['email'] = 'form.error.email_invalid';
    } elseif (mb_strlen($values['email']) > 180) {
        $errors['email'] = 'Please use a shorter email address.';
        $errorKeys['email'] = 'form.error.email_long';
    }

    if ($values['phone'] !== '' && mb_strlen($values['phone']) > 40) {
        $errors['phone'] = 'Please keep the phone number under 40 characters.';
        $errorKeys['phone'] = 'form.error.phone_long';
    }

    if ($values['company'] !== '' && mb_strlen($values['company']) > 120) {
        $errors['company'] = 'Please keep the restaurant or company name under 120 characters.';
        $errorKeys['company'] = 'form.error.company_long';
    }

    if (mb_strlen($values['message']) < 20) {
        $errors['message'] = 'Please tell us a little more — at least 20 characters.';
        $errorKeys['message'] = 'form.error.message_short';
    } elseif (mb_strlen($values['message']) > 5000) {
        $errors['message'] = 'Please keep your message under 5,000 characters.';
        $errorKeys['message'] = 'form.error.message_long';
    }

    if (!$errors) {
        $safeName    = preg_replace('/[\r\n]+/', ' ', $values['name']);
        $safeEmail   = str_replace(["\r", "\n"], '', $values['email']);
        $safePhone   = preg_replace('/[\r\n]+/', ' ', $values['phone']);
        $safeCompany = preg_replace('/[\r\n]+/', ' ', $values['company']);

        $subject = 'Website enquiry — ' . $safeName;

        $body = "New enquiry from the Flavour & Co. website\n\n"
            . "Name: {$safeName}\n"
            . "Email: {$safeEmail}\n"
            . 'Phone: ' . ($safePhone !== '' ? $safePhone : 'Not provided') . "\n"
            . 'Restaurant / company: ' . ($safeCompany !== '' ? $safeCompany : 'Not provided') . "\n\n"
            . "Message:\n{$values['message']}\n";

        [$sentBySmtp, $smtpError] = smtp_send($to, $subject, $body, $safeEmail);

        if ($sentBySmtp) {
            unset($_SESSION['csrf']);
            $_SESSION['contact_sent'] = true;
            header('Location: contact');
            exit;
        }

        if ($smtpError !== '') {
            error_log('Contact form SMTP: ' . $smtpError);
        }

        $errors['form'] = 'We could not send your message automatically. Please email us directly at ' . SITE_EMAIL . '.';
        $errorKeys['form'] = 'form.error.mail_failed';
    }
}

require __DIR__ . '/inc/header.php';
?>

<main id="main">
    <section class="page-hero" aria-labelledby="page-title">
        <div class="page-hero-media">
            <img src="assets/img/terrace.jpg" srcset="assets/img/terrace-800.jpg 800w, assets/img/terrace.jpg 1600w" sizes="100vw" alt="" width="1600" height="1200" fetchpriority="high" decoding="async">
        </div>
        <div class="page-hero-shade"></div>
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="./" data-i18n="nav.home">Home</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page" data-i18n="contact.breadcrumb">Contact</span>
            </nav>
            <p class="eyebrow eyebrow-light" data-i18n="contact.hero.eyebrow">Enquiries</p>
            <h1 id="page-title" data-i18n-html="contact.hero.title">Let’s talk about<br>your restaurant.</h1>
            <p class="lede" data-i18n="contact.hero.lede">
                Tell us where the restaurant is and what you have in mind. We will reply
                directly by phone or email.
            </p>
        </div>
    </section>

    <section class="section" aria-labelledby="contact-title">
        <div class="container contact-grid">
            <div class="contact-intro" data-reveal>
                <p class="eyebrow" data-i18n="contact.eyebrow">Contact</p>
                <h2 id="contact-title" data-i18n="contact.title">Start with a conversation.</h2>
                <p class="lede" data-i18n="contact.intro">
                    Opening, relaunching, or looking for a steadier hand on the day-to-day —
                    a short conversation is the best place to begin.
                </p>

                <ul class="contact-list">
                    <li class="contact-item">
                        <span class="contact-item-icon"><?= icon('phone', 20) ?></span>
                        <div>
                            <span class="contact-item-label" data-i18n="contact.label.phone">Phone</span>
                            <p class="contact-item-value"><a href="tel:<?= e(SITE_PHONE_LINK) ?>"><span dir="ltr"><?= e(SITE_PHONE) ?></span></a></p>
                        </div>
                    </li>
                    <li class="contact-item">
                        <span class="contact-item-icon"><?= icon('mail', 20) ?></span>
                        <div>
                            <span class="contact-item-label" data-i18n="contact.label.email">Email</span>
                            <p class="contact-item-value"><a href="mailto:<?= e(SITE_EMAIL) ?>"><span dir="ltr"><?= e(SITE_EMAIL) ?></span></a></p>
                        </div>
                    </li>
                    <li class="contact-item">
                        <span class="contact-item-icon"><?= icon('pin', 20) ?></span>
                        <div>
                            <span class="contact-item-label" data-i18n="contact.label.address">Address</span>
                            <p class="contact-item-value" data-i18n="common.address"><?= e(SITE_ADDRESS) ?></p>
                        </div>
                    </li>
                </ul>

                <p class="contact-note">
                    <?= icon('sparkle', 18) ?>
                    <span data-i18n="contact.note">Enquiries are handled directly by our team. There is no newsletter and no third-party list.</span>
                </p>
            </div>

            <div class="contact-form-wrap" data-reveal>
                <?php if ($sent): ?>
                    <div class="form-status form-status--ok" role="status">
                        <?= icon('check', 20) ?>
                        <div>
                            <strong data-i18n="contact.success.strong">Thank you — your enquiry has been sent.</strong><br>
                            <span data-i18n="contact.success.reply">We will reply using the email address you provided.</span>
                        </div>
                    </div>
                    <h2 data-i18n="contact.success.title">Message received</h2>
                    <p>
                        <span data-i18n="contact.success.add">If you would like to add something, open a fresh form or email us directly at</span>
                        <a class="inline-link" href="mailto:<?= e(SITE_EMAIL) ?>" dir="ltr"><?= e(SITE_EMAIL) ?></a>.
                    </p>
                    <p>
                        <a class="text-link" href="./contact">
                            <span data-i18n="contact.success.fresh">Open a fresh form</span>
                            <?= icon('arrow-right', 16, 'icon-arrow') ?>
                        </a>
                    </p>
                <?php else: ?>
                    <h2 data-i18n="contact.form.title">Send an enquiry</h2>
                    <p data-i18n-html="contact.form.required">Fields marked with <span class="required">*</span> are required.</p>

                    <?php if (!empty($errors)): ?>
                        <div class="error-summary" id="error-summary" role="alert" tabindex="-1">
                            <h3 data-i18n="contact.form.summary">Please check the following</h3>
                            <ul>
                                <?php foreach ($errors as $key => $message): ?>
                                    <li>
                                        <?php if ($key === 'form'): ?>
                                            <span data-i18n="<?= e($errorKeys['form'] ?? '') ?>"><?= e($message) ?></span>
                                        <?php else: ?>
                                            <a href="#<?= e($key) ?>"<?= isset($errorKeys[$key]) ? ' data-i18n="' . e($errorKeys[$key]) . '"' : '' ?>><?= e($message) ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="contact" method="post" novalidate>
                        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                        <div class="hp-field" aria-hidden="true">
                            <label for="website">Leave this field empty</label>
                            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="form-row">
                            <div class="field">
                                <label for="name" data-i18n-html="contact.form.name_label">Name <span class="required" aria-hidden="true">*</span></label>
                                <input
                                    type="text" id="name" name="name" autocomplete="name"
                                    value="<?= e($values['name']) ?>" required
                                    <?= isset($errors['name']) ? 'aria-invalid="true" aria-describedby="name-error"' : '' ?>>
                                <?php if (isset($errors['name'])): ?>
                                    <p class="field-error" id="name-error" data-i18n="<?= e($errorKeys['name'] ?? '') ?>"><?= e($errors['name']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="field">
                                <label for="email" data-i18n-html="contact.form.email_label">Email <span class="required" aria-hidden="true">*</span></label>
                                <input
                                    type="email" id="email" name="email" autocomplete="email" dir="ltr"
                                    value="<?= e($values['email']) ?>" required
                                    <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="email-error"' : '' ?>>
                                <?php if (isset($errors['email'])): ?>
                                    <p class="field-error" id="email-error" data-i18n="<?= e($errorKeys['email'] ?? '') ?>"><?= e($errors['email']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="field">
                                <label for="phone" data-i18n-html="contact.form.phone_label">Phone <span class="label-optional">(optional)</span></label>
                                <input
                                    type="tel" id="phone" name="phone" autocomplete="tel" dir="ltr"
                                    value="<?= e($values['phone']) ?>"
                                    <?= isset($errors['phone']) ? 'aria-invalid="true" aria-describedby="phone-error"' : '' ?>>
                                <?php if (isset($errors['phone'])): ?>
                                    <p class="field-error" id="phone-error" data-i18n="<?= e($errorKeys['phone'] ?? '') ?>"><?= e($errors['phone']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="field">
                                <label for="company" data-i18n-html="contact.form.company_label">Restaurant / company <span class="label-optional">(optional)</span></label>
                                <input
                                    type="text" id="company" name="company" autocomplete="organization"
                                    value="<?= e($values['company']) ?>"
                                    <?= isset($errors['company']) ? 'aria-invalid="true" aria-describedby="company-error"' : '' ?>>
                                <?php if (isset($errors['company'])): ?>
                                    <p class="field-error" id="company-error" data-i18n="<?= e($errorKeys['company'] ?? '') ?>"><?= e($errors['company']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="field">
                            <label for="message" data-i18n-html="contact.form.message_label">Message <span class="required" aria-hidden="true">*</span></label>
                            <textarea
                                id="message" name="message" required
                                placeholder="Where is the restaurant, and what would you like help with?"
                                data-i18n-placeholder="contact.form.message_placeholder"
                                <?= isset($errors['message']) ? 'aria-invalid="true" aria-describedby="message-error"' : '' ?>><?= e($values['message']) ?></textarea>
                            <?php if (isset($errors['message'])): ?>
                                <p class="field-error" id="message-error" data-i18n="<?= e($errorKeys['message'] ?? '') ?>"><?= e($errors['message']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-foot">
                            <p data-i18n="contact.form.privacy">We use these details only to respond to your enquiry. Nothing is stored on this website.</p>
                            <button class="btn btn-solid" type="submit">
                                <span data-i18n="contact.form.submit">Send enquiry</span>
                                <?= icon('arrow-right', 18, 'icon-arrow') ?>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php if (!$sent && !empty($errors)): ?>
    <script>
        (function () {
            var summary = document.getElementById("error-summary");
            if (summary) summary.focus();
        })();
    </script>
<?php endif; ?>

<?php require __DIR__ . '/inc/footer.php'; ?>
