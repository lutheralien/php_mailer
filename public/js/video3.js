document.addEventListener('DOMContentLoaded', (ev)=>{
    let form = document.getElementById('myform');
    //get the captured media file
    let input3 = document.getElementById('capture3');
    input3.addEventListener('change', (ev)=>{
        console.dir( input3.files[0] );
        if(input3.files[0].type.indexOf("image/") > -1){
            let img3 = document.getElementById('img3');
            img3.src = window.URL.createObjectURL(input3.files[0]);
        }
    
        
    })
    
  })