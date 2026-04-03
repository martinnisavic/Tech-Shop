<?php 

echo "<div class='container my-5'>
    <div class='row justify-content-center'>
        <div class='border p-4 shadow-sm bg-white rounded'>
            <h2 class='text-center mb-4'>Prijava</h2>
            
            <form id='loginForma' method='POST'>
                <div class='mb-3'>
                    <label for='email' class='form-label'>Email adresa</label>
                    <input type='email' name='email' id='email' class='form-control' placeholder='primer@mail.com' required/>
                    <span class='error-container' id='error-email-login'></span>'
                    </div>
                
                <div class='mb-3'>
                    <label for='pass' class='form-label'>Lozinka</label>
                    <input type='password' name='password' id='password' class='form-control' placeholder='******' required/>
                    <span class='error-container' id='error-password-login'></span>'
                    </div>
                
                <button type='submit' name='btnLogin' class='btn btn-primary w-100'>Uloguj se</button>
                
                <div class='mt-3 text-center'>
                    <p>Nemate nalog? <a href='index.php?stranica=register.php' class='text-decoration-none'>Registrujte se</a></p>
                </div>
            </form>
            <span class='error-container' id='error-login'></span>'
        </div>
    </div>
</div>  "
        ?>