<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function start_session() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function is_logged_in() {
    start_session();
    return isset($_SESSION['user_id']);
}

function is_admin() {
    start_session();
    return isset($_SESSION['razina']) && (int)$_SESSION['razina'] === 1;
}

function categories() {
    return array(
        'Procesori',
        'Grafičke kartice',
        'Matične ploče',
        'Napajanja',
        'Pohrana podataka'
    );
}

function page_header($title) {
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="top-nav">
            <a href="index.php">Home</a>
            <a href="kategorija.php?kategorija=Procesori">Procesori</a>
            <a href="kategorija.php?kategorija=Grafičke kartice">Grafičke kartice</a>
            <a href="kategorija.php?kategorija=Matične ploče">Matične ploče</a>
            <a href="kategorija.php?kategorija=Napajanja">Napajanja</a>
            <a href="kategorija.php?kategorija=Pohrana podataka">Pohrana podataka</a>
            <a href="unos.php">Unos vijesti</a>
            <a href="administrator.php">Administracija</a>
            <?php if (is_logged_in()): ?>
                <a href="logout.php">Odjava</a>
            <?php else: ?>
                <a href="login.php">Prijava</a>
            <?php endif; ?>
        </nav>

        <h1>PC Komponente News</h1>
    </header>
<?php
}

function page_footer() {
?>
    <footer>
        <h2>PC Komponente News</h2>
        <p>Autor: Tarik Taletović | E-mail: ttaletovi@tvz.hr | JMBAG: 0246122685 | 2026.</p>
    </footer>
</body>
</html>
<?php
}

function db_message($db_error) {
?>
    <main class="form-page">
        <section class="form-box">
            <h2>Baza nije spojena</h2>
            <p>Provjeri da je MySQL pokrenut u XAMPP-u i da je u phpMyAdminu kreirana baza <strong>projekt0246122685</strong>.</p>
            <?php if (!empty($db_error)): ?>
                <p class="meta"><?php echo e($db_error); ?></p>
            <?php endif; ?>
        </section>
    </main>
<?php
}

function news_card($row) {
?>
    <article class="news-card">
        <?php if (!empty($row['slika'])): ?>
            <img class="news-image" src="<?php echo e($row['slika']); ?>" alt="<?php echo e($row['naslov']); ?>">
        <?php else: ?>
            <div class="image-placeholder">Slika nije odabrana</div>
        <?php endif; ?>
        <p class="category"><?php echo e($row['kategorija']); ?></p>
        <h3><a href="clanak.php?id=<?php echo (int)$row['id']; ?>"><?php echo e($row['naslov']); ?></a></h3>
        <p><?php echo e($row['sazetak']); ?></p>
        <p class="meta"><?php echo e($row['datum']); ?></p>
    </article>
<?php
}
?>
