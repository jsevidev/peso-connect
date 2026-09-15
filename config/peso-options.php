<?php

return [
    'admin_notification_email' => env('PESO_ADMIN_EMAIL', 'admin@peso.local'),
    'job_types' => ['Full-Time', 'Part-Time', 'Contract'],
    'job_statuses' => ['Active', 'Closed', 'Draft'],
    'job_categories' => ['All', 'IT & Tech', 'Healthcare', 'Construction', 'Education'],
    'posted_filters' => ['Anytime', 'Last 7 Days', 'Last 30 Days'],

    'enlistee_statuses' => ['Pending', 'Hired', 'For Interview', 'Not Qualified'],
    'position_filters' => ['All Positions', 'Administrative', 'Healthcare', 'IT & Tech'],
    'date_filters' => ['Last 30 Days', 'Last 7 Days', 'This Month', 'All Time'],

    'referral_statuses' => ['Pending Review', 'Approved', 'Denied'],
    'referral_date_filters' => ['This Month', 'Last 30 Days', 'Last 7 Days', 'All Time'],

    'announcement_statuses' => ['Published', 'Scheduled', 'Draft'],
    'announcement_categories' => ['Job Fair', 'Recruitment', 'Training', 'System', 'Advisory'],
    'announcement_filter_tabs' => ['Published', 'Scheduled'],
    'announcement_sort_options' => ['Recent First', 'Oldest First'],

    'certification_statuses' => ['Pending', 'Claimed', 'Not Claimed'],
    'certification_date_filters' => ['This Month', 'Last 30 Days', 'Last 7 Days', 'All Time'],

    'activity_date_filters' => ['Oct 24 - Oct 31, 2024', 'Oct 17 - Oct 23, 2024', 'Oct 10 - Oct 16, 2024', 'All Time'],

    'report_types' => [
        ['value' => 'enlistments', 'label' => 'Enlistments Summary'],
        ['value' => 'referrals', 'label' => 'Referral Requests'],
        ['value' => 'jobs', 'label' => 'Job Postings'],
        ['value' => 'ftjs', 'label' => 'FTJS Certifications'],
        ['value' => 'activity_logs', 'label' => 'Activity Logs'],
    ],
    'report_date_filters' => ['This Month', 'Last 30 Days', 'Last 7 Days', 'All Time'],

    'category_colors' => [
        'Full-Time' => '#1b3a6b',
        'Part-Time' => '#f57c00',
        'Contract' => '#009688',
        'Unassigned' => '#4f46e5',
        'Other' => '#94a3b8',
    ],
];
