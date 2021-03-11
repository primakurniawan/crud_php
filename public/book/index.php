<?php
require_once("./../../database.php");

$search = $_GET['search'] ?? '';
if ($search) {
    $search = $_GET['search'];
    $statement = $pdo->prepare("SELECT * FROM book WHERE title LIKE :search OR author LIKE :search OR publisher LIKE :search OR year=:year");
    $statement->bindValue(':search', "%$search%");
    $statement->bindValue(':year', intval($search));
} else {
    $statement = $pdo->prepare('SELECT * FROM book ORDER BY title');
}

$statement->execute();

$books = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
include_once("./../../views/partials/header.php");
?>
<title>Books CRUD</title>
</head>

<body>
    <div class="container">
        <h1>Books CRUD</h1>
        <a href="./create.php" type="button" class="btn btn-success mb-2">Add Book</a>
        <div class="input-group mb-3">
            <form action="./index.php" method="GET">
                <input name="search" type="text" class="form-control" placeholder="Search Book">
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit" value="Search" />
                </div>
            </form>
        </div>
        <?php if (empty($books)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                There is no book
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php else : ?>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Cover book</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Year</th>
                        <th scope="col">No of copies</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $i => $book) : ?>
                        <tr>
                            <th scope="row"><?= $i + 1 ?></th>
                            <td><img src="./cover/<?= $book['image_cover'] ?>" width="100" /></td>
                            <td><?= $book['title'] ?></td>
                            <td><?= $book['author'] ?></td>
                            <td><?= $book['publisher'] ?></td>
                            <td><?= $book['year'] ?></td>
                            <td><?= $book['no_of_copies'] ?></td>
                            <td>
                                <a href="./update.php?id=<?= $book['id'] ?>" type="button" class="btn btn-warning" style="display: inline-block;">Edit</a>
                                <form action="./delete.php" method="POST" style="display: inline-block;">
                                    <input name="id" value="<?= $book['id'] ?>" type="hidden" />
                                    <input type="submit" class="btn btn-danger " value="Delete" />
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
    <?php
    include_once("./../../views/partials/footer.php")
    ?>