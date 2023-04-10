function traerDatos(){
    fetch('../mostrar_registros.php')
            .then(response => response.json())
            .then(data => {
                const tabla = document.getElementById('Lecturas');
                
                var filas = tabla.getElementsByTagName("tr");
                for (var i = filas.length - 1; i > 1; i--) {
                    filas[i].remove();
                }

                data.forEach(registro => {
                    
                    let fecha = registro.Fecha;
                    let corriente = registro.Corriente;
                    let potencia = registro.Potencia;
                    let fila = `<tr><td>${fecha}</td><td>${corriente} V</td><td>${potencia} Watts</td></tr>`;
                    tabla.innerHTML += fila;
                });
            })
            .catch(error => console.error(error));
}
traerDatos();