const search = document.querySelector('input[placeholder="search"]');
const productContainer = document.querySelector(".products");

search.addEventListener("keyup", function (event){
   if(event.key === "Enter"){
       event.preventDefault();

       const data = {search: this.value};

       fetch("/search", {
           method: "POST",
           headers: {
                'Content-Type': 'application/json'
           },
           body: JSON.stringify(data)
       }).then(function (response) {
           console.log(response);
           return response.json();
       }).then(function (products){
           productContainer.innerHTML="";
           loadProducts(products);
       })
   }
});

function loadProducts(products){
    products.forEach(product => {
        console.log(product.image);
        createProduct(product);
    });
}

function createProduct(product){
    const template = document.querySelector("#product-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `public/uploads/${product.image}`;
    console.log("img", product.image);

    const title = clone.querySelector("h2");
    title.innerHTML = product.title;

    const description = clone.querySelector("p");
    description.innerHTML = product.description;

   /* const like = clone.querySelector(".fa-heart");
    like.innerText = product.like;
    const dislike = clone.querySelector(".fa-minus-square");
    like.innerText = product.dislike;*/

    productContainer.appendChild(clone);

}