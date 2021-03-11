<?php
require_once("./../../database.php");
require_once("./../../functions.php");

$errors = [];



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {

        $id = intval($_GET['id']);
        $statement = $pdo->prepare("SELECT * FROM book WHERE id=:id");

        $statement->bindValue(':id', $id);

        if ($statement->execute()) {
            $book = $statement->fetchAll(PDO::FETCH_ASSOC);
            setcookie('book', serialize($book), time() + 3600);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $book = unserialize($_COOKIE['book'])[0];

    $id = intval($_POST['id']);
    $image_cover = empty($_FILES['image_cover']['name']) ? $book['name'] : updateCover($_FILES['image_cover'], $book['image_cover'], $book);
    // var_dump($_FILES['image_cover']);
    // var_dump($book['image_cover']);
    // var_dump($book);
    // exit;

    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = intval($_POST['year']);
    $no_of_copies = intval($_POST['no_of_copies']);

    if (empty($title)) $errors[] = "Please input title";
    if (empty($no_of_copies)) $errors[] = "Please input no of copies ";


    $statement = $pdo->prepare("UPDATE book SET image_cover = :image_cover, title= :title, author= :author, publisher= :publisher, year= :year, no_of_copies= :no_of_copies WHERE id = :id");

    $statement->bindValue(':id', $id);
    $statement->bindValue(':image_cover', $image_cover);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':author', $author);
    $statement->bindValue(':publisher', $publisher);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':no_of_copies', $no_of_copies);

    if (empty($errors)) {
        setcookie('book', "", time() - 3600);
        $statement->execute();
        header('Location: index.php');
    }
}


?>
<?php
include_once("./../../views/partials/header.php");
?>
<title>Edit Book</title>
</head>

<body>
    <div class="container">
        <h1>Edit Book</h1>
        <a href="./index.php" class="btn btn-secondary">Go back to books</a>
        <?php include_once("./../../views/form.php") ?>
    </div>
    <?php
    include_once("./../../views/partials/footer.php")
    ?>