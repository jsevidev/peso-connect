<?php

$referral = require __DIR__.'/peso-referral-letter.php';

return [
    'default_city' => 'Ozamiz City',

    'signatory' => $referral['signatory'],

    'footer' => $referral['footer'],

    'letterhead' => $referral['letterhead'],

    'contact_line' => 'Should you require any further information or clarification regarding this certification, please do not hesitate to contact our office at PESO, City Hall, Ozamiz City contact no. (088) 564-4332.',
];
