<h3 class="text-center">Custom send parameters</h3>
<div   class="row m-0 p-0">
<div class="col-12">
    <h5>Change Message :</h5>
<div class="mb-3">
<label for="text" class="form-label">Text here:</label>
<div class="d-flex col-12" >
    <div class="col-10">
        <input  autocomplete="off"  style="max-width:400px;" onfocus="newInput(this)" onkeydown="stopBracketing(event,this)" onkeyup="onkeyUp(event,this)"    id="typer" type="text" name="text" class="d-inline inputTag form-control" placeholder="write your text here"  value="{{$message}}"  required>
    </div>
    <div class="col-2  text-center">
        <i  class="btn  emojiToggler d-inline fa-regular fa-face-smile"></i>

    </div>
</div>


<div id="" class="shadow emojiContainer  position-absolute col-4" >
    <emoji-picker class="light"  emoji-version="14.0"></emoji-picker>
</div>
</div>    
<div class="mt-2">

    <label for="">Send with picture ?</label>
</div>
<div class="form-check form-switch">
   
    @if ( $type=="pic")
    <input checked  class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
    @else
    <input   class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
    @endif

  
 </div>
</div>
</div>
<div  id="imgStub" class="row m-0 p-0">
    <div class="col-12">
        <h5>Change picture :</h5>
    <label class="btn btn-primary col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-8 col-8 text-light p-3 mt-2"  for="pic"><i class="fa-solid fa-image"></i></label>
     <input  onchange="changeImage()"  hidden  type="file" name="image" id="pic">
    <img class="mt-2" src="{{$img}}" alt="" srcset="" id="showing">
    </div>
    </div>

    <div class="mt-3 ps-3">
        {{--    
        <button type="submit"  class="btn btn-success">Save</button> --}}
    
        <a  onclick="updateCustomParameters()" type="button" class="btn btn-success" >Save</a>
        <button onclick="reloadImage()"  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
