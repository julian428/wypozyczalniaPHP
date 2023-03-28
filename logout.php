<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <title>Logout</title>
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
  <?php
    session_start();
    if (isset($_SESSION['login'])) {
      session_destroy();
      header("Location: login.php");
    } else {
      echo "Nie jesteś zalogowany";
    }
  ?>
</body>
</html>