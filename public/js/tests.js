var openBracketIndex = 0 , closeBracketIndex = 0 ;
 var searchEnabled = false ;
var tagsArr = [];
var alltags = new Set(tagsArr) ;
var template = document.createElement("ul");
template =`<ul></ul>`;


function getTags() {
    
    $.ajax({
        url: "/getTags",
        type: "GET",
        dataType: "json",
        success: function (data) {
            data.tags.forEach((element) => {
                tagsArr.push(element.name);
            });
             alltags = new Set(tagsArr);
       //----------------------------------------
        },
    });
    }
    getTags()




function onkeyUp(e,input) {

const lastTypedChar = input.value[input.selectionEnd -1]
if (lastTypedChar == "[") {
    searchEnabled = true;
    openBracketIndex = input.selectionEnd-1
}

if (lastTypedChar == "]") {
    searchEnabled = false;
    closeBracketIndex  = input.selectionEnd
}



if ( searchEnabled == true) {
    if (!( e.which <= 40 && e.which >=37) ) {
      
        startSearching(input,input.value,openBracketIndex,input.selectionEnd) 
    } 
}

if (input.value == "") {
    destroy()
}

}



function startSearching(input,val,startIndex,endIndex){
 //console.log(val.slice(startIndex +1,endIndex));
destroy();
 var filtredTags = [];
 alltags.forEach(function (value) {          
     if (value.includes(val.slice(startIndex +1,endIndex).toUpperCase())) {
         //recheck ythis one
         filtredTags.push(value);
     }
 });
 return build(new Set(filtredTags),input); 

}


function stopBracketing(e,input) {
const lastTypedChar = input.value[input.selectionEnd - 1] ;
    if (e.code == "Digit5" && searchEnabled == true ) {
        e.preventDefault()
    }
    
if (e.code =="Backspace") {
    
    if ( lastTypedChar == "]") {
    
        console.log("-----------------------------------------------------");
        for (let index = input.selectionEnd-2; index >= 0 ; index--) {
         //   console.log(index);
            if (input.value[index] == "[" ) {
                openBracketIndex = index ;
                searchEnabled = true;
                break;
            }
            else if (input.value[index] == "]" ) 
            {
                searchEnabled = false;
                break;
            }
            else{
                searchEnabled = false;
            }
        }
    }
    
    if (lastTypedChar == "[") {
        searchEnabled = false;
    }
    
    
    }
    
    
}

function build(Mcontent,input) {
    const rect = input.getBoundingClientRect();
    console.log(rect.left);
    var listContainer = document.createElement("div");
    listContainer.setAttribute("id","taglistContainer");
    listContainer.style.zIndex = 1111111;
    listContainer.style.position = "absolute"
    listContainer.style.background = "white"
    listContainer.style.top = rect.top  +rect.height + "px"
    if ( rect.left + window.scrollX + (input.selectionEnd * 8) > rect.left +  window.scrollX + rect.width) {
        listContainer.style.left =(rect.left + rect.width - 70) + "px";
    } else {
        console.log("else :" + (rect.left + window.scrollX + (input.selectionEnd  * 8)));
        listContainer.style.left = rect.left + window.scrollX + (input.selectionEnd * 8)+"px"
    }
    listContainer.style.boxShadow = "-2px -1px 45px 10px rgba(133,127,127,0.26)";
    listContainer.style.webkitBoxShadow =  "-2px -1px 45px 10px rgba(133,127,127,0.26)";
    listContainer.style.padding = "0px"; 

    var list  = document.createElement("ul");
    list.style.fontSize= "10pt";
    list.style.listStyle = "none";
    list.style.padding = "0px";
    list.setAttribute("id","taglist");
    Mcontent.forEach(function (value) {
    var listeitem = document.createElement("li")
    listeitem.append(value)
    listeitem.setAttribute("onmousedown", "onItemClick('"+value+"','" + input.getAttribute("id") + "' )")
    listeitem.setAttribute("onmouseover", "onHover(this)")
    listeitem.setAttribute("onmouseleave", "onLeave(this)")
    listeitem.setAttribute("onkeyup", "onEnterClick()")
    listeitem.style.cursor = "pointer"
    listeitem.style.padding = "5px";
    list.append(listeitem) 

    });
    listContainer.append(list)
    var parent = document.getElementById("main");
    document.body.append(listContainer) ;
}


function typeInTextarea(newText, el ) {
    const [start, end] = [el.selectionStart, el.selectionEnd];
    if (el != "undefined") {
        el.setRangeText(newText, start, end , 'select');
    }
   
  }

  function onHover(li) {
  
    li.style.background = "rgba(30,140,200,0.5)";
    top
}
function onLeave(li) {
    li.style.background = "none";
}
function onItemClick(text,inputId) {
    const input = document.getElementById(inputId);
    const selectionStart =   input.selectionStart+text.length + 2;
    const selectionEnd =   input.selectionEnd + text.length + 2;
    var indexsarr = [];
  //  const slicedText =  document.getElementById(input).value.slice(0,openBracketIndex);
  for (let index = input.selectionEnd-1; index >= 0 ; index--) {
      indexsarr.push(index) ;
      if (input.value[index] == "[" ) {
          indexsarr.push(index) ;
          break;
      }}
    typeInTextarea( "["+text+"]" ,input)
        input.value =  removeTypedTag(input.value,new Set(indexsarr));
    destroy() ;
    reset();
    $(document).ready(function () {
        input.focus();
        input.selectionStart = selectionStart;
        input.selectionEnd = selectionEnd;
    });
    }
function destroy() {
    var taglist = document.getElementById("taglistContainer");
    if (taglist != null) {
       taglist.remove();
    }}


function reset() {
openBracketIndex = 0;
closeBracketIndex = 0 ;
 searchEnabled = false ;
}


function newInput(input) {
    openBracketIndex = 0;
    closeBracketIndex = 0 ;
    destroy()
    countOpenBracket = 0;
    countCloseBracket = 0;
    for (let index = 0; index < input.value.length; index++) {
        console.log();
        if (input.value[index] == "[") {
            countOpenBracket++;
        } 
        else if (input.value[index] == "]") {
            countCloseBracket++;
        }
        else{

        }
    }

    console.log(countOpenBracket);
    console.log(countCloseBracket);
    if (countCloseBracket >= countOpenBracket) {
        searchEnabled = false ;
    } else {
        searchEnabled = true ;
    }



}


function removeTypedTag(value , indexsArr) {
    
    var valToarr = value.split("");
    for (let index = 0; index < valToarr.length; index++){
         
        if (indexsArr.has(index)) {       
            valToarr[index] = "";
        }
          
    }
            console.log(valToarr.join(''));
        return valToarr.join('');

}
