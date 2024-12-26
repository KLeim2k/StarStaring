<?php
// add_product.php
session_start();

// Проверяем, авторизован ли пользователь и является ли он администратором
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Перенаправляем на страницу авторизации, если не администратор
    header('Location: login.php');
    exit();
}

include('server/connection.php');

// Логика добавления товара
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);

    // Загрузка изображений
    $upload_dir = 'assets/img/';
    $image1 = $upload_dir . basename($_FILES['image1']['name']);
    $image2 = !empty($_FILES['image2']['name']) ? $upload_dir . basename($_FILES['image2']['name']) : null;
    $image3 = !empty($_FILES['image3']['name']) ? $upload_dir . basename($_FILES['image3']['name']) : null;
    $image4 = !empty($_FILES['image4']['name']) ? $upload_dir . basename($_FILES['image4']['name']) : null;

    if (move_uploaded_file($_FILES['image1']['tmp_name'], $image1) &&
        (empty($image2) || move_uploaded_file($_FILES['image2']['tmp_name'], $image2)) &&
        (empty($image3) || move_uploaded_file($_FILES['image3']['tmp_name'], $image3)) &&
        (empty($image4) || move_uploaded_file($_FILES['image4']['tmp_name'], $image4))) {

        $query = "INSERT INTO products (product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4, product_price) 
                  VALUES ('$name', '$category', '$description', '$image1', '$image2', '$image3', '$image4', $price)";

        if (mysqli_query($conn, $query)) {
            header("Location: admin.php");
            exit();
        } else {
            $error = "Ошибка при добавлении товара: " . mysqli_error($conn);
        }
    } else {
        $error = "Ошибка загрузки изображений.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarStaring | Панель Администратора | Добавление товара</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/2824928ee5.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">
        <img class="logo" src="assets/img/logo1.png" alt="#">
        <a class="brd" href="https://www.youtube.com/watch?v=xvFZjo5PgG0"><h2 class="brand">StarStaring</h2></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-5">
    <h1 class="mb-4">Добавить товар</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"> <?= $error ?> </div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Телефон">Телефон</option>
                <option value="Автозапуск">Автозапуск</option>
                <option value="CAN">CAN</option>
                <option value="Метка">Метка</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="image1" class="form-label">Изображение 1</label>
            <input type="file" class="form-control" id="image1" name="image1" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="image2" class="form-label">Изображение 2</label>
            <input type="file" class="form-control" id="image2" name="image2" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="image3" class="form-label">Изображение 3</label>
            <input type="file" class="form-control" id="image3" name="image3" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="image4" class="form-label">Изображение 4</label>
            <input type="file" class="form-control" id="image4" name="image4" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Добавить</button>
        <a href="admin.php" class="btn btn-secondary">Назад</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
