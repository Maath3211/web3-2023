let select = document.getElementById("select");

let btn = document.getElementById("btnFeedEl");
btn.addEventListener("click", function(){
    window.location.assign("FeedbackEleve.php?id=" + select.value);
})

let btn1 = document.getElementById("btnFeedEmp");
btn1.addEventListener("click", function(){
    window.location.assign("FeedbackEmp.php?id=" + select.value);
})