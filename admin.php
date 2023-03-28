<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <title>Admin panel</title>
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
      if($_SESSION['type_id'] == 1){
        echo "Witaj " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " w panelu admina". "!<br/>";
        $connection = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
        $sql = "SELECT * FROM users";
        $response = $connection -> query($sql);
        if($response -> num_rows > 0) {
          echo "<section><a href='add.php'>Dodaj użytkownika</a></section>";
          echo "<article>";
          while($row = $response -> fetch_assoc()) {
            echo "<section>";
            echo "Imię: " . $row["first_name"] ."<br/>";
            echo "Nazwisko: " . $row["last_name"] . "<br/>";
            echo "Login: " . $row["login"] . "<br/>";
            echo "Email: " . $row["email"] . "<br/>";
            echo "Telefon: " . $row["phone"] . "<br/>";
            echo "Pesel: " . $row["pesel"] . "<br/>";
            echo "Typ konta: " . getProfileName($row["profile_id"]) . "<br/>";
            // przycisk do edycji
            echo "
              <div>
                <a href='edit.php?id=" . $row["id"] . "'>Edytuj</a>
              </div>
            ";
            // przycisk do dezaktywacji
            echo "<a href='toggleActive.php?id=".$row["id"]."'>".($row["active"] == "1" ? "Dezaktywuj" : "Aktywuj")."</a>";
            echo "</section>";
          }
          echo "</article>";
        } else {
          echo "Brak użytkowników";
        }
      } else {
        echo "Nie masz uprawnień do tego panelu";
      }
    } else {
      echo "Nie jesteś zalogowany";
    }
  ?>
  </main>
</body>
</html>