<?php
session_start();
unset($_SESSION["level"]);
unset($_SESSION["username"]);
unset($_SESSION["name"]);
// redirect

      header("Location:form_login.php");
      exit();

?>