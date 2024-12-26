<?php

  session_start();
  
  include('server/connection.php');
  
  //выход
  if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
  }

  
  if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
      unset($_SESSION['logged_in']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      header('location: login.php');
      exit;
    }
  }


  //заказы
  if(isset($_SESSION['logged_in'])){

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();
      
    $orders = $stmt->get_result();

  }

?>


<?php include('layout/header.php'); ?>


    <!--Аккаунт-->
    <section class="my-5 py-5">
        <div class="container mx-auto">
            <div class="text-center mt-3 pt-5">
                <h3 class="font-weight-bold">Об аккаунте</h3>
                <hr class="mx-auto">
                <div class="account-info">
                  <p>Имя - <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; } ?></span></p>
                  <p>Email - <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; } ?></span></p>
                  <p><a href="#orders" id="orders-btn">Ваши заказы</a></p>
                  <p><a href="account.php?logout=1" id="logout-btn">Выйти из аккаунта</a></p>
                  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                      <p><a href="admin.php" id="logout-btn">Войти в панель администратора</a></p>
                  <?php endif; ?>
                </div>
            </div>
        </div>
    </section>


        <!--Заказы-->
    <section id="orders" class="orders container my-5 py-3">

        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">Ваши заказы</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Номер заказа</th>
                <th>Стоимость</th>
                <th>Статус заказа</th>
                <th>Дата заказа</th>
            </tr>

            <?php while($row = $orders->fetch_assoc() ){?>

                  <tr>
                      <td>
                          <span><?php echo $row['order_id']; ?></span>
                      </td>

                      <td>
                        <span><?php echo $row['order_cost']; ?></span>
                      </td>

                      <td>
                        <span><?php echo $row['order_status']; ?></span>
                      </td>

                      <td>
                        <span><?php echo $row['order_date']; ?></span>
                      </td>
                  </tr>


            <?php }?>
        </table>
    </section>



    <?php include('layout/footer.php'); ?>
