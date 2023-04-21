//global variables
var map1 = document.getElementById("map1")
var map2 = document.getElementById("map2")
var map3 = document.getElementById("map3")
var nav1 = document.getElementById("nav1")
var nav2 = document.getElementById("nav2")
var nav3 = document.getElementById("nav3")
var formSearch = document.getElementById("formSearch")

currentMap = 1

function init() {

    render()

    nav1.addEventListener("click", (e) => {
        currentMap = 1
        render()
    })

    nav2.addEventListener("click", (e) => {
        currentMap = 2
        render()
    })

    nav3.addEventListener("click", (e) => {
        currentMap = 3
        render()
    })

    formSearch.addEventListener("submit", (e) => {
        e.preventDefault()
        const formData = new FormData(e.target);
        const formProps = Object.fromEntries(formData);

        console.log({ data: formProps })
    })

}

function render() {
    currentMap == 1 ? map1.style.display = "block" : map1.style.display = "none"
    currentMap == 2 ? map2.style.display = "block" : map2.style.display = "none"
    currentMap == 3 ? map3.style.display = "block" : map3.style.display = "none"

    leafLet()
}

function leafLet() {
    var map = L.map('map' + currentMap).setView([52, -3], 8);
    //OSM layer
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map)


    var rootUrl = 'http://localhost:8080/geoserver/ne/ows';

    var defaultParameters = {
        service: 'WFS',
        version: '1.0.0',
        request: 'GetFeature',
        typeName: 'ne:national_parks_august_2016_full_clipped_boundaries_in_great_bri',
        maxFeatures: 200,
        outputFormat: 'text/javascript',
        format_options: 'callback: getJson',
        srsName: 'EPSG:4326'

    };

    var parameters = L.Util.extend(defaultParameters);

    $.ajax({
        jsonp: false,
        url: rootUrl + L.Util.getParamString(parameters),
        dataType: 'jsonp',
        jsonpCallback: 'getJson',
        success: handleJson
    });


    var group = new L.featureGroup().addTo(map);
    var geojsonlayer;
    function handleJson(data) {
        console.log({ data })
        geojsonlayer = L.geoJson(data, {
            style: function (feature) {
                return { color: '#e75025' };
            }
        }).addTo(group);
        map.fitBounds(group.getBounds());
    }



    function getJson(data) {
        console.log("callback function fired");
    }



}

init()
