
    <h3 class="text-center">Add a new employee</h3>
<form action="{{route("saveuser")}}" method="post" class="container mt-xxl-5 mt-xl-5 mt-lg-5 mt-5">
    @csrf
    
<div class="mb-3">
<label for="fullname" class="form-label">Fullname</label>
<input type="text" name="fullname" class="form-control" id="formGroupExampleInput" placeholder="Right the full name here">
</div> 
<div class="mb-3">
    <label for="chatid" class="form-label">Chat id : </label>
    <input type="text" name="chatid" class="form-control" id="chatid" placeholder="Right the chat id here" required aria-required="true">
</div> 
<div class="mb-3">
<button type="submit"  class="btn btn-success">Save</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div> 
</form>
