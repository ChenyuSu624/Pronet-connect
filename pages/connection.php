<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php'); // Redirect to login if not authenticated
    exit;
}

// Use the profile image passed from the dashboard or fallback to the session value
$randomProfileImage = $_GET['profile_image'] ?? $_SESSION['profile_image'] ?? '../icons/default-profile.png';

// Randomly select profile images for connections from the icons/user directory
$userIcons = glob('../icons/user/*.png'); // Adjust the extension if needed
function getRandomUserIcon($userIcons) {
    return !empty($userIcons) ? $userIcons[array_rand($userIcons)] : '../icons/default-profile.png';
}

// Use the same profile image as the dashboard
if (!isset($_SESSION['profile_image'])) {
    $_SESSION['profile_image'] = !empty($userIcons) ? $userIcons[array_rand($userIcons)] : '../icons/default-profile.png';
}
$randomProfileImage = $_SESSION['profile_image'];

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

// Pagination logic
$connectionsPerPage = 6;
$totalConnections = count($connections);
$totalPages = ceil($totalConnections / $connectionsPerPage);
$currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1;
$startIndex = ($currentPage - 1) * $connectionsPerPage;
$paginatedConnections = array_slice($connections, $startIndex, $connectionsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connections - ProNet Connect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5; /* Match login page background */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the contents horizontally */
            height: 100vh;
        }
        .header {
            width: 100%;
            background-color: white;
            padding: 10px 20px; /* Adjust padding to fit within the viewport */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative; /* Allow positioning of elements */
            flex-wrap: nowrap; /* Prevent wrapping of elements */
            box-sizing: border-box; /* Ensure padding is included in width calculation */
        }
        .header .logo {
            display: flex;
            align-items: center; /* Vertically center the logo and title */
            cursor: pointer; /* Add pointer cursor for clickable logo */
        }
        .header .logo a {
            display: flex;
            align-items: center; /* Vertically center the link content */
            text-decoration: none; /* Remove underline */
            color: black; /* Ensure text color matches the design */
        }
        .header .logo a:hover {
            text-decoration: none; /* Ensure no underline on hover */
        }
        .header .logo img {
            height: 40px;
            margin-left: 10px;
            margin-right: 10px;
        }
        .header .logo span {
            font-size: 20px;
            font-weight: bold;
            color: black;
        }
        .header form {
            position: relative;
            flex: 1; /* Allow the search box to take available space */
            max-width: 500px; /* Maximum width for the search box */
            margin: 0 20px; /* Add spacing between logo and profile */
        }
        .header input {
            width: 100%; /* Full width within the form */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px; /* Reduced rounding for a more square design */
            box-sizing: border-box; /* Include padding in width calculation */
        }
        .header input::placeholder {
            color: #999; /* Placeholder text color */
        }
        .header button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
        }
        .header button img {
            height: 20px;
            width: 20px;
        }
        .header .profile {
            display: flex;
            align-items: center;
            height: 28px; /* Set the height of the profile container */
            width: 28px; /* Set the width of the profile container */
        }
        .header .profile img {
            height: 30px; /* Set the height of the profile icon */
            width: 30px; /* Set the width of the profile icon */
            border-radius: 50%;
            margin-left: 10px;
        }
        .header .icons {
            display: flex;
            align-items: center;
            gap: 15px; /* Add spacing between icons */
        }
        .header .icons img {
            height: 24px;
            width: 24px;
            cursor: pointer;
        }
        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            width: 100%;
            max-width: 1200px;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            width: 100%;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
            max-width: 1200px; /* Ensure alignment with connections panel */
        }
        .stats div {
            text-align: center;
        }
        .stats div h3 {
            margin: 0;
            font-size: 24px;
        }
        .stats div p {
            margin: 5px 0 0;
            color: #666;
        }
        .actions {
            display: flex;
            justify-content: space-between; /* Align buttons and dropdown on opposite sides */
            align-items: center;
            margin-bottom: 20px;
            width: 100%; /* Full width */
            max-width: 1200px; /* Match the width of the connections panel */
        }
        .actions .left-actions {
            display: flex;
            gap: 10px; /* Add spacing between buttons */
        }
        .actions .right-actions {
            display: flex;
        }
        .actions button {
            padding: 10px 20px;
            background-color: #4a00e0; /* Match login page button color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #3a00b0; /* Match login page hover color */
        }
        .actions select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .connections {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
            max-width: 1200px; /* Ensure alignment with stats panel */
        }
        .connection-card {
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: calc(33.333% - 20px); /* Ensure consistent width for cards */
            box-sizing: border-box;
        }
        .connection-card img {
            width: 60px; /* Reduce icon size */
            height: 60px; /* Maintain aspect ratio */
            border-radius: 50%; /* Make the icon circular */
            margin-bottom: 10px;
        }
        .connection-card h4 {
            margin: 0 0 10px;
            font-size: 18px;
        }
        .connection-card p {
            margin: 0 0 10px;
            color: #666;
        }
        .connection-card .actions {
            display: flex;
            justify-content: space-between;
        }
        .connection-card .actions button {
            padding: 5px 10px;
            background-color: #4a00e0; /* Match login page button color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .connection-card .actions button:hover {
            background-color: #3a00b0; /* Match login page hover color */
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination button {
            padding: 10px 20px;
            background-color: #4a00e0; /* Match login page button color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 5px;
        }
        .pagination button.disabled {
            background-color: #ccc; /* Disabled button color */
            cursor: not-allowed;
        }
        .pagination button:hover:not(.disabled) {
            background-color: #3a00b0; /* Match login page hover color */
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="dashboard.php">
                <img src="../icons/pronet.gif" alt="ProNet Connect">
                <span>ProNet Connect</span>
            </a>
        </div>
        <form id="searchForm">
            <input type="text" name="query" id="searchQuery" placeholder="Search connections...">
            <button type="submit">
                <img src="../icons/magnify.png" alt="Search">
            </button>
        </form>
        <div class="icons">
            <img src="../icons/bell-outline.png" alt="Notifications">
            <img src="../icons/email-outline.png" alt="Messages">
            <div class="profile">
                <img src="<?= htmlspecialchars($randomProfileImage) ?>" alt="Profile"> <!-- Use the passed or session profile image -->
            </div>
        </div>
    </div>
    <div class="main">
        <div class="stats">
            <div>
                <h3>847</h3>
                <p>Connections</p>
            </div>
            <div>
                <h3>32</h3>
                <p>Pending Invites</p>
            </div>
            <div>
                <h3>156</h3>
                <p>Profile Views</p>
            </div>
            <div>
                <h3>12</h3>
                <p>New Messages</p>
            </div>
        </div>
        <div class="actions">
            <div class="left-actions">
                <button id="addConnectionButton">Add Connection</button>
                <button id="filterButton">Filter</button>
            </div>
            <div class="right-actions">
                <select id="filterSelect">
                    <option value="recently_added">Recently Added</option>
                    <option value="alphabetical">Alphabetical</option>
                </select>
            </div>
        </div>
        <div class="connections" id="connectionsContainer">
            <?php foreach ($paginatedConnections as $connection): ?>
                <div class="connection-card">
                    <img src="<?= htmlspecialchars(getRandomUserIcon($userIcons)) ?>" alt="User">
                    <h4><?= htmlspecialchars($connection['name']) ?></h4>
                    <p><?= htmlspecialchars($connection['title']) ?></p>
                    <p><?= htmlspecialchars($connection['location']) ?></p>
                    <div class="actions">
                        <button>Message</button>
                        <button>...</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <button <?= $currentPage <= 1 ? 'class="disabled"' : '' ?> onclick="location.href='?page=<?= $currentPage - 1 ?>'">Previous</button>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <button <?= $i === $currentPage ? 'class="disabled"' : '' ?> onclick="location.href='?page=<?= $i ?>'"><?= $i ?></button>
            <?php endfor; ?>
            <button <?= $currentPage >= $totalPages ? 'class="disabled"' : '' ?> onclick="location.href='?page=<?= $currentPage + 1 ?>'">Next</button>
        </div>
    </div>
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent page refresh
            const query = document.getElementById('searchQuery').value;

            // Perform AJAX request to fetch filtered connections
            fetch('search-connections.php?query=' + encodeURIComponent(query))
                .then(response => response.text())
                .then(data => {
                    document.querySelector('.connections').innerHTML = data; // Update connections
                })
                .catch(error => console.error('Error fetching connections:', error));
        });

        // Add functionality to the filter button
        document.getElementById('filterButton').addEventListener('click', function() {
            const filterValue = document.getElementById('filterSelect').value;
            const connectionsContainer = document.getElementById('connectionsContainer');
            let sortedConnections = Array.from(connectionsContainer.children);

            if (filterValue === 'alphabetical') {
                sortedConnections.sort((a, b) => {
                    const nameA = a.querySelector('h4').textContent.toLowerCase();
                    const nameB = b.querySelector('h4').textContent.toLowerCase();
                    return nameA.localeCompare(nameB);
                });
            } else if (filterValue === 'recently_added') {
                sortedConnections.reverse(); // Reverse the order for recently added
            }

            connectionsContainer.innerHTML = '';
            sortedConnections.forEach(connection => connectionsContainer.appendChild(connection));
        });

        // Add functionality to sort connections immediately on dropdown selection
        document.getElementById('filterSelect').addEventListener('change', function() {
            const filterValue = this.value;
            const connectionsContainer = document.getElementById('connectionsContainer');
            let sortedConnections = Array.from(connectionsContainer.children);

            if (filterValue === 'alphabetical') {
                sortedConnections.sort((a, b) => {
                    const nameA = a.querySelector('h4').textContent.toLowerCase();
                    const nameB = b.querySelector('h4').textContent.toLowerCase();
                    return nameA.localeCompare(nameB);
                });
            } else if (filterValue === 'recently_added') {
                sortedConnections.reverse(); // Reverse the order for recently added
            }

            connectionsContainer.innerHTML = '';
            sortedConnections.forEach(connection => connectionsContainer.appendChild(connection));
        });
    </script>
</body>
</html>
