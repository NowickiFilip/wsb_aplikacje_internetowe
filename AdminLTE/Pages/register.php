<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">


<div class="register-box">
  <?php
if(isset($_SESSION['error'])){
  echo <<< ERROR


  <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-ban"></i> ERROR</h5>
  $_SESSION[error]
 
  </div>


ERROR;
unset ($_SESSION['success']);
}

if(isset($_SESSION['success'])){
  echo <<< ERROR


  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-ban"></i> SUCCESSS</h5>
  $_SESSION[success]
 
  </div>


ERROR;
unset ($_SESSION['error']);

}
  
  ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./index.php" class="h1"><b>UltraMegaGiga<br>Koks</b><br>Rejestracja</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Rejestracja uzytkownika</p>

      <form action="../skrypty/register.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Podaj Imie" name="firstName">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Podaj Nazwisko" name="lastName">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Podaj Email" name="email1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Powtorz Email" name="email2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Podaj Hasło" name="pass1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Powtorz hasło" name="pass2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="date" class="form-control" name="DataUrodzenia">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <select class="custom-select" name="city_id">
          <?php
          require_once "../skrypty/conect.php";
          $sql = "SELECT * FROM `cities`";
          $result = $conn->query($sql);
          while ($city = $result->fetch_assoc()){
            echo "<option value='$city[id]'>$city[city]</option>";
          }
          
          
          ?>
          </select>
        
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-city"></span>
            </div>
          </div>
        </div>
            <div class= "input-group mb-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="w" checked>
                <label class="form-checked-label">Kobieta</label>
              </div>
            </div>

            <div class="input-group mb-2">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="m" checked>
                <label class="form-checked-label">Mężczyzna</label>
            </div>
          </div>



        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Zatwierdz regulamin <a href="#">Regulamin</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Rejestracja</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="./" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
