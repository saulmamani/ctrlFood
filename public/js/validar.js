function validar(e, patron)
{
    //tecla = (document.all) ? e.keyCode : e.which;
    tecla = e.keyCode || e.which;

    //Tecla de retroceso para borrar, o tabulador siempre la permite
    if ( tecla == 8 || tecla == 9 ){
        return true;
    }

    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function numeros(e)
{
    patron =  /[0-9]/;
    return validar(e, patron);
}

function decimales(e)
{ 
    patron = /[0-9.,]/;
    return validar(e, patron);
}

function letras(e)
{ 
    patron = /^[A-Za-z\_\-\.\s\xF1\xD1]+$/;
    return validar(e, patron);
}

function alpha(e)
{ 
    patron = /^[0-9A-Za-z\.\,\_\-\.\s\xF1\xD1]+$/;
    return validar(e, patron);
}