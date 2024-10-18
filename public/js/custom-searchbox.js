let officers_obj = {};
for (let x in officers) {
    // console.log();
    officers_obj[officers[x]["addressee_name"]] = officers[x]["designation"];
    var newElement = document.createElement("a");
    newElement.classList.add("searched-values");
    var newText = document.createTextNode(officers[x]["addressee_name"]);
    newElement.appendChild(newText);
    document.getElementById("myDropdown").appendChild(newElement);
}

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
    for (let x in officers) {
        console.log(designation_select.value, officers[x]["id"]);
        if (designation_select.value == officers[x]["id"]) {
            document.getElementById("myInput").value =
                officers[x]["addressee_name"];
            break;
        }
    }
});
function officer_id(name) {
    for (let x in officers) {
        if (name == officers[x]["addressee_name"]) {
            return officers[x]["id"];
        }
    }
}
for (var i = 0; i < links.length; i++) {
    links[i].addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default action
        document.getElementById("myInput").value = this.innerText;
        designation_select.value = officer_id(this.innerText);
        // console.log(officer_id(this.innerText));

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
