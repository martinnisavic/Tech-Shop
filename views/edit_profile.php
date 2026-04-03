<?php
// Pretpostavljamo da je konekcija već uključena u index.php
$userId = $_SESSION['userID']; // tvoj ključ iz var_dump-a

$query = "SELECT * FROM user WHERE id = :id";
$user = IzvrsiSelectUpit($query, false, [':id' => $userId]);

if ($user) {
    echo "
    <div class='container mt-4'>
        <div class='row justify-content-center'>
            <div class='col-md-8'>
                <div class='card shadow-sm border-0'>
                    <div class='card-header bg-primary text-white p-3'>
                        <h5 class='mb-0'><i class='fas fa-user-edit me-2'></i> Izmena ličnih podataka</h5>
                    </div>
                    <div class='card-body p-4'>
                        <form>
                            <div class='row'>
                                <div class='col-md-6 mb-3'>
                                    <label class='form-label fw-bold'>Ime</label>
                                    <input type='text' id='tbIme' class='form-control' value='" . $user['ime'] . "'>
                                </div>
                                <div class='col-md-6 mb-3'>
                                    <label class='form-label fw-bold'>Prezime</label>
                                    <input type='text' id='tbPrezime' class='form-control' value='" . $user['prezime'] . "'>
                                </div>
                            </div>

                            <div class='mb-3'>
                                <label class='form-label fw-bold'>Telefon</label>
                                <input type='text' id='tbTelefon' class='form-control' value='" . $user['telefon'] . "'>
                                <small class='text-muted'>Format: 06x xxx xxx ili +3816x...</small>
                            </div>

                            <div class='mb-3'>
                                <label class='form-label fw-bold'>Ime firme (opciono)</label>
                                <input type='text' id='tbFirma' class='form-control' value='" . $user['ime firme'] . "'>
                            </div>

                            <hr class='my-4'>

                            <div id='editResponse' class='mb-3'></div>

                            <div class='d-flex gap-2'>
                                <button type='button' id='btnUpdateProfile' class='btn btn-success px-4'>
                                    <i class='fas fa-check me-1'></i> Sačuvaj izmene
                                </button>
                                <a href='index.php?stranica=profile.php' class='btn btn-outline-secondary px-4'>
                                    Odustani
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>";
} else {
    echo "<div class='alert alert-danger'>Korisnik nije pronađen.</div>";
}
?>