<?php

session_start();

if(!empty($_SESSION['cart'])){

  //Запустить пользователя


}else{
  header('location: index.php');
}



?>

<?php include('layout/header.php'); ?>


      <!--Перейти к оформлению-->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Перейти к оформлению</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <div class="form-group checkout-small-element">
                    <label>Имя</label>
                    <input type="name" class="form-control" id="checkout-name" name="name" placeholder="Имя" required/>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Телефон</label>
                    <input type="phone" class="form-control" id="checkout-phone" name="phone" placeholder="Номер телефона" required/>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Город</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Город" required/>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Адрес</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Адрес" required/>
                </div>
                <div class="form-group checkout-btn-container">
                    <p>Итоговая сумма: <?php echo $_SESSION['total'];?> <i class="fa-solid fa-ruble-sign"></i></p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Подтвердить заказ"/>
                </div>
            </form>
        </div>
    </section>








<?php include('layout/footer.php'); ?>
