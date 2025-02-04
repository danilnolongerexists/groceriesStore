// Открываем модальное окно профиля
// openProductmodalProductBtn.addEventListener("click", () => {
//     productmodalProduct.style.display = "block";
// });
let modalProduct;
function setproducttemp(product_id) {
    modalProduct = document.getElementById("productModal-"+product_id);
    modalProduct.style.display = "block";
}

// Закрываем модальное окно профиля при клике на крестик
function closeProduct() {
    modalProduct.style.display = "none";
}

window.addEventListener("click", (event) => {
    if (event.target === modalProduct) {
        modalProduct.style.display = "none";
    }
});
