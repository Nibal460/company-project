<?php

// Define the target and link
$target = '/home/techturn/public_html/storage/app/public';
$link = '/home/techturn/public_html/public/storage';

if (symlink($target, $link)) {
    echo 'Symlink created successfully.';
} else {
    echo 'Failed to create symlink.';
}
?>
