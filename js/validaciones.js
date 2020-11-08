function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";
    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}
/* 
function nospaces2() {
    orig = document.form.pass1.value;
    nuev = orig.split(' ');
    nuev = nuev.join('');
    document.form.pass1.value = nuev;
    if (nuev = orig.split(' ').length >= 2);
}

function nospaces1() {
    orig = document.form.pass2.value;
    nuev = orig.split(' ');
    nuev = nuev.join('');
    document.form.pass2.value = nuev;
    if (nuev = orig.split(' ').length >= 2);
} */

function noSpaces(id) {
    orig = document.getElementById(id).value;
    nuev = orig.split(' ');
    nuev = nuev.join('');
    document.form.getElementById(id).value = nuev;
    if (nuev = orig.split(' ').length >= 2);
}

function validarCorreo(id) {
    var correo, expresion;
    correo = document.getElementById(id).value;
    expresion = /\w+@\w+\.+[a-z]/;
    if (correo.length > 80) {
        alert("El campo correo excede su capacidad de caracteres");
    } else if (!expresion.test(correo)) {
        alert('El correo no es valido');
        return false;
    }
}

getElementByClassName();