$(function () {

	$('#dgregistrasi').datagrid({
		//width: 'auto', 
		height: 'auto',
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: 'id',
		url: 'registrasi/read',
		title: 'Data Registrasi Pasien',
		onDblClickRow: function () {
			doSearch()
			edit();
		},
		frozenColumns: [
			[{
					field: 'noregistrasi',
					title: 'No Registrasi',
					width: 120,
					align: 'left'
				},
				{
					field: 'nama',
					title: 'Nama Lengkap',
					width: 200,
					align: 'left',
					formatter: function (value, row, index) {
						if (row.validate == 'y') {
							return '<img src=\'assets/themes/icons/correct.png\' border=\'0\'/ class="item-img"></img>' + ' ' + row.nama + ' ';
						} else {
							return '<img src=\'assets/themes/icons/uncheck.png\' border=\'0\'/ class="item-img"></img>' + ' ' + row.nama + ' ';
						}
					}
				},
			]
		],
		columns: [
			[{
					field: 'nik',
					title: 'NIK',
					width: 200,
					align: 'left'
				},
				{
					field: 'ttl',
					title: 'Tempat, Tgl Lahir',
					width: 180,
					align: 'left'
				},
				{
					field: 'jkelamin',
					title: 'Jenis Kelamin',
					width: 120,
					align: 'left'
				},
				{
					field: 'usiadiagnosis',
					title: 'Usia Terdiagnosis',
					width: 150,
					align: 'left'
				},
				{
					field: 'alamat',
					title: 'Alamat',
					width: 200,
					align: 'left'
				},
				{
					field: 'propinsi',
					title: 'Propinsi',
					width: 150,
					align: 'left'
				},
				{
					field: 'kabupaten',
					title: 'Kabupaten',
					width: 150,
					align: 'left'
				},
				{
					field: 'kecamatan',
					title: 'Kecamatan',
					width: 150,
					align: 'left'
				},
				{
					field: 'desa',
					title: 'Desa',
					width: 150,
					align: 'left'
				},
				{
					field: 'no_rekam',
					title: 'No Rekam Medis',
					width: 150,
					align: 'left'
				},
				{
					field: 'no_hp',
					title: 'No HP',
					width: 150,
					align: 'left'
				},
				{
					field: 'no_hp2',
					title: 'No HP 2',
					width: 150,
					align: 'left'
				},
				{
					field: 'no_bpjs',
					title: 'No BPJS',
					width: 150,
					align: 'left'
				},
				{
					field: 'bb',
					title: 'BB',
					width: 80,
					align: 'left'
				},
				{
					field: 'tb',
					title: 'TB',
					width: 80,
					align: 'left'
				},
				{
					field: 'kesimpulan',
					title: 'kesimpulan',
					width: 150,
					align: 'left'
				},
				//{field:'diagnosis',title:'Dasar Diagnosis',width:150,align:'left'},
				{
					field: 'subgrup',
					title: 'Subgrup',
					width: 250,
					align: 'left'
				},
				{
					field: 'morfologi',
					title: 'Morfologi',
					width: 250,
					align: 'left'
				},
				{
					field: 'topografi',
					title: 'Topografi',
					width: 250,
					align: 'left'
				},
				{
					field: 'ketliteralitas',
					title: 'Literalitas',
					width: 100,
					align: 'left'
				},
				
				{
					field: 'tgldiagnosis',
					title: 'Tgl Diagnosis',
					width: 120,
					align: 'left'
				},
				{
					field: 'nama_unit',
					title: 'Unit',
					width: 200,
					align: 'left'
				}
			]
		],
		showFooter: true
		//onDblClickRow:function(row,index){
		//EditOutlet();
		//rowStyler:function(index,row){
		//  if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
		//}     
	});

	$('#dgluaran').datagrid({
		width: '500',
		height: '300',
		singleSelect: true,
		pagination: false,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: 'id',
		//url: 'registrasi/readluaran', 
		title: 'Data Luaran Pasien',
		onDblClickRow: function () {
			editluaran();
		},
		columns: [
			[{
					field: 'newstatus',
					title: 'Status',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_abstraksi',
					title: 'Tgl Abstraksi',
					width: 120,
					align: 'center'
				},
				{
					field: 'statusnow',
					title: 'Status Lanjutan',
					width: 130,
					align: 'left'
				},
				{
					field: 'tgl_status',
					title: 'Tanggal',
					width: 120,
					align: 'left'
				},
				{
					field: 'rumah_sakit',
					title: 'Rumah Sakit',
					width: 150,
					align: 'left'
				},
				{
					field: 'namatindakan',
					title: 'Tindakan',
					width: 150,
					align: 'left'
				},
				{
					field: 'ket_lainnya',
					title: 'Tindakan Lain',
					width: 150,
					align: 'left'
				},
				{
					field: 'date_loss',
					title: 'Tgl Loss',
					width: 120,
					align: 'left'
				},
				{
					field: 'date_meninggal',
					title: 'Tgl Meninggal',
					width: 120,
					align: 'left'
				},
				{
					field: 'sebab_kematian',
					title: 'Sebab Kematian',
					width: 150,
					align: 'left'
				},
				// {field:'action',title:'Hapus',width:80,align:'center',formatter:function(value,row,index){  return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deleteLuaran(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> ';  }  
				// } 
			]
		],
		showFooter: true
	});

	$('#dgsubgrup').datagrid({
		width: '300',
		height: '340',
		singleSelect: true,
		pagination: false,
		rownumbers: true,
		collapsible: false,
		nowrap: false,
		fitColumns: false,
		idField: 'id',
		toolbar: "#toolbar",
		url: 'registrasi/optionsubgrup',
		//title:'Data Sub Grup',toolbar="#toolbar"
		columns: [
			[{
				field: 'subgrup',
				title: 'Pilih Sub Grup',
				halign: 'center',
				align: 'left'
			}]
		]
	});

	$('#dgmorfologi').datagrid({
		width: '700',
		height: '340',
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		nowrap: false,
		fitColumns: false,
		idField: 'id',
		toolbar: "#toolbar-m",
		url: 'registrasi/optionmorfologi',
		columns: [
			[{
					field: 'subgrup',
					width: 250,
					title: 'Sub Grup',
					halign: 'center',
					align: 'left'
				},
				{
					field: 'kodemorfologi',
					width: 80,
					title: 'Kode',
					halign: 'center',
					align: 'left'
				},
				{
					field: 'morfologi',
					width: 300,
					title: 'Morfologi',
					halign: 'center',
					align: 'left'
				}
			]
		],
		onClickRow: function () {
			loadtopografi()
		},
		onLoadSuccess: function (data) {
			//Merge all columns
			//$(this).datagrid("autoMergeCells");
			//Specify columns for merging operations  
			$(this).datagrid("autoMergeCells", ['subgrup', '']);
		}
	});

	$('#dgtopografi').datagrid({
		width: '350',
		height: '340',
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		nowrap: false,
		fitColumns: true,
		idField: 'id',
		toolbar: "#toolbar-t",
		//url: 'registrasi/optiontopografi', 
		columns: [
			[{
					field: 'kodetopografi',
					title: 'Kode',
					halign: 'center',
					align: 'left'
				},
				{
					field: 'topografi',
					width: 300,
					title: 'Topografi',
					halign: 'center',
					align: 'left'
				}
			]
		]
	});

	var pager = $('#dgtopografi').datagrid('getPager'); // get the pager of datagrid
	pager.pagination({
		showPageList: false,
		showRefresh: false,
		displayMsg: ''
		// onBeforeRefresh:function(){
		//     alert('before refresh');
		//     return true;
		// }
	});

	var pager2 = $('#dgmorfologi').datagrid('getPager'); // get the pager of datagrid
	pager2.pagination({
		showPageList: false,
		//showRefresh: false,
		// displayMsg: ''
		// onBeforeRefresh:function(){
		//     alert('before refresh');
		//     return true;
		// }
	});

	$('#dgriwayat').datagrid({
		width: 'auto',
		height: '150',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		//footer:"#ft",
		//url: 'subgrup/read', 
		columns: [
			[{
					field: 'keluarga',
					title: 'Hubungan',
					width: 150,
					align: 'left'
				},
				{
					field: 'jenis_kanker',
					title: 'Jenis',
					width: 150,
					align: 'left'
				}
			]
		]
	});

	$('#dgdiagnosis').datagrid({
		width: 'auto',
		height: '150',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		//footer:'#ft2',
		//url: 'subgrup/read', 
		columns: [
			[{
					field: 'diagnosisid',
					title: 'Id',
					width: 50,
					align: 'center',
					hidden: 'true'
				},
				{
					field: 'diagnosis',
					title: 'Diagnosis',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_diagnosis',
					title: 'Tanggal',
					width: 150,
					align: 'left'
				}
				// ,
				// {field:'action',title:'',width:50,align:'center',formatter:function(value,row,index){  return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus" onClick="deleteDiagnosis(\''+index+'\');"><img src=\'assets/themes/icons/delete.png\' border=\'0\'/ class="item-img"></img></a> ';  }  
				// }
			]
		]
	});

	$('#combosubgrup').combogrid({
		panelWidth: 360,
		idField: 'id',
		textField: 'subgrup',
		editable: true,
		pagination: false,
		nowrap: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		url: 'registrasi/optionsubgrup',
		columns: [
			[{
				field: 'subgrup',
				title: 'Subgrup',
				width: 350
			}]
		],
		onSelect: function (index, row) {
			doSearchMorfologi();
			// var id = $('#combosubgrup').combogrid('getValue');
			// $('#dgmorfologi').datagrid('reload',{  
			// kodesubgrup: id,
			// });
		}
	})

	$('#key_unitid').combobox({
		panelWidth: 200,
		panelHeight: '200',
		valueField: 'id',
		editable: false,
		loadMsg: 'Please Wait..',
		textField: 'nama_unit',
		formatter: formatUnit,
		fitColumns: true,
		url: 'registrasi/optionunit',
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

	$('#key_subgrupid').combobox({
		panelWidth: 200,
		panelHeight: '300',
		valueField: 'id',
		editable: false,
		loadMsg: 'Please Wait..',
		textField: 'subgrup',
		fitColumns: true,
		url: 'registrasi/optionsubgrup',
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

	$('#literalitas').combobox({
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

				// $('#id_kab').combogrid('setValue','');
				// var g = $('#id_kab').combogrid('grid');
				// g.datagrid('loadData', []);  
			}
		},
	})

	$('#id_prov').combogrid({
		panelWidth: 400,
		idField: 'id_prov',
		textField: 'propinsi',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		required: true,
		url: 'registrasi/propinsi',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')

				$('#id_kab').combogrid('setValue', '');
				var g = $('#id_kab').combogrid('grid');
				g.datagrid('loadData', []);
			}
		},
		columns: [
			[{
				field: 'propinsi',
				title: 'Nama Propinsi',
				width: 350
			}]
		],
		onSelect: function (index, row) {
			$('#id_kab').combogrid('setValue', '');
			$('#id_kec').combogrid('setValue', '');
			$('#id_kel').combogrid('setValue', '');
			var url = 'registrasi/kabupaten/' + row.id_prov;
			var g = $('#id_kab').combogrid('grid');
			//g.datagrid('loadData', []);  
			g.datagrid('reload', url);
		}
	})
	// custom pagination
	// var g = $('#id_prov').combogrid('grid'); // get datagrid objec
	// var pagerkec = g.datagrid('getPager');  // get the pager of datagrid
	// pagerkec.pagination({
	//     showPageList:false,
	//     showRefresh: false,
	//     displayMsg: ''
	//     // onBeforeRefresh:function(){
	//     // alert('before refresh');
	//     //     return true;
	//     // }
	// });

	$('#id_kab').combogrid({
		panelWidth: 400,
		idField: 'id_kab',
		textField: 'kabupaten',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		required: true,
		//url:'registrasi/kabupaten',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')
				$('#id_kec').combogrid('setValue', '');
				// var url = 'registrasi/kabupaten/'+row.id_prov;
				var g = $('#id_kec').combogrid('grid');
				g.datagrid('loadData', []);
			}
		},
		columns: [
			[{
				field: 'kabupaten',
				title: 'Nama Kabupaten',
				width: 350
			}]
		],
		onSelect: function (index, row) {
			var url = 'registrasi/kecamatan/' + row.id_kab;
			var gkab = $('#id_kec').combogrid('grid');
			$('#id_kec').combogrid('setValue', '');
			$('#id_kel').combogrid('setValue', '');
			//g.datagrid('loadData', []);  
			gkab.datagrid('reload', url);
		}
	})

	// custom pagination

	// var g2 = $('#id_kab').combogrid('grid'); // get datagrid objec
	// var pagerkab = g2.datagrid('getPager');    // get the pager of datagrid
	// pagerkab.pagination({
	//     showPageList:false,
	//     showRefresh: false,
	//     displayMsg: ''
	// });

	$('#id_kec').combogrid({
		panelWidth: 400,
		idField: 'id_kec',
		textField: 'kecamatan',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		//url:'registrasi/optionkecamatan',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')

				$('#id_kel').combogrid('setValue', '');
				var g = $('#id_kel').combogrid('grid');
				g.datagrid('loadData', []);
			}
		},
		columns: [
			[{
				field: 'kecamatan',
				title: 'Nama Kecamatan',
				width: 350
			}]
		],
		onSelect: function (index, row) {
			var url = 'registrasi/desa/' + row.id_kec;
			var g = $('#id_kel').combogrid('grid');
			$('#id_kel').combogrid('setValue', '');
			//g.datagrid('loadData', []);  
			g.datagrid('reload', url);
		}
	})
	// var g3 = $('#id_kec').combogrid('grid'); // get datagrid objec
	// var pagerkec = g3.datagrid('getPager');    // get the pager of datagrid
	// pagerkec.pagination({
	//     showPageList:false,
	//     showRefresh: false,
	//     displayMsg: ''
	// });

	$('#id_kel').combogrid({
		panelWidth: 400,
		idField: 'id_kel',
		textField: 'desa',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		//url:'registrasi/optionkecamatan',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')
			}
		},
		columns: [
			[{
				field: 'desa',
				title: 'Nama Desa',
				width: 350
			}]
		]
	})
	// var g4 = $('#id_kel').combogrid('grid'); // get datagrid objec
	// var pagerdes = g4.datagrid('getPager');    // get the pager of datagrid
	// pagerdes.pagination({
	//     showPageList:false,
	//     showRefresh: false,
	//     displayMsg: ''
	// });

	//------------- Alamat 2 -------------//

	$('#id_prov_2').combogrid({
		panelWidth: 400,
		idField: 'id_prov',
		textField: 'propinsi',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		url: 'registrasi/propinsi',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')

				$('#id_kab_2').combogrid('setValue', '');
				var g = $('#id_kab_2').combogrid('grid');
				g.datagrid('loadData', []);
			}
		},
		columns: [
			[{
				field: 'propinsi',
				title: 'Nama Propinsi',
				width: 350
			}]
		],
		onSelect: function (index, row) {
			var url = 'registrasi/kabupaten/' + row.id_prov;
			var g = $('#id_kab_2').combogrid('grid');
			$('#id_kab_2').combogrid('setValue', '');
			$('#id_kec_2').combogrid('setValue', '');
			$('#id_kel_2').combogrid('setValue', '');
			//g.datagrid('loadData', []);  
			g.datagrid('reload', url);
		}
	})
	var p = $('#id_prov_2').combogrid('grid'); // get datagrid objec
	var pagerp = p.datagrid('getPager'); // get the pager of datagrid
	pagerp.pagination({
		showPageList: false,
		showRefresh: false,
		displayMsg: ''
	});

	$('#id_kab_2').combogrid({
		panelWidth: 400,
		idField: 'id_kab',
		textField: 'kabupaten',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		//url:'registrasi/kabupaten',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')

				$('#id_kec_2').combogrid('setValue', '');
				var g = $('#id_kec_2').combogrid('grid');
				g.datagrid('loadData', []);
			}
		},
		columns: [
			[{
				field: 'kabupaten',
				title: 'Nama Kabupaten',
				width: 350
			}]
		],
		onSelect: function (index, row) {
			var url = 'registrasi/kecamatan/' + row.id_kab;
			var gkab2 = $('#id_kec_2').combogrid('grid');
			$('#id_kec_2').combogrid('setValue', '');
			$('#id_kel_2').combogrid('setValue', '');
			//g.datagrid('loadData', []);  
			gkab2.datagrid('reload', url);
		}
	});

	$('#id_kec_2').combogrid({
		panelWidth: 400,
		idField: 'id_kec',
		textField: 'kecamatan',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		//url:'registrasi/optionkecamatan',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')

				$('#id_kel_2').combogrid('setValue', '');
				var g = $('#id_kel_2').combogrid('grid');
				g.datagrid('loadData', []);
			}
		},
		columns: [
			[{
				field: 'kecamatan',
				title: 'Nama Kecamatan',
				width: 350
			}]
		],
		onSelect: function (index, row) {
			var url = 'registrasi/desa/' + row.id_kec;
			var g = $('#id_kel_2').combogrid('grid');
			$('#id_kel_2').combogrid('setValue', '');
			//g.datagrid('loadData', []);  
			g.datagrid('reload', url);
		}
	});

	$('#id_kel_2').combogrid({
		panelWidth: 400,
		idField: 'id_kel',
		textField: 'desa',
		editable: false,
		pagination: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		//url:'registrasi/optionkecamatan',
		icons: [{
			iconCls: 'icon-clear',
			handler: function (e) {
				$(e.data.target).combogrid('clear').combogrid('textbox').focus();
			}
		}],
		onChange: function (value) {
			if (value) {
				$(this).combogrid('getIcon', 0).css('visibility', 'visible')
			} else {
				$(this).combogrid('getIcon', 0).css('visibility', 'hidden')
			}
		},
		columns: [
			[{
				field: 'desa',
				title: 'Nama Desa',
				width: 350
			}]
		]
	});


	$('#search').keyup(function () {

		doSearchregistrasi();

	});

	$('#diagnosisid').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'dasardiagnosis',
		fitColumns: true,
		editable: false,
		url: 'registrasi/diagnosis',
	});

	$('#tatalaksanaid').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'tatalaksana',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: 'registrasi/tatalaksana',
		formatter: function (row) {
			var opts = $(this).combobox('options');
			return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', true);

		},
		onUnselect: function (row) {
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', false);
			//console.log(row)
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox('options');
			var target = this;
			var values = $(target).combobox('getValues');
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find('input.combobox-checkbox')._propAttr('checked', true);
			})
		},
		// getValue: function(target){
		//         var opts = $(target).combobox('options');
		//         if (opts.multiple){
		//             console.log($(target).combobox('getValues').join(opts.separator));
		//         } else {
		//             return $(target).combobox('getValue');
		//         }
		//     },
	});

	$('#tindakan').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'tatalaksana',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: 'registrasi/tatalaksana',
		formatter: function (row) {
			var opts = $(this).combobox('options');
			return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', true);

		},
		onUnselect: function (row) {
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', false);
			//console.log(row)
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox('options');
			var target = this;
			var values = $(target).combobox('getValues');
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find('input.combobox-checkbox')._propAttr('checked', true);
			})
		},
	});

	$('#stagingid').combobox({
		// url: 'registrasi/staging/stagingid',
		//panelHeight:200,
		checkbox: true,
		loadMsg: 'Please Wait..',
		method: 'get',
		editable: false,
		valueField: 'id',
		textField: 'staging',
		//     groupField:'grup',
		//       onLoadSuccess:function(items){
		//         if (items.length){
		//         var opts = $(this).combobox('options');
		//         $(this).combobox('select', items[0][opts.valueField]);
		//     }
		// },
	})

	$.extend($.fn.datagrid.methods, {
		autoMergeCells: function (jq, fields) {
			return jq.each(function () {
				var target = $(this);
				if (!fields) {
					fields = target.datagrid("getColumnFields");
				}
				var rows = target.datagrid("getRows");
				var i = 0,
					j = 0,
					temp = {};
				for (i; i < rows.length; i++) {
					var row = rows[i];
					j = 0;
					for (j; j < fields.length; j++) {
						var field = fields[j];
						var tf = temp[field];
						if (!tf) {
							tf = temp[field] = {};
							tf[row[field]] = [i];
						} else {
							var tfv = tf[row[field]];
							if (tfv) {
								tfv.push(i);
							} else {
								tfv = tf[row[field]] = [i];
							}
						}
					}
				}
				$.each(temp,
					function (field, colunm) {
						$.each(colunm,
							function () {
								var group = this;

								if (group.length > 1) {
									var before, after, megerIndex = group[0];
									for (var i = 0; i < group.length; i++) {
										before = group[i];
										after = group[i + 1];
										if (after && (after - before) == 1) {
											continue;
										}
										var rowspan = before - megerIndex + 1;
										if (rowspan > 1) {
											target.datagrid('mergeCells', {
												index: megerIndex,
												field: field,
												rowspan: rowspan
											});
										}
										if (after && (after - before) != 1) {
											megerIndex = after;
										}
									}
								}
							});
					});
			});
		}
	});

})

function onLoadSuccess(data) {
	// alert(data.index)
	// var merges = [{
	//     index: 2,
	//     rowspan: 2
	// }];
	// for(var i=0; i<merges.length; i++){
	//     $(this).datagrid('mergeCells',{
	//         index: merges[i].index,
	//         field: 'subgrup',
	//         rowspan: merges[i].rowspan
	//     });
	// }
	$(this).datagrid("autoMergeCells", ['subgrup', '']);
}

function formatUnit(row) {
	var s = '<span style="font-weight:bold">' + row.nama_unit + '</span><br/>' +
		'<span style="color:#888">' + row.alamat + '</span>';
	return s;
}

function moresearch() {
	$('#dlg-search').dialog('open');
	$('#fm-search').form('clear');
	document.getElementById("semua").checked = true;
	document.getElementById("luaran_u").checked = true;
	document.getElementById("status_u").checked = true;
	$('#key_area_id').combobox('reload', 'area/options');
}

function deleteRiwayat(index) {
	$('#dgriwayat').datagrid('deleteRow', index);
	//$('#dgriwayat').datagrid('reload');
}

function deleteDiagnosis(index) {
	//var dg = $('#dgdiagnosis');
	//var index = dg.datagrid('getRowIndex');
	// alert(index);
	$('#dgdiagnosis').datagrid('deleteRow', index);
	//$('#dgdiagnosis').datagrid('reload');
}

function getstaging(id) {
	// var dg = $('#stagingid').combobox('grid');
	$('#stagingid').combobox('clear');
	var url = 'registrasi/staging?stagingid=' + id;
	$('#stagingid').combobox('reload', url);
}

function tambahkan() {
	var rowmorfologi = $('#dgmorfologi').datagrid('getSelected');
	var rowtopografi = $('#dgtopografi').datagrid('getSelected');

	if (rowmorfologi) {
		document.getElementById('labelsubgrup').innerHTML = rowmorfologi.subgrup;
		document.getElementById('labelkodesubgrup').innerHTML = rowmorfologi.kodesubgrup;
		document.getElementById('subgrupid').value = rowmorfologi.id;
		rowmorfologi

		document.getElementById('labelmorfologi').innerHTML = rowmorfologi.morfologi;
		document.getElementById('labelkodemorfologi').innerHTML = rowmorfologi.kodemorfologi;
		document.getElementById('morfologiid').value = rowmorfologi.morfologiid;
	} else {
		$.messager.alert('warning', 'anda belum memilih data', 'warning');
	}
	if (rowtopografi) {
		document.getElementById('labeltopografi').innerHTML = rowtopografi.topografi;
		document.getElementById('labelkodetopografi').innerHTML = rowtopografi.kodetopografi;
		document.getElementById('topografiid').value = rowtopografi.topografiid;
	} else {
		document.getElementById('labeltopografi').innerHTML = '';
		document.getElementById('labelkodetopografi').innerHTML = '';
		document.getElementById('topografiid').value = '';
	}
	getstaging(rowmorfologi.stagingid);
	$('#dlg-subreg').dialog('close');
}

function tampilkan(isi) {
	if (isi == 'y') {
		document.getElementById("tgriwayat").style.display = '';
		document.getElementById("btnriwayat").style.display = '';
		document.getElementById("btn-hapus-riwayat").style.display = '';
	} else if (isi == 'n') {
		document.getElementById("tgriwayat").style.display = 'none';
		document.getElementById("btnriwayat").style.display = 'none';
		document.getElementById("btn-hapus-riwayat").style.display = 'none';
		$('#dgriwayat').datagrid('loadData', {
			"total": 0,
			"rows": []
		});
	} else {
		document.getElementById("tgriwayat").style.display = 'none';
		document.getElementById("btnriwayat").style.display = 'none';
		document.getElementById("btn-hapus-riwayat").style.display = 'none';
		$('#dgriwayat').datagrid('loadData', {
			"total": 0,
			"rows": []
		});
	}

}

function showstatus2(v) {
	if (v == 1) {
		document.getElementById("statushidup").style.display = '';
		document.getElementById("sebabkematian").style.display = 'none';

		$('#date_loss').datebox('clear');
		$('#date_loss').datebox('readonly');
		$('#date_meninggal').datebox('clear');
		$('#date_meninggal').datebox('readonly');

	} else if (v == 2) {
		document.getElementById("statushidup").style.display = 'none';
		document.getElementById("sebabkematian").style.display = 'none';

		$('#date_loss').datebox('readonly', false);
		$('#date_meninggal').datebox('clear');
		$('#date_meninggal').datebox('readonly');

		$('#date_complete').datebox('clear');
		$('#date_complete').datebox('readonly');
		$('#date_stable').datebox('clear');
		$('#date_stable').datebox('readonly');
		$('#date_relaps').datebox('clear');
		$('#date_relaps').datebox('readonly');
		$('#date_progresif').datebox('clear');
		$('#date_progresif').datebox('readonly');

	} else if (v == 3) {
		document.getElementById("statushidup").style.display = 'none';
		document.getElementById("sebabkematian").style.display = '';

		$('#date_loss').datebox('readonly');
		$('#date_loss').datebox('clear');
		$('#date_meninggal').datebox('readonly', false);

		$('#date_complete').datebox('clear');
		$('#date_complete').datebox('readonly');
		$('#date_stable').datebox('clear');
		$('#date_stable').datebox('readonly');
		$('#date_relaps').datebox('clear');
		$('#date_relaps').datebox('readonly');
		$('#date_progresif').datebox('clear');
		$('#date_progresif').datebox('readonly');
	}
}

function showstatus(v) {
	if (v == 1) {
		document.getElementById("statushidup").style.display = '';
		document.getElementById("sebabkematian").style.display = 'none';
		$('#date_loss').datebox('clear');
		$('#date_loss').datebox('readonly');
		$('#date_meninggal').datebox('clear');
		$('#date_meninggal').datebox('readonly');

		$('#date_complete').datebox('clear');
		$('#date_complete').datebox('readonly');
		$('#date_stable').datebox('clear');
		$('#date_stable').datebox('readonly');
		$('#date_relaps').datebox('clear');
		$('#date_relaps').datebox('readonly');
		$('#date_progresif').datebox('clear');
		$('#date_progresif').datebox('readonly');
	} else if (v == 2) {
		document.getElementById("statushidup").style.display = 'none';
		document.getElementById("sebabkematian").style.display = 'none';
		document.getElementById("cm").checked = false;
		$('#date_complete').datebox('clear');
		$('#date_complete').datebox('readonly');
		document.getElementById("st").checked = false;
		$('#date_stable').datebox('clear');
		$('#date_stable').datebox('readonly');
		document.getElementById("re").checked = false;
		$('#date_relaps').datebox('clear');
		$('#date_relaps').datebox('readonly');
		document.getElementById("pr").checked = false;
		$('#date_progresif').datebox('clear');
		$('#date_progresif').datebox('readonly');
		$('#date_meninggal').datebox('clear');
		$('#rumah_sakit').textbox('clear');
		$('#tindakan').combobox('clear');
		$('#ket_lainnya').textbox('clear');
		$('#sebab_kematian').textbox('clear');
		$('#date_loss').datebox('readonly', false);
		$('#date_meninggal').datebox('readonly');
		// $('#dgriwayat').datagrid('loadData', {"total":0,"rows":[]});
	} else if (v == 3) {
		document.getElementById("statushidup").style.display = 'none';
		document.getElementById("sebabkematian").style.display = '';
		document.getElementById("cm").checked = false;
		$('#date_complete').datebox('clear');
		$('#date_complete').datebox('readonly');
		document.getElementById("st").checked = false;
		$('#date_stable').datebox('clear');
		$('#date_stable').datebox('readonly');
		document.getElementById("re").checked = false;
		$('#date_relaps').datebox('clear');
		$('#date_relaps').datebox('readonly');
		document.getElementById("pr").checked = false;
		$('#date_progresif').datebox('clear');
		$('#date_progresif').datebox('readonly');
		$('#date_loss').datebox('clear');
		$('#rumah_sakit').textbox('clear');
		$('#tindakan').combobox('clear');
		$('#ket_lainnya').textbox('clear');
		$('#date_loss').datebox('readonly');
		$('#date_meninggal').datebox('readonly', false);
		// $('#dgriwayat').datagrid('loadData', {"total":0,"rows":[]});
	}

}

function opendate(v) {
	if (v == 'cm') {
		$('#date_complete').datebox('readonly', false);

		$('#date_stable').datebox('clear');
		$('#date_relaps').datebox('clear');
		$('#date_progresif').datebox('clear');

		$('#date_stable').datebox('readonly');
		$('#date_relaps').datebox('readonly');
		$('#date_progresif').datebox('readonly');
	} else if (v == 'st') {
		$('#date_stable').datebox('readonly', false);

		$('#date_complete').datebox('clear');
		$('#date_relaps').datebox('clear');
		$('#date_progresif').datebox('clear');

		$('#date_complete').datebox('readonly');
		$('#date_relaps').datebox('readonly');
		$('#date_progresif').datebox('readonly');
	} else if (v == 're') {
		$('#date_relaps').datebox('readonly', false);

		$('#date_complete').datebox('clear');
		$('#date_stable').datebox('clear');
		$('#date_progresif').datebox('clear');

		$('#date_complete').datebox('readonly');
		$('#date_stable').datebox('readonly');
		$('#date_progresif').datebox('readonly');
	} else if (v == 'pr') {
		$('#date_progresif').datebox('readonly', false);

		$('#date_complete').datebox('clear');
		$('#date_stable').datebox('clear');
		$('#date_relaps').datebox('clear');

		$('#date_complete').datebox('readonly');
		$('#date_stable').datebox('readonly');
		$('#date_relaps').datebox('readonly');
	}
}

function myformatter(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	var d = date.getDate();
	return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
}

function sriwayat(isi) {
	if (isi == 'y') {
		document.getElementById("trppk1").style.display = '';
		document.getElementById("trppk2").style.display = '';
		document.getElementById("trppk3").style.display = '';
		$('#ppk1').textbox('textbox').focus();
	} else {
		document.getElementById("trppk1").style.display = 'none';
		document.getElementById("trppk2").style.display = 'none';
		document.getElementById("trppk3").style.display = 'none';
		$('#ppk1').textbox('clear');
		$('#ppk2').textbox('clear');
		$('#ppk3').textbox('clear');
	}
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

function doSearch() {

	var value = $('#search').val();
	var tglregistrasi = $('#key_tglregistrasi').val();
	var tglregistrasi2 = $('#key_tglregistrasi2').val();
	var tgldiagnosis = $('#key_tgldiagnosis').val();
	var tgldiagnosis2 = $('#key_tgldiagnosis2').val();
	var validasi = $("input[name='key_validasi']:checked").val();
	var status = $("input[name='key_status']:checked").val();
	var luaran = $("input[name='key_luaran']:checked").val();
	var unitid = $('#key_unitid').val();
	var subgrupid = $('#key_subgrupid').val();

	$('#dgregistrasi').datagrid('reload', {
		search: value,
		tglregistrasi: tglregistrasi,
		tglregistrasi2: tglregistrasi2,
		tgldiagnosis: tgldiagnosis,
		tgldiagnosis2: tgldiagnosis2,
		validasi: validasi,
		status: status,
		luaran: luaran,
		unitid: unitid,
		subgrupid: subgrupid
	});
}

function doSearchSubgrup() {
	var search = $('#searchsubgrup').val();
	$('#dgsubgrup').datagrid('reload', {
		search: search,
	});
}

function doSearchMorfologi() {
	var id = $('#combosubgrup').combogrid('getValue');
	var search = $('#searchmorfologi').val();
	$('#dgmorfologi').datagrid('reload', {
		search: search,
		kodesubgrup: id
	});
}

function loadtopografi() {
	var row = $('#dgmorfologi').datagrid('getSelected');
	var id = $('#combosubgrup').combogrid('getValue');

	var search = $('#searchtopografi').val();
	var url = 'registrasi/optiontopografi?search=' + search + '&kodesubgrup=' + row.id;
	$('#dgtopografi').datagrid('reload', url);
}

function doSearchTopografi() {
	var row = $('#dgmorfologi').datagrid('getSelected');
	var id = $('#combosubgrup').combogrid('getValue');

	var search = $('#searchtopografi').val();

	$('#dgtopografi').datagrid('reload', {
		search: search,
		kodesubgrup: row.id
	});
}

function clearSearch() {

	$('#search').searchbox('clear');
	$('#fm-search').form('clear')

	$('#dgregistrasi').datagrid('reload', {
		search: '',
		tglregistrasi: '',
		tglregistrasi2: '',
		validasi: '',
		unitid: ''
	});
}

function no_registrasi() {
	//  var noregistrasi ='';
	var nounit = document.getElementById("ssnya").value;
	var x = 'l'; //document.getElementByName("jeniskelamin").value;
	if (x == 'l') {
		j = 1;
	} else if (x == 'p') {
		j = 2;
	} else {
		j = 0;
	}
	var no = '';
	$.getJSON('registrasi/no_registrasi', {
		get_param: 'value'
	}, function (data) {
		document.getElementById('nourut').value = data.nourut;
	});

	noregistrasi = nounit + j + no;
	//$('#dlg').dialog({title : nounit});
	document.getElementById('noregistrasi').value = noregistrasi;
}

function cariSubgrup() {
	$('#dlg-subreg').dialog('open').dialog('setTitle', 'Cari dan klik pada data penyakit/atau tumor yang di maksud. dari mulai sub grup, morfologi dan topografi lalu klik tambahkan');
	$('#dgtopografi').datagrid('loadData', []);
	$('#dgmorfologi').datagrid('loadData', []);
	$('#dgmorfologi').datagrid('clearSelections');
	$('#dgtopografi').datagrid('clearSelections');
	$('#combosubgrup').combogrid('clear');
	$('#searchmorfologi').searchbox('clear')
	doSearchMorfologi();
}

function addtogrid() {
	var d1 = $('#hubkeluarga').textbox('getValue'),
		d2 = $('#jkanker').textbox('getValue');
	if (d1 && d2) {
		$('#dgriwayat').datagrid('appendRow', {
			keluarga: d1,
			jenis_kanker: d2
		});
		$('#hubkeluarga').textbox('setValue', '');
		$('#jkanker').textbox('setValue', '');
	} else {
		$.messager.alert('warning', 'mohon isi kolom keluarga terlebih dahulu', 'warning');
	}

}

function adddiagnosis() {
	var a = $('#diagnosisid').combobox('getValue'),
		b = $('#diagnosisid').combobox('getText'),
		c = $('#tgl_diagnosis').datebox('getValue')

	if (b && c) {
		$('#dgdiagnosis').datagrid('appendRow', {
			diagnosisid: a,
			diagnosis: b,
			tgl_diagnosis: c
		});
		$('#diagnosisid').combobox('setValue', '');
	} else {
		$.messager.alert('warning', 'mohon isi kolom diagnosis terlebih dahulu', 'warning');
	}
}

function progress() {
	$.messager.progress({
		title: 'Mohon Tunggu',
		msg: 'Simpan data...'
	});
}

function kosongkanriwayat() {
	$('#dgriwayat').datagrid('loadData', {
		"total": 0,
		"rows": []
	});
}

function kosongkandiagnosis() {
	$('#dgdiagnosis').datagrid('loadData', {
		"total": 0,
		"rows": []
	});
}

function add() {
	$('#dlg').dialog('open').dialog('setTitle', 'Tambah Registrasi');
	$('#fm').form('clear');
	$('#id_prov').combogrid('grid').datagrid('reload');
	document.getElementById("laki").checked = true;
	document.getElementById("bunknow").checked = true;
	document.getElementById("imunisasi_u").checked = true;
	document.getElementById("asi_u").checked = true;
	document.getElementById("ry").checked = true;
	document.getElementById("r_n").checked = true;
	with(new Date) {
		$('#tgl_lahir').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_ppk1').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_ppk2').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_ppk3').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_konsultasi').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_diagnosis').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_keluhan_pertama').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	$('#dgriwayat').datagrid('loadData', {
		"total": 0,
		"rows": []
	});
	$('#dgdiagnosis').datagrid('loadData', {
		"total": 0,
		"rows": []
	});

	document.getElementById('labelsubgrup').innerHTML = '';
	document.getElementById('labelkodesubgrup').innerHTML = '';
	document.getElementById('subgrupid').value = '';

	document.getElementById('labelmorfologi').innerHTML = '';
	document.getElementById('labelkodemorfologi').innerHTML = '';
	document.getElementById('morfologiid').value = '';

	document.getElementById('labeltopografi').innerHTML = '';
	document.getElementById('labelkodetopografi').innerHTML = '';
	document.getElementById('topografiid').value = '';
	$('#btnlink').linkbutton({
		text: 'Simpan'
	});
	url = 'registrasi/save';
}

function save() {

	var tatalaksanaid = $('#tatalaksanaid').combobox('getValues');
	// ubah nilai val jadi string array
	// _StrInvitees = String(val);
	// $('#tatalaksanaid').combobox('setValue', _StrInvitees);

	//ambil data dg riwayat
	var getdata = $('#dgriwayat').datagrid('getRows');
	var datadetail = JSON.stringify(getdata);
	var detail = '?datajson=' + encodeURIComponent(datadetail);

	//ambil data dg diagnosis
	var getdata2 = $('#dgdiagnosis').datagrid('getRows');
	var datadetail2 = JSON.stringify(getdata2);
	var detail2 = '&datajson2=' + encodeURIComponent(datadetail2);
	if (document.getElementById('ry').checked && getdata == 0) {
		$.messager.alert('warning', 'isi data riwayat keganasan pada keluarga', 'warning');
	} else if (getdata2 == 0) {
		$.messager.alert('warning', 'isi data dasar diagnosis', 'warning');
	} else {
		progress() // show the message box
		$('#fm').form('submit', {

			url: url + detail + detail2 + '&tatalaksanaid=' + tatalaksanaid,

			onSubmit: function () {
				//return $(this).form('validate');
				var v = $(this).form('validate');
				if (!v) $.messager.progress('close'); // close the message box
				return v;
			},
			success: function (result) {
				var result = eval('(' + result + ')');
				console.log(result);
				if (result.errorMsg) {
					//$.messager.progress('close');
					$.messager.show({
						title: 'Error',
						msg: result.errorMsg
					});
				} else {
					$.messager.progress('close');
					$.messager.alert('Info', 'Data Sukses Disimpan', '');
					$('#dlg').dialog('close'); // close the dialog
					$('#dgregistrasi').datagrid('reload'); // reload the user data
				}
			}
		});
	}
}

function edit() {
	var ui = document.getElementById("uid").value;
	var row = $('#dgregistrasi').datagrid('getSelected');

	if (row) {
		// cek apakah data ini data unit yang login??
		if (ui == row.unitid) {
			$('#dlg').dialog('open').dialog('setTitle', 'Edit Registrasi');
			$('#fm').form('load', row);

			var urlprop = 'registrasi/propinsi/' + row.id_prov;
			$('#id_prov').combogrid('grid').datagrid('reload', urlprop);
			$('#id_prov').combogrid('setValue', {
				id_prov: row.id_prov,
				propinsi: row.propinsi
			});
			if (row.id_prov != '') {
				var urlkab = 'registrasi/kabupaten/' + row.id_prov;
				$('#id_kab').combogrid('grid').datagrid('reload', urlkab);
				$('#id_kab').combogrid('setValue', {
					id_kab: row.id_kab,
					kabupaten: row.kabupaten
				});
			}
			if (row.id_kab != '') {
				var urlkec = 'registrasi/kecamatan/' + row.id_kab;
				$('#id_kec').combogrid('grid').datagrid('reload', urlkec);
				$('#id_kec').combogrid('setValue', {
					id_kec: row.id_kec,
					kecamatan: row.kecamatan
				});
			}
			if (row.id_kec != '') {
				var urldesa = 'registrasi/desa/' + row.id_kec;
				$('#id_kel').combogrid('grid').datagrid('reload', urldesa);
				$('#id_kel').combogrid('setValue', {
					id_kel: row.id_kel,
					desa: row.desa
				});
			}

			var urlprop2 = 'registrasi/propinsi/' + row.id_prov_2;
			$('#id_prov_2').combogrid('grid').datagrid('reload', urlprop2);
			$('#id_prov_2').combogrid('setValue', {
				id_prov: row.id_prov_2,
				propinsi: row.propinsi
			});
			if (row.id_prov_2 != '') {
				var urlkab2 = 'registrasi/kabupaten/' + row.id_prov_2;
				$('#id_kab_2').combogrid('grid').datagrid('reload', urlkab2);
				$('#id_kab_2').combogrid('setValue', {
					id_kab: row.id_kab_2,
					kabupaten: row.kabupaten
				});
			}
			if (row.id_kab_2 != '') {
				var urlkec2 = 'registrasi/kecamatan/' + row.id_kab_2;
				$('#id_kec_2').combogrid('grid').datagrid('reload', urlkec2);
				$('#id_kec_2').combogrid('setValue', {
					id_kec: row.id_kec_2,
					kecamatan: row.kecamatan
				});
			}
			if (row.id_kec_2 != '') {
				var urldesa2 = 'registrasi/desa/' + row.id_kec_2;
				$('#id_kel_2').combogrid('grid').datagrid('reload', urldesa2);
				$('#id_kel_2').combogrid('setValue', {
					id_kel: row.id_kel_2,
					desa: row.desa
				});
			}
			if (row.riwayat_rujukan == 'y') {
				document.getElementById("trppk1").style.display = '';
				document.getElementById("trppk2").style.display = '';
				document.getElementById("trppk3").style.display = '';
			} else {
				document.getElementById("trppk1").style.display = 'none';
				document.getElementById("trppk2").style.display = 'none';
				document.getElementById("trppk3").style.display = 'none';
			}
			//tampilkan data staging bedasar id yang ada di subgrup
			getstaging(row.idstaging)
			//pilih nilai sesua yang ada di registrasi
			$('#stagingid').combobox('setValue', row.stagingid)

			$('#dgriwayat').datagrid('reload', 'registrasi/getdatariwayat?registrasiid=' + row.id);
			$('#dgdiagnosis').datagrid('reload', 'registrasi/getdatadiagnosis?registrasiid=' + row.id);

			document.getElementById('labelmorfologi').innerHTML = row.morfologi;
			document.getElementById('labelkodemorfologi').innerHTML = row.kodemorfologi;
			//document.getElementById('morfologiid').value = row.idmorfologi;
			document.getElementById('labeltopografi').innerHTML = row.topografi;
			document.getElementById('labelkodetopografi').innerHTML = row.kodetopografi;
			//document.getElementById('topografiid').value = row.idtopografi;
			document.getElementById('labelsubgrup').innerHTML = row.subgrup;
			document.getElementById('labelkodesubgrup').innerHTML = row.kodesubgrup;
			//document.getElementById('subgrupid').value = row.id;
			$('#btnlink').linkbutton({
				text: 'Update'
			});
			url = 'registrasi/update/' + row.id;
		} else {
			$.messager.alert('Warning', 'Maaf! Anda tidak bisa edit data ini', 'warning');
		}
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau diedit', 'warning');
	}
}

function remove() {
	var ui = document.getElementById("uid").value;
	var row = $('#dgregistrasi').datagrid('getSelected');
	if (row) {
		if (ui == row.unitid) {
			$.messager.confirm('Konfirmasi', 'Apakah anda yakin akan menghapus data \"' + row.nama + '\" ?', function (r) {
				if (r) {
					$.post('registrasi/delete', {
							id: row.id
						},
						function (result) {
							if (result.success) {
								$.messager.alert('info', 'Data Registrasi\"' + row.nama + '\" telah di hapus !', 'info');
								$('#dgregistrasi').datagrid('reload');
							} else {
								$.messager.show({
									title: 'Error',
									msg: result.msg
								});
							}
						}, 'json');
					$('#dlg').dialog('close');
				}
			});
		} else {
			$.messager.alert('Warning', 'Maaf! Anda tidak bisa menghapus data ini', 'warning');
		}
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau dihapus', 'warning');
	}

}

function updateluaran() {
	var ui = document.getElementById("uid").value;
	var row = $('#dgregistrasi').datagrid('getSelected');
	if (row) {
		if (row.validate == 'y') {
			if (ui == row.unitid) {
				$('#dlg-luaran').dialog('open').dialog('setTitle', 'Update Data Luaran');
				$('#fmluaran').form('clear');
				$('#dgluaran').datagrid('reload', 'registrasi/readluaran?registrasiid=' + row.id)
				document.getElementById('labelnoreg').innerHTML = row.noregistrasi;
				document.getElementById('labelnama').innerHTML = row.nama;
				document.getElementById('registrasiid').value = row.id;
				with(new Date) {
					$('#tgl_abstraksi').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				$('#lnk').linkbutton({
					text: 'Simpan'
				});
				url = 'registrasi/saveluaran';
			} else {
				$.messager.alert('Warning', 'Maaf! Anda tidak bisa edit data ini', 'warning');
			}
		} else {
			$.messager.alert('Warning', 'Data ini belum di validasi', 'warning');
		}
	} else {
		$.messager.alert('Warning', 'Pilih data terlebih dahulu', 'warning');
	}

}

function saveluaran() {
	var val = $('#tindakan').combobox('getValues');
	// ubah nilai val jadi string array
	_StrInvitees = String(val);
	$('#tindakan').combobox('setValue', _StrInvitees);

	var st = $("input[name='status']:checked").val();
	if (st) {
		progress();
		$('#fmluaran').form('submit', {

			url: url,

			onSubmit: function () {
				//return $(this).form('validate');
				var v = $(this).form('validate');
				if (!v) $.messager.progress('close'); // close the message box
				return v;
			},
			success: function (result) {
				var result = eval('(' + result + ')');
				if (result.errorMsg) {
					//$.messager.progress('close');
					$.messager.show({
						title: 'Error',
						msg: result.errorMsg
					});
				} else {
					$.messager.progress('close');
					$('#lnk').linkbutton({
						text: 'Simpan'
					});
					url = 'registrasi/saveluaran';
					$.messager.alert('Info', 'Data Sukses Disimpan', '');
					$('#fmluaran').form('clear');

					document.getElementById('registrasiid').value = $('#dgregistrasi').datagrid('getSelected').id;
					with(new Date) {
						$('#tgl_abstraksi').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
					}
					//$('#dlg').dialog('close');        // close the dialog
					$('#dgluaran').datagrid('reload'); // reload the user data
				}
			}
		});
	} else {
		$.messager.alert('warning', 'Pilih Status terlebih dahulu', 'warning');
	}
}

function editluaran() {
	var row = $('#dgluaran').datagrid('getSelected');
	if (row) {

		$('#fmluaran').form('load', row);

		opendate(row.status2)
		showstatus2(row.status)
		$('#tindakan').combobox('reload', 'registrasi/gettatalaksana?id=' + row.idtindakan)
		url = 'registrasi/updateluaran/' + row.id;
		$('#lnk').linkbutton({
			text: 'Update'
		});
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau diedit', 'warning');
	}
}

function deleteLuaran(id) {
	if (id) {
		$.messager.confirm('Konfirmasi', 'yakin akan menghapus data ini ?', function (r) {
			if (r) {
				$.post('registrasi/deleteluaran', {
						id: id
					},
					function (result) {
						if (result.success) {
							$.messager.alert('info', 'Data telah di hapus !', 'info');
							$('#dgluaran').datagrid('reload');
						} else {
							$.messager.show({
								title: 'Error',
								msg: result.msg
							});
						}
					}, 'json');

			}
		});
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau dihapus', 'warning');
	}

}

function removedata() {
	var row = $('#dgregistrasi').datagrid('getSelected');
	var aktif;
	if (row.aktif == 'y') {
		aktif = 'n';
		var str = 'nonaktifkan';
	} else {
		aktif = 'y';
		var str = 'aktifkan';
	}
	$.messager.confirm('Confirm', 'Apakah Anda yakin akan ' + str + ' atas nama ' + row.muzakki + ' ?', function (r) {
		if (r) {
			$.post('?mod=df&file=df&m=remove', {
				id: row.id,
				aktif: aktif
			}, function (result) {
				if (result.success) {
					$.messager.show({
						title: 'Information',
						msg: 'Nama \"' + row.muzakki + '\" telah di ' + str + ' !'
					});
					$('#dgPerson').datagrid('reload');
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}, 'json');
			$('#dlgAction').dialog('close');
		}
	});
}

function exportdata() {
	var value = $('#search').val();
	var tgl1 = $('#key_tglregistrasi').val();
	var tgl2 = $('#key_tglregistrasi2').val();
	var tgldiagnosis = $('#key_tgldiagnosis').val();
	var tgldiagnosis2 = $('#key_tgldiagnosis2').val();
	var validasi = $("input[name='key_validasi']:checked").val();
	var luaran = $("input[name='key_luaran']:checked").val();
	var status = $("input[name='key_status']:checked").val();
	var unitid = $('#key_unitid').val();
	var subgrupid = $('#key_subgrupid').val();

	window.open('registrasi/export?search=' + value + '&tgl1=' + tgl1 + '&tgl2=' + tgl2 + '&validasi=' + validasi + '&luaran=' + luaran + '&status=' + status + '&unitid=' + unitid + '&subgrupid=' + subgrupid+ '&tgldiagnosis=' + tgldiagnosis + '&tgldiagnosis2=' + tgldiagnosis2);
}
