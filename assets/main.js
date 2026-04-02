import { changePicture, PrikaziSakrij } from './functions.js';

document.addEventListener("DOMContentLoaded", function () {
    let images = document.getElementsByClassName('product-inf-images');
    let imagesNumber = images.length;
    let currentIndex = 0;
    let prev_button = document.querySelector('.prevBtn');
    let next_button = document.querySelector('.nextBtn');

    if (prev_button && next_button) {
        prev_button.addEventListener("click", function () {
            currentIndex = changePicture(currentIndex - 1, imagesNumber, currentIndex, images);
        });

        next_button.addEventListener("click", function () {
            currentIndex = changePicture(currentIndex + 1, imagesNumber, currentIndex, images);
        })
    }


    const btnProducts = document.querySelector('#products-profile-show');
    if (btnProducts) {
        btnProducts.addEventListener('click', function() {
            PrikaziSakrij('products');
        });
    }

    const btnUsers = document.querySelector('#users-profile-show');
    if (btnUsers) {
        btnUsers.addEventListener('click', function() {
            PrikaziSakrij('users');
        });
    }
})
