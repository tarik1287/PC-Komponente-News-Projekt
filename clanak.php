<?php
include 'connect.php';
include 'helpers.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$dbc) {
    page_header('Clanak');
    db_message(isset($db_error) ? $db_error : '');
    page_footer();
    exit;
}

$query = "SELECT * FROM vijesti WHERE id = ?";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);
mysqli_stmt_close($stmt);

page_header($row ? $row['naslov'] : 'Članak nije pronađen');
?>

    <main class="article-page">
        <article>
            <?php if ($row): ?>
                <p class="category"><?php echo e($row['kategorija']); ?></p>
                <h2><?php echo e($row['naslov']); ?></h2>
                <p class="meta">Autor: Tarik Taletović | Objavljeno: <?php echo e($row['datum']); ?></p>

                <?php if (!empty($row['slika'])): ?>
                    <img class="article-image" src="<?php echo e($row['slika']); ?>" alt="<?php echo e($row['naslov']); ?>">
                <?php else: ?>
                    <div class="image-placeholder">Slika nije odabrana</div>
                <?php endif; ?>

                <p class="lead"><?php echo nl2br(e($row['sazetak'])); ?></p>
                <p><?php echo nl2br(e($row['tekst'])); ?></p>
            <?php else: ?>
                <h2>Članak nije pronađen</h2>
                <p>Traženi članak ne postoji u bazi.</p>
            <?php endif; ?>
        </article>
    </main>

<?php
mysqli_close($dbc);
page_footer();
?>
