<?php
session_start();

$reference_email = 'guinet@derriaz.com';
$reference_password_hash = password_hash('password', PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == $reference_email && password_verify($password, $reference_password_hash)) {
        $_SESSION['user'] = array(
            'email' => $email,
            'password' => $reference_password_hash
        );

        header('Location: /index.php');
        exit;
    } else {
        $_SESSION['login_error'] = 'Invalid email or password';
        header('Location: /src/login.php');
        exit;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_index'])) {
        if (!isset($_SESSION['user'])) {
            header('Location: /src/login.php');
            exit;
        }

        $index = $_POST['delete_index'];

        if (isset($_SESSION['name'][$index]) && isset($_SESSION['age'][$index]) && isset($_SESSION['city'][$index])) {
            array_splice($_SESSION['name'], $index, 1);
            array_splice($_SESSION['age'], $index, 1);
            array_splice($_SESSION['city'], $index, 1);

            $_SESSION['message'] = "Le membre a été supprimé avec succès";
        }
    } elseif (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['city'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $city = $_POST['city'];

        if (!is_array($_SESSION['name'])) {
            $_SESSION['name'] = array();
        }
        if (!is_array($_SESSION['age'])) {
            $_SESSION['age'] = array();
        }
        if (!is_array($_SESSION['city'])) {
            $_SESSION['city'] = array();
        }

        array_push($_SESSION['name'], $name);
        array_push($_SESSION['age'], $age);
        array_push($_SESSION['city'], $city);

        $_SESSION['message'] = "Merci de vous être inscrit";
    }

    header('Location: /index.php');
}
?>