let getForm = document.getElementById("getForm");

getForm.addEventListener("submit", (event) =>
{

    event.preventDefault();
    toPhpWithGet(event);
});

let form = event.target;
const data = new FormData(form);
console.log(data.get("article"));
console.log(data.get("maxPrice"));