
CREATE TABLE PhotoMetadata (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unieke primaire sleutel
    file_name VARCHAR(255) NOT NULL, -- Naam van het bestand, verplicht
    file_path VARCHAR(500) NOT NULL, -- Volledig pad naar het bestand, verplicht
    upload_date DATETIME DEFAULT CURRENT_TIMESTAMP, -- Datum en tijd van upload, standaard huidige tijd
    size_in_bytes BIGINT NOT NULL, -- Grootte van het bestand in bytes
    resolution_width INT NOT NULL, -- Breedte in pixels
    resolution_height INT NOT NULL, -- Hoogte in pixels
    format ENUM('JPEG', 'PNG', 'GIF', 'BMP', 'TIFF') NOT NULL, -- Bestandstype
    camera_make VARCHAR(100), -- Camera merk
    camera_model VARCHAR(100), -- Camera model
    iso INT, -- ISO-waarde
    aperture DECIMAL(4, 2), -- Diafragma-instelling
    shutter_speed DECIMAL(5, 2), -- Sluitertijd als decimaal
    focal_length DECIMAL(5, 2), -- Brandpuntsafstand in mm
    gps_latitude DECIMAL(10, 8), -- GPS-breedtegraad
    gps_longitude DECIMAL(11, 8), -- GPS-lengtegraad
    tags TEXT, -- Tags of trefwoorden
    description TEXT -- Beschrijving of notities
);
