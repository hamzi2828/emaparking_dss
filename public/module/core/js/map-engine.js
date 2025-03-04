!function(t){function o(t,o){}function n(t,o){this.defaults={fitBounds:!0};return this.map=null,this.id=t,this.options=o,this.markers=[],this.bounds=null,this.init(),this}function i(t,o){this.defaults={fitBounds:!0};this.map=null,this.id=t,this.options=o,this.markersPositions=[],this.markers=[];return this.infoboxs=[],this.init(),this}window.BravoMapEngine=function(t,o){switch(bookingCore.map_provider){case"osm":return new n(t,o);case"gmap":return new i(t,o)}},o.prototype.getOption=function(t){return void 0===this.options[t]?void 0!==this.defaults[t]?this.defaults[t]:null:this.options[t]},(n.prototype=new o).initScripts=function(t){t()},n.prototype.init=function(){var n=this;this.el=t("#"+this.id),this.initScripts(function(){var t=n.getOption("center"),o=n.getOption("zoom");n.map=L.map(n.id).setView(t,o),L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",{attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(n.map);o=n.getOption("ready");"function"==typeof o&&o(n)})},n.prototype.addMarker=function(t,o){o=L.marker(t,o).addTo(this.map);this.markers.push(o)},n.prototype.addMarker2=function(t){var o={icon_options:{iconUrl:""}};o.icon_options.iconUrl=t.marker,o.icon_options&&(o.icon=L.icon(o.icon_options));o=L.marker([t.lat,t.lng],o).addTo(this.map);this.markers.push(o)},n.prototype.addMarkers=function(t){for(var o=0;o<t.length;o++)this.addMarker(t[o][0],t[o][1]);if(this.getOption("fitBounds")){for(var n in this.bounds=[],this.markers){var i=this.markers[n];this.bounds.push([i._latlng.lat,i._latlng.lng])}try{this.map.fitBounds(this.bounds)}catch(t){console.log(t)}this.map.invalidateSize()}},n.prototype.addMarkers2=function(t){for(var o=0;o<t.length;o++)this.addMarker2(t[o]);if(this.getOption("fitBounds")){for(var n in this.bounds=[],this.markers){var i=this.markers[n];this.bounds.push([i._latlng.lat,i._latlng.lng])}try{this.map.fitBounds(this.bounds)}catch(t){console.log(t)}this.map.invalidateSize()}},n.prototype.clearMarkers=function(t){for(var o=0;o<this.markers.length;o++)this.map.removeLayer(this.markers[o]);this.markers=[]},n.prototype.on=function(t,o){switch(t){case"click":return this.map.on(t,function(t){o([t.latlng.lat,t.latlng.lng])});case"zoom_changed":return this.map.on("zoomend",function(t){o(t.target.getZoom())})}},n.prototype.searchBox=function(t,o){t.hide()},(i.prototype=new o).initScripts=function(t){t()},i.prototype.init=function(){var n=this;this.el=t("#"+this.id),this.initScripts(function(){var t=n.getOption("center"),o=n.getOption("zoom");n.map=new google.maps.Map(document.getElementById(n.id),{center:{lat:t[0],lng:t[1]},zoom:o,maxZoom:15});o=n.getOption("ready");"function"==typeof o&&(o(n),n.getOption("markerClustering")&&new markerClusterer.MarkerClusterer(n.map,n.markers,{imagePath:"https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m"}))})},i.prototype.addMarker=function(t,o){o=new google.maps.Marker({position:{lat:t[0],lng:t[1]},map:this.map,icon:o.icon_options.iconUrl});this.markers.push(o)},i.prototype.addMarker2=function(t){var o=new google.maps.Marker({position:{lat:t.lat,lng:t.lng},map:this.map,icon:t.marker});if(t.infobox){var n={content:"",disableAutoPan:!0,maxWidth:0,pixelOffset:new google.maps.Size(-135,-35),zIndex:null,boxStyle:{padding:"0px 0px 0px 0px",width:"270px"},closeBoxURL:"",cancelBubble:!0,infoBoxClearance:new google.maps.Size(1,1),isHidden:!1,pane:"floatPane",enableEventPropagation:!0,alignBottom:!0},i=document.createElement("div");i.style.cssText="border-radius: 5px; background: #fff; padding: 0px;",i.innerHTML=t.infobox,n.content=i;for(var e=0;e<this.infoboxs.length;e++)this.infoboxs[e].close();var s=new InfoBox(n);this.infoboxs.push(s);var r=this;o.addListener("click",function(){for(var t=0;t<r.infoboxs.length;t++)r.infoboxs[t].close();s.open(r.map,this),r.map.panTo(s.getPosition()),window.lazyLoadInstance&&window.lazyLoadInstance.update()})}this.markers.push(o),this.markersPositions.push(o.getPosition())},i.prototype.addMarkers=function(t){for(var o=0;o<t.length;o++)this.addMarker(t[o][0],t[o][1]);if(this.getOption("fitBounds")){this.bounds=new google.maps.LatLngBounds;for(o=0;o<this.markers.length;o++)this.bounds.extend(this.markers[o]);this.map.fitBounds(this.bounds)}},i.prototype.addMarkers2=function(t){for(var o=0;o<t.length;o++)this.addMarker2(t[o]);if(this.getOption("fitBounds")){this.bounds=new google.maps.LatLngBounds;for(o=0;o<this.markersPositions.length;o++)this.bounds.extend(this.markersPositions[o]);this.map.fitBounds(this.bounds)}},i.prototype.clearMarkers=function(t){if(0<this.markers.length)for(var o=0;o<this.markers.length;o++)this.markers[o].setMap(null);this.markers=[],this.markersPositions=[],this.infoboxs=[]},i.prototype.on=function(t,n){switch(t){case"click":return this.map.addListener(t,function(t){var o=this.getZoom();n([t.latLng.lat(),t.latLng.lng(),o])});case"zoom_changed":return this.map.addListener(t,function(t){var o=this.getZoom();n(o)})}},i.prototype.searchBox=function(t,e){var s=this,r=new google.maps.places.SearchBox(t[0]);google.maps.event.addListener(r,"places_changed",function(){var t=r.getPlaces();if(0!=t.length){for(var o,n=new google.maps.LatLngBounds,i=0;o=t[i];i++){if(!o.geometry)return void console.log("Returned place contains no geometry");o.geometry.viewport?n.union(o.geometry.viewport):n.extend(o.geometry.location),0===i&&e([o.geometry.location.lat(),o.geometry.location.lng(),s.map.getZoom()])}s.map.fitBounds(n)}})}}(jQuery);