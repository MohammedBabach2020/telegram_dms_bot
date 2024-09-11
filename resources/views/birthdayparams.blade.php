<h3 class="text-center">Birthday send parameters</h3>
<div   class="row m-0 p-0">
<div class="col-12">
    <h5>Change Message :</h5>
<div class="mb-3">
<label for="message" class="form-label">Text here:</label>

<div class="d-flex col-12">
    <div class="col-10">
        <input  autocomplete="off" onfocus="newInput(this)" onkeydown="stopBracketing(event,this)" onkeyup="onkeyUp(event,this)"  style="max-width:400px;  " id="message" type="text" name="text" class="d-inline inputTag form-control" placeholder="write your text here"  value="{{$birthDaymessage}}"  required>
    </div>
    <div class="col-2 text-center">
        <i class="btn  emojiToggler d-inline fa-regular fa-face-smile"></i>

    </div>
</div>


<div id="" class="shadow emojiContainer  position-absolute col-4" >
    <emoji-picker class="light"  emoji-version="14.0"></emoji-picker>
</div>
</div> 
<div   class="row m-0 p-0">
   
        <h5>When do you want too receive the notification :</h5>
        <div class="col-3">
            <h6>Hours</h6>
            <select  name="hours" id="hours" class="form-control"> 
                @for ($i = 1; $i <10; $i++)      
                @if ($curhour == "0".$i)
                <option  value="0{{$i}}" selected>0{{$i}}</option>
                @else
                <option value="0{{$i}}">0{{$i}}</option>
                @endif 
              
                @endfor
                @for ($i = 10; $i <=12; $i++) 
                @if ($curhour == $i )
                <option value="{{$i}}" selected>{{$i}}</option>
                @else
                <option value="{{$i}}">{{$i}}</option>
                @endif           
                @endfor
            </select>
        </div>
   <div class="col-3">
    <h6>Minutes</h6>
    <select onchange="changeSendingTime()" name="minutes" id="minutes" class="form-control "> 
        @for ($i = 0; $i <10; $i++)       
            @if ($curmin == "0".$i)
            <option value="0{{$i}}" selected>0{{$i}}</option>
            @else
            <option value="0{{$i}}">0{{$i}}</option>
            @endif  
        @endfor
        @for ($i = 10; $i < 60; $i++)  
        @if ($curmin == $i)
        <option value="{{$i}}" selected>{{$i}}</option>
        @else
        <option value="{{$i}}">{{$i}}</option>
        @endif     
        @endfor
    </select>
   </div>
   <div class="col-3">
    <h6>Meridian</h6>
    <select onchange="changeSendingTime()" name="meridian" id="meridian" class="form-control"> 
        @if ($curmeridian == "am")
        <option value="am" selected>AM</option>
        <option value="pm" >PM</option>
        @else
        <option value="pm" selected>PM</option>
        <option value="pm" >AM</option>
        @endif
      
        
      
    </select>
   </div>
 

</div>
</div>
</div>
    <div class="mt-3 ps-3">
      
      
        <a  onclick="changeSendingTime()" type="button" class="btn btn-success" >Save</a>
        <button onclick="destroy()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div> 
        
@section('scripts')
<script>
   


</script>
<script>


</script>









@endsection