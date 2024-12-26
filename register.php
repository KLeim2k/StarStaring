<?php
session_start();
include('server/connection.php');
  //Если пользователь уже зарегистрирован
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  // Проверка имени: только русские или только английские буквы
  if (!preg_match('/^[а-яА-ЯёЁ]+$/u', $name) && !preg_match('/^[a-zA-Z]+$/', $name)) {
      header('location: register.php?error=Имя может содержать только русские или только английские буквы');
      exit;
  }

  // Если пароль не подходит
  if ($password !== $confirmPassword) {
      header('location: register.php?error=пароли не совпадают');
  }
  // Если пароль слишком короткий
  else if (strlen($password) < 6) {
      header('location: register.php?error=пароль слишком короткий');
  }
  // Если нет ошибок
  else {
      // Проверка на повтор почты
      $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
      $stmt1->bind_param('s', $email);
      $stmt1->execute();
      $stmt1->bind_result($num_rows);
      $stmt1->store_result();
      $stmt1->fetch();

      // Если существует пользователь с такой же почтой
      if ($num_rows != 0) {
          header('location: register.php?error=пользователь с введенной почтой уже существует');
      } else {
          // Создание нового пользователя
          $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?,?,?)");
          $stmt->bind_param('sss', $name, $email, md5($password));
          // Если аккаунт был создан успешно
          if ($stmt->execute()) {
              $user_id = $stmt->insert_id;
              $_SESSION['user_id'] = $user_id;
              $_SESSION['user_email'] = $email;
              $_SESSION['user_name'] = $name;
              $_SESSION['logged_in'] = true;
              header('location: account.php?register=Регистрация прошла успешно');
          } else {
              header('location: register.php?error=бееедааа бееедааа');
          }
      }
    } 
}




?>


<?php include('layout/header.php'); ?>


    <!--Регистрация-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Регистарция</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
              <p style="color: red;" ><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Имя" required/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Пароль" required/>
                </div>
                <div class="form-group">
                    <label>Подтвердите пароль</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Подтвердите Пароль" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Зарегистрироваться"/>
                </div>
                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn">Уже есть аккаунта? Авторизируйся!</a>
                </div>
                
            </form>
        </div>
    </section>

<script>
  document.getElementById('register-form').addEventListener('submit', function(event) {
    const name = document.getElementById('register-name').value.trim();
    const onlyRussian = /^[а-яА-ЯёЁ]+$/; // Только русские буквы
    const onlyEnglish = /^[a-zA-Z]+$/;   // Только английские буквы

    if (!onlyRussian.test(name) && !onlyEnglish.test(name)) {
        event.preventDefault(); // Отменяем отправку формы
        alert("Имя должно содержать только русские или только английские буквы, без смешивания и без цифр!");
    }
  });
</script>




    <?php include('layout/footer.php'); ?>
