$(document).ready(function (){
    //This line below would hide the div when the page load by default
    $('#load').hide();
  
    //This would display when the user clicks the button
    $('#buttonID').click(function (){
      $('#load').show();
      document.getElementById('bdy').remove()
      
    });
  });