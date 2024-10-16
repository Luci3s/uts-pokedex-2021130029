import './bootstrap';
// app.js

// Document Ready Function
document.addEventListener("DOMContentLoaded", function() {
    // Menangani dropdown Bootstrap
    var dropdowns = document.querySelectorAll('.dropdown-toggle');

    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.preventDefault();
            // Toggle class untuk dropdown
            this.classList.toggle('show');
            var dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });
    });

    // Menutup dropdown ketika klik di luar
    document.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            dropdowns.forEach(function(dropdown) {
                var dropdownMenu = dropdown.nextElementSibling;
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                    dropdown.classList.remove('show');
                }
            });
        }
    });
});
