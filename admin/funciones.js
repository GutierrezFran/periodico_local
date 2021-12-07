function validarfrmadmin(form){
    if(String(form.password.value) != String(form.cpassword.value)){
        alert('Password incorrecto, vuelva a intentarlo !!');
        return false;
    }
    return true;
}
function eliminar_admin(us){
    if(confirm("Desea eliminar el administrador?  "+us+"\n\nConfirme")){
        location.href='admin_eliminar.php?usuario='+us;
    }
}
function eliminar_nota(cvn){
    if(confirm("Desea eliminar la nota? "+cvn+"\n\nConfirme")){
        location.href='nota_eliminar.php?cvnota='+cvn;
    }
}