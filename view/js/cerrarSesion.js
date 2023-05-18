function exitSystem(){
    Swal.fire({
        title: '¿Estas seguro de querer salir del sistema?',
        text: "Se cerrara su sesion",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.isConfirmed) {
            fetch('../closeSession.php')
            .then(()=>{
                history.go(0);
            })
            .catch((err)=>{ 
                console.log(err);   
    
            });        
        }
      })
}