<?php include('layout/header.php'); ?>

    <!--1 секция-->
    <section id="home">
      <div class="container">
        <h5>ЛУЧШИЕ АВТОСИГНАЛИЗАЦИИ</h5>
        <h1><span class="coral">Лучшие Цены</span> На Автосигнализацию</h1>
        <P>StarStaring предлагает лучшие автосигнализации по самым доступным ценам в Екатеринбурге</P>
        <button href="shop.php">Приступить к покупкам</button>
      </div>
    </section>


    <!--Популярное-->
    <section id="featured" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Популярные товары</h3>
        <hr class="mx-auto">
        <p>Здесь вы можете взглянуть на наши популярные товары</p>
      </div>
      <div class="row mx-auto container-fluid">

      <?php include('server/get_featured_products.php'); ?>

      <?php while($row = $featured_products->fetch_assoc()){ ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="<?php echo $row['product_image'];?>" alt="#">
          <h5 class="p-name"><?php echo $row['product_name'];?></h5>
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h4 class="p-price"><?php echo $row['product_price'];?> <i class="fa-solid fa-ruble-sign"></i></h4>
          <a href="<?php echo "single_product.php?product_id=". $row['product_id']?>"><button class="buy-btn">Купить</button></a>
        </div>

        <?php } ?>
      </div>
    </section>


    <!--Баннер-->
    <section id="banner" class="my-5 py-5">
      <div class="container">
        <h4>Новогодние скидки</h4>
        <h1>Скидки на аксессуары<br>до 30%</h1>
        <button class="text-uppercase">Залутать</button>
      </div>
    </section>


    <!--Автозапуск-->
    <section id="autostart" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Автозапуск</h3>
        <hr class="mx-auto">
        <p>Здесь вы можете взглянуть на сигнализации с <span class="coral">автозапуском</span></p>
      </div>
      <div class="row mx-auto container-fluid">

      <?php include('server/get_autostart.php'); ?>

      <?php while($row = $autostart_products->fetch_assoc()){ ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="<?php echo $row['product_image'];?>" alt="#">
          <h5 class="p-name"><?php echo $row['product_name'];?></h5>
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h4 class="p-price"><?php echo $row['product_price'];?> <i class="fa-solid fa-ruble-sign"></i></h4>
          <a href="<?php echo "single_product.php?product_id=". $row['product_id']?>"><button class="buy-btn">Купить</button></a>
        </div>
        <?php }?>
      </div>
    </section>


    <!--Управление с телефона-->
    <section id="phonecontrol" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Управление с телефона</h3>
        <hr class="mx-auto">
        <p>Здесь вы можете взглянуть на сигнализации с возможностью <span class="coral">управления с телефона</span></p>
      </div>
      <div class="row mx-auto container-fluid">
        
      <?php include('server/get_phone_control.php'); ?>

      <?php while($row = $autostart_products->fetch_assoc()){ ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="<?php echo $row['product_image'];?>" alt="#">
          <h5 class="p-name"><?php echo $row['product_name'];?></h5>
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h4 class="p-price"><?php echo $row['product_price'];?> <i class="fa-solid fa-ruble-sign"></i></h4>
          <a href="<?php echo "single_product.php?product_id=". $row['product_id']?>"><button class="buy-btn">Купить</button></a>
        </div>
        <?php }?>
      </div>
    </section>

    <?php include('layout/footer.php'); ?>
