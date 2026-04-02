<?php 
echo "
<div class='w-80 m-auto'>
    <h3>Register</h3>
    <form action='funkcijePhp/registerObrada.php' method='POST'>
        <input type='text' name='ime' placeholder='Vaše ime' required>
        <input type='text' name='prezime' placeholder='Vaše prezime' required>
        <input type='text' name='username' placeholder='Korisničko ime' required>
        <input type='email' name='email' placeholder='Email' required>
        <input type='password' name='password' placeholder='Lozinka' required>
        <input type='password' name='password_confirm' placeholder='Potvrdite lozinku' required>
        <input type='text' name='telefon' placeholder='Telefon (06x...)' required>
        
        <input type='text' name='ime_firme' placeholder='Ime firme (opciono)'>

        <select name='grad'>
            <option value='1'>Beograd</option>
            <option value='2'>Novi Sad</option>
        </select>
        
        <div class='pol-izbor'>
            <label><input type='radio' name='pol' value='M'> Muški</label>
            <label><input type='radio' name='pol' value='Z'> Ženski</label>
        </div>

        <button type='submit'>Registruj se</button>
    </form>
</div>";
?>