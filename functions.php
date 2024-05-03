<?php
function getImages() {
    try {
        $dbPath = __DIR__ . '/data/data2.db';
        $db = new PDO('sqlite:' . $dbPath);

        // Get all images
        $images = $db->query("SELECT * FROM images")->fetchAll(PDO::FETCH_ASSOC);

        // For each image, get the likes and comments
        foreach ($images as $key => $image) {
            $image_id = $image['id'];

            // Get likes
            $likes = $db->prepare("SELECT COUNT(*) as count FROM likes WHERE image_id = ?");
            $likes->execute([$image_id]);
            $images[$key]['likes'] = $likes->fetch(PDO::FETCH_ASSOC)['count'];

            // Get comments
            $comments = $db->prepare("SELECT * FROM comments WHERE image_id = ?");
            $comments->execute([$image_id]);
            $images[$key]['comments'] = $comments->fetchAll(PDO::FETCH_ASSOC);
        }

        return $images;
    } catch (PDOException $e) {
        echo "PDO Exception: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}

function uploadImage($file_name, $file_content) {

    if (!isset($_SESSION['user'])) {
        echo "Vous devez être connecté pour ajouter une image.";
        return;
    }

    try {
        $dbPath = __DIR__ . '/data/data2.db';
        $db = new PDO('sqlite:' . $dbPath);
        $stmt = $db->prepare("INSERT INTO images (name, content) VALUES (:name, :content)");
        $stmt->bindParam(':name', $file_name);
        $stmt->bindParam(':content', $file_content, PDO::PARAM_LOB);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "PDO Exception: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}


function displayMembers() {
    if (isset($_SESSION['name']) && isset($_SESSION['age']) && isset($_SESSION['city'])) {
        for ($i = 0; $i < count($_SESSION['name']); $i++) {
            echo "<tr>";
            echo "<td>" . $_SESSION['name'][$i] . "</td>";
            echo "<td>" . $_SESSION['age'][$i] . "</td>";
            echo "<td>" . $_SESSION['city'][$i] . "</td>";
            echo "<td>";
            if (isset($_SESSION['user'])) {
                echo "<div class='d-flex justify-content-center'>";
                echo "<form action='data/data.php' method='post' class='mr-2'>";
                echo "<input type='hidden' name='delete_index' value='$i'>";
                echo "<button type='submit' class='btn btn-danger btn-sm'>Supprimer</button>";
                echo "</form>";
                echo "<a href='src/edit.php?id=$i' class='btn btn-primary btn-sm'>Modifier</a>";
                echo "</div>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
}

function deleteImage($id) {
    try {
        $dbPath = __DIR__ . '/data/data2.db';
        $db = new PDO('sqlite:' . $dbPath);
        $stmt = $db->prepare("DELETE FROM images WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}

function getMember($id) {
    if (isset($_SESSION['name'][$id]) && isset($_SESSION['age'][$id]) && isset($_SESSION['city'][$id])) {
        return array(
            'name' => $_SESSION['name'][$id],
            'age' => $_SESSION['age'][$id],
            'city' => $_SESSION['city'][$id]
        );
    }
    return null;
}

function updateMember($id, $newName, $newAge, $newCity) {
    if (isset($_SESSION['name'][$id]) && isset($_SESSION['age'][$id]) && isset($_SESSION['city'][$id])) {
        $_SESSION['name'][$id] = $newName;
        $_SESSION['age'][$id] = $newAge;
        $_SESSION['city'][$id] = $newCity;
    }
}


?>