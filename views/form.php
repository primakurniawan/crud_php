<?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endforeach; ?>
<?php endif ?>

<div class="jumbotron bg-light p-3">
    <?php if ($book[0]['image_cover']) : ?>
        <img src="./cover/<?= $book[0]['image_cover'] ?>" width="100" />
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Image cover</label>
            <input name="image_cover" type="file" class="form-control" id="image" aria-describedby="emailHelp" placeholder="Upload image">

        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input value="<?= $book[0]['title'] ?>" name="title" type="text" class="form-control" id="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input value="<?= $book[0]['author'] ?>" name="author" type="text" class="form-control" id="author" placeholder="Author">
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input value="<?= $book[0]['publisher'] ?>" name="publisher" type="text" class="form-control" id="publisher" placeholder="Publisher">
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input value="<?= $book[0]['year'] ?>" name="year" type="number" step="1" class="form-control" id="year" placeholder="Year">
        </div>
        <div class="form-group">
            <label for="no of copies">No of copies</label>
            <input value="<?= $book[0]['no_of_copies'] ?>" name="no_of_copies" type="number" step="1" class="form-control" id="no of copies" placeholder="No of copies">
        </div>
        <input type="hidden" name="id" value="<?= $book[0]['id'] ?>">
        <input type="submit" class="btn btn-primary mt-2" />
    </form>
</div>