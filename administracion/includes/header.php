<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    
    <title>Header</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
<div class="container">
<a class="navbar-brand" href="panel_admin.php" title="Gastroquirurgica">
    <img src="../images/pestania.png" width="40" height="30" class="d-inline-block align-top" alt="Gastroquirurgica"/> <strong>Gastroquirurgica</strong>
  </a>
  
      
    
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <!--<i class="fa fa-user" aria-hidden="true" id="icon"></i>--> <?php echo $_SESSION["usuario"];?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item text-primary" href="panel_admin.php" ><i class="fa fa-home" aria-hidden="true" id="file_archive"></i> Home</a>
  <a class="dropdown-item text-primary" href="personal.php" ><i class="fa fa-users" aria-hidden="true" id="file_archive"></i> Personal</a>
  <a class="dropdown-item text-primary" href="examenes.php" ><i class="fa fa-medkit" aria-hidden="true" id="file_archive"></i> Examenes</a>
   <a class="dropdown-item text-danger" href="Controlador/Cerrar_Sesion.php"><i class="fa fa-sign-out" aria-hidden="true" id="sign-out"></i> Cerrar Sesión</a>
  </div>
</div>
</ul>
</div>
</div>
</nav>

  </body>
</html>