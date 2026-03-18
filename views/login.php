<?php 

echo "<div class='container my-5'>
    <div class='row justify-content-center'>
        <div class='border p-4 shadow-sm bg-white rounded'>
            <h2 class='text-center mb-4'>Prijava</h2>
            
            <form action='logic/obrada_login.php' method='POST'>
                <div class='mb-3'>
                    <label for='email' class='form-label'>Email adresa</label>
                    <input type='email' name='tbEmail' id='email' class='form-control' placeholder='primer@mail.com' required/>
                </div>
                
                <div class='mb-3'>
                    <label for='pass' class='form-label'>Lozinka</label>
                    <input type='password' name='tbPass' id='pass' class='form-control' placeholder='******' required/>
                </div>
                
                <button type='submit' name='btnLogin' class='btn btn-primary w-100'>Uloguj se</button>
                
                <div class='mt-3 text-center'>
                    <p>Nemate nalog? <a href='index.php?stranica=register.php' class='text-decoration-none'>Registrujte se</a></p>
                </div>
            </form>
        </div>
    </div>
</div>  "
        ?>