<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';



function crear_menu($id_padre,$rol) 
{ 
    global $mysqli;
$test= "numero";
    $hijo = " hijo ";
$menu = ""; // Vaciamos la variable menú 
    $rol=$_SESSION['id_rol'];
    
$consulta="SELECT * FROM (sELECT M.menu_id, M.menu_nombre, M.id_padre ,M.link,M.logo , M.li_class , M.ul_class , M.ul_cerrar fROM permisos P inner join menu M on M.menu_id= P.per_id_pantalla inner join roles R on R.rol_id_rol= P.per_id_rol where P.per_id_rol=$rol UNION SELECT ME.menu_id,ME.menu_nombre,ME.id_padre,ME.link,ME.logo , ME.li_class,  ME.ul_class , ME.ul_cerrar from permisos PE ,menu ME WHERE ME.menu_id IN (SELECT distinct id_padre fROM permisos PR inner join menu MR on MR.menu_id= PR.per_id_pantalla inner join roles RE on RE.rol_id_rol= PR.per_id_rol where PR.per_id_rol=$rol ) GROUP by ME.menu_nombre) as tab where id_padre= $id_padre order by menu_id asc";
//$consulta = " SELECT * FROM menu where estatus='1' and id_padre=" ; 
    

$resultado=mysqli_query($mysqli,$consulta); 
    $cont = count($resultado); 
echo $cont;
    //for ($i = 0; $i < count($resultado); ++$i)    

        
        
 while($row=mysqli_fetch_array($resultado)) 
{ 
   // echo $test;
  //  $row_cnt = mysqli_num_rows($resultado);    
 // echo $row_cnt;  

$menu .="<li ".$row['li_class']." ><a href='".$row['link']."'><i class='".$row['logo']."'></i>".$row['menu_nombre'] ; 

  $row_cnt = mysqli_num_rows($resultado);   
      //echo $row_cnt;
      //if ( $row_cnt  = 0){
$menu .= " ".$row['ul_class']." ".crear_menu($row['menu_id'],$rol).$row['ul_cerrar']; //LLamada recursiva para generar todos los niveles del menú 
//}
$menu .= "</li>"; 

 
}
return $menu; 

} 


$rol=$_SESSION['id_rol'];
 //echo $_SESSION['id_rol'];
?>



 <?php
echo crear_menu(0,$rol);

