<?php

include('server/connection.php');

// Инициализация запроса
$query = "SELECT * FROM products";
$params = [];

// Проверка фильтров
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $query .= " WHERE product_category = ?";
    $params[] = $_GET['category'];
}

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%";
    if (!empty($params)) {
        $query .= " AND product_name LIKE ?";
    } else {
        $query .= " WHERE product_name LIKE ?";
    }
    $params[] = $search;
}

// Подготовка запроса
$stmt = $conn->prepare($query);

// Связываем параметры, если они есть
if (!empty($params)) {
    $types = str_repeat("s", count($params)); // Тип данных для каждого параметра
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$products = $stmt->get_result();

?>


<?php include('layout/header.php'); ?>

    <!--Товары-->
    <section id="featured" class="my-5 py-5">
      <div class="container mt-5 py-5">
        <h3>Наши товары</h3>
        <hr>
        <p>Здесь вы можете взглянуть на наши товары</p>
        <form method="GET" action="shop.php">
            <input type="text" name="search" placeholder="Введите название товара" style="padding:0 10px; display: inline-block; width: 300px; height: 48px;"/>
            <button type="submit" style="padding: 15px 30px;">Поиск</button>
        </form>

        <!-- Фильтры по категориям -->
        <div class="categories my-3">
            <a href="shop.php" class="btn btn-dark">Все товары</a>
            <a href="shop.php?category=Телефон" class="btn btn-dark">Управление с телефона</a>
            <a href="shop.php?category=Автозапуск" class="btn btn-dark">Автозапуск</a>
            <a href="shop.php?category=Метка" class="btn btn-dark">Авторизация по метке</a>
            <a href="shop.php?category=CAN" class="btn btn-dark">Блокировка двигателя по CAN</a>
        </div>

      </div>
      <div class="row mx-auto container">
      <?php if ($products->num_rows > 0) { ?>
        <?php while ($row = $products->fetch_assoc()) { ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="<?php echo $row['product_image']; ?>" alt="#"/>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h4 class="p-price"><?php echo $row['product_price'];?> <i class="fa-solid fa-ruble-sign"></i></h4>
            <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Купить</a>
          </div>
        <?php } ?>
      <?php } else { ?>
      <p class="text-center">Товары не найдены</p>
    <?php } ?>
      </div>
    </section>


<?php include('layout/footer.php'); ?>
