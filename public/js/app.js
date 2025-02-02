// Получаем элементы
const modal = document.getElementById("myModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.querySelector(".close");
const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");
const switchToRegister = document.getElementById("switchToRegister");
const switchToLogin = document.getElementById("switchToLogin");

// Открываем модальное окно
openModalBtn.addEventListener("click", () => {
    modal.style.display = "block";
    loginForm.style.display = "block"; // Показываем форму авторизации по умолчанию
    registerForm.style.display = "none"; // Скрываем форму регистрации
});

// Закрываем модальное окно
closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Закрываем модальное окно при клике вне его области
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

// Переключаемся на форму регистрации
switchToRegister.addEventListener("click", (e) => {
    e.preventDefault(); // Отменяем действие ссылки
    loginForm.style.display = "none";
    registerForm.style.display = "block";
});

// Переключаемся на форму авторизации
switchToLogin.addEventListener("click", (e) => {
    e.preventDefault(); // Отменяем действие ссылки
    registerForm.style.display = "none";
    loginForm.style.display = "block";
});
