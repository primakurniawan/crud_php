<?php
function uploadCover($cover)
{
    if ($cover) {
        if (empty($cover['name'])) return null;
        $image_path = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . '-' . $cover['name'];
        if (!file_exists("cover")) {
            mkdir("cover");
        }
        move_uploaded_file($cover['tmp_name'], "cover/$image_path");
        return $image_path;
    }
}

function updateCover($cover, $name, $book)
{
    if ($cover) {
        $image_path = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . '-' . $cover['name'];
        if (!file_exists("cover")) {
            mkdir("cover");
        }
        if (!file_exists('./cover/' . $book['image_cover'])) {
            unlink('./cover/' . $book['image_cover']);
        }
        move_uploaded_file($cover['tmp_name'], "./cover/$image_path");
        return $image_path;
    } else {
        return $name;
    }
}
