// Получаем элементы (Модалка Профиля)
const profileModal = document.getElementById("profileModal");
const openProfileModalBtn = document.getElementById("openProfileModalBtn");
const closeProfileModalBtn = document.getElementById("closeProfile");
const modalProfileInfo = document.getElementById("modalProfileInfo")

// Открываем модальное окно профиля
openProfileModalBtn.addEventListener("click", () => {
    profileModal.style.display = "block";
    modalProfileInfo.style.textAlign = "left";
});



// Закрываем модальное окно профиля при клике на крестик
closeProfileModalBtn.addEventListener("click", () => {
    profileModal.style.display = "none";
});

// Закрытие модального окна профиля при клике вне его области
window.addEventListener("click", (event) => {
    if (event.target === profileModal) {
        profileModal.style.display = "none";
    }
});

const editProfileBtn = document.getElementById("editProfileBtn");
const cancelEditBtn = document.getElementById("cancelEditBtn");
const modalProfile = document.getElementById("modalProfile");
const editProfileForm = document.getElementById("editProfileForm");

editProfileBtn.addEventListener("click", () => {
    modalProfile.style.display = "none";
    editProfileForm.style.display = "block";
});

cancelEditBtn.addEventListener("click", () => {
    editProfileForm.style.display = "none";
    modalProfile.style.display = "block";
});

