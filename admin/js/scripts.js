// alert("hi there");  //to test once it works

// ClassicEditor
//     .create( document.querySelector( '#body' ) )
//     .catch( error => {
//         console.error( error );
//     } );


$(document).ready(function(){


//function to scheck all boxes.
  $('#selectAllBoxes').click(function(event){
    if(this.checked){
      $('.checkBoxes').each(function(){
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function(){
        this.checked = false;
      });
    }
  });

//screen loading function (unnecessary and annoying)
  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);
  $('#load-screen').delay(100).fadeOut(300, function(){
    $(this).remove();
  }
)


});
