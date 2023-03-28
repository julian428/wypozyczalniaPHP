<?php
    session_start();
    $connection = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
        $sql = "SELECT active FROM users WHERE login='".$_SESSION['login']."'";
        $response = $connection -> query($sql);
        $res = $response -> fetch_assoc();
        if($res["active"] == 0){
          echo "Konto nieaktywne";
          exit();
        }
    if(!isset($_SESSION['login']) || $_SESSION['type_id'] != 1){
      header("Location: index.php");
    }
    if(isset($_GET['id'])){
      $connection = new mysqli('localhost', 'jmetzger', 'eidaePho', 'jmetzger');
      $sql = "UPDATE users SET active = NOT active WHERE id = " . $_GET['id'];
      echo($sql);
      $response = $connection -> query($sql);
      header("Location: admin.php");
    }
  ?>