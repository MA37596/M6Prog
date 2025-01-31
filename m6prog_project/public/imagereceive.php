<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';

$response = [
    "succeeded" => false,
    "message" => "",
    "fileName" => "",
    "downloadLink" => ""
];

if (!isset($_FILES["image"])) {
    $response["message"] = "Geen bestand ontvangen.";
    echo json_encode($response);
    exit;
}

if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
    $response["message"] = "Fout bij uploaden: " . $_FILES["image"]["error"];
    echo json_encode($response);
    exit;
}

$tmpFile = $_FILES["image"]["tmp_name"];
$fileInfo = pathinfo($_FILES["image"]["name"]);
$ext = strtolower($fileInfo["extension"]);
$allowedExtensions = ["jpg", "jpeg", "png", "gif"];

$mime = mime_content_type($tmpFile);
$validMimes = ["image/jpeg", "image/png", "image/gif"];
if (!in_array($mime, $validMimes) || !in_array($ext, $allowedExtensions)) {
    $response["message"] = "Ongeldig bestandstype.";
    echo json_encode($response);
    exit;
}

$cleanFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileInfo["filename"]);
$uniqueId = uniqid("image_", true);
$newFileName = $cleanFileName . "_" . $uniqueId . "." . $ext;
$uploadDir = "../uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$uploadPath = $uploadDir . $newFileName;

if (move_uploaded_file($tmpFile, $uploadPath)) {
    $response["succeeded"] = true;
    $response["message"] = "Bestand succesvol geüpload!";
    $response["fileName"] = $newFileName;
    $response["downloadLink"] = "http://localhost:88/uploads/" . $newFileName;

    $size = filesize($uploadPath);

    if (insertImageInDb($mime, $size, $newFileName, $uploadPath)) {
        $response["message"] .= " En opgeslagen in de database!";
    } else {
        $response["message"] .= " Maar databaseopslag is mislukt.";
    }
} else {
    $response["message"] = "Fout bij het opslaan van het bestand.";
}

echo json_encode($response);

function insertImageInDb($type, $size, $filename, $path) {
    $link = database_connect();
    
    if (!$link) {
        return false;
    }

    $sql = "INSERT INTO images (type, size, filename, path) VALUES (?, ?, ?, ?)";
    $stmt = $link->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("siss", $type, $size, $filename, $path);
    $success = $stmt->execute();
    
    $stmt->close();
    $link->close();
    
    return $success;
}
