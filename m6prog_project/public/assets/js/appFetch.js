let getForm = document.getElementById("getForm");

getForm.addEventListener("submit", (event) => {
    event.preventDefault();
    toPhpWithGet(event);
    let url = "fetchGet.php?article="+data.get("article")+"&maxprice="+data.get("maxprice"); 
    fetch(url)
    .then((response))=>{
        console.log(reponse);
    }

});

function toPhpWithGet(event) {
    const form = event.target; 
    const data = new FormData(form); 
    console.log(data.get("article"));
    console.log(data.get("maxPrice"));
    
}