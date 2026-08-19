<?php

return [
    'credentials' => [
        'username' => 'admin',
        'password' => 'admin',
    ],

    'dashboard' => [
        'stats' => [
            ['label' => 'Total Enlistees', 'value' => '1,247', 'change' => '+12%', 'change_type' => 'up'],
            ['label' => 'Active Job Posts', 'value' => '84', 'change' => '+4%', 'change_type' => 'up'],
            ['label' => 'Pending Referrals', 'value' => '23', 'change' => '-2%', 'change_type' => 'down'],
            ['label' => 'New This Month', 'value' => '156', 'change' => '+18%', 'change_type' => 'up'],
        ],
        'recent_enlistees' => [
            ['name' => 'Juan Dela Cruz', 'position' => 'Software Engineer', 'date' => 'Oct 24, 2024', 'status' => 'For Interview'],
            ['name' => 'Maria Santos', 'position' => 'Public Health Nurse', 'date' => 'Oct 23, 2024', 'status' => 'Pending'],
            ['name' => 'Jose Rizal', 'position' => 'Civil Engineer', 'date' => 'Oct 22, 2024', 'status' => 'Hired'],
            ['name' => 'Manuel Quezon', 'position' => 'Accountant', 'date' => 'Oct 21, 2024', 'status' => 'Not Qualified'],
        ],
        'upcoming_activities' => [
            ['day' => '26', 'month' => 'OCT', 'title' => 'PESO Mega Job Fair', 'details' => 'Manila City Hall Plaza, 9:00 AM - 4:00 PM'],
            ['day' => '28', 'month' => 'OCT', 'title' => 'Career Coaching Webinar', 'details' => 'Zoom Session for Gov Job Seekers'],
            ['day' => '02', 'month' => 'NOV', 'title' => 'Referral Validation', 'details' => 'Monthly review of LGU endorsed enlistments'],
        ],
        'categories' => [
            ['name' => 'IT & Tech', 'count' => 436, 'percent' => '35%', 'color' => '#1b3a6b'],
            ['name' => 'Construction', 'count' => 311, 'percent' => '25%', 'color' => '#f57c00'],
            ['name' => 'Healthcare', 'count' => 187, 'percent' => '15%', 'color' => '#009688'],
            ['name' => 'Education', 'count' => 187, 'percent' => '15%', 'color' => '#4f46e5'],
            ['name' => 'Others', 'count' => 126, 'percent' => '10%', 'color' => '#94a3b8'],
        ],
    ],

    'admin_jobs' => [
        ['id' => 1, 'title' => 'Administrative Assistant II', 'company' => 'DSWD NCR', 'company_abbr' => 'DSW', 'type' => 'Full-Time', 'category' => 'Administrative', 'posted' => 'Oct 24, 2023', 'enlistments' => 42, 'status' => 'Active'],
        ['id' => 2, 'title' => 'Heavy Equipment Mechanic', 'company' => 'DPWH Infrastructure', 'company_abbr' => 'DPW', 'type' => 'Part-Time', 'category' => 'Construction', 'posted' => 'Oct 18, 2023', 'enlistments' => 37, 'status' => 'Closed'],
        ['id' => 3, 'title' => 'Internal Senior Auditor', 'company' => 'Bureau of Internal Revenue', 'company_abbr' => 'BUR', 'type' => 'Full-Time', 'category' => 'Administrative', 'posted' => 'Oct 15, 2023', 'enlistments' => 12, 'status' => 'Draft'],
        ['id' => 4, 'title' => 'Municipal Agriculturist I', 'company' => 'Department of Agriculture', 'company_abbr' => 'DEP', 'type' => 'Part-Time', 'category' => 'Education', 'posted' => 'Oct 12, 2023', 'enlistments' => 19, 'status' => 'Active'],
        ['id' => 5, 'title' => 'Technical Support Representative', 'company' => 'Accenture Philippines', 'company_abbr' => 'ACC', 'type' => 'Full-Time', 'category' => 'IT & Tech', 'posted' => 'Oct 10, 2023', 'enlistments' => 28, 'status' => 'Active'],
    ],

    'enlistees' => [
        ['id' => 1, 'name' => 'Maria Clara de los Santos', 'position' => 'Senior IT Support Specialist', 'date' => 'Oct 24, 2024', 'contact' => '+63 917 123 4567', 'address' => 'Barangay 76, Pasay City, Metro Manila', 'skills' => 'Customer Service, Data Entry, MS Office', 'education' => "College (Bachelor's Degree)", 'status' => 'Hired'],
        ['id' => 2, 'name' => 'Juan Dela Cruz', 'position' => 'Administrative Assistant', 'date' => 'Oct 23, 2024', 'contact' => '+63 920 987 6543', 'address' => 'Barangay 12, Quezon City, Metro Manila', 'skills' => 'Customer Service, MS Office', 'education' => "College (Bachelor's Degree)", 'status' => 'Pending'],
        ['id' => 3, 'name' => 'Ana Reyes', 'position' => 'Registered Nurse', 'date' => 'Oct 22, 2024', 'contact' => '+63 918 987 6543', 'address' => 'Barangay 5, Manila City, Metro Manila', 'skills' => 'Healthcare, Data Entry', 'education' => "College (Bachelor's Degree)", 'status' => 'For Interview'],
        ['id' => 4, 'name' => 'Carlos Mendoza', 'position' => 'Data Analyst', 'date' => 'Oct 21, 2024', 'contact' => '+63 999 444 5555', 'address' => 'Barangay 3, Makati City, Metro Manila', 'skills' => 'Data Entry, MS Office', 'education' => "College (Bachelor's Degree)", 'status' => 'Not Qualified'],
    ],

    'referrals' => [
        ['id' => 1, 'name' => 'Juanito dela Cruz', 'job' => 'Production Engineer', 'employer' => 'San Miguel Corporation', 'date' => 'Oct 24, 2024', 'status' => 'Pending Review'],
        ['id' => 2, 'name' => 'Clarissa Mae Recto', 'job' => 'Marketing Associate', 'employer' => 'SM Prime Holdings', 'date' => 'Oct 23, 2024', 'status' => 'Approved'],
        ['id' => 3, 'name' => 'Aldrin Bautista', 'job' => 'Technical Analyst', 'employer' => 'Globe Telecom', 'date' => 'Oct 20, 2024', 'status' => 'Denied'],
    ],

    'referral_stats' => [
        ['label' => 'Total Requests', 'value' => '142', 'icon_bg' => '#e8eef5', 'icon_stroke' => '#1b3a6b'],
        ['label' => 'Pending Review', 'value' => '38', 'icon_bg' => '#fff3e0', 'icon_stroke' => '#f57c00'],
        ['label' => 'Approved', 'value' => '84', 'icon_bg' => '#e8f5e9', 'icon_stroke' => '#2e7d32'],
        ['label' => 'Denied', 'value' => '20', 'icon_bg' => '#ffebee', 'icon_stroke' => '#c62828'],
    ],

    'admin_announcements' => [
        ['id' => 1, 'title' => 'Annual Mega Job Fair 2026 Registration Now Open', 'excerpt' => 'Pre-register today to secure your exclusive fast-track pass and meet over 150 local and global employers at the SMX Convention Center. Free counseling services and resume assessments are available on-site.', 'author' => 'Admin Maria Santos', 'date' => 'Oct 24, 2026', 'publish_date' => '2026-10-24', 'category' => 'Job Fair', 'status' => 'Published'],
        ['id' => 2, 'title' => 'Special Recruitment Activity for Customer Support Representatives', 'excerpt' => 'A premier international BPO partner is hosting a one-day recruitment hub at the 3rd floor PESO main building on October 29. High school graduates and college graduates with exceptional communication skills are welcome.', 'author' => 'Officer Juan Dela Cruz', 'date' => 'Oct 23, 2026', 'publish_date' => '2026-10-23', 'category' => 'Recruitment', 'status' => 'Published'],
        ['id' => 3, 'title' => 'New Free Livelihood Skills Training Program in Barangay San Jose', 'excerpt' => 'In partnership with TESDA, we are opening enrollment for a comprehensive 10-day hands-on training series in Baking and Pastry Production. All ingredients, equipment, and starter kits are fully subsidized.', 'author' => 'Coop Officer Jane Diaz', 'date' => 'Oct 28, 2026', 'publish_date' => '2026-10-28', 'category' => 'Training', 'status' => 'Scheduled'],
        ['id' => 4, 'title' => 'System Maintenance: PESO Online Portal Offline This Weekend', 'excerpt' => 'Our engineering team will perform scheduled database updates and servers optimization on Saturday, October 31, from 12:00 AM to 6:00 AM. Access to online profiles and job postings will be temporarily offline.', 'author' => 'IT Support Dept', 'date' => 'Oct 22, 2026', 'publish_date' => '2026-10-22', 'category' => 'System', 'status' => 'Published'],
        ['id' => 5, 'title' => 'Webinar: Resume Writing, Branding, and Professional LinkedIn Presence', 'excerpt' => 'Draft concept for our quarterly virtual career acceleration boot camp. Key target audience: fresh graduates and career shifters seeking specialized tips from regional recruiters.', 'author' => 'HR Specialist Dan Cruz', 'date' => 'Oct 19, 2026', 'publish_date' => '2026-10-19', 'category' => 'Training', 'status' => 'Draft'],
    ],

    'announcement_categories' => ['Job Fair', 'Recruitment', 'Training', 'System', 'Advisory'],

    'certifications' => [
        ['id' => 1, 'name' => 'Mateo Katigbak', 'date' => 'Oct 24, 2024', 'barangay' => 'Brgy. 12, Balayan', 'status' => 'Pending'],
        ['id' => 2, 'name' => 'Maria Clara Santos', 'date' => 'Oct 23, 2024', 'barangay' => 'Brgy. Kumintang Ilaya, Batangas City', 'status' => 'Claimed'],
        ['id' => 3, 'name' => 'Juan dela Cruz Jr.', 'date' => 'Oct 22, 2024', 'barangay' => 'Brgy. Wawa, Nasugbu', 'status' => 'Not Claimed'],
        ['id' => 4, 'name' => 'Angelica Panganiban', 'date' => 'Oct 21, 2024', 'barangay' => 'Brgy. Calicanto, Batangas City', 'status' => 'Claimed'],
        ['id' => 5, 'name' => 'Jose Rizalito Mercado', 'date' => 'Oct 19, 2024', 'barangay' => 'Brgy. Bagong Pook, San Jose', 'status' => 'Pending'],
        ['id' => 6, 'name' => 'Corazon Aquino Diokno', 'date' => 'Oct 18, 2024', 'barangay' => 'Brgy. Muzon, Alitagtag', 'status' => 'Not Claimed'],
    ],

    'certification_stats' => [
        ['label' => 'Total Certifications', 'value' => '87', 'icon_bg' => '#e8eef5', 'icon_stroke' => '#1b3a6b'],
        ['label' => 'Pending Approval', 'value' => '24', 'icon_bg' => '#fff3e0', 'icon_stroke' => '#f57c00'],
        ['label' => 'Claimed', 'value' => '51', 'icon_bg' => '#e8f5e9', 'icon_stroke' => '#2e7d32'],
        ['label' => 'Not Claimed', 'value' => '12', 'icon_bg' => '#ffebee', 'icon_stroke' => '#c62828'],
    ],

    'activity_logs' => [
        ['timestamp' => 'Oct 31, 2024, 10:42 AM', 'user' => 'Maria Santos', 'action' => 'Created Job Posting', 'details' => 'ID #29402: Lead Software Engineer (Manila)'],
        ['timestamp' => 'Oct 31, 2024, 10:35 AM', 'user' => 'Jose Maria', 'action' => 'Approved Referral', 'details' => 'Candidate: Juan Dela Cruz • Referrer: Al S.'],
        ['timestamp' => 'Oct 31, 2024, 09:12 AM', 'user' => 'Antonio Luna', 'action' => 'Updated Enlistee Status', 'details' => "Marked Clara Reyes as 'Interviewing' (DevOps Role)"],
        ['timestamp' => 'Oct 31, 2024, 08:45 AM', 'user' => 'Jose Maria', 'action' => 'Login', 'details' => 'Successful admin console session start'],
        ['timestamp' => 'Oct 30, 2024, 05:22 PM', 'user' => 'Giselle Diaz', 'action' => 'Exported Report', 'details' => 'Referral Conversion Summary (Q3 2024)'],
        ['timestamp' => 'Oct 30, 2024, 03:10 PM', 'user' => 'Antonio Luna', 'action' => 'Removed Enlistee Record', 'details' => 'Removed enlistee record for test entry'],
        ['timestamp' => 'Oct 30, 2024, 11:15 AM', 'user' => 'Maria Santos', 'action' => 'Updated Enlistee Status', 'details' => 'Rejected 3 candidates for Senior QA Tester role'],
        ['timestamp' => 'Oct 30, 2024, 09:30 AM', 'user' => 'Juan Gomez', 'action' => 'Created Job Posting', 'details' => 'ID #29381: Senior Project Manager'],
        ['timestamp' => 'Oct 29, 2024, 04:50 PM', 'user' => 'Jose Maria', 'action' => 'Approved Referral', 'details' => 'Candidate: Michael Tan • Referrer: Sarah G.'],
        ['timestamp' => 'Oct 29, 2024, 02:15 PM', 'user' => 'Giselle Diaz', 'action' => 'Modified System Settings', 'details' => 'Changed default referral bonus cap limit to PHP 10,000'],
    ],
    'activity_total' => 1420,

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
    'announcement_filter_tabs' => ['Published', 'Scheduled'],
    'announcement_sort_options' => ['Recent First', 'Oldest First'],
    'certification_statuses' => ['Pending', 'Claimed', 'Not Claimed'],
    'certification_date_filters' => ['This Month', 'Last 30 Days', 'Last 7 Days', 'All Time'],
    'activity_users' => ['All Users', 'Maria Santos', 'Jose Maria', 'Antonio Luna', 'Giselle Diaz', 'Juan Gomez'],
    'activity_actions' => [
        'All Actions',
        'Created Job Posting',
        'Approved Referral',
        'Updated Enlistee Status',
        'Login',
        'Exported Report',
        'Removed Enlistee Record',
        'Modified System Settings',
    ],
    'activity_date_filters' => ['Oct 24 - Oct 31, 2024', 'Oct 17 - Oct 23, 2024', 'Oct 10 - Oct 16, 2024', 'All Time'],

    'reports' => [
        'stats' => [
            ['label' => 'Total Enlistees', 'value' => '1,247', 'change' => '+12%', 'change_type' => 'up', 'icon_bg' => 'rgba(27,58,107,0.1)', 'icon_stroke' => '#1b3a6b', 'icon' => 'users'],
            ['label' => 'Active Job Posts', 'value' => '84', 'change' => '+4%', 'change_type' => 'up', 'icon_bg' => 'rgba(245,124,0,0.1)', 'icon_stroke' => '#f57c00', 'icon' => 'briefcase'],
            ['label' => 'Pending Referrals', 'value' => '23', 'change' => '-2%', 'change_type' => 'down', 'icon_bg' => 'rgba(0,150,136,0.1)', 'icon_stroke' => '#009688', 'icon' => 'referral'],
            ['label' => 'New This Month', 'value' => '156', 'change' => '+18%', 'change_type' => 'up', 'icon_bg' => 'rgba(79,70,229,0.1)', 'icon_stroke' => '#4f46e5', 'icon' => 'new'],
        ],
        'monthly_enlistments' => [
            ['month' => 'Jan', 'value' => 320],
            ['month' => 'Feb', 'value' => 350],
            ['month' => 'Mar', 'value' => 330],
            ['month' => 'Apr', 'value' => 380],
            ['month' => 'May', 'value' => 400],
            ['month' => 'Jun', 'value' => 410, 'highlight' => true],
        ],
        'categories' => [
            ['name' => 'IT & Tech', 'count' => 436, 'percent' => '35%', 'color' => '#1b3a6b'],
            ['name' => 'Construction', 'count' => 311, 'percent' => '25%', 'color' => '#f57c00'],
            ['name' => 'Healthcare', 'count' => 187, 'percent' => '15%', 'color' => '#009688'],
            ['name' => 'Education', 'count' => 187, 'percent' => '15%', 'color' => '#4f46e5'],
            ['name' => 'Government', 'count' => 126, 'percent' => '10%', 'color' => '#94a3b8'],
        ],
        'category_total' => '1,247',
        'report_types' => [
            ['value' => 'enlistments', 'label' => 'Enlistments Summary'],
            ['value' => 'referrals', 'label' => 'Referral Requests'],
            ['value' => 'jobs', 'label' => 'Job Postings'],
            ['value' => 'ftjs', 'label' => 'FTJS Certifications'],
        ],
        'date_filters' => ['This Month', 'Last 30 Days', 'Last 7 Days', 'All Time'],
        'display_date' => 'October 24, 2024',
    ],
];
