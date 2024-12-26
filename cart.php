<?php

session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
  header('location: login.php?message=Авторизируйтесь, чтобы войти в корзину или добавить товар к корзину ');
}else
{
  if(isset($_POST['add_to_cart'])){
  
    //if user has already added a product to cart
    if(isset($_SESSION['cart'])){
    
      $products_array_ids = array_column($_SESSION['cart'],"product_id");
      //if product has already added to cart or not
      if(!in_array($_POST['product_id'], $products_array_ids)){
      
      
          $product_id = $_POST['product_id'];
            $product_array = array(
              'product_id' => $_POST['product_id'],
              'product_name' => $_POST['product_name'],
              'product_price' => $_POST['product_price'],
              'product_image' => $_POST['product_image'],
              'product_quantity' => $_POST['product_quantity']
            );
          
        $_SESSION['cart'][$product_id] = $product_array;
        //product has already been added
      }else{
        echo '<script>alert("Зачем тебе 2 ананаса?");</script>';
      }
    
      //if this is the firts product
    }else{
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];
    
    
      $product_array = array(
        'product_id'=>$product_id,
        'product_name'=>$product_name,
        'product_price'=>$product_price,
        'product_image'=>$product_image,
        'product_quantity'=>$product_quantity
      );
    
      $_SESSION['cart'][$product_id] = $product_array;
    }
  
    calculateTotalCart();
  
  
  }else if(isset($_POST['remove_product'])){
  
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
  
    calculateTotalCart();
  
  
  
  }else if(isset($_POST['edit_quantity'])){
  
      $product_id = $_POST['product_id'];
      $product_quantity = $_POST['product_quantity'];
  
      $product_array = $_SESSION['cart'][$product_id];
  
      $product_array['product_quantity'] = $product_quantity;
  
      $_SESSION['cart'][$product_id] = $product_array;
  
      calculateTotalCart();
  
  }else{
  }
}

function calculateTotalCart(){

  $total = 0;

  foreach($_SESSION['cart'] as $key => $value){
    
    $product = $_SESSION['cart'][$key];

    $price = $product['product_price'];
    $quantity = $product['product_quantity'];


    $total =  $total + ($price * $quantity);
  }

  $_SESSION['total'] = $total;

}

?>

<?php include('layout/header.php'); ?>


      <!--Корзина-->
      <section class="cart container my-5 py-5">

        <div class="container mt-5">
            <h2 class="font-weight-bold">Ваша коризна</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Товар</th>
                <th>Количество</th>
                <th>Промежуточный итог</th>
            </tr>

            <?php foreach($_SESSION['cart'] as $key => $value){?>

                <tr>
                    <td>
                        <div class="product-info">
                          <img src="<?php echo $value['product_image'];?>" alt="#">
                            <div>
                              <p><?php echo $value['product_name'];?></p>
                              <small><?php echo $value['product_price'];?> <span><i class="fa-solid fa-ruble-sign"></i></span></small>
                              <br>
                                <form method="POST" action="cart.php">
                                  <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                                  <input type="submit" name="remove_product" class="remove-btn" value="Удалить"/>
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                      
                      <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>"/>
                        <input type="submit" class="edit-btn" value="Изменить" name="edit_quantity"/>
                      </form>
                      
                    </td>

                    <td>
                      <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                      <span><i class="fa-solid fa-ruble-sign"></i></span>
                    </td>
                </tr>

            <?php }?>

        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Итого</td>
                    <td> <?php echo $_SESSION['total']; ?> <i class="fa-solid fa-ruble-sign"></i></td>
                </tr>
            </table>
        </div>
        

        <div class="checkout-container">
          <form method="POST" action="checkout.php">
            <input type="submit" class="checkout-btn" value="Перейти к оформлению" name="checkout">
          </form>
        </div>
      </section>

    


      <?php include('layout/footer.php'); ?>
