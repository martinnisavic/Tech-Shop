const regForma = document.getElementById("regForma");

// Tvoji regEx (dodajemo i telefon)
let regExUser = /^[\S]{8,25}$/;
let regExImePrezime = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}|-[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20})?$/;
let regExPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*()-\+]).{8,}$/;
let regExMail = /^[\S]{3,20}@(gmail|yahoo|outlook|ict\.edu\.rs)\.(com|rs)$/;
let regExTel = /^((\+381)6\d\s\d{2}\s\d{2}\s\d{3}|(06)\d\s\d{2}\s\d{2}\s\d{3}|(06)\d-\d{2}-\d{2}-\d{3})$/;

if (regForma) {
    regForma.addEventListener("submit", function (e) {
        e.preventDefault();

        // Hvatanje vrednosti
        const username = document.getElementById("username").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const passConfirm = document.getElementById("password_confirm").value;
        const telefon = document.getElementById("telefon").value;

        let klijentskeGreske = false;

        // Resetuj poruke o greškama pre provere
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = "");

        // Validacija redom
        if (!regExUser.test(username)) {
            document.querySelector('#error-user-reg').textContent = "Username mora imati 8-25 karaktera.";
            klijentskeGreske = true;
        }

        if (!regExUser.test(username)) {
            document.querySelector('#error-user-reg').textContent = "Username mora imati 8-25 karaktera.";
            klijentskeGreske = true;
        }

        if (!regExMail.test(email)) {
            document.querySelector('#error-email-reg').textContent = "Neispravan email format.";
            klijentskeGreske = true;
        }

        if (!regExPass.test(password)) {
            document.querySelector('#error-pass-reg').textContent = "Lozinka mora imati veliko, malo slovo, broj i simbol.";
            klijentskeGreske = true;
        }

        if (password !== passConfirm) {
            document.querySelector('#error-passconf-reg').textContent = "Lozinke se ne podudaraju.";
            klijentskeGreske = true;
        }

        if (!regExTel.test(telefon)) {
            document.querySelector('#error-tel-reg').textContent = "Format telefona nije ispravan.";
            klijentskeGreske = true;
        }

        if (klijentskeGreske) return;

        // Ako nema klijentskih grešaka, šaljemo na PHP 
        let formData = new FormData(regForma);

        fetch('funkcijePhp/registerObrada.php', {
            method: 'POST',
            body: formData
        })
            .then(odgovor => {
            return odgovor.json();
        })
        .then(data => {
            if (data.status == "200") {
                window.location.href = "../Tech-Shop/index.php";
            }else {
                if (data.errors) {
                    if (data.errors.password) {
                        document.querySelector('#error-password-login').textContent = data.errors.password;
                        console.log('greska pass]')
                    }
                    if (data.errors.password) {
                        document.querySelector('#error-password-login').textContent = data.errors.password;
                        console.log('greska pass]')
                    }
                    if (data.errors.email) {
                        document.querySelector('#error-email-login').textContent = data.errors.email;
                        console.log('greska mail')
                    }
                    if (data.errors.password) {
                        document.querySelector('#error-password-login').textContent = data.errors.password;
                        console.log('greska pass]')
                    }
                    if (data.errors.password) {
                        document.querySelector('#error-password-login').textContent = data.errors.password;
                        console.log('greska pass]')
                    }
                    if (data.errors.password) {
                        document.querySelector('#error-password-login').textContent = data.errors.password;
                        console.log('greska pass]')
                    }
                    if (data.errors.password) {
                        document.querySelector('#error-password-login').textContent = data.errors.password;
                        console.log('greska pass]')
                    }
                    if (data.errors.password) {
                        document.querySelector('#error-password-login').textContent = data.errors.password;
                        console.log('greska pass]')
                    }
                    if (data.errors.common) {
                        document.querySelector('#error-login').textContent = data.errors.common;
                        console.log('greska common')
                    }
                }
                else {
                    console.log('greska nije status 200')
                    document.querySelector('#error-login').textContent = data.message || "Došlo je do greške.";
                }
            }
        });
    });


}