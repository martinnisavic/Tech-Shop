<?php 
echo "
<div class='w-80 m-auto'>
    <h3>Register</h3>
    <form id='regForma' method='POST'>
        
        <input type='text' id='ime' name='ime' placeholder='Vaše ime' required>
        <span id='error-ime-reg' class='text-danger'></span>

        <input type='text' id='prezime' name='prezime' placeholder='Vaše prezime' required>
        <span id='error-prezime-reg' class='text-danger'></span>

        <input type='text' id='username' name='username' placeholder='Korisničko ime' required>
        <span id='error-user-reg' class='text-danger'></span>

        <input type='email' id='email' name='email' placeholder='Email' required>
        <span id='error-email-reg' class='text-danger'></span>

        <input type='password' id='password' name='password' placeholder='Lozinka' required>
        <span id='error-pass-reg' class='text-danger'></span>

        <input type='password' id='password_confirm' name='password_confirm' placeholder='Potvrdite lozinku' required>
        <span id='error-passconf-reg' class='text-danger'></span>

        <input type='text' id='telefon' name='telefon' placeholder='Telefon (06x...)' required>
        <span id='error-tel-reg' class='text-danger'></span>
        
        <input type='text' id='ime_firme' name='ime_firme' placeholder='Ime firme (opciono)'>

        <select name='grad' id='grad'>
            <option value=''>Izaberite grad</option>
            <option value='1'>Beograd</option>
            <option value='2'>Novi Sad</option>
        </select>
        
        <div class='pol-izbor'>
            <label><input type='radio' name='pol' value='M' checked> Muški</label>
            <label><input type='radio' name='pol' value='Z'> Ženski</label>
        </div>

        <div id='error-general-reg' class='text-danger' style='margin-bottom: 10px;'></div>

        <button type='submit'>Registruj se</button>
    </form>
</div>";
?>