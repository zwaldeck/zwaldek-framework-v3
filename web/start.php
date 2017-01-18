<?php
define('ROOT_DIR', __DIR__);

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    include __DIR__ . '/app.php';
}