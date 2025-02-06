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


// let modalProductProd;
// function setproducttempprod(product_id) {
//     modalProductProd = document.getElementById("productModal-"+product_id);
//     modalProductProd.style.display = "block";
// }

// // Закрываем модальное окно профиля при клике на крестик
// function closeProduct() {
//     modalProductProd.style.display = "none";
// }

// window.addEventListener("click", (event) => {
//     if (event.target === modalProductProd) {
//         modalProductProd.style.display = "none";
//     }
// });
// const productModal = document.getElementById("productModal");
// const openProductModalBtn = document.getElementById("openProductModalBtn");
// const closeProductModalBtn = document.getElementById("closeProduct");

// // Открываем модальное окно профиля
// openProductModalBtn.addEventListener("click", () => {
//     productModal.style.display = "block";
// });

// // Закрываем модальное окно профиля при клике на крестик
// closeProductModalBtn.addEventListener("click", () => {
//     productModal.style.display = "none";
// });

// // Закрытие модального окна профиля при клике вне его области
// window.addEventListener("click", (event) => {
//     if (event.target === productModal) {
//         productModal.style.display = "none";
//     }
// });
