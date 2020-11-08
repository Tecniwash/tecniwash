$(function(){
	$('#pais').on('change', function(){
		var id = $('#pais').val();
		var url = './agregar_depto.php';
		$.ajax({
			type:'POST',
			url:url,
			data:'id='+id,
			success: function(data){
				$('#municipio option').remove();
				$('#depto option').remove();
				$('#depto').append(data);
			}
		});
		return false;
	});
	
	$('#depto').on('change', function(){
		var id = $('#depto').val();
		var url = './agregar_munic.php';
		$.ajax({
			type:'POST',
			url:url,
			data:'id='+id,
			success: function(data){
				$('#municipio option').remove();
				$('#municipio').append(data);
			}
		});
		return false;
	});
});




function showl() {
	document.getElementById('txt_telefono2').style.visibility = "visible";
	document.getElementById('mas1').style.visibility = "visible";
	document.getElementById('menos1').style.visibility = "visible";
	document.getElementById('t1').style.visibility = "visible";

}

function hiddenl() {
	document.getElementById('txt_telefono2').style.visibility = "hidden";
	document.getElementById('mas1').style.visibility = "hidden";
	document.getElementById('menos1').style.visibility = "hidden";
	document.getElementById('t1').style.visibility = "hidden";
	document.getElementById('txt_telefono3').style.visibility = "hidden";
	document.getElementById('t2').style.visibility = "hidden";
}


function showl1() {
	document.getElementById('txt_telefono3').style.visibility = "visible";
	document.getElementById('t2').style.visibility = "visible";
}

function hiddenl1() {
	document.getElementById('txt_telefono3').style.visibility = "hidden";
	document.getElementById('t2').style.visibility = "hidden";
}


/*EMPIEZA LA FUNCION QUE SOLO ACEPTA NUMEROS Y LETRAS*/
function isNumber(e) {
k = (document.all) ? e.keyCode : e.which;
if (k==8 || k==0) return true;
patron = /\w/;
n = String.fromCharCode(k);
return patron.test(n);
}
/*TERMINA FUNCION*/


/*FUNCION QUE ACEPTA NUMEROS*/
function isNumber2(e) {
k = (document.all) ? e.keyCode : e.which;
if (k==8 || k==0) return true;
patron = /\d/;
n = String.fromCharCode(k);
return patron.test(n);
}
/*TERMINA FUNCION*/

/*FUNCION QUE ACEPTA NUMEROS Y PUNTO */
function isNumber3(e) {
k = (document.all) ? e.keyCode : e.which;
if (k==8 || k==0) return true;
patron = /[0-9.]/;
n = String.fromCharCode(k);
return patron.test(n);
}
/*TERMINA FUNCION*/

/*EMPIEZA LA FUNCION QUE SOLO LETRAS*/
function letra(e) {
k = (document.all) ? e.keyCode : e.which;
if (k==8 || k==0) return true;
patron = /[a-zA-Zá-ú  ]/;
n = String.fromCharCode(k);
return patron.test(n);
}
/*TERMINA FUNCION*/

/*EMPIEZA LA FUNCION QUE SOLO LETRAS Y SIGNO INTERROGACION*/
function letra1(e) {
k = (document.all) ? e.keyCode : e.which;
if (k==8 || k==0) return true;
patron = /[a-zA-Zá-ú ?]/;
n = String.fromCharCode(k);
return patron.test(n);
}
/*TERMINA FUNCION*/




/*PARA CONVERTIR CAMPOS MAYUSCULAS MIENTRAS SE ESCRIBE*/
function mayusculas() {
    var x = document.getElementById("txt_primernombre");
    var a = document.getElementById("txt_segundonombre");
    var b = document.getElementById("txt_primerapellido");
    var c = document.getElementById("txt_segundoapellido");
    var d = document.getElementById("txt_nombres");
    var e = document.getElementById("txt_apellidos");
    x.value = x.value.toUpperCase();
    a.value = a.value.toUpperCase();
    b.value = b.value.toUpperCase();
    c.value = c.value.toUpperCase();
    d.value = d.value.toUpperCase();
    e.value = e.value.toUpperCase();
}

/*TERMINA*/

/*PARA CONVERTIR CAMPOS MAYUSCULAS MIENTRAS SE ESCRIBE*/
function mayuscula() {
	
	var x = document.getElementById("txt_prescripcion")
    var z = document.getElementById("txt_nombre");
    z.value = z.value.toUpperCase();
    x.value = x.value.toUpperCase();
  
}

/*TERMINA*/


/*FUNCION PARA DECLARAR EDAD*/
function edad(){

if ( document.frm.txt_edad.value < 18){

document.frm.estado_civil.disabled = true;
document.frm.txt_correo.disabled = true;
document.frm.txt_direccion.disabled = true;
document.frm.txt_telefono1.disabled = true;
document.frm.mas.disabled = true;
document.frm.menos.disabled = true;
}
else{
  document.frm.estado_civil.disabled = false;
  document.frm.txt_correo.disabled = false;
  document.frm.txt_direccion.disabled = false;
  document.frm.txt_telefono1.disabled = false;
  document.frm.mas.disabled = false;
  document.frm.menos.disabled = false;
}

}
/*TERMINA*/


/*MARCAR VARIOS CHECHBOX EN ROLES OBJETOS*/
function seleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=0 
}
/*TERMINA VARIOS CHECHBOX*/
