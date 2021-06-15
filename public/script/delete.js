const deleteButtons = document.querySelectorAll('#delete');
function deleteProduct(){
    let productId = this.parentElement.getAttribute("id");
    const deleteBt = this;
    console.log(productId);
    fetch(`/deleteProduct/${productId}`)
        .then(function (response){
            deleteBt.parentElement.parentElement.removeChild(deleteBt.parentElement);
        })
}

deleteButtons.forEach(button => button.addEventListener("click", deleteProduct));