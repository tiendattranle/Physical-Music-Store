<?php
$stores = [
    [
        "name" => "143 record",
        "latitude" => 10.7721195,
        "longitude" => 106.6578917,
        "address" => "268 Ly Thuong Kiet, Ward 14, District 10, HCM City"
    ]
];

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($stores, JSON_PRETTY_PRINT);
?>