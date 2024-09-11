//getining new ids

setInterval(() => {
    $.ajax({
        url: "/fetchidsajax",
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.new == true) {
                location.reload();
            }
        },
    });
}, 60000);

//checking if somoone has a birthday each minute
// setInterval(() => {
//     $.ajax({
//         url: "/greetingCHeck",
//         type: "GET",
//         dataType: "json",
//         success: function (data) {
//             console.log(data.state);
//         },
//     });
// }, 60000);

//filtering tables

function filtrTables(inp, tbl) {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById(inp);
    filter = input.value.toUpperCase();
    table = document.getElementById(tbl);
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query

    if (input.value == "") {
        for (i = 0; i < tr.length; i++) {
            tr[i].style.display = "";
        }
    } else {
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}

// select or diselect each receiver

$(document).on("click", ".select", function () {
    var selection = 0;
    var id = $(this).attr("key");

    if ($(this).prop("checked")) {
        selection = 1;
    } else {
        selection = 0;
    }

    $.ajax({
        url: "/selectreceiver/" + id,
        type: "PUT",
        cache: false,

        data: {
            _token: csrf,
            select: selection,
        },
        success: function (dataResult) {
            dataResult = JSON.parse(dataResult);

            console.log(dataResult.selection);
        },
    });
});
