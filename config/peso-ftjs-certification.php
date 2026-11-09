<?php

$referral = require __DIR__.'/peso-referral-letter.php';

return [
    'default_city' => 'Ozamiz City',

    'signatory' => $referral['signatory'],

    'footer' => $referral['footer'],

    'letterhead' => [
        'logos' => [
            ['src' => 'assets/img/referral/city-of-ozamiz.png', 'alt' => 'City of Ozamiz'],
            ['src' => 'assets/img/peso-logo.png', 'alt' => 'Public Employment Service Office'],
        ],
    ],

    'contact_line' => 'Should you require any further information or clarification regarding this certification, please do not hesitate to contact our office at PESO, City Hall, Ozamiz City contact no. (088) 564-4332.',
];
