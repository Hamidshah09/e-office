let officers_obj = {};
for (let x in officers) {
    // console.log();
    officers_obj[officers[x]["addressee_name"]] = officers[x]["designation_id"];
    var newElement = document.createElement("a");
    newElement.classList.add("searched-values");
    var newText = document.createTextNode(officers[x]["addressee_name"]);
    newElement.appendChild(newText);
    document.getElementById("myDropdown").appendChild(newElement);
}
officer_names = Object.keys(officers_obj);
officer_desig = Object.values(officers_obj);

document.getElementById("myInput").addEventListener("blur", () => {
    delay_removeclass();
});
document.getElementById("myInput").addEventListener("focus", () => {
    document.getElementById("myDropdown").classList.add("show");
});

function removeClass() {
    document.getElementById("myDropdown").classList.remove("show");
}

function delay_removeclass() {
    // document.getElementById("myDropdown").classList.remove("show");
    setTimeout(() => {
        document.getElementById("myDropdown").classList.remove("show");
    }, 300);
}
var links = document.getElementsByClassName("searched-values");
var designation_select = document.getElementById("designation_id");

designation_select.addEventListener("input", (event) => {
    console.log(designation_select.value);
    for (var i = 0; i < officer_names.length; i++) {
        if (designation_select.value == officer_desig[i]) {
            document.getElementById("myInput").value = officer_names[i];
            break;
        }
    }
});

for (var i = 0; i < links.length; i++) {
    links[i].addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default action
        document.getElementById("myInput").value = this.innerText;
        designation_select.value = officers_obj[this.innerText];

        delay_removeclass();
    });
}
var select_count = -1;
document.getElementById("myInput").addEventListener("keyup", function (event) {
    var input, filter, div, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByClassName("searched-values");

    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
});
