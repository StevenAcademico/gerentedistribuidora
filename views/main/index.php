<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <!-- Custom fonts for this template-->
  <!-- Custom styles for this template-->
  <link href="<?php echo constant("URL")?>public/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo constant("URL")?>public/img/logo.png"> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
  <title>DISTRIBUCIONES Y SERVICIOS LAL</title>

</head>

<body class="bg-white">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-gray-900">
        <a class="navbar-brand" href="#">Distribuciones Y Servicios Generales LAL</a>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Buscar" aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-dark" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
  </nav>
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">
          <main>
            <div class="row justify-content-center p-2">
                <div class="col-lg-5">
                    <div class="card shadow-lg bg-gray-500 border-0 rounded-lg mt-5">
                        <div class="card-header bg-gray-900">
                          <h3 class="text-center text-uppercase font-weight-light text-white my-4">Iniciar Sesión</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo constant("URL")?>usuario/login">
                                <?php if($this->mensaje != ''):?>
                                    <div class="alert alert-primary" role="alert">
                                    <?php echo $this->mensaje;?>
                                    </div>
                                <?php endif;?>
                                <div class="form-group text-center">
                                  <i class="fas fa-user text-gray-900 fa-5x">                                    
                                  </i>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1 text-dark font-weight-bold" for="inputEmailAddress">Usuario</label>
                                    <input class="form-control py-4" id="inputEmailAddress" required type="text" name="username" placeholder="Ingrese Usuario..." />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1 text-dark font-weight-bold" for="inputPassword">Contraseña</label>
                                    <input class="form-control py-4" id="inputPassword" required type="password" name="clave" placeholder="Ingrese Contraseña..." />
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small text-dark" href="#">¿Olvidaste Tu Contraseña?</a>
                                    <input type="submit" class="btn bg-gray-900 text-white" value="Ingresar">
                                </div>
                                
                            </form>
                        </div>
                        <!--<div class="card-footer text-center">
                            <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                        </div>-->
                    </div>
                </div>
            </div>
          </main>
            

      </div>

    </div>

  </div>
  <footer class="py-4 bg-gray-900 mt-auto">
      <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
              <div class="text-white">Copyrights&copy; Distribuciones y Servicios L.A.L</div>
              <div>
                  <a href="#">
                    <i class="fab fa-2x fa-facebook text-white"></i>
                  </a>
                  &middot;
                  <a href="#">
                    <i class="fab fa-2x fa-twitter text-white"></i>
                  </a>
                  &middot;
                  <a href="#">
                    <i class="fab fa-2x fa-linkedin text-white"></i>
                  </a>
                  &middot;
                  <a href="#">
                    <i class="fab fa-2x fa-instagram text-white"></i>
                  </a>
              </div>
          </div>
      </div>
  </footer>


  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo constant("URL")?>public/js/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo constant("URL")?>public/js/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo constant("URL")?>public/js/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo constant("URL")?>public/js/sb-admin-2.min.js"></script>

</body>

</html>