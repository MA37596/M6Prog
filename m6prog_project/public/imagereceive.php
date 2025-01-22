<?php

print_r($_FILES);

// Controleer of er geen fouten zijn bij het uploaden
if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
    die("Fout bij bestand uploaden: " . $_FILES["image"]["error"]);
}

// Controleer of het bestand daadwerkelijk werd geüpload
if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
    // Verplaats bestand naar gewenste locatie
    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/temp.png")) {
        echo "Bestand succesvol geüpload!";
    } else {
        echo "Fout bij het verplaatsen van het bestand.";
    }
} else {
    echo "Het bestand is niet correct geüpload.";
}

?>