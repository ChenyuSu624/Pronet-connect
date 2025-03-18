<?php
$query = $_GET['query'] ?? '';

// Dummy feed data
$feedItems = [
    ['title' => 'Sarah Chen', 'content' => 'Excited to share that we\'re hiring for multiple UX Research positions!'],
    ['title' => 'Michael Roberts', 'content' => 'Just published a new article on building scalable microservices architecture.'],
    ['title' => 'Emma Wilson', 'content' => 'Looking for a talented graphic designer to join our team.'],
];

// Filter feed items based on the query
$filteredFeed = array_filter($feedItems, function($item) use ($query) {
    return stripos($item['title'], $query) !== false || stripos($item['content'], $query) !== false;
});

// Generate HTML for the feed
foreach ($filteredFeed as $item) {
    echo '<div class="feed-item">';
    echo '<h4>' . htmlspecialchars($item['title']) . '</h4>';
    echo '<p>' . htmlspecialchars($item['content']) . '</p>';
    echo '</div>';
}
