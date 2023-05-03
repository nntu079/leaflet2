var mapDiv = document.getElementById("map")
var spinner = document.getElementById("spinner")
var formSearch = document.getElementById("formSearch")
var changeView = document.getElementById("change_view")


function initMap() {
    var map = L.map('map').setView([52, -3], 8);

    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map)

    return map
}


function init() {

    let map = initMap()

    fetchData({ map, keywords: "" })

    formSearch.addEventListener("submit", (e) => {
        e.preventDefault()
        const formData = new FormData(e.target);
        const formProps = Object.fromEntries(formData);

        fetchData({ map, keywords: formProps.keywords })
    })

    changeView.addEventListener("change", (e) => {
        const value = e.target.value
        if (value == "1") {
            getOSMLayer().addTo(map)
        } else if (value == "2") {
            getGoogleStreetLayer().addTo(map)
        } else if (value == "3") {
            getWaterColorLayer().addTo(map)
        } else {
            getOSMLayer().addTo(map)
        }
    })

}


function fetchData({ map, keywords }) {
    loading(true, mapDiv, spinner)

    var rootUrl = 'https://ces-gis.southwales.ac.uk:2345/geoserver/s20/ows';

    var defaultParameters = {
        service: 'WFS',
        version: '1.0.0',
        request: 'GetFeature',
        typeName: 's20:National_Parks_August_2016_Full_Clipped_Boundaries_in_Great_Bri',
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

                    return { color: 'red' };
                } else {
                    return { color: 'green' };
                }
            },
            onEachFeature: function (feature, layer) {
                let NP_NAME = feature.properties?.npark16nm?.toString()
                let AREA_HA = feature.properties?.st_areasha?.toString()
                let DESIG_DATE = feature.properties?.st_lengths?.toString()


                layer.bindPopup(`
                <div> 
                    <div> Name: ${NP_NAME}</div>
                    <div> AREA_HA: ${AREA_HA} </div>
                    <div> Length: ${DESIG_DATE} </div>
                </div>
                `);
            }
        }).addTo(group);
        map.fitBounds(group.getBounds());

        loading(false, mapDiv, spinner)
    }

    function getJson(data) {
        console.log("callback function fired");
    }

}

init()
