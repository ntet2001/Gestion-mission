$buttonhome = document.querySelector("#v-pills-home-tab");
$buttonprofil = document.querySelector("#v-pills-profile-tab");

$buttonprofil.addEventListener("click",()=>{
    buttonhome.classList.toggle("show active");
    $buttonprofil.classList.toggle("show active");
},false);