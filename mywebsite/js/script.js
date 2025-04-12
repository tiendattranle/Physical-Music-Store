function myFunction(x) {
    x.classList.toggle("change");
    let nav = document.getElementById("nav-bar").style
    if (x.classList.contains('change')) {
        nav.display = 'inline-block'
    }
    else {
        nav.display = 'none'
    }
}
function searchFunction() {
    let query = document.getElementById("search-box").value;
    if (query.length < 1) {
        document.getElementById("results").innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?q=" + query, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("results").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function initMap() {
    // Store location coordinates
    var storeLocation = { lat: 10.7721195, lng: 106.6578917 };

    // Initialize Google Map
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: storeLocation,
    });

    // Add marker
    var marker = new google.maps.Marker({
        position: storeLocation,
        map: map,
        title: "143 Record"
    });

    // Info Window
    var infoWindow = new google.maps.InfoWindow({
        content: "<strong>143 Record</strong><br>268 Ly Thuong Kiet, Ward 14, District 10, HCM City"
    });

    marker.addListener("click", function () {
        infoWindow.open(map, marker);
    });
}