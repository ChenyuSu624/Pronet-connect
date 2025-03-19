<?php
require_once '../data/dummy-data.php'; // Include the dummy data file

$query = $_GET['query'] ?? '';

// Filter feed items based on the query
$filteredFeed = array_filter($feedItems, function($item) use ($query) {
    $name = $item['name'] ?? '';
    $title = $item['title'] ?? '';
    $content = $item['content'] ?? '';
    return stripos($name, $query) !== false || 
           stripos($title, $query) !== false || 
           stripos($content, $query) !== false;
});

// Get offset and limit from query parameters
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;

// Slice the feed items based on offset and limit
$paginatedFeed = array_slice($filteredFeed, $offset, $limit);

// Generate HTML for the feed
foreach ($paginatedFeed as $item) {
    $name = htmlspecialchars($item['name'] ?? 'Unknown');
    $title = htmlspecialchars($item['title'] ?? 'No Title');
    $content = htmlspecialchars($item['content'] ?? 'No Content');
    echo '<div class="feed-item">';
    echo '<h4>' . $name . ' - ' . $title . '</h4>';
    echo '<p>' . $content . '</p>';
    echo '</div>';
}
?>
