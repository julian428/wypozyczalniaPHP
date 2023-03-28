<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
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
  <main>
  <?php
  function getProfileName($id) {
    $types = ["Admin", "Worker", "Client"];
    return $types[$id - 1];
  }
    if (isset($_SESSION['login'])) {
      echo "<section>";
      echo "<p>Witaj " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "!</p>";
      echo "<p>Twój login to: " . $_SESSION['login']."</p>";
      echo "<p>Twój email to: " . $_SESSION['email']."</p>";
      echo "<p>Twój numer telefonu to: " . $_SESSION['phone']."</p>";
      echo "<p>Twój pesel to: " . $_SESSION['pesel']."</p>";
      echo "<p>Twój typ konta to: " . getProfileName($_SESSION['type_id'])."</p>";
      echo "</section>";
    } else {
      echo "Nie jesteś zalogowany";
    }
  ?>
  </main>
</body>
</html>