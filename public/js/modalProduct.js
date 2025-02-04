const productModal = document.getElementById("productModal");
const openProductModalBtn = document.getElementById("openProductModalBtn");
const closeProductModalBtn = document.getElementById("closeProduct");

// Открываем модальное окно профиля
openProductModalBtn.addEventListener("click", () => {
    productModal.style.display = "block";
});

// Закрываем модальное окно профиля при клике на крестик
closeProductModalBtn.addEventListener("click", () => {
    productModal.style.display = "none";
});

// Закрытие модального окна профиля при клике вне его области
window.addEventListener("click", (event) => {
    if (event.target === productModal) {
        productModal.style.display = "none";
    }
});
