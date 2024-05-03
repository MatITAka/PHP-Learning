<?php
require '../header.php';

// Start the session
session_start();
?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Login</h1>

                <?php
                if (isset($_SESSION['login_error'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
                    unset($_SESSION['login_error']);
                }
                ?>

                <form action="../data/data.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

<?php require '../footer.php'; ?>