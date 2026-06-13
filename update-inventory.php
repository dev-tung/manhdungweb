<?php

$url = 'https://manhdungsports.io.vn/job/inventory-website';

$json = file_get_contents($url);

if ($json === false) {
    die('Cannot fetch inventory data');
}

$data = json_decode($json, true);

if (
    json_last_error() !== JSON_ERROR_NONE ||
    !isset($data['success'])
) {
    die('Invalid JSON response');
}

file_put_contents(
    __DIR__ . '/inventory-website.json',
    $json,
    LOCK_EX
);

echo 'Inventory updated: ' . date('Y-m-d H:i:s');