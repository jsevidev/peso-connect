<?php

/**
 * Demo seed data for database seeders only.
 * UI options live in config/peso-options.php.
 * Live pages read from the database.
 */

return [
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

    'admin_announcements' => [
        ['id' => 1, 'title' => 'Annual Mega Job Fair 2026 Registration Now Open', 'excerpt' => 'Pre-register today to secure your exclusive fast-track pass and meet over 150 local and global employers at the SMX Convention Center. Free counseling services and resume assessments are available on-site.', 'author' => 'Admin Maria Santos', 'date' => 'Oct 24, 2026', 'publish_date' => '2026-10-24', 'category' => 'Job Fair', 'status' => 'Published'],
        ['id' => 2, 'title' => 'Special Recruitment Activity for Customer Support Representatives', 'excerpt' => 'A premier international BPO partner is hosting a one-day recruitment hub at the 3rd floor PESO main building on October 29. High school graduates and college graduates with exceptional communication skills are welcome.', 'author' => 'Officer Juan Dela Cruz', 'date' => 'Oct 23, 2026', 'publish_date' => '2026-10-23', 'category' => 'Recruitment', 'status' => 'Published'],
        ['id' => 3, 'title' => 'New Free Livelihood Skills Training Program in Barangay San Jose', 'excerpt' => 'In partnership with TESDA, we are opening enrollment for a comprehensive 10-day hands-on training series in Baking and Pastry Production. All ingredients, equipment, and starter kits are fully subsidized.', 'author' => 'Coop Officer Jane Diaz', 'date' => 'Oct 28, 2026', 'publish_date' => '2026-10-28', 'category' => 'Training', 'status' => 'Scheduled'],
        ['id' => 4, 'title' => 'System Maintenance: PESO Online Portal Offline This Weekend', 'excerpt' => 'Our engineering team will perform scheduled database updates and servers optimization on Saturday, October 31, from 12:00 AM to 6:00 AM. Access to online profiles and job postings will be temporarily offline.', 'author' => 'IT Support Dept', 'date' => 'Oct 22, 2026', 'publish_date' => '2026-10-22', 'category' => 'System', 'status' => 'Published'],
        ['id' => 5, 'title' => 'Webinar: Resume Writing, Branding, and Professional LinkedIn Presence', 'excerpt' => 'Draft concept for our quarterly virtual career acceleration boot camp. Key target audience: fresh graduates and career shifters seeking specialized tips from regional recruiters.', 'author' => 'HR Specialist Dan Cruz', 'date' => 'Oct 19, 2026', 'publish_date' => '2026-10-19', 'category' => 'Training', 'status' => 'Draft'],
    ],

    'certifications' => [
        ['id' => 1, 'name' => 'Mateo Katigbak', 'date' => 'Oct 24, 2024', 'barangay' => 'Brgy. 12, Balayan', 'status' => 'Pending'],
        ['id' => 2, 'name' => 'Maria Clara Santos', 'date' => 'Oct 23, 2024', 'barangay' => 'Brgy. Kumintang Ilaya, Batangas City', 'status' => 'Claimed'],
        ['id' => 3, 'name' => 'Juan dela Cruz Jr.', 'date' => 'Oct 22, 2024', 'barangay' => 'Brgy. Wawa, Nasugbu', 'status' => 'Not Claimed'],
        ['id' => 4, 'name' => 'Angelica Panganiban', 'date' => 'Oct 21, 2024', 'barangay' => 'Brgy. Calicanto, Batangas City', 'status' => 'Claimed'],
        ['id' => 5, 'name' => 'Jose Rizalito Mercado', 'date' => 'Oct 19, 2024', 'barangay' => 'Brgy. Bagong Pook, San Jose', 'status' => 'Pending'],
        ['id' => 6, 'name' => 'Corazon Aquino Diokno', 'date' => 'Oct 18, 2024', 'barangay' => 'Brgy. Muzon, Alitagtag', 'status' => 'Not Claimed'],
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
];
