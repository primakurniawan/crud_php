<?php
require_once("./../../database.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $id = intval($id);

    $statement = $pdo->prepare('SELECT * FROM book WHERE id=:id');
    $statement->bindValue(':id', $id);
    $statement->execute();

    $book = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($book)) {
        $statement = $pdo->prepare('DELETE FROM book WHERE id=' . $id);
        if ($statement->execute()) {
            unlink('./cover/' . $book[0]['image_cover']);
            header('Location: index.php');
        } else echo "<h1>Can't remove a book</h1>";
    } else {
        echo "<h1>The book isn't exist</h1>";
    }
    header('Location: index.php');
}
