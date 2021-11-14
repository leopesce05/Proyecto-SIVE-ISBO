//DEFINE ELEMENTOS DEL HTML A SELECCIONAR
var text= document.getElementById('errorContraseñasUser')
var contra = document.getElementById('contraUsuario')
var verifcontra = document.getElementById('verifcontraUsuario')
var formEmpresa = document.getElementById('formEmpresa')
var formUsuario = document.getElementById('formUsuario')
var contraEmpresa = document.getElementById('contraEmpresa')
var verifcontraEmpresa = document.getElementById('verifContraEmpresa')
var textEmpresa = document.getElementById('errorContraseñasEmpresa')



//Muestra un formulario o el otro dependiendo la seleccion
function regist() {
    if (document.getElementById('empresa').checked) {
        formEmpresa.classList.remove('ocultar')
        formEmpresa.classList.add('mostrar')
        formUsuario.classList.remove('mostrar')
        formUsuario.classList.add('ocultar')
    }else{
        formEmpresa.classList.remove('mostrar')
        formEmpresa.classList.add('ocultar')
        formUsuario.classList.remove('ocultar')
        formUsuario.classList.add('mostrar')
    }
}


//Si a un input se le insertan letras, no las acepta
function soloNumeros(evt) {
          
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

//Muestra error si las contraseñas son iguales del usuario
function userValidar() {
    if (contra.value != verifcontra.value) {
        text.className = 'mostrar contra_error'
        return false
    }else{
        text.className = 'ocultar contra_error'
        return true
    }
    
}

//Muestra error si las contraseñas son iguales de la empresa
function empresaValidar() {
    if (contraEmpresa.value != verifcontraEmpresa.value) {
        textEmpresa.className = 'mostrar contra_error'
        return false
    }else{
        textEmpresa.className = 'ocultar contra_error'
        return true
    }
}

