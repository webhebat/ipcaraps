$(function () {

	$('#dgData').datagrid({ 
        //width: 'auto', 
        height: '400', 
        singleSelect: true,  
        rownumbers: true, 
        collapsible: false, 
        fitColumns: false, 
        idField: 'id_prov', 
        url: 'petanasional/readprov', 
        columns:[[   
            {field:'nama',title:'Propinsi',align:'left'},
            {field:'jml',title:'Jml',align:'left'}
        ]], 
        showFooter:true
        //onDblClickRow:function(row,index){
            //EditOutlet();
        //rowStyler:function(index,row){
        //  if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
        //}     
    });

	var mymap = L.map('mapid').setView([-7.090910999999999, 107.66888700000004], 5);
	ACCESS_TOKEN = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: ACCESS_TOKEN
	}).addTo(mymap);

	var subgrupid = $('#key_subgrupid').val();

	var d = new window.Date();
	var date = d.getDate();
	//var month = d.getMonth() + 1;
	var month = ("0" + (d.getMonth() + 1)).slice(-2);
	var year = d.getFullYear();
	//var tgl1 = year + "-" + month + "-"+'01';
	var tgl1 = year + "-" + month + "-" + "01";
	//$('#key_tgl').datebox('setValue', tgl);	// set datebox value
	//var v = $('#dd').datebox('getValue');	// get datebox value
	//alert(tgl1);
	var tgl2 = year + "-" + month + "-" + date;
	//keyid_kantor = $('#keyid_kantor').combogrid('getValues').join();

	var datanilai = JSON.parse($.ajax({
		url: 'petanasional/getdata/?subgrupid=' + subgrupid + "&tgl1=" +tgl1 +"&tgl2=" +tgl2,
		async: false
	}).responseText);

	var geojson = L.geoJson(datanilai.data, {
		style: style,
		onEachFeature: onEachFeature,
	}).addTo(mymap);

	$('#dgData').datagrid('reload',{  
        subgrupid : subgrupid,
        tgl1 : tgl1,
        tgl2 : tgl2              
    });

	var marker = {};
	var markers = {};

	$("#button").click(function () {

		//if(geojson) {
		 //mymap.removeLayer(geojson);
		//}

		var subgrupid = $('#key_subgrupid').combobox('getValue'),
		tgl1 = $("#key_tgl").datebox("getValue"),
		tgl2 = $("#key_tgl2").datebox("getValue");

		var url = '?subgrupid=' + subgrupid + "&tgl1=" +tgl1 +"&tgl2=" +tgl2;
		var datas = JSON.parse($.ajax({
			url: 'petanasional/getdata/' + url,
			async: false
		}).responseText);

		var geojson = L.geoJson(datas.data, {
			style: style,
			onEachFeature: onEachFeature,
		}).addTo(mymap);

	    $('#dgData').datagrid('reload',{  
	        subgrupid : subgrupid,
	        tgl1 : tgl1,
	        tgl2 : tgl2              
	    });

	});


	//var data = JSON.stringify(a);

	//var a = ["a", "b", "c"];

	// MARKER TANPA CLUSTER
	// // a.forEach(function(data) {
	// //     L.marker([data.lat,data.lng]).addTo(mymap)
	// //     .bindPopup(data.nama+',<br>Jml : '+data.jml).openPopup();
	// // });


	// MARKER DENGAN CLUSTER
	// var markers = L.markerClusterGroup();

	// a.forEach(function(data) {
	//     var marker = L.marker([data.lat,data.lng])
	//     .bindPopup(data.nama+'<br>Jml : '+data.jml).openPopup();
	//     markers.addLayer(marker);
	// });
	// mymap.addLayer(markers);

	//var marker = L.marker([-7.150975,110.14025939999999]).addTo(mymap);

	window.onload = function () {
		//var d = new date();
		var d = new window.Date();
		var date = d.getDate();
		//var month = d.getMonth() + 1;
		var month = ("0" + (d.getMonth() + 1)).slice(-2);
		var year = d.getFullYear();
		var tgl1 = year + "-" + month + "-" + '01';
		//$('#key_tgl').datebox('setValue', tgl);	// set datebox value
		//var v = $('#dd').datebox('getValue');	// get datebox value
		//alert(tgl1);
		var tgl2 = year + "-" + month + "-" + date;
		//keyid_kantor = $('#keyid_kantor').combogrid('getValues').join();
		var url = '?kategori=jkelamin&subgrupid=&jtanggal=by_tglinput&tgl1=' + tgl1 + '&tgl2=' + tgl2;

	};

	$('#key_subgrupid').combobox({
		panelWidth: 200,
		panelHeight: '300',
		valueField: 'id',
		editable: false,
		loadMsg: 'Please Wait..',
		textField: 'subgrup',
		fitColumns: true,
		url: 'dashboard/optionsubgrup',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combobox('clear').combobox('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combobox('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combobox('getIcon', 0).css('visibility', 'hidden')
			}
		}
	});

	with(new Date) {
		$('#key_tgl').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#key_tgl2').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}


});
/// https://diariesofanessexgirl.com/yellow-analogous-color-palette/
function getColor(d,n) {

	return d > (n / 8) * 7 ? '#f00000' :
		d > (n / 8) * 6 ? '#ff0000' :
		d > (n / 8) * 5 ? '#f07800' :
		d > (n / 8) * 4 ? '#ff7800' :
		d > (n / 8) * 3 ? '#fff000' :
		d > (n / 8) * 2 ? '#f0ff00' :
		d > (n / 8) * 1 ? '#ffff00' :
		'#00ff00';
	// console.log(d);
}

function style(feature) {
	return {
		weight: 2,
		opacity: 1,
		color: 'white',
		dashArray: '2',
		fillOpacity: 0.5,
		fillColor: getColor(parseInt(feature.properties.nilai),parseInt(feature.properties.nilaiMax))
	};
}

function style2(feature) {
	return {
		weight: 2,
		opacity: 0,
		color: '',
		dashArray: '3',
		fillOpacity: 0.7,
		fillColor: getColor(parseInt(feature.properties.nilai),parseInt(feature.properties.nilaiMax))
	};
}



function onEachFeature(feature, layer) {
	layer.bindPopup(feature.properties.Propinsi + " : " + feature.properties.nilai + " kasus");
}

function myformatter(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	var d = date.getDate();
	return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
}

function myparser(s) {
	if (!s) return new Date();
	var ss = (s.split('-'));
	var y = parseInt(ss[0], 10);
	var m = parseInt(ss[1], 10);
	var d = parseInt(ss[2], 10);
	if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
		return new Date(y, m - 1, d);
	} else {
		return new Date();
	}
}

function show() {
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

	document.getElementById('mapid').style.display = '';
	document.getElementById('mapid').innerHTML = '';

	var kategori = $('#key_kategori').combobox('getValue'),
		subgrupid = $('#key_subgrupid').combobox('getValue');
	var url = '?kategori=' + kategori + '&subgrupid=' + subgrupid;
	//GenerateMap(url);

	var container = L.DomUtil.get('mapid');
	if (container != null) {
		container._leaflet_id = null;
	}

	var mymap = L.map('mapid').setView([-7.090910999999999, 107.66888700000004], 8);

	ACCESS_TOKEN = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: ACCESS_TOKEN
	}).addTo(mymap);

	var a = JSON.parse($.ajax({
		url: 'petasebaran/getmarker/' + url,
		async: false
	}).responseText);

	// MARKER DENGAN CLUSTER
	var markers = L.markerClusterGroup();

	a.forEach(function (data) {
		var marker = L.marker([data.lat, data.lng])
			.bindPopup(data.nama + '<br>Jml : ' + data.jml).openPopup();
		markers.addLayer(marker);
	});
	mymap.addLayer(markers);
}

function GenerateMap(url) {


}
