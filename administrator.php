<?php
include 'connect.php';
include 'helpers.php';

start_session();

$message = '';

if ($dbc && is_admin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if (isset($_POST['delete'])) {
        $query = "DELETE FROM vijesti WHERE id = ?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $message = 'Vijest je izbrisana.';
    }

    if (isset($_POST['update'])) {
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $about = isset($_POST['about']) ? $_POST['about'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $category = isset($_POST['category']) ? $_POST['category'] : 'Procesori';
        $archive = isset($_POST['archive']) ? 1 : 0;
        $currentImage = isset($_POST['current_image']) ? $_POST['current_image'] : '';
        $imagePath = $currentImage;

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

        $query = "UPDATE vijesti SET naslov = ?, sazetak = ?, tekst = ?, slika = ?, kategorija = ?, arhiva = ? WHERE id = ?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, 'sssssii', $title, $about, $content, $imagePath, $category, $archive, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $message = 'Vijest je izmijenjena.';
    }
}

page_header('Administracija');

if (!$dbc) {
    db_message(isset($db_error) ? $db_error : '');
    page_footer();
    exit;
}
?>

    <main class="admin-page">
        <section class="admin-box">
            <h2>Administracija vijesti</h2>
            <?php if (!is_logged_in()): ?>
                <p class="admin-intro">Za pristup administraciji prvo se moraš prijaviti.</p>
                <p><a href="login.php">Idi na prijavu</a> ili <a href="registracija.php">registriraj novi račun</a>.</p>
            <?php elseif (!is_admin()): ?>
                <p class="form-message">Bok <?php echo e($_SESSION['ime']); ?>! Uspješno si prijavljen, ali nemaš administratorska prava za pristup ovoj stranici.</p>
            <?php else: ?>
            <p class="admin-intro">Ovdje možeš mijenjati, arhivirati ili obrisati vijesti iz baze.</p>

            <?php if ($message !== ''): ?>
                <p class="form-message"><?php echo e($message); ?></p>
            <?php endif; ?>

            <?php
            $query = "SELECT * FROM vijesti ORDER BY id DESC";
            $result = mysqli_query($dbc, $query);

            if (mysqli_num_rows($result) === 0) {
                echo '<p>Nema vijesti u bazi.</p>';
            }

            while ($row = mysqli_fetch_array($result)):
            ?>
                <form class="admin-edit-form" enctype="multipart/form-data" action="administrator.php" method="POST">
                    <h3><?php echo e($row['naslov']); ?></h3>

                    <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                    <input type="hidden" name="current_image" value="<?php echo e($row['slika']); ?>">

                    <div class="form-item">
                        <label>Naslov vijesti</label>
                        <input type="text" name="title" value="<?php echo e($row['naslov']); ?>">
                    </div>

                    <div class="form-item">
                        <label>Kratki sažetak</label>
                        <textarea name="about" rows="4"><?php echo e($row['sazetak']); ?></textarea>
                    </div>

                    <div class="form-item">
                        <label>Tekst vijesti</label>
                        <textarea name="content" rows="7"><?php echo e($row['tekst']); ?></textarea>
                    </div>

                    <div class="form-item">
                        <label>Kategorija</label>
                        <select name="category">
                            <?php foreach (categories() as $category): ?>
                                <option value="<?php echo e($category); ?>" <?php if ($row['kategorija'] === $category) echo 'selected'; ?>>
                                    <?php echo e($category); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-item">
                        <label>Slika</label>
                        <?php if (!empty($row['slika'])): ?>
                            <img class="admin-thumb" src="<?php echo e($row['slika']); ?>" alt="<?php echo e($row['naslov']); ?>">
                        <?php endif; ?>
                        <input type="file" name="pphoto" accept="image/jpeg,image/png,image/gif,image/webp">
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="archive" value="1" <?php if ((int)$row['arhiva'] === 1) echo 'checked'; ?>>
                        <label>Arhiviraj vijest</label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="update">Izmijeni</button>
                        <button type="submit" name="delete" onclick="return confirm('Obrisati ovu vijest?');">Izbriši</button>
                    </div>
                </form>
            <?php endwhile; ?>
            <?php endif; ?>
        </section>
    </main>

<?php
mysqli_close($dbc);
page_footer();
?>
