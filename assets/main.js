import { changePicture, PrikaziSakrij, updateUserProfile } from './functions.js';

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


document.addEventListener("click", function(e) {
    if (e.target && e.target.id === "btnUpdateProfile") {
        
        // Prikupljanje podataka iz input polja
        const podaci = {
            ime: document.querySelector("#tbIme").value,
            prezime: document.querySelector("#tbPrezime").value,
            telefon: document.querySelector("#tbTelefon").value,
            firma: document.querySelector("#tbFirma").value
        };

        // Pozivanje eksportovane funkcije
        updateUserProfile(podaci).then(data => {
            const resDiv = document.querySelector("#editResponse");
            
            if (data.status == 200) {
                resDiv.innerHTML = `<p class='alert alert-success'>${data.message}</p>`;
                // Preusmeravanje na profil nakon 2 sekunde
                setTimeout(() => {
                    window.location.href = "index.php?stranica=profile.php";
                }, 2000);
            } else {
                resDiv.innerHTML = `<p class='alert alert-danger'>${data.message}</p>`;
            }
        });
    }
});