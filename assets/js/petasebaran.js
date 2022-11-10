$(function(){

	var mymap = L.map('mapid').setView([-7.090910999999999,107.66888700000004], 6);
    ACCESS_TOKEN = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: ACCESS_TOKEN
	}).addTo(mymap);

	var marker = {};
	var markers = {};

	$( "#button" ).click(function() {

		if (markers != undefined) {
              mymap.removeLayer(markers);
        };

		var kategori = $('#key_kategori').combobox('getValue'),
		subgrupid = $('#key_subgrupid').combobox('getValue');

		var url = '?kategori='+kategori+'&subgrupid='+subgrupid;
		var a = JSON.parse($.ajax({url: 'petasebaran/getmarker/'+url, async: false}).responseText);

		// MARKER DENGAN CLUSTER
		markers = L.markerClusterGroup();
        
		a.forEach(function(data) {
		     marker = L.marker([data.lat,data.lng])
		    .bindPopup(data.nama+'<br>Jml : '+data.jml).openPopup();
		     markers.addLayer(marker);
		});

		mymap.addLayer(markers);
		//markers.clearLayers();

	});

	var a = JSON.parse($.ajax({url: 'petasebaran/getmarker', async: false}).responseText);
 	//var data = JSON.stringify(a);

 	//var a = ["a", "b", "c"];

 	// MARKER TANPA CLUSTER
	// // a.forEach(function(data) {
	// //     L.marker([data.lat,data.lng]).addTo(mymap)
	// //     .bindPopup(data.nama+',<br>Jml : '+data.jml).openPopup();
	// // });

	
	// MARKER DENGAN CLUSTER
	var markers = L.markerClusterGroup();

	a.forEach(function(data) {
	    var marker = L.marker([data.lat,data.lng])
	    .bindPopup(data.nama+'<br>Jml : '+data.jml).openPopup();
	    markers.addLayer(marker);
	});
	mymap.addLayer(markers);
 
	//var marker = L.marker([-7.150975,110.14025939999999]).addTo(mymap);

	window.onload = function() {
	  	//var d = new date();
		var d = new window.Date();
	    var date = d.getDate();
		//var month = d.getMonth() + 1;
	  	var month = ("0" + (d.getMonth() + 1)).slice(-2);
	  	var year = d.getFullYear();
		var tgl1 = year + "-" + month + "-"+'01';
		//$('#key_tgl').datebox('setValue', tgl);	// set datebox value
		//var v = $('#dd').datebox('getValue');	// get datebox value
		//alert(tgl1);
		var tgl2 = year + "-" + month + "-"+date;
		//keyid_kantor = $('#keyid_kantor').combogrid('getValues').join();
		var url = '?kategori=jkelamin&subgrupid=&jtanggal=by_tglinput&tgl1='+tgl1+'&tgl2='+tgl2;

	};

  	$('#key_subgrupid').combobox({
        panelWidth:200,
        panelHeight:'300',
        valueField: 'id',
        editable:false,
        loadMsg:'Please Wait..',
        textField: 'subgrup', 
        fitColumns:true,
        url:'dashboard/optionsubgrup',
        icons: [{
		iconCls: 'icon-clear',
		handler: function(e){
			$(e.data.target).combobox('clear').combobox('textbox').focus();
		}
		}],
		onChange: function(value){
			if (value){
				$(this).combobox('getIcon', 0).css('visibility','visible')
			} else {
				$(this).combobox('getIcon', 0).css('visibility','hidden')
			}
		}
    });

    with(new Date){
        $('#key_tgl').datebox('setValue',getFullYear()+"-"+(getMonth()+1<10?'0':'')+(getMonth()+1)+"-"+(getDate()<10?'0':'')+getDate());
    }
    with(new Date){
        $('#key_tgl2').datebox('setValue',getFullYear()+"-"+(getMonth()+1<10?'0':'')+(getMonth()+1)+"-"+(getDate()<10?'0':'')+getDate());
    }


});


function myformatter(date){
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}

function myparser(s){
    if (!s) return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0],10);
    var m = parseInt(ss[1],10);
    var d = parseInt(ss[2],10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
        return new Date(y,m-1,d);
    } else {
        return new Date();
    }
}

	function show(){
	 	//    window.location.reload()

	 	//    $.ajax({
		//     type: "POST",
		//     url: "packtypeAdd.php",
		//     data: infoPO,
		//     success: function() {   
		//         location.reload();  
		//     }
		// });

		//halo = 'halo adam';
		alert(halo);

		document.getElementById('mapid').style.display='';
		document.getElementById('mapid').innerHTML='';

		var kategori = $('#key_kategori').combobox('getValue'),
		subgrupid = $('#key_subgrupid').combobox('getValue');
		var url = '?kategori='+kategori+'&subgrupid='+subgrupid;
		//GenerateMap(url);
    
		var container = L.DomUtil.get('mapid');
	    if(container != null){
	        container._leaflet_id = null;
	    }

		var mymap = L.map('mapid').setView([-7.090910999999999,107.66888700000004], 8); 

	    ACCESS_TOKEN = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
		
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox/streets-v11',
	    tileSize: 512,
	    zoomOffset: -1,
	    accessToken: ACCESS_TOKEN
		}).addTo(mymap);

		var a = JSON.parse($.ajax({url: 'petasebaran/getmarker/'+url, async: false}).responseText);
	 	
		// MARKER DENGAN CLUSTER
		var markers = L.markerClusterGroup();

		a.forEach(function(data) {
		    var marker = L.marker([data.lat,data.lng])
		    .bindPopup(data.nama+'<br>Jml : '+data.jml).openPopup();
		    markers.addLayer(marker);
		});
		mymap.addLayer(markers);
	}

    function GenerateMap(url){
 
       
	}

