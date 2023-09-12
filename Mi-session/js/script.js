let select = document.getElementById("select");
let choix = select.value;

let btn = document.getElementById("btnSubmit");
btn.addEventListener("click", function(){
    window.location.assign("feedback.php?id=" + choix);
})