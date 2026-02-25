<?php
// dashboard.php

// Display current date and time
$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', '2026-02-25 06:36:53');

// Display dashboard header
echo "<h1>Community Dashboard</h1>";

echo "<p>Current Date and Time (UTC): " . $dateTime->format('Y-m-d H:i:s') . "</p>";

echo "<p>Welcome, Raynerlimyk!</p>";
?>
