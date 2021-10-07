<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <title>Login</title>
</head>

<body style="height: 100%;">

  <main class="bg-danger d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-6 offset-3">
          <div class="card bd-light rounded">
            <div class="card-header">
              Administrador
            </div>
            <form method="POST" action="../../actions/auth/login.php">
              <div class="card-body">

                <?php include('../auth/alertas/alerts.php')?>

                <div class="form-group">
                  <label>E-mail</label>
                  <input type="email" required name="email" class="form-control" />
                </div>

                <div class="form-group">
                  <label>Senha</label>
                  <input type="password" required name="senha" class="form-control" />
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-6">
                    <button class="btn btn-success btn-block">Entrar</button>
                  </div>
                  <div class="col-md-6">
                    <a href="../auth/Admin/cadastrarAdmin.php" class="btn btn-primary btn-block">Cadastrar</a>
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </main>



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>