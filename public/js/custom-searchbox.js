function preparelist() {
    let countries = [
        "Afganganistan",
        "Algeria",
        "Argentina",
        "Australia",
        "Bangladesh",
        "Belgium",
        "Bhutan",
        "Brazil",
        "Canada",
        "China",
        "Denmark",
        "Ethiopia",
        "Finland",
        "France",
        "Germany",
        "Hungry",
        "Iceland",
        "India",
        "Indonesia",
        "Iran",
        "Italy",
        "Japan",
        "Malaysia",
        "Maldives",
        "Mexico",
        "Morocco",
        "Nepal",
        "Netherlands",
        "Nigeria",
        "Norway",
        "Pakistan",
        "Peru",
        "Russia",
        "Romania",
        "South Africa",
        "Spain",
        "Sri Lanka",
        "Sweden",
        "Switzerland",
        "Thailand",
        "Turkey",
        "Uganda",
        "Ukraine",
        "United States",
        "United Kingdom",
        "Vietnam",
    ];
    countries.forEach((item) => {
        var newElement = document.createElement("a");
        newElement.classList.add("searched-values");
        var newText = document.createTextNode(item);
        newElement.appendChild(newText);
        document.getElementById("myDropdown").appendChild(newElement);
    });
}
preparelist();
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
    }, 100);
}
var links = document.getElementsByClassName("searched-values");

for (var i = 0; i < links.length; i++) {
    links[i].addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default action
        document.getElementById("myInput").value = this.innerText;
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
