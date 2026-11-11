<?php
declare(strict_types=1);

/**
 * Site-wide settings and content.
 * Only verified details are used here: business name, activity, phone,
 * email and city. Trade licence numbers and dates are deliberately excluded.
 */

const SITE_NAME        = 'Flavour & Co.';
const SITE_LEGAL_NAME  = 'Flavour & Co Restaurants Management L.L.C';
const SITE_TAGLINE     = 'Restaurant management · Dubai, UAE';
const SITE_PHONE       = '+971 58 864 9391';
const SITE_PHONE_LINK  = '+971588649391';
const SITE_EMAIL       = 'Flavourco2025@gmail.com';
const SITE_CITY        = 'Dubai';
const SITE_COUNTRY     = 'United Arab Emirates';
const SITE_ADDRESS     = 'Dubai, United Arab Emirates';
const SITE_YEAR        = 2026;

/**
 * SMTP delivery for the contact form.
 * Keep these credentials out of version control on a production server and
 * prefer environment-specific configuration where possible.
 */
const SMTP_HOST            = 'send.one.com';
const SMTP_PORT            = 465;
const SMTP_USER            = 'no-reply@whiteseastar.com';
const SMTP_PASS            = 'Developer#18';
const SMTP_FROM_NAME       = 'Flavour & Co.';
const SMTP_FALLBACK_DOMAIN = 'whiteseastar.com';

/**
 * Contact form recipient.
 * Change this one line when the receiving address or domain changes.
 */
$to = 'it@whiteseastar.com';

const NAV_ITEMS = [
    './'       => 'Home',
    'about'    => 'About',
    'services' => 'Services',
    'contact'  => 'Contact',
];

const NAV_KEYS = [
    './'       => 'nav.home',
    'about'    => 'nav.about',
    'services' => 'nav.services',
    'contact'  => 'nav.contact',
];

const SERVICES = [
    [
        'slug'  => 'operations',
        'title' => 'Restaurant operations',
        'short' => 'Daily management with a clear line of sight.',
        'copy'  => 'We look after the rhythm of service — the opening checklist, the floor during a busy pass, the close at the end of the night. The aim is a restaurant that runs the same way whether or not anyone is watching.',
        'items' => [
            'Service standards and floor routines',
            'Scheduling and daily operations',
            'Supplier and delivery coordination',
        ],
        'icon'  => 'sliders',
    ],
    [
        'slug'  => 'concept',
        'title' => 'Concept and menu',
        'short' => 'An idea that works on the plate and on paper.',
        'copy'  => 'A concept has to be clear before it is beautiful. We help shape the offer, structure the menu and set the standards that keep every plate recognisably yours.',
        'items' => [
            'Concept positioning and offer',
            'Menu structure and pricing',
            'Recipe and portion standards',
        ],
        'icon'  => 'book',
    ],
    [
        'slug'  => 'kitchen',
        'title' => 'Kitchen management',
        'short' => 'A line that works clean, calm and consistent.',
        'copy'  => 'The kitchen is where consistency is won or lost. We support the workflow, the prep, the stock and the hygiene routines that let a team cook well under pressure.',
        'items' => [
            'Kitchen workflow and prep',
            'Food safety and hygiene routines',
            'Stock, portion and waste control',
        ],
        'icon'  => 'flame',
    ],
    [
        'slug'  => 'people',
        'title' => 'People and training',
        'short' => 'Teams that understand the standard, and why it matters.',
        'copy'  => 'Service is a skill, not a script. We help build teams that know the menu, read the room and take responsibility for the guest experience.',
        'items' => [
            'Hiring support and onboarding',
            'Service and kitchen training',
            'Rota and performance routines',
        ],
        'icon'  => 'users',
    ],
    [
        'slug'  => 'guest',
        'title' => 'Guest experience',
        'short' => 'The details a guest feels but never sees.',
        'copy'  => 'From the first reservation to the last goodbye, we review how the experience holds together — and fix the points where it doesn’t.',
        'items' => [
            'Reservations and front-of-house flow',
            'Service recovery',
            'Guest feedback routines',
        ],
        'icon'  => 'sparkle',
    ],
    [
        'slug'  => 'commercial',
        'title' => 'Commercial oversight',
        'short' => 'Clarity on what the restaurant earns and spends.',
        'copy'  => 'Good management needs good numbers. We keep a close view of costs, sales and margins, and use them to make practical decisions rather than decorative reports.',
        'items' => [
            'Budget and cost tracking',
            'Sales and margin reporting',
            'Menu and supplier reviews',
        ],
        'icon'  => 'chart',
    ],
];

const APPROACH = [
    [
        'title' => 'Listen',
        'copy'  => 'We start with the restaurant as it is: the concept, the team, the kitchen, the numbers and the guest experience.',
    ],
    [
        'title' => 'Build',
        'copy'  => 'Together we set the standards, routines and reporting that suit the business — not a template lifted from somewhere else.',
    ],
    [
        'title' => 'Run',
        'copy'  => 'We stay close to the day-to-day, reviewing what works, correcting what doesn’t and keeping the standard in place.',
    ],
];

const PRINCIPLES = [
    [
        'title' => 'Own the detail',
        'copy'  => 'Standards are set in the small things: the pass, the floor, the close. That is where a restaurant is made.',
    ],
    [
        'title' => 'Respect the craft',
        'copy'  => 'Cooks cook, hosts host. Management exists to make their work possible, not to get in its way.',
    ],
    [
        'title' => 'Say what is true',
        'copy'  => 'Clear reporting and honest conversations, even when the numbers are uncomfortable.',
    ],
    [
        'title' => 'Consistency over theatre',
        'copy'  => 'A good Tuesday matters as much as a good opening night. We manage for the everyday.',
    ],
];
