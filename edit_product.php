<?php

session_start();

// Проверяем, авторизован ли пользователь и является ли он администратором
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Перенаправляем на страницу авторизации, если не администратор
    header('Location: login.php');
    exit();
}

include('server/connection.php');

// Получение данных о товаре для редактирования
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        die("Товар не найден");
    }
} else {
    header("Location: admin.php");
    exit();
}

// Логика обновления товара
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);

    // Обновление изображений, если они были загружены
    $upload_dir = 'assets/img/';
    $image1 = $product['product_image'];
    $image2 = $product['product_image2'];
    $image3 = $product['product_image3'];
    $image4 = $product['product_image4'];

    if (!empty($_FILES['image1']['name'])) {
        $image1 = $upload_dir . basename($_FILES['image1']['name']);
        move_uploaded_file($_FILES['image1']['tmp_name'], $image1);
    }
    if (!empty($_FILES['image2']['name'])) {
        $image2 = $upload_dir . basename($_FILES['image2']['name']);
        move_uploaded_file($_FILES['image2']['tmp_name'], $image2);
    }
    if (!empty($_FILES['image3']['name'])) {
        $image3 = $upload_dir . basename($_FILES['image3']['name']);
        move_uploaded_file($_FILES['image3']['tmp_name'], $image3);
    }
    if (!empty($_FILES['image4']['name'])) {
        $image4 = $upload_dir . basename($_FILES['image4']['name']);
        move_uploaded_file($_FILES['image4']['tmp_name'], $image4);
    }

    $query = "UPDATE products SET product_name = '$name', product_category = '$category', product_description = '$description',
              product_image = '$image1', product_image2 = '$image2', product_image3 = '$image3', product_image4 = '$image4',
              product_price = $price WHERE product_id = $product_id";

    if (mysqli_query($conn, $query)) {
        header("Location: admin.php");
        exit();
    } else {
        $error = "Ошибка при обновлении товара: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarStaring | Панель Администратора | Редактирование товара</title>
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
    <h1 class="mb-4">Редактировать товар</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"> <?= $error ?> </div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Телефон" <?= $product['product_category'] === 'Телефон' ? 'selected' : '' ?>>Телефон</option>
                <option value="Автозапуск" <?= $product['product_category'] === 'Автозапуск' ? 'selected' : '' ?>>Автозапуск</option>
                <option value="CAN" <?= $product['product_category'] === 'CAN' ? 'selected' : '' ?>>CAN</option>
                <option value="Метка" <?= $product['product_category'] === 'Метка' ? 'selected' : '' ?>>Метка</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($product['product_description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= $product['product_price'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="image1" class="form-label">Изображение 1</label>
            <input type="file" class="form-control" id="image1" name="image1" accept="image/*">
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
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="admin.php" class="btn btn-secondary">Назад</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
