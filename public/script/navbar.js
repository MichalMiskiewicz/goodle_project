function showhideNav(){
    if (document.querySelector("#navigation").style.left === '0px') {
        document.querySelector("nav").style.left = "-100vw";
        let newWidth = document.querySelector("#navigation").style.width * (100 / document.documentElement.clientWidth);
        setTimeout(() => {  document.querySelector("header>img").style.opacity = "1";}, 500);
        setTimeout(() => {  document.querySelector("main").style.transition = "none"; }, 1000);
        document.querySelector("#bt_nav").innerHTML = ">";

    }else{
        document.querySelector("header>img").style.opacity = "0";
        document.querySelector("#navigation").style.width = "15vw";
        document.querySelector("#navigation").style.left = "0";
        document.querySelector("#bt_nav").innerHTML = "X";
        let newWidth = document.querySelector("#navigation").style.width * (100 / document.documentElement.clientWidth);
        setTimeout(() => {  document.querySelector("main").style.transition = "none"; }, 500);
    }
}