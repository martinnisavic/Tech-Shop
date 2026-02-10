<?php 

echo "<div>
        <h3>Register</h3>
        <div class='d-flex justify-content-evenly flex-wrap'>
        <div id='fiz-lice-btn-div'>
            <button>Fizicko lice</button>
        </div>
        <div id='pravno-lice-btn-div'>
            <button>Pravno lice</button>
        </div>
        </div>
        ";
        
echo "
    <div class='w-80 m-auto'>
    <form id='fizicko-lice' class='w-30 show flex-wrap flex-column justify-content-center' action='provera.php' method='post'>
        <label for='ime'>Ime</label>
        <input type='text' name='ime' id='ime' class=''/>
        <label for='prezime'>Prezime</label>
        <input type='text' name='prezime' id='prezime' class=''/>
        <label for='username'>Username</label>
        <input type='text' name='username' id='username' class=''/>
        <label for='broj-telefona'>Broj telefona</label>
        <input type='text' name='broj-telefona' id='broj-telefona' class=''/>
        <label for='email'>Email</label>
        <input type='email' name='email' id='email' class=''/>
        <label for='password'>Password</label>
        <input type='password' name='password' id='password' class=''/>
        <label for='conf-password'>Confirm password</label>
        <input type='password' name='conf-password' id='conf-password' class=''/><br/>
        <input type='submit' name='fiz-lice-submit' id=''/>

    </form>
";


echo "<form id='pravno-lice' class='hide flex-wrap flex-column' action='provera.php' method='post'>

        <input type='text' name='ime' id='ime' class=''/><br/>
        <input type='text' name='prezime' id='prezime' class=''/><br/>
        <input type='text' name='username' id='username' class=''/><br/>
        <input type='text' name='broj-telefona' id='broj-telefona' class=''/><br/>
        <input type='email' name='email' id='email' class=''/><br/>
        <input type='password' name='password' id='password' class=''/><br/>
        <input type='password' name='conf-password' id='conf-password' class=''/><br/>
        <input type='submit' name='pravno-lice-submit' id=''/>

    </form>
    </div>
    </div>";


?>