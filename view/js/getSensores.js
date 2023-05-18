function getSensores() {
    
    fetch('../getSensores.php')//conectar con el php, se escribe por que metodo se envian los datos
    .then(res => res.json())
    .then(data =>{
    console.log(data);
    
    data.forEach(sensor=> {
        let id = sensor.id_sensor;
        console.log(id);
        document.getElementById('botones').insertAdjacentHTML('beforeend',
        `<a href="./lecturas.php?id=${id}"><div class="btn">${id}
        <a href="#"><img src="img/sensor-icon.png" alt=""></a>
        </div></a>`
        )
    })
    })
    .catch(e => console.log(e));
}
getSensores();