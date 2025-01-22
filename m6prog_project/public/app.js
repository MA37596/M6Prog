let searchFormulier = document.getElementById("searchForm");

function searchPersoon(event) {
    event.preventDefault(); 
    console.log("Formulier is niet verzonden, maar de zoekfunctie is aangeroepen!");

    let form = event.target;
    const data = new FormData(form); 

    //let url = "search.php?search=" + encodeURIComponent(data.get("search"));
    let url = "search.php?search"+data.get("search");

    console.log(url);
}

searchFormulier.addEventListener("submit", searchPersoon);

// deze opdracht lukte niet