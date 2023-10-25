document.addEventListener('DOMContentLoaded', (ev)=>{
  let form = document.getElementById('myform');
  //get the captured media file
  let input = document.getElementById('capture');
  
  input.addEventListener('change', (ev)=>{
      console.dir( input.files[0] );
      if(input.files[0].type.indexOf("image/") > -1){
          let img = document.getElementById('img');
          img.src = window.URL.createObjectURL(input.files[0]);
      }
      
      else if(input.files[0].type.indexOf("audio/") > -1 ){
          let audio = document.getElementById('audio');
          audio.src = window.URL.createObjectURL(input.files[0]);
      }
      else if(input.files[0].type.indexOf("video/") > -1 ){
          let video = document.getElementById('video');
          video.src=window.URL.createObjectURL(input.files[0]);
      }
      
      
  })
  
})