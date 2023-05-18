
    fetch("../sesion.php")
    .then((res)=>{
        return res.text();
    })
    .then((res1)=>{
        console.log(res1)
        if (res1 == 'true') {
            window.location.href = "./Home.php";       
        }else if(res1 == 'error'){
            console.log("error");
        }
    })
    .catch((err)=>{ 
        console.log(err);
    });