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

let postForm = document.getElementById("postForm");

postForm.addEventListener("submit", (event) => 
{

    event.preventDefault();
    toPhpWithPost(event);
});

function FormToDictionary(form)
{
    const data = new FormData(form);
    let formKeyValue={};
    for (const [name,value] of data)
    {
        formKeyValue[name] = value;
    }
    return formKeyValue;
}
