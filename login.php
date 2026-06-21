<?php
include 'connect.php';
include 'helpers.php';

start_session();

$message = '';

if ($dbc && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $query = "SELECT * FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_array($result);
    mysqli_stmt_close($stmt);

    if ($user && password_verify($password, $user['lozinka'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['korisnicko_ime'];
        $_SESSION['ime'] = $user['ime'];
        $_SESSION['prezime'] = $user['prezime'];
        $_SESSION['razina'] = (int)$user['razina'];

        header('Location: administrator.php');
        exit;
    } else {
        $message = 'Krivo korisničko ime ili lozinka. Ako nemaš račun, prvo se registriraj.';
    }
}

page_header('Prijava');

if (!$dbc) {
    db_message(isset($db_error) ? $db_error : '');
    page_footer();
    exit;
}
?>

    <main class="form-page">
        <section class="form-box">
            <h2>Prijava</h2>

            <?php if ($message !== ''): ?>
                <p class="form-message"><?php echo e($message); ?></p>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="form-item">
                    <label for="username">Korisničko ime</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>

                <div class="form-item">
                    <label for="password">Lozinka</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-actions">
                    <button type="submit">Prijavi se</button>
                </div>
            </form>

            <p class="auth-link">Nemaš račun? <a href="registracija.php">Registriraj se</a></p>
        </section>
    </main>

<?php
mysqli_close($dbc);
page_footer();
?>
