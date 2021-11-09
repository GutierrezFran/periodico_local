function validar(formulario){
    exp_reg_letras= /^[A-Z_]+$/i;
    exp_reg= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

       
    if (!exp_reg_letras.test(formulario.nombre.value)){
        alert("Hola... escribe un nombre valido usando solo letras");
        formulario.nombre.value=""
        formulario.nombre.focus();
        return false;
    }
    
    if (isNaN(formulario.celular.value)==true || formulario.celular.value.length !=10){
        alert("Hola... escribe un numero de celular valido con 10 digitos");
        formulario.celular.value=""
        formulario.celular.focus();
        return false;
    }

    if (!exp_reg.test(formulario.email.value)){
        alert("Hola... escribe un correo electronico valido");
        formulario.email.value=""
        formulario.email.focus();
        return false;
    }

    return true;
}