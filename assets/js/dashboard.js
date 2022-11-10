$(function () {
	// $.getJSON('dashboard/countdata', { get_param: 'value' },
	// 	function(data) {
	// 		document.getElementById('jmlpasien').innerHTML=data.jmlpasien
	// 		document.getElementById('validate').innerHTML=data.validate
	// 		document.getElementById('notvalidate').innerHTML=data.notvalidate
	// 		//document.getElementById('unfollowup').innerHTML=data.unfollowup
	// 	}
	// );

	window.onload = function () {
		//var d = new date();
		var d = new window.Date();
		var date = d.getDate();
		//var month = d.getMonth() + 1;
		var month = ("0" + (d.getMonth() + 1)).slice(-2);
		var year = d.getFullYear();
		//var tgl1 = year + "-" + month + "-"+'01';
		var tgl1 = year + "-" + "01" + "-" + "01";
		//$('#key_tgl').datebox('setValue', tgl);	// set datebox value
		//var v = $('#dd').datebox('getValue');	// get datebox value
		//alert(tgl1);
		var tgl2 = year + "-" + month + "-" + date;
		//keyid_kantor = $('#keyid_kantor').combogrid('getValues').join();
		unitid = $('#key_unitid').val();
		var url =
			"?kategori=jkelamin&subgrupid=&jtanggal=by_tglinput&tgl1=" +
			tgl1 +
			"&tgl2=" +
			tgl2 +
			"&unitid=" +
			unitid;
		GenerateChart(url);
	};

	$("#key_subgrupid").combobox({
		panelWidth: 200,
		panelHeight: "300",
		valueField: "id",
		editable: false,
		loadMsg: "Please Wait..",
		textField: "subgrup",
		fitColumns: true,
		url: "dashboard/optionsubgrup",
		icons: [{
			iconCls: "icon-clear",
			handler: function (e) {
				$(e.data.target)
					.combobox("clear")
					.combobox("textbox")
					.focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this)
					.combobox("getIcon", 0)
					.css("visibility", "visible");
			} else {
				$(this)
					.combobox("getIcon", 0)
					.css("visibility", "hidden");
			}
		}
	});

	$("#key_unitid").combobox({
		panelWidth: 200,
		panelHeight: "200",
		valueField: "id",
		editable: false,
		loadMsg: "Please Wait..",
		textField: "nama_unit",
		formatter: formatUnit,
		fitColumns: true,
		url: "dashboard/optionunit",
		icons: [{
			iconCls: "icon-clear",
			handler: function (e) {
				$(e.data.target)
					.combobox("clear")
					.combobox("textbox")
					.focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this)
					.combobox("getIcon", 0)
					.css("visibility", "visible");
			} else {
				$(this)
					.combobox("getIcon", 0)
					.css("visibility", "hidden");
			}
		}
	});

	with(new Date()) {
		$("#key_tgl").datebox(
			"setValue",
			getFullYear() +
			"-" +
			(getMonth() + 1 < 10 ? "0" : "") +
			(getMonth() + 1) +
			"-" +
			(getDate() < 10 ? "0" : "") +
			getDate()
		);
	}
	with(new Date()) {
		$("#key_tgl2").datebox(
			"setValue",
			getFullYear() +
			"-" +
			(getMonth() + 1 < 10 ? "0" : "") +
			(getMonth() + 1) +
			"-" +
			(getDate() < 10 ? "0" : "") +
			getDate()
		);
	}
});

function formatUnit(row) {
	var s = '<span style="font-weight:bold">' + row.nama_unit + '</span><br/>' +
		'<span style="color:#888">' + row.alamat + '</span>';
	return s;
}

function myformatter(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	var d = date.getDate();
	return y + "-" + (m < 10 ? "0" + m : m) + "-" + (d < 10 ? "0" + d : d);
}

function myparser(s) {
	if (!s) return new Date();
	var ss = s.split("-");
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
	var kategori = $("#key_kategori").combobox("getValue"),
		subgrupid = $("#key_subgrupid").combobox("getValue"),
		jtanggal = $("#key_jtanggal").combobox("getValue"),
		tgl1 = $("#key_tgl").datebox("getValue"),
		tgl2 = $("#key_tgl2").datebox("getValue"),
		unitid = $('#key_unitid').val();
	//keyid_kantor = $('#keyid_kantor').combogrid('getValues').join();
	var url =
		"?kategori=" +
		kategori +
		"&subgrupid=" +
		subgrupid +
		"&jtanggal=" +
		jtanggal +
		"&tgl1=" +
		tgl1 +
		"&tgl2=" +
		tgl2 +
		"&unitid=" +
		unitid;
	GenerateChart(url);
}

function GenerateChart(url) {
	var a = JSON.parse(
		$.ajax({
			url: "dashboard/showdata" + url,
			async: false
		}).responseText
	);
	var colors = Highcharts.getOptions().colors;
	var categories = a.categories;
	var data = a.items;
	var name =
		"RESUME " +
		a.str +
		$("#key_kategori")
		.combobox("getText")
		.toUpperCase();

	document.getElementById("jmlpasien").innerHTML = a.pasien.jmlpasien;
	document.getElementById("validate").innerHTML = a.pasien.validate;
	document.getElementById("notvalidate").innerHTML = a.pasien.notvalidate;
	//document.getElementById('unfollowup').innerHTML=a.pasien.unfollowup
	var jtanggal = $("#key_jtanggal").combobox("getValue");
	var subgrupid = $("#key_subgrupid").combobox("getText");
	bytgl = "";
	subgrup = "";
	if (jtanggal == "by_tglinput") {
		bytgl = "Input";
	} else {
		bytgl = "Diagnosis";
	}
	if (subgrupid != "") {
		subgrup = " & Subgrup : " + subgrupid;
	}

	//ViewData(a.data);
	$("#container").highcharts({
		chart: {
			renderTo: "container",
			type: "column"
		},
		title: {
			text: "SUMMARY BY " +
				$("#key_kategori")
				.combobox("getText")
				.toUpperCase() +
				subgrup
		},
		subtitle: {
			text: "Tanggal " +
				bytgl +
				" " +
				a.tgl1 +
				" s/d " +
				$("#key_tgl2").datebox("getValue")
		},
		xAxis: {
			categories: categories
			// labels: {
			// 	formatter: function() {
			// 		return '<a href="?mod=helpdesk&file=helpdeskRequestMain&created_date1=2015-06-01&created_date2=2015-06-23&created_date_opsi=AND&customer_id=&kategori_opsi=AND&kategori_id='+this.value+'&btnMoreSearch=Search" title="View Detail '+this.value+'">'+this.value+'</a>';
			// 	}
			// }
		},
		yAxis: {
			title: {
				text: "Total "
			}
		},
		plotOptions: {
			column: {
				cursor: "pointer",
				pointPadding: 0,
				point: {
					events: {
						click: function () {
							var drilldown = this.drilldown;
							if (drilldown) {
								setChart(
									drilldown.name,
									drilldown.categories,
									drilldown.data,
									drilldown.color
								);
							} else {
								setChart(name, categories, data);
							}
						}
					}
				},
				dataLabels: {
					enabled: true,
					color: colors[0],
					style: {
						fontWeight: "bold"
					},
					formatter: function () {
						return FormatRp(this.y, 0); /* +' IDR';*/
					}
				}
			}
		},
		tooltip: {
			formatter: function () {
				var point = this.point,
					s = this.x + ":<b>" + FormatRp(this.y, 0) + " </b><br/>";
				if (point.drilldown) {
					s += "Click to view " + point.category + " detail";
				} else {
					s += "Click to view detail";
				}
				return s;
			}
		},
		series: [{
				name: name,
				data: data,
				color: "white"
			}
			//          {
			// 	type: 'pie',
			// 	data:data,
			// 	center: [760, 5],
			// 	size: 65,
			// 	showInLegend: false,
			// 	tooltip: {
			//                  enabled: false
			//              },
			// 	dataLabels: {
			// 		enabled: true,
			// 		distance: 1,
			// 		connectorWidth: 1,
			// 		formatter: function() {
			//                      return  Highcharts.numberFormat(this.percentage, 0) +' %';
			//                  }
			// 	}

			// }
		]
	});
}

function FormatRp(val, dec) {
	if (val == 0) val = parseInt(0);
	return accounting.formatMoney(val, "", dec, ".", ",");
}
