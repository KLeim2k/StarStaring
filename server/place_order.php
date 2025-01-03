<?php 
    session_start();
    include('connection.php');

    if(isset($_POST['place_order'])){
        //1
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "в ожидании";
        $user_id = $_SESSION['user_id'];
    
        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address)
                        VALUES (?,?,?,?,?,?) ");
        $stmt->bind_param('isiiss',$order_cost, $order_status, $user_id, $phone, $city, $address);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        //2
        foreach($_SESSION['cart'] as $key => $value){
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id)
                            VALUES (?,?,?,?,?,?,?)");
            $stmt1->bind_param('iissiii', $order_id, $product_id, $product_name, $product_image,$product_price,$product_quantity,$user_id);
            $stmt1->execute();
        }
    }
    header('location: ../account.php');
?>