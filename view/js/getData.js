
function traerDatos(){
    let id = document.getElementById('idsensor').textContent;
    let data = new FormData();
    data.append('idsensor',id)
    fetch('../mostrar_registros.php',{
        method: 'POST',
        body: data
    })
            .then(response => response.json())
            .then(data => {
                const tabla = document.getElementById('Lecturas');
                
                var filas = tabla.getElementsByTagName("tr");
                for (var i = filas.length - 1; i > 1; i--) {
                    filas[i].remove();
                }
                //console.log(data);
                data.forEach(registro => {
                    
                    let fecha = registro.fecha;
                    let corriente = registro.corriente;
                    let potencia = registro.potencia;
                    let fila = `<tr><td>${fecha}</td><td>${corriente} V</td><td>${potencia} Watts</td></tr>`;
                    tabla.innerHTML += fila;
                });
            })
            .catch(error => console.error(error));
}
traerDatos();
