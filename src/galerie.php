<?php
require_once '../header.php';
require_once '../functions.php';
session_start();
?>

    <div class="container mt-5">
    <h1 class="text-center">Galerie</h1>

    <?php
    if (isset($_SESSION['upload_errors'])) {
        foreach ($_SESSION['upload_errors'] as $error) {
            echo "<p class='text-danger text-center'>$error</p>";
        }
    }
    ?>

    <div class="text-center">
        <?php if (isset($_SESSION['user'])): ?>

            <button type="button" class="btn btn-primary mb-5 mt-4" data-toggle="modal" data-target="#uploadModal">
                Ajouter une image
            </button>
        <?php endif; ?>
    </div>


    <div class="row">
        <?php
        $images = getImages();

        foreach ($images as $image) {
            echo '<div class="col-4 mb-2">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($image['content']) . '" class="img-thumbnail hover-zoom">';
            echo '<p>' . $image['likes'] . ' likes</p>';

            $comments = getComments($image['id']);
            foreach ($comments as $comment) {
                echo '<p>' . $comment['comment'] . '</p>';
                if (isset($_SESSION['user'])) {
                    echo "<form action='delete_comment.php' method='post' class='form-inline'>";
                    echo "<input type='hidden' name='comment_id' value='" . $comment['id'] . "'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Delete Comment</button>";
                    echo "</form>";
                }
            }
            echo "<form action='comment.php' method='post' class='form-inline'>";
            echo "<input type='hidden' name='id' value='" . $image['id'] . "'>";
            echo "<textarea name='comment' class='form-control mr-2'></textarea>";
            echo "<button type='submit' class='btn btn-primary btn-sm'>Add Comment</button>";
            echo "</form>";

            echo "<form action='like.php' method='post' class='form-inline'>";
            echo "<input type='hidden' name='id' value='" . $image['id'] . "'>";
            echo "<button type='submit' class='btn btn-link like-button'><i class='far fa-heart'></i></button>";
            echo "</form>";

            if (isset($_SESSION['user'])) {
                echo "<form action='delete.php' method='post' class='form-inline'>";
                echo "<input type='hidden' name='id' value='" . $image['id'] . "'>";
                echo "<button type='submit' class='btn btn-danger btn-sm'>Supprimer</button>";
                echo "</form>";
            }

            echo '</div>';
        }
        ?>
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Ajouter une image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Choisir une image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <?php
                        if (isset($_SESSION['upload_errors'])) {
                            foreach ($_SESSION['upload_errors'] as $error) {
                                echo "<p class='text-danger'>$error</p>";
                            }
                        }
                        ?>
                        <button type="submit" class="btn btn-primary">Télécharger</button>
                    </form>

                    <div class="row mt-4">
                        <?php
                        $images = getImages();
                        foreach ($images as $image) {
                            echo '<div class="col-4 mb-2">';
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($image['content']) . '" class="img-thumbnail">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once '../footer.php'; ?>