<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add user</title>
  <link rel="stylesheet" href="main.css">
</head>

<body>
<nav id="main_nav">
    <a href="index.php">Strona główna</a>
    <?php
    session_start();
      if(isset($_SESSION['login']) && isset($_SESSION['type_id'])){
        $connection = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
        $sql = "SELECT active FROM users WHERE login='".$_SESSION['login']."'";
        $response = $connection -> query($sql);
        $res = $response -> fetch_assoc();
        if($res["active"] == 0){
          echo "Konto nieaktywne";
          exit();
        }
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
  <?php
    if(!isset($_SESSION['login']) || $_SESSION['type_id'] != 1){
      header("Location: index.php");
    }
  ?>
  <main><section>
  <form method="POST">
    <input type="text" name="first_name" placeholder="imie" required>
    <input type="text" name="last_name" placeholder="nazwisko" required>
    <input type="text" name="login" placeholder="login" required>
    <input type="text" name="password" placeholder="haslo" required>
    <input type="text" name="email" placeholder="email" required>
    <input type="text" name="phone" placeholder="telefon" required>
    <input type="text" name="pesel" placeholder="pesel">
    <select name="type" id="type">
      <option value="1">Admin</option>
      <option value="2">Pracownik</option>
      <option value="3">Klient</option>
    </select>
      <button type="submit">Dodaj</button>
  </form>
  </section></main>
  <?php
    if(isset($_SESSION['login'])){
      if($_SESSION['type_id'] == 1){
        if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pesel']) && isset($_POST['type'])){
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $login = $_POST['login'];
          $password = $_POST['password'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $pesel = $_POST['pesel'];
          $type = $_POST['type'];
          $connection = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
          $sql = "INSERT INTO users (first_name, last_name, login, password, email, phone, pesel, profile_id) VALUES ('$first_name', '$last_name', '$login', '$password', '$email', '$phone', '$pesel', '$type')";
          $response = $connection -> query($sql);
          if($response){
            echo "Dodano użytkownika";
          } else {
            echo "Nie udało się dodać użytkownika";
          }
        }
      } else {
        echo "Nie masz uprawnień do dodawania użytkowników";
      }
    }
  ?>
</body>

</html>