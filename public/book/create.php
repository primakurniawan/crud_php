<?php
require_once("./../../database.php");
require_once("./../../functions.php");

$errors = [];

$book[0]['image_cover'] = '';
$book[0]['title'] = '';
$book[0]['author'] = '';
$book[0]['publisher'] = '';
$book[0]['year'] = 0;
$book[0]['no_of_copies'] = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $image_cover = $_FILES['image_cover'] ? uploadCover($_FILES['image_cover']) : '';
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = intval($_POST['year']);
    $no_of_copies = intval($_POST['no_of_copies']);


    if (empty($image_cover)) $errors[] = "Please input book cover";
    if (empty($title)) $errors[] = "Please input title";
    if (empty($no_of_copies)) $errors[] = "Please input no of copies ";


    $statement = $pdo->prepare("INSERT INTO book (image_cover, title, author, publisher, year, no_of_copies) VALUES (:image_cover, :title, :author, :publisher, :year, :no_of_copies)");

    $statement->bindValue(':image_cover', $image_cover);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':author', $author);
    $statement->bindValue(':publisher', $publisher);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':no_of_copies', $no_of_copies);

    if (empty($errors)) {
        $statement->execute();
        header('Location: index.php');
    }
}


?>
<?php
include_once("./../../views/partials/header.php");
?>
<title>Add Book</title>
</head>

<body>
    <div class="container">
        <h1>Add Book</h1>
        <?php
        include_once("./../../views/form.php");
        ?>
    </div>
    <?php
    include_once("./../../views/partials/footer.php")
    ?>