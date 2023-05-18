fetch("../websockets.php")
.then((data)=>{
    console.log(data.text);

})
.catch(error => console.error(error));
try{
    var HOST = location.origin.replace(/^http/, 'ws').replace("/innovatec/view/js/cliente.js","");
    const socket = new WebSocket(`${HOST}:3000`);

    socket.onopen = e =>{
        console.log("Conexion establecida");
        socket.send('Hola, servidor!');
    };

    socket.onmessage= e => {
        console.log('Mensaje recibido desde el servidor:', event.data);
        if(event.data == 'Se actualizó la tabla de lecturas'){
            traerDatos();
            gaugeRT();
        }
    };

    socket.addEventListener('close', function (event) {
        console.log('Conexión cerrada con el servidor');
    });
}catch(e){
    console.error(e);
    setTimeout(() =>{
        //location.reload();
        traerDatos();
        gaugeRT();  
        }, 900);
}