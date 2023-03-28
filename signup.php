<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <title>Signup</title>
</head>
<body>
<nav id="main_nav">
    <a href="index.php">Strona główna</a>
    <?php
    session_start();
      if(isset($_SESSION['login']) && isset($_SESSION['type_id'])){
        if($_SESSION['type_id'] == 1){
          echo "<a href='admin.php'>Admin Panel</a>";
        }
      }
      if (isset($_SESSION['login'])) {
        echo "<a href='logout.php'>Wyloguj</a>";
      } else {
        echo "<a href='login.php'>Zaloguj</a>";
      }
    ?>
  </nav>
  <main>
  <section>
  <form method="POST">
    <input type="text" name="first_name" placeholder="imie" required>
    <input type="text" name="last_name" placeholder="nazwisko" required>
    <input type="text" name="login" placeholder="login" required>
    <input type="password" name="password" placeholder="haslo" required>
    <input type="email" name="email" placeholder="email" required>
    <input type="phone" name="phone" placeholder="telefon" required>
    <input type="text" name="pesel" placeholder="pesel">
    <button type="submit">Dodaj</button>
  </form>
  </section>
  <?php
    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pesel'])){
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $login = $_POST['login'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $pesel = $_POST['pesel'];
      $conn = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
      $sql = "INSERT INTO users (first_name, last_name, login, password, email, phone, pesel) VALUES ('$first_name', '$last_name', '$login', '$password', '$email', '$phone', '$pesel')";
      $result = $conn->query($sql);
      if($result){
        echo "Dodano";
        header("Location: login.php");
      }else{
        echo "Użytkownik już istnieje";
      }
    }
  ?>
  </main>
</body>
</html>