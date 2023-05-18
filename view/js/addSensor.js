function add(){
const { value: id } = Swal.fire({
    title: 'Add Sensor',
    text: "Escriba el id del sensor que desea agregar",
    //showCancelButton: true,
    //cancelButtonColor: '#d33',
    input: 'text',
    //inputLabel: 'Sensor: ',
    inputPlaceholder: 'ID',
    inputAttributes: {
        maxlength: 35,
        autocapitalize: 'off',
        autocorrect: 'off'
    }
  }).then((result) => {
    //console.log(result);
    let sensor = result.value;
    //console.log(sensor);
    if (!sensor == "") {
        let data = new FormData();
        data.append('idsensor',sensor);
        fetch('../addSensor.php',{
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then((res)=>{
            Swal.fire(res);
        })
        .catch((err)=>{ 
            console.log(err);   

        });        
    }
  })
}