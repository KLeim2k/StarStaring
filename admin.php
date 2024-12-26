<?php
// admin.php
session_start();

// Проверяем, авторизован ли пользователь и является ли он администратором
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Перенаправляем на страницу авторизации, если не администратор
    header('Location: login.php');
    exit();
}

include('server/connection.php');

// Логика удаления товара
if (isset($_GET['delete_product'])) {
    $product_id = intval($_GET['delete_product']);
    mysqli_query($conn, "DELETE FROM products WHERE product_id = $product_id");
    header("Location: admin.php");
    exit();
}

// Логика обновления статуса заказа
if (isset($_GET['mark_sent'])) {
    $order_id = intval($_GET['mark_sent']);
    mysqli_query($conn, "UPDATE orders SET order_status = 'Доставляется' WHERE order_id = $order_id");
    header("Location: admin.php");
    exit();
}

// Логика обновления статуса заказа
if (isset($_GET['mark1_sent'])) {
    $order_id = intval($_GET['mark1_sent']);
    mysqli_query($conn, "UPDATE orders SET order_status = 'Ожидает в магазине' WHERE order_id = $order_id");
    header("Location: admin.php");
    exit();
}

// Логика удаления заказа
if (isset($_GET['delete_sent'])) {
    $order_id = intval($_GET['delete_sent']);
    mysqli_query($conn, "DELETE FROM orders WHERE order_id = $order_id");
    header("Location: admin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarStaring | Панель Администратора</title>
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
                    <a class="nav-link btn" href="account.php">Выйти</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-5">
    <h1 class="mb-4">Управление товарами</h1>
    <a href="add_product.php" class="btn btn-success mb-3">Добавить товар</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $products = mysqli_query($conn, "SELECT * FROM products");
            while ($product = mysqli_fetch_assoc($products)) {
                echo "<tr>
                    <td>{$product['product_id']}</td>
                    <td>{$product['product_name']}</td>
                    <td>{$product['product_category']}</td>
                    <td>{$product['product_price']}</td>
                    <td>
                        <a href='admin/edit_product.php?id={$product['product_id']}' class='btn btn-primary btn-sm'>Редактировать</a>
                        <a href='admin.php?delete_product={$product['product_id']}' class='btn btn-danger btn-sm'>Удалить</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <h1 class="mt-5 mb-4">Заказы</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID заказа</th>
                <th>Сумма</th>
                <th>Статус</th>
                <th>Информация о клиенте</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $orders = mysqli_query($conn, "SELECT * FROM orders");
            while ($order = mysqli_fetch_assoc($orders)) {
                echo "<tr>
                    <td>{$order['order_id']}</td>
                    <td>{$order['order_cost']}</td>
                    <td>{$order['order_status']}</td>
                    <td>{$order['user_phone']}<br>{$order['user_city']}<br>{$order['user_address']}</td>
                    <td>
                        <a href='admin.php?mark_sent={$order['order_id']}' class='btn btn-success btn-sm'>Отправлен</a>
                        <a href='admin.php?mark1_sent={$order['order_id']}' class='btn btn-success btn-sm'>Заказ в магазине</a>
                        <a href='admin.php?delete_sent={$order['order_id']}' class='btn btn-danger btn-sm'>Завершить заказ</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
