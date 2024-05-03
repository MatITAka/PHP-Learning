<?php
session_start();
require 'header.php';
require 'data/data.php';
require 'functions.php';
?>

    <div class="container mt-5 p-3">
        <h1 class="text-center">Bonjour et bienvenue</h1>
        <p class="lead text-center">Voici ma liste de membres</p>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='alert alert-success'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>


        <div class="table-responsive">
            <table class="table table-striped mt-5">
                <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Age</th>
                    <th>Ville</th>
                </tr>
                </thead>
                <tbody>
                <?php
                displayMembers();
                ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require 'footer.php' ?>