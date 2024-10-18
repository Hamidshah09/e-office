var dataTable = document.getElementById("table-body");
function display_records(data_obj) {
    data_obj.forEach(function (item) {
        var row = dataTable.insertRow();
        var cell1 = row.insertCell();
        var cell2 = row.insertCell();
        var cell3 = row.insertCell();
        cell1.innerText = item["id"];
        cell2.innerText = item["file_no"];
        cell3.innerText = item["file_subject"];
        row.addEventListener("click", function (event) {
            var rows = document.getElementsByTagName("tr");
            for (var x = 0; x < rows.length; x++) {
                rows[x].classList.remove("table-active");
            }
            this.classList.add("table-active");
            id = this.firstElementChild.innerText;
        });
    });
}

display_records(files_data);
var id = 0;
var rows = document.getElementsByTagName("tr");
for (var i = 0; i < rows.length; i++) {
    rows[i].addEventListener("click", function (event) {
        var rows = document.getElementsByTagName("tr");
        for (var x = 0; x < rows.length; x++) {
            rows[x].classList.remove("table-active");
        }
        this.classList.add("table-active");
        id = this.firstElementChild.innerText;
    });
}

function search() {
    var search_in = document.getElementById("search-type").value;
    found_records = [];
    var searchvalue = document.getElementById("search").value;
    files_data.forEach((record) => {
        if (
            record[search_in].toLowerCase().includes(searchvalue.toLowerCase())
        ) {
            found_records.push(record);
        }
    });

    var tbody = document.getElementById("data-table");
    for (var i = tbody.rows.length - 1; i > 0; i--) {
        tbody.deleteRow(i);
    }
    display_records(found_records);
}
