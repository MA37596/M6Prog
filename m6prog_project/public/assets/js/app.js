function searchPersoon(event)
searchFormulier.addEventListener("submit", (event) => { searchPersoon(event)
    event.preventDefault();
    let form = event.target;
    const data = new FormData(form);
    let url = "search.php?search="+data.get("search");
});

console.log(url)