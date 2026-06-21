<?php
include 'connect.php';
include 'helpers.php';

$message = '';

if ($dbc && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $about = isset($_POST['about']) ? $_POST['about'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : 'Procesori';
    $date = date('d.m.Y.');
    $archive = isset($_POST['archive']) ? 1 : 0;
    $imagePath = '';

    if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'Media/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['pphoto']['name']);
        $fileName = preg_replace('/[^A-Za-z0-9._-]/', '_', $fileName);
        $imagePath = $uploadDir . time() . '-' . $fileName;
        move_uploaded_file($_FILES['pphoto']['tmp_name'], $imagePath);
    }

    $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $date, $title, $about, $content, $imagePath, $category, $archive);

    if (mysqli_stmt_execute($stmt)) {
        $message = 'Vijest je spremljena u bazu.';
    } else {
        $message = 'Greška kod spremanja vijesti.';
    }

    mysqli_stmt_close($stmt);
}

page_header('Unos vijesti');

if (!$dbc) {
    db_message(isset($db_error) ? $db_error : '');
    page_footer();
    exit;
}
?>

    <main class="form-page">
        <section class="form-box">
            <h2>Unos nove vijesti</h2>

            <?php if ($message !== ''): ?>
                <p class="form-message"><?php echo e($message); ?></p>
            <?php endif; ?>

            <form name="unos_vijesti" action="unos.php" method="POST" enctype="multipart/form-data">
                <div class="form-item">
                    <label for="title">Naslov vijesti</label>
                    <input type="text" id="title" name="title" required autofocus>
                </div>

                <div class="form-item">
                    <label for="about">Kratki sažetak vijesti</label>
                    <textarea id="about" name="about" rows="5" required></textarea>
                </div>

                <div class="form-item">
                    <label for="content">Tekst vijesti</label>
                    <textarea id="content" name="content" rows="10" required></textarea>
                </div>

                <div class="form-item">
                    <label for="category">Kategorija vijesti</label>
                    <select id="category" name="category" required>
                        <?php foreach (categories() as $category): ?>
                            <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-item">
                    <label for="pphoto">Slika vijesti</label>
                    <input type="file" id="pphoto" name="pphoto" accept="image/jpeg,image/png,image/gif,image/webp">
                </div>

                <div class="form-check">
                    <input type="checkbox" id="archive" name="archive" value="1">
                    <label for="archive">Spremi u arhivu (ne prikazuj na naslovnici)</label>
                </div>

                <div class="form-actions">
                    <button type="reset">Poništi</button>
                    <button type="submit">Spremi vijest</button>
                </div>
            </form>
        </section>
    </main>

<?php
mysqli_close($dbc);
page_footer();
?>
