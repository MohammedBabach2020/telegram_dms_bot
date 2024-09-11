    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300&display=swap" rel="stylesheet">



        <script src="https://kit.fontawesome.com/97e5e75a10.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

        <title>Telegram dms communication</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
    
            font-family: 'Lexend', sans-serif;

        }
  
        @font-face {
          font-family: "MozillaTwemojiColr";
          src: url("https://cdn.jsdelivr.net/npm/twemoji-colr-font@^14/twemoji.woff2") format("woff2");
      }
      emoji-picker {
          --emoji-font-family: "MozillaTwemojiColr" !important;
      }
        #showing{
            max-width: 50px;
            max-height: 50px;
            width: 50px;
            height: 50px;
        }
.navbar{

    background-color: #158cc4;
}
.nav-link{
    cursor: pointer;
color:white;
}
body{
min-height: 100vh;
}
body .container-fluid{
height: 100%;
}
.nav-link:hover{
    cursor: pointer;
color:white;
border-bottom: 2px solid white;
}

.emojiContainer{
    display: none;
}



    </style>
    </head>
    <body id="main"  >


    <?php 
    use Carbon\Carbon;
                        ?>



    
        <nav class="navbar shadow navbar-expand-lg bg-body-tertiary ">
            <div class="container-fluid">
            <a class="navbar-brand" >

                <svg width="110" height="53" viewBox="0 0 110 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g filter="url(#filter0_d_1_12)">
                    <ellipse cx="25.5" cy="25.5" rx="16.5" ry="17.5" fill="url(#paint0_diamond_1_12)"/>
                    </g>
                    <path d="M47.804 30.12C47.156 30.12 46.58 29.984 46.076 29.712C45.58 29.432 45.188 29.052 44.9 28.572C44.62 28.092 44.48 27.54 44.48 26.916C44.48 26.42 44.56 25.968 44.72 25.56C44.88 25.152 45.1 24.8 45.38 24.504C45.668 24.2 46.008 23.968 46.4 23.808C46.8 23.64 47.232 23.556 47.696 23.556C48.104 23.556 48.484 23.636 48.836 23.796C49.188 23.948 49.492 24.16 49.748 24.432C50.012 24.704 50.212 25.028 50.348 25.404C50.492 25.772 50.56 26.176 50.552 26.616L50.54 27.144H45.392L45.116 26.16H49.472L49.292 26.364V26.076C49.268 25.812 49.18 25.576 49.028 25.368C48.876 25.16 48.684 24.996 48.452 24.876C48.22 24.756 47.968 24.696 47.696 24.696C47.264 24.696 46.9 24.78 46.604 24.948C46.308 25.108 46.084 25.348 45.932 25.668C45.78 25.98 45.704 26.368 45.704 26.832C45.704 27.272 45.796 27.656 45.98 27.984C46.164 28.304 46.424 28.552 46.76 28.728C47.096 28.904 47.484 28.992 47.924 28.992C48.236 28.992 48.524 28.94 48.788 28.836C49.06 28.732 49.352 28.544 49.664 28.272L50.288 29.148C50.096 29.34 49.86 29.508 49.58 29.652C49.308 29.796 49.016 29.912 48.704 30C48.4 30.08 48.1 30.12 47.804 30.12ZM51.9193 30V21.12H53.1553V30H51.9193ZM57.7298 30.12C57.0818 30.12 56.5058 29.984 56.0018 29.712C55.5058 29.432 55.1138 29.052 54.8258 28.572C54.5458 28.092 54.4058 27.54 54.4058 26.916C54.4058 26.42 54.4858 25.968 54.6458 25.56C54.8058 25.152 55.0258 24.8 55.3058 24.504C55.5938 24.2 55.9338 23.968 56.3258 23.808C56.7258 23.64 57.1578 23.556 57.6218 23.556C58.0298 23.556 58.4098 23.636 58.7618 23.796C59.1138 23.948 59.4178 24.16 59.6738 24.432C59.9378 24.704 60.1378 25.028 60.2738 25.404C60.4178 25.772 60.4858 26.176 60.4778 26.616L60.4658 27.144H55.3178L55.0418 26.16H59.3978L59.2178 26.364V26.076C59.1938 25.812 59.1058 25.576 58.9538 25.368C58.8018 25.16 58.6098 24.996 58.3778 24.876C58.1458 24.756 57.8938 24.696 57.6218 24.696C57.1898 24.696 56.8258 24.78 56.5298 24.948C56.2338 25.108 56.0098 25.348 55.8578 25.668C55.7058 25.98 55.6298 26.368 55.6298 26.832C55.6298 27.272 55.7218 27.656 55.9058 27.984C56.0898 28.304 56.3498 28.552 56.6858 28.728C57.0218 28.904 57.4098 28.992 57.8498 28.992C58.1618 28.992 58.4498 28.94 58.7138 28.836C58.9858 28.732 59.2778 28.544 59.5898 28.272L60.2138 29.148C60.0218 29.34 59.7858 29.508 59.5058 29.652C59.2338 29.796 58.9418 29.912 58.6298 30C58.3258 30.08 58.0258 30.12 57.7298 30.12ZM64.5824 32.76C64.1344 32.76 63.6864 32.688 63.2384 32.544C62.7984 32.408 62.4424 32.228 62.1704 32.004L62.6264 31.044C62.7864 31.164 62.9744 31.268 63.1904 31.356C63.4064 31.452 63.6344 31.524 63.8744 31.572C64.1144 31.628 64.3504 31.656 64.5824 31.656C65.0224 31.656 65.3904 31.584 65.6864 31.44C65.9824 31.296 66.2064 31.084 66.3584 30.804C66.5104 30.524 66.5864 30.176 66.5864 29.76V28.548L66.7184 28.632C66.6784 28.88 66.5464 29.12 66.3224 29.352C66.1064 29.576 65.8344 29.76 65.5064 29.904C65.1784 30.048 64.8424 30.12 64.4984 30.12C63.8984 30.12 63.3624 29.98 62.8904 29.7C62.4264 29.412 62.0584 29.024 61.7864 28.536C61.5144 28.04 61.3784 27.476 61.3784 26.844C61.3784 26.212 61.5104 25.652 61.7744 25.164C62.0464 24.668 62.4144 24.28 62.8784 24C63.3504 23.712 63.8784 23.568 64.4624 23.568C64.7024 23.568 64.9344 23.6 65.1584 23.664C65.3824 23.72 65.5904 23.804 65.7824 23.916C65.9744 24.02 66.1464 24.136 66.2984 24.264C66.4504 24.392 66.5744 24.528 66.6704 24.672C66.7664 24.816 66.8264 24.952 66.8504 25.08L66.5864 25.176V23.7H67.8224V29.616C67.8224 30.12 67.7464 30.564 67.5944 30.948C67.4504 31.34 67.2384 31.668 66.9584 31.932C66.6784 32.204 66.3384 32.408 65.9384 32.544C65.5384 32.688 65.0864 32.76 64.5824 32.76ZM64.6304 28.98C65.0224 28.98 65.3704 28.888 65.6744 28.704C65.9784 28.52 66.2144 28.268 66.3824 27.948C66.5504 27.628 66.6344 27.26 66.6344 26.844C66.6344 26.428 66.5464 26.06 66.3704 25.74C66.2024 25.412 65.9664 25.156 65.6624 24.972C65.3664 24.788 65.0224 24.696 64.6304 24.696C64.2464 24.696 63.9024 24.792 63.5984 24.984C63.3024 25.168 63.0664 25.424 62.8904 25.752C62.7224 26.072 62.6384 26.436 62.6384 26.844C62.6384 27.252 62.7224 27.62 62.8904 27.948C63.0664 28.268 63.3024 28.52 63.5984 28.704C63.9024 28.888 64.2464 28.98 64.6304 28.98ZM69.5554 30V23.7H70.8034V25.68L70.6834 25.2C70.7714 24.896 70.9194 24.62 71.1274 24.372C71.3434 24.124 71.5874 23.928 71.8594 23.784C72.1394 23.64 72.4274 23.568 72.7234 23.568C72.8594 23.568 72.9874 23.58 73.1074 23.604C73.2354 23.628 73.3354 23.656 73.4074 23.688L73.0834 25.032C72.9874 24.992 72.8794 24.96 72.7594 24.936C72.6474 24.904 72.5354 24.888 72.4234 24.888C72.2074 24.888 71.9994 24.932 71.7994 25.02C71.6074 25.1 71.4354 25.216 71.2834 25.368C71.1394 25.512 71.0234 25.684 70.9354 25.884C70.8474 26.076 70.8034 26.288 70.8034 26.52V30H69.5554ZM76.5497 30.12C76.0297 30.12 75.5537 29.976 75.1217 29.688C74.6977 29.4 74.3577 29.008 74.1017 28.512C73.8457 28.016 73.7177 27.456 73.7177 26.832C73.7177 26.2 73.8457 25.64 74.1017 25.152C74.3657 24.656 74.7177 24.268 75.1577 23.988C75.6057 23.708 76.1057 23.568 76.6577 23.568C76.9857 23.568 77.2857 23.616 77.5577 23.712C77.8297 23.808 78.0657 23.944 78.2657 24.12C78.4737 24.288 78.6417 24.484 78.7697 24.708C78.9057 24.932 78.9897 25.172 79.0217 25.428L78.7457 25.332V23.7H79.9937V30H78.7457V28.5L79.0337 28.416C78.9857 28.632 78.8857 28.844 78.7337 29.052C78.5897 29.252 78.4017 29.432 78.1697 29.592C77.9457 29.752 77.6937 29.88 77.4137 29.976C77.1417 30.072 76.8537 30.12 76.5497 30.12ZM76.8737 28.98C77.2497 28.98 77.5817 28.888 77.8697 28.704C78.1577 28.52 78.3817 28.268 78.5417 27.948C78.7097 27.62 78.7937 27.248 78.7937 26.832C78.7937 26.424 78.7097 26.06 78.5417 25.74C78.3817 25.42 78.1577 25.168 77.8697 24.984C77.5817 24.8 77.2497 24.708 76.8737 24.708C76.5057 24.708 76.1777 24.8 75.8897 24.984C75.6097 25.168 75.3857 25.42 75.2177 25.74C75.0577 26.06 74.9777 26.424 74.9777 26.832C74.9777 27.248 75.0577 27.62 75.2177 27.948C75.3857 28.268 75.6097 28.52 75.8897 28.704C76.1777 28.888 76.5057 28.98 76.8737 28.98ZM81.6955 30V23.7H82.9435V25.044L82.7155 25.188C82.7795 24.98 82.8795 24.78 83.0155 24.588C83.1595 24.396 83.3315 24.228 83.5315 24.084C83.7395 23.932 83.9595 23.812 84.1915 23.724C84.4315 23.636 84.6755 23.592 84.9235 23.592C85.2835 23.592 85.5995 23.652 85.8715 23.772C86.1435 23.892 86.3675 24.072 86.5435 24.312C86.7195 24.552 86.8475 24.852 86.9275 25.212L86.7355 25.164L86.8195 24.96C86.9075 24.776 87.0275 24.604 87.1795 24.444C87.3395 24.276 87.5195 24.128 87.7195 24C87.9195 23.872 88.1315 23.772 88.3555 23.7C88.5795 23.628 88.7995 23.592 89.0155 23.592C89.4875 23.592 89.8755 23.688 90.1795 23.88C90.4915 24.072 90.7235 24.364 90.8755 24.756C91.0355 25.148 91.1155 25.636 91.1155 26.22V30H89.8675V26.292C89.8675 25.932 89.8195 25.64 89.7235 25.416C89.6355 25.184 89.4995 25.012 89.3155 24.9C89.1315 24.788 88.8955 24.732 88.6075 24.732C88.3835 24.732 88.1715 24.772 87.9715 24.852C87.7795 24.924 87.6115 25.028 87.4675 25.164C87.3235 25.3 87.2115 25.46 87.1315 25.644C87.0515 25.82 87.0115 26.016 87.0115 26.232V30H85.7635V26.268C85.7635 25.94 85.7155 25.664 85.6195 25.44C85.5235 25.208 85.3835 25.032 85.1995 24.912C85.0155 24.792 84.7915 24.732 84.5275 24.732C84.3035 24.732 84.0955 24.772 83.9035 24.852C83.7115 24.924 83.5435 25.028 83.3995 25.164C83.2555 25.292 83.1435 25.448 83.0635 25.632C82.9835 25.808 82.9435 26 82.9435 26.208V30H81.6955Z" fill="white"/>
                    <path d="M20.8805 32V19.4H25.9385C26.8505 19.4 27.6725 19.55 28.4045 19.85C29.1485 20.15 29.7845 20.582 30.3125 21.146C30.8525 21.71 31.2605 22.376 31.5365 23.144C31.8245 23.912 31.9685 24.764 31.9685 25.7C31.9685 26.636 31.8245 27.494 31.5365 28.274C31.2605 29.042 30.8585 29.708 30.3305 30.272C29.8025 30.824 29.1665 31.25 28.4225 31.55C27.6785 31.85 26.8505 32 25.9385 32H20.8805ZM23.2205 30.182L23.0405 29.84H25.8485C26.4365 29.84 26.9585 29.744 27.4145 29.552C27.8825 29.36 28.2785 29.084 28.6025 28.724C28.9265 28.364 29.1725 27.932 29.3405 27.428C29.5085 26.912 29.5925 26.336 29.5925 25.7C29.5925 25.064 29.5085 24.494 29.3405 23.99C29.1725 23.474 28.9205 23.036 28.5845 22.676C28.2605 22.316 27.8705 22.04 27.4145 21.848C26.9585 21.656 26.4365 21.56 25.8485 21.56H22.9865L23.2205 21.254V30.182Z" fill="white"/>
                    <defs>
                    <filter id="filter0_d_1_12" x="0" y="0" width="51" height="53" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                    <feOffset dy="1"/>
                    <feGaussianBlur stdDeviation="4.5"/>
                    <feComposite in2="hardAlpha" operator="out"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1_12"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1_12" result="shape"/>
                    </filter>
                    <radialGradient id="paint0_diamond_1_12" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(35.2377 21.3475) rotate(114.215) scale(23.7414 23.1471)">
                    <stop stop-color="#158CC4"/>
                    <stop offset="1" stop-color="#59B6E1"/>
                    </radialGradient>
                    </defs>
                    </svg>

            </a>
           
              <button style="background: none !important; " class="navbar-toggler navbar-toggler-icon justify-content-center  fa-solid fa-bars text-light"   type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#addreceiver">Add new receiver</a>
                  <a class="nav-link" data-bs-toggle="modal" data-bs-target="#addemployee"  >Add new employee</a>
                  <a class="nav-link" data-bs-toggle="modal" data-bs-target="#sendParameters">Custom send parameters</a>
                  <a class="nav-link" data-bs-toggle="modal" data-bs-target="#birthParameters">Birthday message parameters</a>
                 
                </div>
              </div>
            </div>
          </nav>

 
            
          {{-- <h1><a href="/greetingCHeck">Here</a></h1> --}}
    <div class="container-fluid p-3 ">
    <div class="row p-0">
       
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 table-responsive">
            <div class="mb-3">
                <label for="text" class="form-label">Search by name :</label>
                <input onkeyup="filtrTables('searchNameReceiver','tableReceivers')" type="text" id="searchNameReceiver" name="searchNametxt" class="form-control" placeholder="write your text here"  value="" >
            </div>    
    <table class="table table-responsive table-bordred table-dark table-striped caption-top">
        <caption>List of receivers</caption>
    <thead >
    <tr>
    <th>Fullname</th>
    <th>Chat id</th>
    <th>Select</th>
    <th class="text-center">Block</th>
    </tr>
    </thead>
    <tbody id="tableReceivers">
        @foreach ($receivers as $receiver)
    <tr>
    <td>{{$receiver->name}}</td>
    <td>{{$receiver->chat_id}}</td>
    @if ($receiver->selected == 1)
    <td> 
  
    <input key="{{$receiver->id}}" class="select" type="checkbox" checked>
   </td>
    @else
    <td> 
    <input key="{{$receiver->id}}"  class="select" type="checkbox">
    </td>
    @endif
   
    <td>
       <form action="/deletereceiver/{{$receiver->id}}" method="post" class="d-flex justify-content-center">
            @method("PUT")
            @csrf
            <button type="submit" class="btn btn-danger text-light"><i class="fa-solid fa-ban text-light"></i></button>
        </form> 
    </td>
</tr>
        @endforeach
    </tbody>
    </table>
        </div>
     
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 table-responsive">
            
            <div class="mb-3">
                <label for="text" class="form-label">Search by name :</label>
                <input onkeyup="filtrTables('searchNamePerson','tablePersons')" type="text" id="searchNamePerson" name="searchNametxt" class="form-control" placeholder="write your text here"  value="" >
            </div>  
            <table class="table table-responsive table-bordred table-dark table-striped caption-top ">
                <caption>List of empolyees</caption>
            <thead >
            <tr><th>Fullname</th> 
            <th>Birthday</th> 
            <th class="text-center">Delete</th> 
            </tr>
            </thead> 
            <tbody id="tablePersons">
                @foreach ($persons as $person)
            <tr>
            <td> {{$person->fullname}}</td>
            <td> {{Carbon::parse($person->birthday)->format('d/M/Y')}}</td>
            <td>
    <form action="/deleteperson/{{$person->id}}" method="post" class="d-flex justify-content-center">
        @method("DELETE")
        @csrf
        <button type="submit" class="btn btn-danger text-light"><i class="fa-solid fa-trash"></i></button>
    </form>
            </td>
            </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>




<div  class="row p-0">

    <div id="prtTag" class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
<div class="row  px-3">

    <label for="">Tags Management :  <i  onclick="addRow()" class="btn btn-success  p-1 py-1  fas fa-plus"></i></label>
</div> 

@foreach ($tags as $tag)
<div tagname ="{{$tag->name}}"  class="row tagsRow py-2">
    <div class="col-2">
    <input    onblur="isExist(this)"  oninput ="alwaysUppercase(this)"  onkeydown="onlyAlphabet(event)" type="text" class="form-control" value="{{$tag->name}}">
    </div>
    <div class="col-8">
     <input id="tagval{{ $loop->index }}" autocomplete="off" onfocus="newInput(this)" onkeydown="stopBracketing(event,this)" onkeyup="onkeyUp(event,this)"   onblur="insertVal(this)"   tagOrval ="val"   type="text" class="form-control"  value="{{$tag->value}}">
    </div>
    <div class="col-2 d-flex justify-content-center align-items-center">
     <button onclick="removeRow(this,'{{$tag->name}}')"  class="  btn btn-danger">remove</button>
    </div>
 </div>
@endforeach





    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"></div>

</div>

    </div>

   
  
{{-- add receiver modal --}}
  
<div class="modal" id="addreceiver"  data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
         @include('addreceiver')
        </div>
      </div>
    </div>
</div>
{{-- add employee modal --}}
  
<div class="modal" id="addemployee"  data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
         @include('addemployee')
        </div>
      </div>
    </div>
</div>
{{-- custom send parameters modal --}}

<div class="modal" id="sendparameters"  data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body" id="tagsParenter">
         @include('sendparameters')
        </div>
      </div>
    </div>
</div>

{{-- birthday message parameters modal --}}

<div class="modal" id="birthParameters"  data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
         @include('birthdayparams')
        </div>
      </div>
    </div>
</div>


{{-- blocked receivers modal --}}


<div class="modal" id="examplemodal"  tabindex="-1">
    <div class="modal-dialog bg-dark modal-lg " >
      <div class="modal-content">
        <div class="modal-header bg-dark ">
          <h5 class="modal-title text-light">Blocked receivers</h5>
          <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-dark " style="height: 300px !important">
            <div class="table-responsive">

            <table class="table table-responsive table-bordred table-dark table-striped shadow">
                <thead >
                <tr><th>Fullname</th>
                <th>Chat id</th>
                <th class="text-center">Unblock</th></tr></thead>
                <tbody id="tableReceivers">
                    @foreach ($blockedReceivers as $receiver)
                <tr>
                <td>{{$receiver->name}}</td>
                <td>{{$receiver->chat_id}}</td>
                <td><form action="/unblockReceiver/{{$receiver->id}}" method="post" class="d-flex justify-content-center">
                        @method("PUT")
                        @csrf
                        <button type="submit" class="btn btn-success text-light"><i class="fa-solid fa-check"></i></button>
                    </form></td></tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>




<div style="margin: 0 !important;" class="row shadow-lg position-sticky bottom-0  p-2 bg-light" >
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-12  col-12">
        <div class="row p-0 justify-content-xxl-start justify-content-xl-start  justify-content-lg-start justify-content-center ">
          
        <a  href ="/customeMessage" class="btn btn-warning  col-2 m-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-ban text-light"></i></a>
        </div>
    </div>
    <div class="col-xxl-10 col-xl-10 col-lg-9 col-md-8 col-sm-12  col-12">
        <div class="row p-0 justify-content-xxl-end justify-content-xl-end  justify-content-lg-end   justify-content-center  ">

    <a  href ="/customeMessage" class="btn fs-4 col-xxl-1 col-xl-1  col-lg-1 col-md-1 col-sm-4 col-8 m-2"  style="color: #fff;  background:#158cc4;;"> send <i class="fa-brands fa-telegram"></i></a>
</div>
    </div>

    <span id="csrf">@csrf</span>
</div>






<script src="{{asset('js/birthSendParams.js')}}"></script>
<script src="{{asset('js/customSendParams.js')}}"></script>
<script src="{{asset('js/this.js')}}"></script>
<script src="{{asset('js/tagsOnType.js')}}"></script>
<script src="{{asset('js/tagsManagement.js')}}"></script>
 <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script> 
<script type="module" src="{{asset('js/modules.js')}}"></script>


<script>
   
var csrf = $("#csrf input").val();
</script>
{{-- <script  src="{{asset('js/tags.js')}}"></script> --}}
</body>
</html>

