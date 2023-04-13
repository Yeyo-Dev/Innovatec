function gaugeRT(){
  fetch('../dataRT.php')
          .then(response => response.json())
          .then(data => {
            data = data[0];
            let corriente = parseFloat(data.Corriente);
            let potencia = parseFloat(data.Potencia);
           
            updateGauge(corriente, potencia);
            document.getElementById("corriente-text").innerHTML =  `Corriente: ${corriente} V`;
            document.getElementById("potencia-text").innerHTML =  `Potencia: ${potencia} Watts`;
          })
          .catch(error => console.error(error));
}
const updateGauge = (corriente, potencia) =>{
  var opts = {
      angle: -0.13, // The span of the gauge arc
      lineWidth: 0.33, // The line thickness
      radiusScale: 1, // Relative radius
      pointer: {
        length: 0.6, // // Relative to gauge radius
        strokeWidth: 0.031, // The thickness
        color: '#FFFFFC' // Fill color
      },
      limitMax: false,     // If false, max value increases automatically if value > maxValue
      limitMin: false,     // If true, the min value of the gauge will be fixed
      colorStart: '#FFCD56',   // Colors
      colorStop: '#FFCD56',    // just experiment with them
      strokeColor: '#002222',  // to see which ones work best for you
      generateGradient: true,
      highDpiSupport: true,     // High resolution support
      
    };

    var opts2 = {
      angle: -0.13, // The span of the gauge arc
      lineWidth: 0.33, // The line thickness
      radiusScale: 1, // Relative radius
      pointer: {
        length: 0.6, // // Relative to gauge radius
        strokeWidth: 0.031, // The thickness
        color: '#FFFFFC' // Fill color
      },
      limitMax: false,     // If false, max value increases automatically if value > maxValue
      limitMin: false,     // If true, the min value of the gauge will be fixed
      colorStart: '#36A2EB',   // Colors
      colorStop: '#36A2EB',    // just experiment with them
      strokeColor: '#002222',  // to see which ones work best for you
      generateGradient: true,
      highDpiSupport: true,     // High resolution support
      
    };
    var target = document.getElementById('gauge-corriente'); // your canvas element
    //var co = new Gauge(target).setOptions(opts); // create sexy gauge!
    var target2 = document.getElementById('gauge-potencia'); // your canvas element
    
    var co = new Gauge(target).setOptions(opts); // create sexy gauge!
    co.maxValue = 30; // set max gauge value
    co.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    co.animationSpeed = 23; // set animation speed (32 is default value)
    co.set(corriente); // set actual value
    
    var po = new Gauge(target2).setOptions(opts2); // create sexy gauge!
    po.maxValue = 300; // set max gauge value
    po.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    po.animationSpeed = 23; // set animation speed (32 is default value)
    po.set(potencia); // set actual value
}
gaugeRT();