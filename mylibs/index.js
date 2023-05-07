function loading(isLoading, map, spinner) {
    if (isLoading) {
        if (map)
            map.style.display = "none"
        if (spinner)
            spinner.style.display = "inline"
    }
    else {
        if (map)
            map.style.display = "block"
        if (spinner)
            spinner.style.display = "none"
    }
}

function getOSMLayer() {
    let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    return osm;
}

function getGoogleStreetLayer() {
    let googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    return googleStreets
}

function getWaterColorLayer() {
    let stamenWatercolor = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
        attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        subdomains: 'abcd',
        minZoom: 1,
        maxZoom: 16,
        ext: 'jpg'
    });

    return stamenWatercolor
}