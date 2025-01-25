<?php
require_once '../source/config.php'; 
require_once SOURCE_ROOT . 'database.php'; 

$response = [
    "succeeded" => false,
    "message" => "",
    "fileName" => ""
];

if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
    $response["message"] = "Fout bij bestand uploaden: " . $_FILES["image"]["error"];
    echo json_encode($response);
    exit;
}

if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
    $fileInfo = pathinfo($_FILES["image"]["name"]);
    $ext = strtolower($fileInfo["extension"]);

    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($ext, $allowedExtensions)) {
        $response["message"] = "Ongeldig bestandstype. Alleen jpg, jpeg, png, en gif zijn toegestaan.";
        echo json_encode($response);
        exit;
    }

    $uniqueId = uniqid("image_", true);
    $newFileName = $uniqueId . "." . $ext;
    $uploadPath = "../uploads/" . $newFileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
        $response["succeeded"] = true;
        $response["message"] = "Bestand succesvol geüpload!";
        $response["fileName"] = $newFileName;

        $type = mime_content_type($uploadPath); 
        $size = filesize($uploadPath); 

        if (insertImageInDb($type, $size, $newFileName)) {
            $response["message"] .= " En opgeslagen in de database!";
        } else {
            $response["message"] .= " Maar er ging iets mis bij het opslaan in de database.";
        }
    } else {
        $response["message"] = "Fout bij het verplaatsen van het bestand.";
    }
} else {
    $response["message"] = "Het bestand is niet correct geüpload.";
}

echo json_encode($response);

function insertImageInDb($type, $size, $filename) {
    $link = database_connect();

    $sql = "INSERT INTO images (type, size, filename) VALUES (?, ?, ?)";

    $stmt = $link->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("sis", $type, $size, $filename);

    $success = $stmt->execute();

    $stmt->close();
    $link->close();

    return $success;
}
