<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <title>Edytuj</title>
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
  <main>
  <?php
    if (isset($_SESSION['login'])) {
      $connection = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
      $sql = "SELECT * FROM users WHERE id = '" . $_GET["id"] . "'";
      $response = $connection -> query($sql);
      if($response -> num_rows > 0) {
        $res = $response -> fetch_assoc();
        echo "<section>";
        echo "<form method='post'>";
        echo "<input required type='text' name='first_name' placeholder='Imię' value='" . $res['first_name'] . "'>";
        echo "<input required type='text' name='last_name' placeholder='Nazwisko' value='" . $res['last_name'] . "'>";
        echo "<input required type='text' name='email' placeholder='Email' value='" . $res['email'] . "'>";
        echo "<input required type='text' name='phone' placeholder='Telefon' value='" . $res['phone'] . "'>";
        echo "<input type='text' name='pesel' placeholder='Pesel' value='" . $res['pesel'] . "'>";
        echo "<input required type='text' name='password' placeholder='Hasło' value='" . $res['password'] . "'>";
        echo "<select name='profile_id' value='".$res["profile_id"]."'>";
        echo "<option value='1'>Admin</option>";
        echo "<option value='2'>Worker</option>";
        echo "<option value='3'>Client</option>";
        echo "</select>";
        echo "<button type='submit'>Zapisz</button>";
        echo "</form>";
        echo "<a href='admin.php'>Anuluj</a>";
        echo "</section>";
        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pesel'])) {
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $pesel = $_POST['pesel'];
          $password = $_POST['password'];
          $profile_id = $_POST['profile_id'];
          $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone', pesel = '$pesel', password='$password', profile_id='$profile_id' WHERE id = '" . $_GET["id"] . "'";
          $connection -> query($sql);
          $_SESSION["first_name"] = $first_name;
          $_SESSION["last_name"] = $last_name;
          $_SESSION["email"] = $email;
          $_SESSION["phone"] = $phone;
          $_SESSION["pesel"] = $pesel;
          echo "Zmieniono dane";
        }
      }
    } else {
      echo "Nie jesteś zalogowany";
    }
  ?>
  </main>
</body>
</html>