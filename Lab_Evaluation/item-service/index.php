<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Contact User Service using Docker service name
    $userResponse = file_get_contents("http://user-service/");

    // Contact Handover Service using Docker service name
    $handoverResponse = file_get_contents("http://handover-service/");

    echo json_encode([
        "service" => "Item Service",
        "status" => "running",
        "message" => "Item service successfully communicated with other services",
        "user_service" => json_decode($userResponse, true),
        "handover_service" => json_decode($handoverResponse, true)
    ]);

} else {

    http_response_code(405);

    echo json_encode([
        "error" => "Method not allowed"
    ]);
}

?>