var template = document.createElement("ul");
template = `<ul></ul>`;
var tagsArr = [];
var alltags;
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

var inp = "";
function rese(params) {
    search(params, "input");
}

var start = false;
var searchText = "";

function search(e, input) {
    destroy();
    if (e.code == "Digit5") {
        start = true;
    }
    if (e.code == "Minus") {
        if (start == false) {
            start == true;
        } else {
            start == false;
            destroy();
        }
        searchText = "";
        start = false;
        destroy();
    }
    if (e.code == "Backspace") {
        if (!input.value.includes("[")) {
            start = false;
            destroy();
        } else {
            analyseText(input.value);
        }
    }

    if (start == true) {
        searchText = analyseText(input.value).toUpperCase().replace("[", "");
        console.log(searchText);
        var filtredTags = [];
        alltags.forEach(function (value) {
            if (value.includes(searchText)) {
                //recheck ythis one
                filtredTags.push(value);
            }
        });

        return build(new Set(filtredTags), input);
    }
}

function build(Mcontent, input) {
    const rect = input.getBoundingClientRect();
    var listContainer = document.createElement("div");
    listContainer.setAttribute("id", "taglistContainer");
    listContainer.style.zIndex = 1111;
    listContainer.style.position = "absolute";
    listContainer.style.top = rect.top + rect.height + "px";
    listContainer.style.left =
        rect.left + window.scrollX + input.value.length * 5 + "px";
    listContainer.style.boxShadow =
        "-2px -1px 45px 10px rgba(133,127,127,0.26)";
    listContainer.style.webkitBoxShadow =
        "-2px -1px 45px 10px rgba(133,127,127,0.26)";
    listContainer.style.padding = "0px";

    var list = document.createElement("ul");
    list.style.fontSize = "8pt";
    list.style.listStyle = "none";
    list.style.padding = "0px";
    list.setAttribute("id", "taglist");
    Mcontent.forEach(function (value) {
        var listeitem = document.createElement("li");
        listeitem.append(value);
        listeitem.setAttribute(
            "onmousedown",
            "onItemClick('" + value + "','" + input.getAttribute("id") + "' )"
        );
        listeitem.setAttribute("onmouseover", "onHover(this)");
        listeitem.setAttribute("onmouseleave", "onLeave(this)");
        listeitem.setAttribute("onkeyup", "onEnterClick()");
        listeitem.style.cursor = "pointer";
        listeitem.style.padding = "5px";
        list.append(listeitem);
    });
    listContainer.append(list);
    var body = document.getElementsByTagName("body")[0];
    body.append(listContainer);
}

function destroy() {
    var taglist = document.getElementById("taglistContainer");
    if (taglist != null) {
        taglist.remove();
        document.getElementById("testTag").focus();
    }
}

function analyseText(text) {
    if (text != null) {
        var arr = text.split(" ");
        for (const a of arr) {
            if (a.startsWith("[") && a.endsWith("]")) {
                console.log("perfecto");
            } else if (a.startsWith("[") && !a.endsWith("]")) {
                console.log("U forget a none closed tag");
            } else {
            }
        }
        if (
            arr[arr.length - 1].startsWith("[") &&
            !arr[arr.length - 1].endsWith("]")
        ) {
            start = true;
            return arr[arr.length - 1];
        }
    }
}

//------ items eventts

function typeInTextarea(newText, el) {
    const [start, end] = [el.selectionStart, el.selectionEnd];
    el.setRangeText(newText, start, end, "select");
}

function onEnterClick(e, input, text) {}

function onHover(li) {
    li.style.background = "rgba(30,140,200,0.5)";
}
function onLeave(li) {
    li.style.background = "none";
}

function onItemClick(text, input) {
    document.activeElement.value = document.activeElement.value.replace(
        analyseText(document.activeElement.value),
        ""
    );
    typeInTextarea("[" + text + "]", document.activeElement);
    destroy();
    start = false;
    document.getElementById("testTag").focus();
}
