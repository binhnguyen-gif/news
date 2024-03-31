<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
        
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/grid.css">
    <link rel="stylesheet" href="assets/css/main.css">
    
    <style>

    </style>
</head>

<body>
    <header class="masthead">
        <div class="grid wide">
            <div class="header-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-pinterest"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
            </div>
            <div class="header-menu">
                <div class="logo">
                    <!-- <img src="assets/images/News-DogTime-header.png" alt=""> -->
                    <span class="dog-text">Dog</span><span class="pet-text">Pet</span>
                </div>

                <nav>
                    <ul class="row">
                        <li class="dropdown">
                            <a href="#" class="menu-item__link">Dog Breeds</a>
                            <span class="dropdown-icon__chevron"><i class="fa-solid fa-chevron-down"></i></span>
                            <div class="dropdown-content">
                                <a href="#">Dog Breed Groups</a>
                                <a href="#">Hybrid Breeds</a>
                                <a href="#">Dog Breeds for Zodiac Signs</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-item__link">Dog Name</a>
                            <span class="dropdown-icon__chevron"><i class="fa-solid fa-chevron-down"></i></span>
                            <!-- <div class="dropdown-content">
                                <a href="#">Name 1</a>
                                <a href="#">Name 2</a>
                            </div> -->
                        </li>
                        <li class="dropdown">
                            <a href="<?php echo getCleanURL($current_url) . '?action=posts'  ?>" class="menu-item__link">News</a>
                            <span class="dropdown-icon__chevron"><i class="fa-solid fa-chevron-down"></i></span>
                            <ul class="dropdown-content">
                                <a href="<?php echo getCleanURL($current_url) . '?action=posts&category=save_a_dog'  ?>">Save A Dog</a>
                                <a href="<?php echo getCleanURL($current_url) . '?action=posts&category=dogs_on_duty'  ?>">Dogs On Duty</a>
                                <a href="<?php echo getCleanURL($current_url) . '?action=posts&category=celeb_pets'  ?>">Celeb Pets</a>
                                <a href="<?php echo getCleanURL($current_url) . '?action=posts&category=dog_study'  ?>">Dog Study</a>
                            </ul>
                        </li>
                        <!-- <li class="dropdown">
                            <a href="#" class="menu-item__link">Health</a>
                            <span class="dropdown-icon__chevron"><i class="fa-solid fa-chevron-down"></i></span>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-item__link">Lifestyle</a>
                            <span class="dropdown-icon__chevron"><i class="fa-solid fa-chevron-down"></i></span>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-item__link">Shop</a>
                            <span class="dropdown-icon__chevron"><i class="fa-solid fa-chevron-down"></i></span> -->
                        </li>
                    </ul>

                </nav>

                <div class="header-search">
                    <a href="#" class="btn-search menu-item__link" id="header-search"><i
                            class="fa-solid fa-magnifying-glass"></i></a>
                    <div class="form-search" id="form-search">
                        <div class="input-search">
                            <span class="input-search__icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" placeholder="Type here to search...">
                        </div>
                        <a class="btn-hide__search">Search</a>
                        <div class="close-search" id="close-search">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownIcons = document.querySelectorAll('.dropdown-icon__chevron');

        dropdownIcons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                const dropdown = icon.parentElement.querySelector('.dropdown-content');
                // Toggle class 'active' để hiển thị/ẩn dropdown
                dropdown.classList.toggle('active');
            });
        });

        // Lắng nghe sự kiện click bên ngoài dropdown để ẩn nó khi click ra ngoài
        document.addEventListener('click', function(event) {
            dropdownIcons.forEach(function(icon) {
                const dropdown = icon.parentElement.querySelector('.dropdown-content');
                if (!dropdown.contains(event.target) && !icon.contains(event.target)) {
                    dropdown.classList.remove('active');
                }
            });
        });
    });

    const search = document.getElementById('header-search');
    const searchActive = document.getElementById('form-search');
    const closeSearch = document.getElementById('close-search');
    search.addEventListener('click', function(event) {
        searchActive.classList.toggle('search-active');
    });

    closeSearch.addEventListener('click', function(event) {
        searchActive.classList.remove('search-active');
    });
    </script>