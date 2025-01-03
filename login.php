<?php

session_start();

include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password, role 
    FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password, $role);
        $stmt->store_result();

        if ($stmt->num_rows() == 1) {
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = $role;

            // Проверяем роль пользователя
            if ($role === 'admin') {
                header('location: account.php');
            } else {
                header('location: account.php?message=Авторизация прошла успешно');
            }

        } else {
            header('location: login.php?error=Не удается подтвердить ваш аккаунт');
        }
    } else {
        // Ошибка
        header('location: login.php?error=Бееедааа бееедааа');
    }
}
?>


<?php include('layout/header.php'); ?>


    <!--Авторизация-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Авторизация</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" method="POST" action="login.php">
              <p style="color: red;" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }else if(isset($_GET['message'])){ echo $_GET['message'];} ?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Пароль" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Войти"/>
                </div>
                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Нет аккаунта? Зарегистрируйся!</a>
                </div>
                
            </form>
        </div>
    </section>




    <?php include('layout/footer.php'); ?>
