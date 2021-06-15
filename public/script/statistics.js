const likeButtons = document.querySelectorAll('.fa-heart');
const dislikeButtons = document.querySelectorAll('.fa-minus-square');

function giveLike(){
    const likes = this;
    const container = likes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/like/${id}`)
        .then(function (response){
            console.log(response);
            if(response === null) {
                return null;
            }else{
                return response.json();
            }
        })
        .then(function (like){
            console.log(like.like);
            console.log(like);
            if(like.like === 'null'){
                likes.innerHTML = parseInt(likes.innerHTML) - 1;
            }else {
                likes.innerHTML = parseInt(likes.innerHTML) + 1;
            }
        })
}

function giveDislike(){
    const dislikes = this;
    const container = dislikes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/dislike/${id}`)
        .then(function (response){
            console.log(response);
            if(response === null) {
                return null;
            }else{
                return response.json();
            }
        })
        .then(function (dislike){
            console.log(dislike.dislike);
            console.log(dislike);
            if(dislike.dislike === 'null'){
                dislikes.innerHTML = parseInt(dislikes.innerHTML) - 1;
            }else {
                dislikes.innerHTML = parseInt(dislikes.innerHTML) + 1;
            }
        })
}
console.log(document.cookie.split("=")[0]);
if(document.cookie.split("=")[0]) {
    likeButtons.forEach(button => button.addEventListener("click", giveLike));
    dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));
}