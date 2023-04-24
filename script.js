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

    let map = initMap()

    fetchData({ map, keywords: "" })

    nav1.addEventListener("click", (e) => {
        currentMap = 1
        fetchData({ map, keywords: "" })
    })

    nav2.addEventListener("click", (e) => {
        currentMap = 2
        fetchData({ map, keywords: "" })
    })

    nav3.addEventListener("click", (e) => {
        currentMap = 3
        fetchData({ map, keywords: "" })
    })

    formSearch.addEventListener("submit", (e) => {
        e.preventDefault()
        const formData = new FormData(e.target);
        const formProps = Object.fromEntries(formData);

        fetchData({ map, keywords: formProps.keywords })
    })
}

function render(data = {}) {

    const keywords = data?.keywords


    currentMap == 1 ? map1.style.display = "block" : map1.style.display = "none"
    currentMap == 2 ? map2.style.display = "block" : map2.style.display = "none"
    currentMap == 3 ? map3.style.display = "block" : map3.style.display = "none"

    leafLet(keywords)
}

function fetchData({ map, keywords }) {
    /*
    var nexrad = L.tileLayer.wms("https://ces-gis.southwales.ac.uk:2345/geoserver/s20/wms", {
        layers: 's20:my_hills',
        format: 'image/png',
        transparent: true
    });
    nexrad.addTo(map)
    */



    var rootUrl = 'https://ces-gis.southwales.ac.uk:2345/geoserver/s17/ows';

    var defaultParameters = {
        service: 'WFS',
        version: '1.0.0',
        request: 'GetFeature',
        typeName: 's17:nationalparkswales',
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
        geojsonlayer = L.geoJson(data, {
            style: function (feature) {
                let NP_NAME = feature.properties?.NP_NAME?.toString()

                if (keywords && NP_NAME && NP_NAME.toLowerCase().includes(keywords?.toLowerCase())) {

                    return { color: '#e75025' };
                }
            },
            onEachFeature: function (feature, layer) {
                let NP_NAME = feature.properties?.NP_NAME?.toString()
                let AREA_HA = feature.properties?.AREA_HA?.toString()
                let DESIG_DATE = feature.properties?.DESIG_DATE?.toString()


                layer.bindPopup(`
                <div> 
                <div> DESIG_DATE: ${DESIG_DATE} </div>
                    <div> Name: ${NP_NAME}</div>
                    <div> AREA_HA: ${AREA_HA} </div>
                </div>
                `);
            }
        }).addTo(group);
        map.fitBounds(group.getBounds());
    }

    function getJson(data) {
        console.log("callback function fired");
    }

}

function initMap() {
    var map = L.map('map' + currentMap).setView([52, -3], 8);
    //OSM layer
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map)

    return map
}

init()
