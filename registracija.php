<?php
include 'connect.php';
include 'helpers.php';

start_session();

$message = '';

if ($dbc && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $ime = isset($_POST['ime']) ? trim($_POST['ime']) : '';
    $prezime = isset($_POST['prezime']) ? trim($_POST['prezime']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $passwordRepeat = isset($_POST['password_repeat']) ? $_POST['password_repeat'] : '';

    if ($username === '' || $ime === '' || $prezime === '' || $password === '') {
        $message = 'Upiši ime, prezime, korisničko ime i lozinku.';
    } elseif ($password !== $passwordRepeat) {
        $message = 'Lozinke se ne podudaraju.';
    } else {
        $check = mysqli_prepare($dbc, "SELECT id FROM korisnik WHERE korisnicko_ime = ?");
        mysqli_stmt_bind_param($check, 's', $username);
        mysqli_stmt_execute($check);
        $result = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($result) > 0) {
            $message = 'Korisničko ime već postoji.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $razina = 0;
            $stmt = mysqli_prepare($dbc, "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $username, $hash, $razina);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $message = 'Registracija je uspješna. Sada se možeš prijaviti.';
        }

        mysqli_stmt_close($check);
    }
}

page_header('Registracija');

if (!$dbc) {
    db_message(isset($db_error) ? $db_error : '');
    page_footer();
    exit;
}
?>

    <main class="form-page">
        <section class="form-box">
            <h2>Registracija</h2>

            <?php if ($message !== ''): ?>
                <p class="form-message"><?php echo e($message); ?></p>
            <?php endif; ?>

            <form action="registracija.php" method="POST">
                <div class="form-item">
                    <label for="ime">Ime</label>
                    <input type="text" id="ime" name="ime" required autofocus>
                </div>

                <div class="form-item">
                    <label for="prezime">Prezime</label>
                    <input type="text" id="prezime" name="prezime" required>
                </div>

                <div class="form-item">
                    <label for="username">Korisničko ime</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-item">
                    <label for="password">Lozinka</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-item">
                    <label for="password_repeat">Ponovi lozinku</label>
                    <input type="password" id="password_repeat" name="password_repeat" required>
                </div>

                <div class="form-actions">
                    <button type="submit">Registriraj se</button>
                </div>
            </form>

            <p class="auth-link">Već imaš račun? <a href="login.php">Prijavi se</a></p>
        </section>
    </main>

<?php
mysqli_close($dbc);
page_footer();
?>
