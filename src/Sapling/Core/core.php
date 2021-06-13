<?php

$files['cores'] = [
    // Starts sapling engine
    CORE_PATH . "loader.php",
];

foreach ($files as $category) {
    foreach ($category as $file) {
        require_once $file;
    }
}
