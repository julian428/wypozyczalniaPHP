<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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

      <form method="post">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="password" placeholder="Hasło">
        <button type="submit">Zaloguj</button>
      <link rel="stylesheet" href="main.css">
      </form>
    </section>
  <section>
    <a href="signup.php">Nie mam konta</a>
  </section>
  <?php
    if(isset($_SESSION['login'])){
      header("Location: index.php");
    }
    if (isset($_POST['login']) && isset($_POST['password'])) {
      $login = $_POST['login'];
      $password = $_POST['password'];
      $connection = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
      $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
      $response = $connection -> query($sql);
      if($response -> num_rows > 0) {
        $res = $response -> fetch_assoc();
        if($res["active"] == 0){
          echo "Konto nieaktywne";
          exit();
        }
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION["first_name"] = $res["first_name"];
        $_SESSION["last_name"] = $res["last_name"];
        $_SESSION["email"] = $res["email"];
        $_SESSION["phone"] = $res["phone"];
        $_SESSION["pesel"] = $res["pesel"];
        $_SESSION["type_id"] = $res["profile_id"];
        header("Location: index.php");
      } else {
        echo "Niepoprawny login lub hasło";
      }
    }
  ?>
  </main>
</body>
</html>