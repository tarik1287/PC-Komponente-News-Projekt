<?php
include 'connect.php';
include 'helpers.php';

page_header('PC Komponente News');

if (!$dbc) {
    db_message(isset($db_error) ? $db_error : '');
    page_footer();
    exit;
}
?>

    <main class="page">
        <?php foreach (categories() as $category): ?>
            <section id="<?php echo e(strtolower(str_replace(' ', '-', $category))); ?>" class="news-section">
                <h2><?php echo e($category); ?></h2>

                <div class="news-grid">
                    <?php
                    $query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = ? ORDER BY id DESC LIMIT 3";
                    $stmt = mysqli_prepare($dbc, $query);
                    mysqli_stmt_bind_param($stmt, 's', $category);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) === 0) {
                        echo '<p>Nema vijesti u ovoj kategoriji.</p>';
                    }

                    while ($row = mysqli_fetch_array($result)) {
                        news_card($row);
                    }

                    mysqli_stmt_close($stmt);
                    ?>
                </div>
            </section>
        <?php endforeach; ?>
    </main>

<?php
mysqli_close($dbc);
page_footer();
?>
