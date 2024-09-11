
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body style="height:100vh;">
{{-- 
    <input style="font-size: 8pt"   type="text" id="testTag">



<form action="/insertTag" method="POST">
@csrf

<input type="text" name="tagname">
<input type="submit" value="ok">

</form> --}}




<input onfocus="newInput(this)" style="width: 600px" id="inpoy" onkeydown="stopBracketing(event,this)" onkeyup="onkeyUp(event,this)" type="text" name="" >
<br>

<input onfocus="newInput(this)" style="width: 600px" id="inpox" onkeydown="stopBracketing(event,this)" onkeyup="onkeyUp(event,this)" type="text" name="" >





<a href="/toTestGet">Hey</a>

       {{-- <script  src="{{asset('js/tags.js')}}"></script> --}}
       <script  src="{{asset('js/tests.js')}}"></script>

<script>

</script>



</body>
</html>

