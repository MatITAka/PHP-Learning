<?php
require '../header.php';
require_once '../functions.php';
session_start();

// Get the current member
$id = $_GET['id'];
$member = getMember($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the member
    $newName = $_POST['name'];
    $newAge = $_POST['age'];
    $newCity = $_POST['city'];
    updateMember($id, $newName, $newAge, $newCity);

    // Redirect back to index.php
    header('Location:/');
    exit();
}
?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Modifier Membre</h1>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" value="<?php echo $member['age']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $member['city']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
                </form>
            </div>
        </div>
    </div>

<?php require '../footer.php'; ?>