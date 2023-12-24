function mostrarDatos(){
    let nombre = document.getElementById('nombre').value;
    let primerApellido = document.getElementById('primer_apellido').value;
    let segundoApellido = document.getElementById('segundo_apellido').value;
    let rfc = document.getElementById('rfc').value;
    let departamento = document.getElementById('departamento_id').selectedOptions[0].text;
    
    return confirm(" Estas seguro de guardar los siguientes datos Ingresados:? Nombre ["+nombre+"-"+primerApellido+"-"+segundoApellido+"] "+"RFC["+rfc+"] "+"Departamento["+departamento+"]");

}