<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Автозапуск' LIMIT 4");

$stmt->execute();

$autostart_products = $stmt->get_result();
?>