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