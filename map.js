//Go ahead and grab the location of the search box
var filterGroup = document.getElementById('filter-group');
var popupWindow = document.getElementById('popup-window');
var layerIDs = [];
var theCollection = {};
//Initialize the geoJSON as a type FeatureCollection so I can add features to it
var geoJSON = {
	type: 'FeatureCollection'
};
var geoJSONBooks = {
	type: 'FeatureCollection'
};

var transformRequest = (url, resourceType) => {
	var isMapboxRequest = url.slice(8, 22) === 'api.mapbox.com' || url.slice(10, 26) === 'tiles.mapbox.com';
	return {
		url: isMapboxRequest ? url.replace('?', '?pluginName=sheetMapper&') : url
	};
};

//MAPBOXTOKEN REMOVE BEFORE PUBLISHING
mapboxgl.accessToken =
	'pk.eyJ1IjoiZmF0aGVycHVtcGtpbiIsImEiOiJja2Nqb3dwaXYwdmYwMnhtaGp1aHhmc2g3In0.kB0nwtcvxTrMf8t-BGIjVA';

//initialize the map
var map = new mapboxgl.Map({
	container: document.getElementById('map'), // container id
	style: 'mapbox://styles/mapbox/streets-v11', //Choose a style: https://docs.mapbox.com/api/maps/#styles
	center: [ -3.5, 40.4 ], // starting position [lng, lat] set at Madrid currently
	zoom: 9, // starting zoom
	transformRequest: transformRequest
});

map.on('load', function() {
	init();
	var delayInMilliseconds = 2000; //Delay to allow the geoJSON to be populated. Fix by using Promises or an await in future build

	setTimeout(function() {
		map.addSource('places', {
			type: 'geojson',
			data: geoJSONBooks
		});

		//Loop through the geoJSON adding each one to my map
		geoJSONBooks.features.forEach(function(feature) {
			//set symbol to whatever property I'm sorting by. Later should be able to sort by multiple properties at once
			var symbol = feature.properties['city'];
			var layerID = 'poi-' + symbol;
			map.on('click', layerID, function(e) {
				var coordinates = e.features[0].geometry.coordinates.slice();
				var library = e.features[0].properties.library;

				popupWindow.innerHTML = library;

				// Ensure that if the map is zoomed out such that multiple
				// copies of the feature are visible, the popup appears
				// over the copy being pointed to.
				while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
					coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
				}

				//Add a popup for each point.
				new mapboxgl.Popup().setLngLat(coordinates).setHTML(name).addTo(map);
			});

			// Add a layer for this symbol type if it hasn't been added already. This is what actually does the filtering
			if (!map.getLayer(layerID)) {
				map.addLayer({
					id: layerID,
					type: 'circle',
					source: 'places',
					layout: {
						// make layer visible by default
						visibility: 'none'
					},
					paint: {
						'circle-radius': 9,
						'circle-color': 'purple'
					},
					//change the filter to whatever searching by
					filter: [ '==', 'city', symbol ]
				});

				// Add checkbox and label elements for the layer.
				var input = document.createElement('input');
				input.type = 'checkbox';
				input.id = layerID;
				input.checked = false;
				filterGroup.appendChild(input);

				var label = document.createElement('label');
				label.setAttribute('for', layerID);
				label.textContent = symbol;
				filterGroup.appendChild(label);

				//When the checkbox changes, update the visibility of the layer.
				input.addEventListener('change', function(e) {
					map.setLayoutProperty(layerID, 'visibility', e.target.checked ? 'visible' : 'none');
					var j;
					// remove the unchecked layer from layerIDs
					for (var i = 0; i < layerIDs.length; i++) {
						if (layerIDs[i] == layerID) {
							j = i;
						}
					}
					e.target.checked ? layerIDs.push(layerID) : layerIDs.splice(j, 1);
					console.log(layerIDs);
				});
			}
		});
	}, delayInMilliseconds);
});

// Initialize D3 to access your table
function init() {
	d3.csv('./libraries.csv', addLibraries);
	setTimeout(function() {
		d3.csv('./books.csv', addPoints);
	}, 1000);
}

function addLibraries(data) {
	var thegeoJSONCollection = [];
	//create a key/value pair for every library with it's GeoJSON feature
	data.forEach(function(row) {
		var obj = {
			type: 'Feature',
			properties: {
				name: row.Name,
				address: row.Address,
				municipality: row.Municipality,
				class: 'library'
			},
			geometry: {
				type: 'Point',
				coordinates: [ Number(row.Longitude), Number(row.Latitude) ]
			}
		};
		theCollection[row.Name] = obj;
	});
	for (var key in theCollection) {
		thegeoJSONCollection.push(theCollection[key]);
	}
	geoJSON['features'] = thegeoJSONCollection;
}

function addPoints(data) {
	var theNewCollection = [];
	//so go ahead and loop through each row
	data.forEach(function(row) {
		var rowLibraries = row.Libraries.split('/// ');
		rowLibraries.forEach(function(libs) {
			if (theCollection[libs]) {
				var obj = {
					type: 'Feature',
					properties: {
						age: row.Age,
						list: row.List,
						title: row.Title,
						author: row.Author,
						illustrator: row.Illustrator,
						press: row.Press,
						city: row.City,
						year: row.Year,
						series: row.Series,
						genre: row.Genre,
						topic: row.Topic,
						list: row.List,
						summary: row.Summary,
						library: libs,
						class: 'book'
					},
					geometry: theCollection[libs].geometry
				};
				theNewCollection.push(obj);
			} else {
				console.log('TheCollection[libs] ', theCollection[libs], 'does not exist');
			}
		});
	});

	geoJSONBooks['features'] = theNewCollection;
}
