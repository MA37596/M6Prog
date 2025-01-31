// Functie om een formulier om te zetten naar een FormData-object
function FormToDictionary(form) {
    return new FormData(form); // FormData bevat ook bestand-invoer
}

// Selecteer het bestand invoerveld en de anchor link
const imageInput = document.getElementById("image");
const link = document.getElementById("link");
const imageForm = document.getElementById("imageform");



function showlink(fileName) {
    link.style.display = "inline";

    link.textContent = `Download het bestand: ${fileName}`;

    link.setAttribute("href", `/uploads/${fileName}`);
}

imageForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Voorkom de standaardformulierverzending

    const formData = new FormData(imageForm); // Haal alle formdata op

    const options = {
        method: "POST",
        body: formData,
    };

    fetch("imagereceive.php", options)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Server fout: ${response.statusText}`);
            }
            return response.json();
        })
        .then((result) => {
            if (result.succeeded) {
                alert("Bestand succesvol geüpload!");
                showlink(result.fileName);
            } else {
                alert(`Fout: ${result.message}`);
            }
        })
        .catch((error) => {
            alert("Er is een fout opgetreden bij het uploaden.");
        });
});
