<?php

// Mocked connections data
$connections = [
    ['name' => 'Sarah Wilson', 'title' => 'Senior Product Designer at Tech Corp', 'location' => 'San Francisco, CA'],
    ['name' => 'Michael Chen', 'title' => 'Software Engineer at StartupX', 'location' => 'New York, NY'],
    ['name' => 'Emily Rodriguez', 'title' => 'Marketing Manager at Global Inc', 'location' => 'Austin, TX'],
    ['name' => 'David Kim', 'title' => 'Data Scientist at AI Labs', 'location' => 'Seattle, WA'],
    ['name' => 'Emma Johnson', 'title' => 'HR Manager at PeopleFirst', 'location' => 'Chicago, IL'],
    ['name' => 'Chris Lee', 'title' => 'Full Stack Developer at WebWorks', 'location' => 'Boston, MA'],
    ['name' => 'Sophia Brown', 'title' => 'Content Strategist at MediaWorks', 'location' => 'Los Angeles, CA'],
    ['name' => 'James Anderson', 'title' => 'Product Manager at InnovateX', 'location' => 'San Diego, CA'],
    ['name' => 'Olivia Martinez', 'title' => 'UX Designer at DesignPro', 'location' => 'Denver, CO'],
    ['name' => 'Liam Garcia', 'title' => 'Backend Developer at CodeBase', 'location' => 'Dallas, TX'],
    ['name' => 'Isabella Davis', 'title' => 'Marketing Specialist at AdSphere', 'location' => 'Miami, FL'],
    ['name' => 'Noah Wilson', 'title' => 'DevOps Engineer at CloudSync', 'location' => 'Atlanta, GA'],
    ['name' => 'Mia Taylor', 'title' => 'Graphic Designer at PixelPerfect', 'location' => 'Portland, OR'],
    ['name' => 'Ethan Moore', 'title' => 'AI Researcher at NeuralNet', 'location' => 'Palo Alto, CA'],
    ['name' => 'Ava White', 'title' => 'Recruiter at TalentHub', 'location' => 'Phoenix, AZ'],
    ['name' => 'Lucas Harris', 'title' => 'Cybersecurity Analyst at SecureTech', 'location' => 'Houston, TX'],
    ['name' => 'Charlotte Clark', 'title' => 'Operations Manager at BizFlow', 'location' => 'Nashville, TN'],
    ['name' => 'Benjamin Lewis', 'title' => 'Mobile Developer at Appify', 'location' => 'Orlando, FL'],
    ['name' => 'Amelia Walker', 'title' => 'Data Analyst at InsightCorp', 'location' => 'Salt Lake City, UT'],
    ['name' => 'Elijah Hall', 'title' => 'Blockchain Developer at CryptoChain', 'location' => 'San Francisco, CA'],
    ['name' => 'Harper Young', 'title' => 'Social Media Manager at Trendify', 'location' => 'Las Vegas, NV'],
    ['name' => 'Alexander King', 'title' => 'Cloud Architect at SkyNet', 'location' => 'Austin, TX'],
    ['name' => 'Ella Wright', 'title' => 'HR Specialist at PeopleFirst', 'location' => 'Chicago, IL'],
    ['name' => 'William Scott', 'title' => 'Game Developer at PlayWorks', 'location' => 'Seattle, WA'],
    ['name' => 'Grace Green', 'title' => 'SEO Specialist at RankBoost', 'location' => 'New York, NY'],
    ['name' => 'Henry Adams', 'title' => 'IT Consultant at TechAdvisors', 'location' => 'Boston, MA'],
    ['name' => 'Victoria Baker', 'title' => 'Project Manager at AgileFlow', 'location' => 'San Diego, CA'],
    ['name' => 'Daniel Perez', 'title' => 'Machine Learning Engineer at AI Labs', 'location' => 'Palo Alto, CA'],
    ['name' => 'Sofia Rivera', 'title' => 'Content Creator at MediaSphere', 'location' => 'Los Angeles, CA'],
    ['name' => 'Jackson Carter', 'title' => 'Network Engineer at NetSecure', 'location' => 'Houston, TX'],
    ['name' => 'Scarlett Mitchell', 'title' => 'Event Coordinator at PlanIt', 'location' => 'Miami, FL'],
    ['name' => 'Sebastian Ramirez', 'title' => 'Frontend Developer at Webify', 'location' => 'Denver, CO'],
    ['name' => 'Aria Torres', 'title' => 'Business Analyst at InsightCorp', 'location' => 'Salt Lake City, UT'],
    ['name' => 'Matthew Brooks', 'title' => 'Technical Writer at DocuTech', 'location' => 'Portland, OR'],
    ['name' => 'Chloe Bennett', 'title' => 'Customer Success Manager at ClientFirst', 'location' => 'Phoenix, AZ'],
    ['name' => 'Levi Foster', 'title' => 'AI Product Manager at NeuralNet', 'location' => 'San Francisco, CA'],
    ['name' => 'Lily Morgan', 'title' => 'Digital Marketer at AdSphere', 'location' => 'Atlanta, GA'],
    ['name' => 'Mason Reed', 'title' => 'Software Tester at QualityCheck', 'location' => 'Dallas, TX'],
    ['name' => 'Zoe Hughes', 'title' => 'E-commerce Specialist at ShopEase', 'location' => 'Los Angeles, CA'],
];

// Updated dummy feed data with consistent keys
$feedItems = [
    ['name' => 'Sarah Chen', 'title' => 'Hiring UX Researchers', 'content' => 'Excited to share that we\'re hiring for multiple UX Research positions!'],
    ['name' => 'Michael Roberts', 'title' => 'Microservices Architecture', 'content' => 'Just published a new article on building scalable microservices architecture.'],
    ['name' => 'Emma Wilson', 'title' => 'Graphic Designer Needed', 'content' => 'Looking for a talented graphic designer to join our team.'],
];

// Mocked content messages
$contentMessages = [
    "Check out my latest update on %s! Let's connect and collaborate in %s.",
    "Excited to share insights about %s. Reach out if you're in %s!",
    "Looking forward to discussing %s with professionals in %s.",
    "Sharing my experience on %s. Let's connect if you're nearby in %s.",
    "Just completed a project on %s. Open to opportunities in %s!",
    "Exploring new ideas in %s. Let's collaborate if you're in %s.",
    "Happy to announce progress in %s. Feel free to connect in %s.",
    "Sharing knowledge about %s. Let's network in %s!",
    "Excited to grow my expertise in %s. Open to connections in %s.",
    "Looking for collaborators on %s. Let's meet in %s!"
];

// Generate additional feed items using connections
foreach ($connections as $connection) {
    $randomMessage = $contentMessages[array_rand($contentMessages)];
    $feedItems[] = [
        'name' => $connection['name'],
        'title' => $connection['title'],
        'content' => sprintf($randomMessage, $connection['title'], $connection['location'])
    ];
}
?>
