document.addEventListener('DOMContentLoaded', (ev)=>{
    let form = document.getElementById('myform');
    //get the captured media file
    let input2 = document.getElementById('capture2');
    input2.addEventListener('change', (ev)=>{
        console.dir( input2.files[0] );
        if(input2.files[0].type.indexOf("image/") > -1){
            let img2 = document.getElementById('img2');
            img2.src = window.URL.createObjectURL(input2.files[0]);
        }
    
        
    })
    
  })