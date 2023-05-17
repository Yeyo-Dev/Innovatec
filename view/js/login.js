let form = document.getElementById('FRMLogin');//se guardan los datos del form en una variable

form.addEventListener('submit',function(e) {//click en submit
    e.preventDefault();//para evitar que se racargue la pagina
    
    let data = new FormData(form);//se guarda la informacion del form
    fetch("../login.php",{//conectar con el php, se escribe por que metodo se envian los datos
        method:"POST",
        body: data
    })
    .then((res) =>{
        res = res.text();//convierte la respuesta a texto
        if(res=='Contraseña incorrecta.' || res=='Usuario no encontrado'){
            alert(res);

        }
    })
});