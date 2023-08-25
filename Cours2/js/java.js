let cont1 = document.getElementById("container");
let div2 = document.getElementById("div2");
let ajouter = document.getElementById("create");

div2.hidden = true;
ajouter.addEventListener("click", event => {
    cont1.hidden = true;
    div2.hidden = false;
})