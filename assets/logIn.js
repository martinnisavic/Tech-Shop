const loginForma = document.getElementById("loginForma");

let regExEmail = /^[\S]{3,20}@(gmail|yahoo|outlook|ict\.edu\.rs)\.(com|rs)$/;
let regExPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*()-\+]).{8,}$/;

if (loginForma) {
    

loginForma.addEventListener("submit", function (e) {

    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    let klijentskeGreske = false;

    if (!regExEmail.test(email)) {
        document.querySelector('#error-email-login').textContent = "Morate uneti email";
        klijentskeGreske = true;
    }

    if (!regExPassword.test(password)) {
        document.querySelector('#error-password-login').textContent = "Morate uneti lozinku, ona mora imati barem jedno veliko i malo slovo, broj i specijalni karakter";
        klijentskeGreske = true;
    }

    if (klijentskeGreske) {
        return;
    }

    let formData = new FormData(loginForma);

    fetch('funkcijePhp/LogInProvera.php', {
        method: 'POST',
        body: formData
    })
        .then(odgovor => {
            return odgovor.json();
        })
        .then(data => {
            if (data.status == "200") {
                window.location.href = "../Tech-Shop/index.php";
            }
            else {
                if (data.errors) {
                    if (data.errors.email) {
                        document.querySelector('#error-email-login').textContent = data.errors.email;
                        console.log('greska mail')
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