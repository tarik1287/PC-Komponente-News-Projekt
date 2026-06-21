<?php
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$title = isset($_POST['title']) ? $_POST['title'] : 'Nema naslova';
$about = isset($_POST['about']) ? $_POST['about'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : 'Nekategorizirano';
$prikaz = isset($_POST['prikaz']) ? 'Vijest se prikazuje na stranici' : 'Vijest nije oznacena za prikaz';
$imagePath = '';

if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'Media/uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['pphoto']['name']);
    $fileName = preg_replace('/[^A-Za-z0-9._-]/', '_', $fileName);
    $targetPath = $uploadDir . time() . '-' . $fileName;

    if (move_uploaded_file($_FILES['pphoto']['tmp_name'], $targetPath)) {
        $imagePath = $targetPath;
    }
}
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
        </nav>

        <h1>PC Komponente News</h1>
    </header>

    <main class="article-page">
        <article>
            <p class="category"><?php echo e($category); ?></p>
            <h2><?php echo e($title); ?></h2>
            <p class="meta">Autor: Tarik Taletović | Objavljeno: <?php echo date('d.m.Y.'); ?> | <?php echo e($prikaz); ?></p>

            <?php if ($imagePath !== ''): ?>
                <img class="article-image" src="<?php echo e($imagePath); ?>" alt="<?php echo e($title); ?>">
            <?php else: ?>
                <div class="image-placeholder">Slika nije odabrana</div>
            <?php endif; ?>

            <p class="lead"><?php echo nl2br(e($about)); ?></p>
            <p><?php echo nl2br(e($content)); ?></p>
        </article>
    </main>

    <footer>
        <h2>PC Komponente News</h2>
        <p>Autor: Tarik Taletović | E-mail: ttaletovi@tvz.hr | JMBAG: 0246122685 | 2026.</p>
    </footer>
</body>
</html>


