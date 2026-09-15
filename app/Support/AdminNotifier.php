<?php

namespace App\Support;

use App\Mail\AdminFormSubmitted;
use Illuminate\Support\Facades\Mail;

class AdminNotifier
{
    public static function formSubmitted(string $formType, string $applicantName, string $summary): void
    {
        $recipient = config('peso-options.admin_notification_email');

        if (! $recipient) {
            return;
        }

        Mail::to($recipient)->send(new AdminFormSubmitted($formType, $applicantName, $summary));
    }
}
