document.addEventListener('DOMContentLoaded', function () {
    // Проверка наличия flash-сообщений
    const successMessage = "<?php echo session('success') ?>";
    const errorMessage = "{{ session('error') }}";

    if (successMessage) {
        toastr.success(successMessage);
    }

    if (errorMessage) {
        toastr.error(errorMessage);
    }
});
