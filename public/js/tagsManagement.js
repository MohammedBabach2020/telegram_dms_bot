function addRow() {
    const rows = document.getElementsByClassName("tagsRow");
    var id = 0;
    if (rows.length > 0) {
        id = rows.length;
    }

    const row = document.createElement("div");
    row.classList.add("row");
    row.classList.add("tagsRow");
    row.classList.add("py-2");
    row.innerHTML =
        `


    <div class="col-2">
    <input   onblur="isExist(this)" oninput = "alwaysUppercase(this)"  onkeydown="onlyAlphabet(event)" type="text" class="form-control">
    </div>
    <div class="col-8">
     <input id="tagval` +
        id +
        `" autocomplete="off"   onfocus="newInput(this)" onkeydown="stopBracketing(event,this)" onkeyup="onkeyUp(event,this)"    onblur="insertVal(this)"  type="text" class="form-control">
    </div>
    <div class="col-2 d-flex justify-content-center align-items-center">
    <button onclick="removeRow(this,this.parentElement.parentElement.getAttribute('tagname'))"  class="  btn btn-danger">remove</button>
    </div>

    `;

    document.getElementById("prtTag").append(row);
}
function removeRow(doc, tag) {
    removeTag(tag);
    doc.parentElement.parentElement.remove();
}

function alwaysUppercase(input) {
    input.value = input.value.toUpperCase();
}
function onlyAlphabet(e) {
    if (e.which != 8 && (e.which < 65 || e.which > 90)) {
        e.preventDefault();
    } else {
        e.key = e.key.toUpperCase();
    }
}

function isExist(input) {
    var notfound = false;
    alltags.forEach(function (value) {
        if (value == input.value) {
            alert("this tag is predefined u need to change it");
            input.value = "";
            notfound = false;
        } else {
            notfound = true;
        }
    });

    if (notfound == true) {
        insertTag(input);
        getTags();
        input.parentElement.parentElement.setAttribute("tagname", input.value);
    }
}

function insertTag(input) {
    if (input.value != "") {
        $.ajax({
            url: "/insertTag",
            type: "POST",
            cache: false,
            data: {
                _token: csrf,
                tagname: input.value,
            },
            success: function (dataResult) {},
        });
    }
}

function insertVal(input) {
    if (input.parentElement.parentElement.getAttribute("tagname") != "") {
        $.ajax({
            url:
                "/updateTagVal/" +
                input.parentElement.parentElement.getAttribute("tagname"),
            type: "PUT",
            cache: false,
            data: {
                _token: csrf,
                tagvalue: input.value,
            },
            success: function (dataResult) {},
        });
    }

    reset();
}

function removeTag(tag) {
    if (tag != "") {
        $.ajax({
            url: "/deleteTag/" + tag,
            type: "DELETE",
            cache: false,
            data: {
                _token: csrf,
            },
            success: function (dataResult) {},
        });

        getTags();
    }
}
