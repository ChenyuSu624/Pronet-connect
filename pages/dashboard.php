<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php'); // Redirect to login if not authenticated
    exit;
}

// Randomly select a profile image from the icons/user directory
$userIcons = glob('../icons/user/*.png'); // Adjust the extension if needed
if (!empty($userIcons)) {
    $randomProfileImage = $userIcons[array_rand($userIcons)];
} else {
    $randomProfileImage = '../icons/default-profile.png'; // Fallback to a default profile image
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ProNet Connect</title>
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
            align-items: center;
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
            flex: 1;
            padding: 20px;
            gap: 20px; /* Ensure consistent gap between left, center, and right panels */
            justify-content: center; /* Center content horizontally */
            width: 100%; /* Full width */
            max-width: 1200px; /* Maximum width for the main content */
        }
        .left-panel, .right-panel {
            width: 250px; /* Fixed width for side panels */
            display: flex;
            flex-direction: column;
            gap: 10px; /* Ensure consistent 10px gap between panels */
        }
        .center-panel {
            flex: 1; /* Center panel takes remaining space */
            max-width: 600px; /* Set a maximum width for the center panel */
        }
        .panel {
            background-color: white;
            padding: 10px 20px; /* Reduce top and bottom padding */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px; /* Add vertical white space between panels */
        }
        .sidebar, .rightbar {
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .sidebar {
            width: 250px;
        }
        .rightbar {
            display: flex;
            flex-direction: column; /* Stack panels vertically */
            gap: 20px; /* Add spacing between panels */
            width: 250px; /* Fixed width for the rightbar */
        }
        .sidebar .profile-info, .sidebar .menu, .rightbar .section {
            margin-bottom: 20px;
        }
        .profile-info, .menu {
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .profile-info {
            text-align: center;
        }
        .profile-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .profile-info h3 {
            margin: 10px 0 5px;
            font-size: 18px;
        }
        .profile-info p {
            margin: 5px 0;
            color: #666;
        }
        .menu a {
            display: flex;
            align-items: center;
            color: #4a00e0; /* Match login page link color */
            text-decoration: none;
            margin-bottom: 10px;
        }
        .menu a img {
            margin-right: 10px;
            width: 20px; /* Limit icon size */
            height: 20px; /* Limit icon size */
        }
        .menu a:hover {
            text-decoration: underline;
        }
        .menu button.logout {
            background-color: #4a00e0; /* Match login page button color */
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%; /* Full width button */
            text-align: center;
        }
        .menu button.logout:hover {
            background-color: #3a00b0; /* Match login page hover color */
        }
        .sidebar .menu a, .rightbar .section a {
            display: block;
            color: #4a00e0;
            text-decoration: none;
            margin-bottom: 10px;
        }
        .sidebar .menu a:hover, .rightbar .section a:hover {
            text-decoration: underline;
        }
        .center-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px; /* Add spacing between post panel and feed panel */
            max-width: 600px; /* Set a maximum width for the panels */
        }
        .post {
            background-color: #ffffff; /* Match login page background for posts */
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px; /* Adjusted for consistency */
            border: 1px solid #ccc; /* Add subtle border for better visibility */
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .post-header img {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .post textarea {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px; /* Reduced rounding for a more square design */
            resize: none;
            margin-bottom: 10px;
        }
        .post-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .post-actions .actions-left {
            display: flex;
            gap: 10px;
        }
        .post-actions .actions-left button {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 14px;
        }
        .post-actions .actions-left button img {
            height: 20px;
            width: 20px;
            margin-right: 5px;
        }
        .post-actions .actions-left button:hover {
            color: #000;
        }
        .post-actions .post-button {
            background-color: #4a00e0; /* Update button color to match the desired style */
            color: white;
            border: none;
            border-radius: 4px; /* Reduced rounding for a more square design */
            padding: 10px 20px;
            cursor: pointer;
        }
        .post-actions .post-button:hover {
            background-color: #3a00b0; /* Update hover color to match the desired style */
        }
        .feed {
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px; /* Adjusted for consistency */
        }
        .feed .feed-item {
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .feed .feed-item img {
            width: 100%;
            border-radius: 8px;
        }
        .feed .feed-item .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .feed .feed-item .actions button {
            background: none;
            border: none;
            color: #4a00e0;
            cursor: pointer;
        }
        .feed .feed-item .actions button:hover {
            text-decoration: underline;
        }
        .right-panel .panel {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
            gap: 10px; /* Add spacing between items inside the panel */
        }
        .right-panel .panel h4 {
            margin-top: 5px; /* Reduce the top margin to minimize white space above headers */
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="../icons/pronet.gif" alt="ProNet Connect">
            <span>ProNet Connect</span>
        </div>
        <form id="searchForm">
            <input type="text" name="query" id="searchQuery" placeholder="Search jobs, people, or content...">
            <button type="submit">
                <img src="../icons/magnify.png" alt="Search">
            </button>
        </form>
        <div class="icons">
            <img src="../icons/bell-outline.png" alt="Notifications">
            <img src="../icons/email-outline.png" alt="Messages">
            <div class="profile">
                <img src="<?= htmlspecialchars($randomProfileImage) ?>" alt="Profile"> <!-- Use the same random profile image -->
            </div>
        </div>
    </div>
    <div class="main">
        <div class="left-panel">
            <div class="profile-info panel">
                <img src="<?= htmlspecialchars($randomProfileImage) ?>" alt="Profile">
                <h3>Admin</h3> <!-- Changed user name to Admin -->
                <p>Administrator</p> <!-- Changed position to Administrator -->
                <p>Profile views: 243</p>
                <p>Connections: 1,834</p>
            </div>
            <div class="menu panel">
                <a href="#"><img src="../icons/bag-checked.png" alt="My Jobs"> My Jobs</a>
                <a href="connection.php?profile_image=<?= urlencode($randomProfileImage) ?>"><img src="../icons/business-network.png" alt="Connections"> Connections</a>
                <a href="#"><img src="../icons/account-group.png" alt="Groups"> Groups</a>
                <a href="#"><img src="../icons/calendar.png" alt="Events"> Events</a>
                <button class="logout" onclick="location.href='../logout.php'">Logout</button>
            </div>
        </div>
        <div class="center-panel">
            <div class="post panel">
                <div class="post-header">
                    <img src="<?= htmlspecialchars($randomProfileImage) ?>" alt="Profile">
                    <textarea id="postContent" placeholder="Share your thoughts..."></textarea>
                </div>
                <div class="post-actions">
                    <div class="actions-left">
                        <button><img src="../icons/picture-24.png" alt="Photo"> Photo</button>
                        <button><img src="../icons/camera-24.png" alt="Video"> Video</button>
                        <button><img src="../icons/calendar.png" alt="Event"> Event</button>
                    </div>
                    <button class="post-button" id="postButton">Post</button>
                </div>
            </div>
            <div class="feed panel" id="feedPanel">
                <!-- Feed items will be dynamically loaded here -->
            </div>
        </div>
        <div class="right-panel">
            <div class="panel">
                <h4>Recommended Jobs</h4>
                <a href="#">Senior UX Designer</a>
                <a href="#">Product Manager</a>
            </div>
            <div class="panel">
                <h4>Upcoming Events</h4>
                <a href="#">Tech Conference 2025</a>
                <a href="#">UX Design Workshop</a>
            </div>
            <div class="panel">
                <h4>People You May Know</h4>
                <a href="#">Emma Wilson</a>
                <a href="#">David Kim</a>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent page refresh
            const query = document.getElementById('searchQuery').value;

            // Perform AJAX request to fetch filtered feed
            fetch('search-feed.php?query=' + encodeURIComponent(query))
                .then(response => response.text())
                .then(data => {
                    document.getElementById('feedPanel').innerHTML = data; // Update feed panel
                })
                .catch(error => console.error('Error fetching feed:', error));
        });

        // Load initial feed
        fetch('search-feed.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('feedPanel').innerHTML = data;
            })
            .catch(error => console.error('Error loading feed:', error));

        // Add functionality for posting
        document.getElementById('postButton').addEventListener('click', function() {
            const postContent = document.getElementById('postContent').value.trim();
            if (postContent) {
                const feedPanel = document.getElementById('feedPanel');
                const newPost = document.createElement('div');
                newPost.classList.add('feed-item');
                newPost.innerHTML = `
                    <h4>John Anderson</h4>
                    <p>${postContent}</p>
                `;
                feedPanel.prepend(newPost); // Add the new post to the top of the feed
                document.getElementById('postContent').value = ''; // Clear the textarea
            } else {
                alert('Please enter some content before posting.');
            }
        });
    </script>
</body>
</html>
