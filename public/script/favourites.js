const fav = document.querySelector("#fav");
const productContainer = document.querySelector(".products");

fav.addEventListener("click", function (){
        fetch("/favourites", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function (response) {
            console.log(response);
            return response.json();
        }).then(function (products){
            productContainer.innerHTML="";
            loadFavourites(products);
        })
});

function loadFavourites(products){
    products.forEach(product => {
        createFavourites(product);
    });
}

function createFavourites(product){
    const template = document.querySelector("#product-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `public/uploads/${product.image}`;
    console.log("img", product.image);

    const title = clone.querySelector("h2");
    title.innerHTML = product.title;

    const description = clone.querySelector("p");
    description.innerHTML = product.description;

    const like = clone.querySelector(".fa-heart");
    like.innerText = product.like;

    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = product.dislike;

    productContainer.appendChild(clone);

}