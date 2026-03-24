import { changePicture } from './functions.js';

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
})