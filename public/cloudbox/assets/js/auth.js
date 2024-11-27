$(document).ready(function () {
    // Menangani toggle untuk password
    $('#togglePassword').click(function (event) {
        event.preventDefault();
        const passwordInput = $('#password');
        const toggleIcon = $(this).find('i');

        // Ubah tipe input dan ikon
        if (passwordInput.attr('type') === 'text') {
            passwordInput.attr('type', 'password');
            toggleIcon.removeClass('fa-lock-open').addClass('fa-lock'); // Set ikon kunci terkunci
        } else {
            passwordInput.attr('type', 'text');
            toggleIcon.removeClass('fa-lock').addClass('fa-lock-open'); // Set ikon kunci terbuka
        }
    });

    // Menangani toggle untuk password confirmation
    $('#togglePasswordConfirm').click(function (event) {
        event.preventDefault();
        const passwordInput = $('#passwordConfirm');
        const toggleIcon = $(this).find('i');

        // Ubah tipe input dan ikon
        if (passwordInput.attr('type') === 'text') {
            passwordInput.attr('type', 'password');
            toggleIcon.removeClass('fa-lock-open').addClass('fa-lock'); // Set ikon kunci terkunci
        } else {
            passwordInput.attr('type', 'text');
            toggleIcon.removeClass('fa-lock').addClass('fa-lock-open'); // Set ikon kunci terbuka
        }
    });
});
