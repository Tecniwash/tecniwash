
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <button onclick="myFunction()" class='glyphicon glyphicon-arrow-left' width 70:: haigth 60> Atras</button>

<p id="demo"></p>

<script>
function myFunction() {
    var $s;
    var r = confirm("Desea cancelar la operacion; OK para confirmar Cancel para permanecer en el formulario");
    if (r == true) {
      $s= window.location = 'facturas.php';
    } else {
      $s= window.location = 'nueva_factura.php';
    }
    document.getElementById("demo").innerHTML = $s;}
</script>
    
   
      <ul class="nav navbar-nav navbar-right">
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	