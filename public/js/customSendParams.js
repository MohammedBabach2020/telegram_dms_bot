// saving msg by ajax
const typer = document.getElementById('typer');
function handleKeyPress(e) {
  window.clearTimeout(500);
//'Typing...';
}

function handleKeyUp(e) {
  window.clearTimeout(500); // prevent errant multiple timeouts from being generated
  timer = window.setTimeout(() => {
    updateCustomParameters();
  }, 500);
}
// typer.addEventListener('keypress', handleKeyPress);
// // triggers a check to see if the user is actually done typing
// typer.addEventListener('keyup', handleKeyUp);


// updating image via ajax after convrting it to base64 string
 
var imgurl ="" ;
var Currenimg =document.getElementById("showing").src ;
var saveClicked = false ; 
function reloadImage() {
  if (saveClicked == false ) {
    $("#showing").attr("src",  Currenimg);
  }
  
}

function updateCustomParameters() {
  saveClicked = true;
  $.ajax({
    url: "/textedit/2",
    type: "PUT",
    cache: false,
    data:{
    _token:csrf,
    txt:  typer.value
    },
    success: function(dataResult){

    }
    });

    if (imgurl == "") {
      imgurl = Currenimg;
    }
      $.ajax({
        url: "/modifyImage/2",
        type: "PUT",
        cache: false,
        data:{
        _token:csrf,
        url:  imgurl
        
        },
        success: function(dataResult){
   //   console.log(dataResult.errorMessage);
        }

        });
  

  
}




function changeImage() {
    var element =  document.getElementById("pic");
    let file = element.files[0];
    let reader = new FileReader();
    reader.onloadend = function() {
     $("#showing").attr("src",  reader.result);
     imgurl =  reader.result;
  
    }
    reader.readAsDataURL(file)
  }

// switching send type with or without Image
var type = "";
if ($("#flexSwitchCheckDefault").is(":checked")) {
    $( "#imgStub" ).fadeIn();
    
} else {
    $( "#imgStub" ).fadeOut();
}
 $("#flexSwitchCheckDefault").change(function() {

if ($("#flexSwitchCheckDefault").is(":checked")) {
    $( "#imgStub" ).fadeIn();
    type="pic"; 
} else {
    $( "#imgStub" ).fadeOut();
    type="txt";
}
$.ajax({
url: "/sendtype/3",
type: "PUT",
cache: false,
data:{
  _token:csrf,
  type:type
},
success: function(dataResult){

}
});
 // $( ".target" ).change();
});