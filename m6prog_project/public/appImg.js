// Functie om een formulier om te zetten naar een FormData-object
function FormToDictionary(form) {
    return new FormData(form); // FormData bevat ook bestand-invoer
}

// Selecteer het formulier met ID "imageForm"
const imageForm = document.getElementById("imageForm");

// Functie om de afbeelding te posten
function postImage(event) {
    event.preventDefault(); // Voorkom standaardformulierverzending

    console.log("Afbeelding wordt verzonden!");

    // Haal de data van het formulier op als FormData
    const formData = FormToDictionary(event.target);

    // Opties voor de fetch-aanroep
    const options = {
        method: "POST",
        body: formData, // Verzend het FormData-object
    };

    // Verstuur de fetch-aanroep naar imagereceive.php
    fetch("imagereceive.php", options)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Server fout: ${response.statusText}`);
            }
            return response.json(); // Verwacht een JSON-response van de server
        })
        .then((result) => {
            if (result.succeeded) {
                console.log(`Bestand succesvol geüpload! Naam: ${result.fileName}`);
                alert(`Succes! Bestand geüpload: ${result.fileName}`);
            } else {
                console.error("Servermelding:", result.message);
                alert(`Fout: ${result.message}`);
            }
        })
        .catch((error) => {
            console.error("Fout bij het verzenden van de afbeelding:", error);
            alert("Er is een fout opgetreden bij het uploaden. Controleer de console voor details.");
        });
}

// Voeg een event listener toe aan het formulier
if (imageForm) {
    imageForm.addEventListener("submit", postImage);
}
