<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';

$response = [
    "succeeded" => false,
    "message" => ""
];

if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
    $response["message"] = "Fout bij bestand uploaden: " . $_FILES["image"]["error"];
    echo json_encode($response);
    exit;
}

if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
    // Haal de bestandsnaam en extensie op
    $fileInfo = pathinfo($_FILES["image"]["name"]);
    $ext = strtolower($fileInfo["extension"]);
    
    // Controleer of het bestand een toegestane extensie heeft (optioneel)
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($ext, $allowedExtensions)) {
        $response["message"] = "Ongeldig bestandstype. Alleen jpg, jpeg, png, en gif zijn toegestaan.";
        echo json_encode($response);
        exit;
    }

    // Genereer een unieke naam voor het bestand
    $uniqueId = uniqid("image_", true);
    $newFileName = $uniqueId . "." . $ext;
    $uploadPath = "../uploads/" . $newFileName;

    // Verplaats het bestand naar de uploads-map
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
        $response["succeeded"] = true;
        $response["message"] = "Bestand succesvol geüpload!";
        $response["fileName"] = $newFileName;
    } else {
        $response["message"] = "Fout bij het verplaatsen van het bestand.";
    }
} else {
    $response["message"] = "Het bestand is niet correct geüpload.";
}

echo json_encode($response);


























