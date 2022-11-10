$(document).ready(function () {

	$('#searchPasien').combogrid({
		panelWidth: 600,
		idField: 'id',
		textField: 'nama',
		editable: true,
		pagination: true,
		nowrap: false,
		loadMsg: 'Please Wait..',
		mode: 'remote',
		url: 'registerspesifik/caripasien',
		columns: [
			[{
					field: 'noregistrasi',
					title: 'No Registrasi',
					width: 120
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
				{
					field: 'subgrup',
					title: 'Subgrup',
					width: 300,
					align: 'left'
				},
				{
					field: 'morfologi',
					title: 'Morfologi',
					width: 150,
					align: 'left'
				},
				{
					field: 'topografi',
					title: 'Topografi',
					width: 150,
					align: 'left'
				},
				{
					field: 'no_rekam',
					title: 'No Rekam Medis',
					width: 200,
					align: 'left'
				},
				{
					field: 'jkelamin',
					title: 'Jenis Kelamin',
					width: 120,
					align: 'left'
				},
				{
					field: 'alamat',
					title: 'Alamat',
					width: 200,
					align: 'left'
				},
			]
		],
		onSelect: function (index, row) {
			entryspesifik(row)
		}
	})

	$('#dgregisterspesifik').datagrid({
		//width: 'auto', 
		height: '400',
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: 'id',
		url: 'registerspesifik/read',
		title: 'Data Register Spesifik',
		onDblClickRow: function () {
			edit();
		},
		frozenColumns: [
			[{
					field: 'noregistrasi',
					title: 'No Reg',
					width: 100,
					align: 'left'
				},
				{
					field: 'nama',
					title: 'Nama Lengkap',
					width: 200,
					align: 'left'
				},
			]
		],
		columns: [
			[{
					field: 'keluhan',
					title: 'Keluhan Utama',
					width: 200,
					align: 'left'
				},
				{
					field: 'keluhan_utama_lainnya',
					title: 'Keluhan Lainnya',
					width: 180,
					align: 'left'
				},
				{
					field: 'thn_keluhan',
					title: 'Thn Keluhan',
					width: 120,
					align: 'center'
				},
				{
					field: 'bln_keluhan',
					title: 'Bln Keluhan',
					width: 120,
					align: 'center'
				},
				{
					field: 'durasi_penyakit',
					title: 'Durasi Penyakit',
					width: 150,
					align: 'center'
				},
				{
					field: 'periksafisik',
					title: 'Pemeriksaan Fisik',
					width: 150,
					align: 'left'
				},
				{
					field: 'pemeriksaan_fisik_lainnya',
					title: 'Pemeriksaan Lainnya',
					width: 180,
					align: 'left'
				},
				{
					field: 'keluhanpenyerta',
					title: 'Keluhan Penyerta',
					width: 160,
					align: 'left'
				},
				{
					field: 'keluhan_penyerta_lainnya',
					title: 'Penyerta Lainnya',
					width: 180,
					align: 'left'
				},
				{
					field: 'besar_hepar',
					title: 'Besar Hepar',
					width: 150,
					align: 'left'
				},
				{
					field: 'besar_spleen',
					title: 'Besar Spleen',
					width: 80,
					align: 'left'
				},
				{
					field: 'besar_schuffner',
					title: 'Besar Schuffner',
					width: 80,
					align: 'left'
				},
				{
					field: 'nama_limfadenopati',
					title: 'Limpadenopati',
					width: 150,
					align: 'left'
				},
				{
					field: 'tanner_stage',
					title: 'Tanner Stage',
					width: 250,
					align: 'left'
				},
				{
					field: 'morfologi',
					title: 'Morfologi',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_periksadarah',
					title: 'Tgl Periksa Darah',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_periksa_tulangbelakang',
					title: 'Tgl Periksa Tulang Belakang',
					width: 150,
					align: 'left'
				},
				{
					field: 'mieloblas',
					title: 'Mieloblas',
					width: 150,
					align: 'left'
				},
				{
					field: 'limfoblas',
					title: 'Limfoblas',
					width: 150,
					align: 'left'
				},
				{
					field: 'jml_sel',
					title: 'Jml Sel',
					width: 150,
					align: 'left'
				},
				{
					field: 'blast',
					title: 'Blast',
					width: 150,
					align: 'left'
				},
				{
					field: 'leukosit',
					title: 'Leukosit',
					width: 150,
					align: 'left'
				},
				{
					field: 'eritrosit',
					title: 'Eritrosit',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_periksaurin',
					title: 'Tgl Periksa Urin',
					width: 150,
					align: 'left'
				},
				{
					field: 'ph_urin',
					title: 'Ph Urin',
					width: 150,
					align: 'left'
				},
				{
					field: 'fab',
					title: 'Fab',
					width: 150,
					align: 'left'
				},
				{
					field: 'sitogenetik',
					title: 'Sitogenetik',
					width: 150,
					align: 'left'
				},
				{
					field: 'stratifikasi',
					title: 'Stratifikasi',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_diagnosis',
					title: 'Tgl Diagnosis',
					width: 150,
					align: 'left'
				},
				{
					field: 'neutropenia',
					title: 'Neutropenia',
					width: 150,
					align: 'left'
				},
				{
					field: 'datainfeksi',
					title: 'Infeksi',
					width: 150,
					align: 'left'
				},
				{
					field: 'infeksi_lainnya',
					title: 'Infeksi Lainnya',
					width: 150,
					align: 'left'
				},
				{
					field: 'datanoninfeksi',
					title: 'Non Infeksi',
					width: 150,
					align: 'left'
				},
				{
					field: 'non_infeksi_lainnya',
					title: 'Non Infeksi Lainnya',
					width: 150,
					align: 'left'
				},
				{
					field: 'kuratif',
					title: 'Kuratif',
					width: 150,
					align: 'left'
				},
				{
					field: 'nonkuratif',
					title: 'Non Kuratif',
					width: 150,
					align: 'left'
				},
				{
					field: 'alasan_tidak_lainnya',
					title: 'Alasan Tidak Lainnya',
					width: 150,
					align: 'left'
				},
				{
					field: 'paliatif',
					title: 'Paliatif',
					width: 150,
					align: 'left'
				},
				{
					field: 'datapaliatif',
					title: 'Pilihan Paliatif',
					width: 150,
					align: 'left'
				},
				{
					field: 'datapain',
					title: 'Symtoms Management',
					width: 200,
					align: 'left'
				},
				{
					field: 'pain_lainnya',
					title: 'Pain Lainnya',
					width: 150,
					align: 'left'
				},
				{
					field: 'obat_kemo',
					title: 'Obat Kemo',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_mulaikemo',
					title: 'Tgl Mulai Kemo',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_selesaikemo',
					title: 'Tgl Selesai Kemo',
					width: 150,
					align: 'left'
				},
				{
					field: 'jml_siklus',
					title: 'Jml Siklus',
					width: 150,
					align: 'left'
				},
				{
					field: 'radioterapi',
					title: 'Radioterapi',
					width: 150,
					align: 'left'
				},
				{
					field: 'lokasi_radioterapi',
					title: 'Lokasi Terapi',
					width: 150,
					align: 'left'
				},
				{
					field: 'radioterapi_lainnya',
					title: 'Terapi Lainnya',
					width: 150,
					align: 'left'
				},
				{
					field: 'nama_unit',
					title: 'Unit',
					width: 150,
					align: 'left'
				}
			]
		],

		showFooter: true
	});

	$('#dgkuratif').datagrid({
		height: '300',
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: 'id',
		nowrap: false,
		//url:'registerspesifik/getdata', 
		title: 'Data Manajemen Kuratif',
		columns: [
			[{
					field: 'fase_kemo',
					title: 'Fase Kemoterapi',
					width: 200,
					align: 'left'
				},
				{
					field: 'dataprotokol',
					title: 'Protokol',
					width: 200,
					align: 'left'
				},
				{
					field: 'tgl_mulai',
					title: 'Tgl Mulai',
					width: 100,
					align: 'center'
				},
				{
					field: 'tgl_selesai',
					title: 'Tgl Selesai',
					width: 100,
					align: 'center'
				},
				{
					field: 'dataobat',
					title: 'Jenis Obat',
					width: 200,
					align: 'left'
				},
				{
					field: 'tempat_kemoterapi',
					title: 'Tempat Kemoterapi',
					width: 200,
					align: 'left'
				},
				{
					field: 'komplikasi_kemo',
					title: 'Komplikasi Kemo',
					width: 150,
					align: 'left'
				},
				{
					field: 'tempat_kemoterapi',
					title: 'Tempat Kemoterapi',
					width: 150,
					align: 'left'
				},
				{
					field: 'alergi_obat',
					title: 'Alergi Obat',
					width: 80,
					align: 'center'
				},
				{
					field: 'nama_alergi_obat',
					title: 'Nama Alergi Obat',
					width: 200,
					align: 'left'
				},
				{
					field: 'hasil_evaluasi',
					title: 'Hasil Evaluasi',
					width: 200,
					align: 'left'
				},
				{
					field: 'parsial_persen',
					title: 'Remisi Parsial(%)',
					width: 150,
					align: 'left'
				},
				{
					field: 'tgl_remisi',
					title: 'Tgl Remisi',
					width: 100,
					align: 'center'
				},
				{
					field: 'tgl_periksa_tulang',
					title: 'Tgl Periksa Sumsum Tulang',
					width: 150,
					align: 'left'
				},
				{
					field: 'selularitas',
					title: 'Selularitas',
					width: 150,
					align: 'left'
				},
				{
					field: 'eritopoiesis',
					title: 'Eritopoiesis',
					width: 150,
					align: 'left'
				},
				{
					field: 'granulopoeisis',
					title: 'Granulopoeisis',
					width: 150,
					align: 'left'
				},
				{
					field: 'tromobopoeisis',
					title: 'Tromobopoeisis',
					width: 150,
					align: 'left'
				},
				{
					field: 'mieloblas',
					title: 'Mieloblas',
					width: 100,
					align: 'left'
				},
				{
					field: 'limfoblas',
					title: 'Limfoblas',
					width: 100,
					align: 'left'
				},
				{
					field: 'tgl_periksa_mrd',
					title: 'Tgl Periksan MRD',
					width: 150,
					align: 'center'
				},
				{
					field: 'status_mrd',
					title: 'Status MRD',
					width: 100,
					align: 'center'
				},
				{
					field: 'datakelengkapan_kemo',
					title: 'Kelengkapan Kemo',
					width: 200,
					align: 'left'
				},
				{
					field: 'nama_pengobatan_tambahan',
					title: 'Pengobatan Tambahan',
					width: 200,
					align: 'left'
				},
				{
					field: 'action',
					title: 'Hapus',
					width: 80,
					align: 'center',
					formatter: function (value, row, index) {
						return '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Kuratif" onClick="deletekuratif(\'' + row.id + '\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> ';
					}
				}
			]
		],
		onDblClickRow: function () {
			editkuratif();
		},
	});

	$('#dgfollowup').datagrid({
		height: '300',
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: 'id',
		nowrap: false,
		//url:'registerspesifik/getdata', 
		title: 'Data Follow Up',
		columns: [
			[{
					field: 'tgl_abstraksi',
					title: 'Tgl Abstraksi',
					width: 150,
					align: 'center'
				},
				{
					field: 'tgl_periksa_darah',
					title: 'Tgl Periksa Darah',
					width: 150,
					align: 'center'
				},
				{
					field: 'tgl_periksa_tulang',
					title: 'Tgl Periksa Sumsum Tulang',
					width: 150,
					align: 'center'
				},
				{
					field: 'selularitas2',
					title: 'Selularitas',
					width: 150,
					align: 'left'
				},
				{
					field: 'eritopoiesis2',
					title: 'Eritopoiesis',
					width: 150,
					align: 'left'
				},
				{
					field: 'granulopoeisis2',
					title: 'Granulopoeisis',
					width: 150,
					align: 'left'
				},
				{
					field: 'tromobopoeisis2',
					title: 'Tromobopoeisis',
					width: 150,
					align: 'left'
				},
				{
					field: 'mieloblas2',
					title: 'Mieloblas',
					width: 100,
					align: 'left'
				},
				{
					field: 'limfoblas2',
					title: 'Limfoblas',
					width: 100,
					align: 'left'
				},
				{
					field: 'action',
					title: 'Hapus',
					width: 80,
					align: 'center',
					formatter: function (value, row, index) {
						return '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deletefollowup(\'' + row.id + '\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> ';
					}
				}

			]
		],
		onDblClickRow: function () {
			editfollowup();
		},
	});

	$('#dgdarah').datagrid({
		width: '400',
		height: 'auto',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		url: 'registerspesifik/dataoptions?type=darah',
		columns: [
			[{
					field: 'nama_options',
					title: 'Item',
					width: 200,
					align: 'left'
				},
				{
					field: 'jml',
					title: 'Jml',
					width: 100,
					align: 'left',
					editor: 'text'
				},
				{
					field: 'ket',
					title: 'Satuan',
					width: 80,
					align: 'left'
				}
			]
		]
	}).datagrid('enableCellEditing').datagrid('gotoCell', {
		index: 0,
		field: 'id'
	});

	$('#dgjenis').datagrid({
		width: '400',
		height: 'auto',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		url: 'registerspesifik/dataoptions?type=jenis darah',
		columns: [
			[{
					field: 'nama_options',
					title: 'Jenis',
					width: 200,
					align: 'left'
				},
				{
					field: 'jml',
					title: 'Jml',
					width: 100,
					align: 'left',
					editor: 'text'
				},
				{
					field: 'ket',
					title: 'Satuan',
					width: 80,
					align: 'center'
				}
			]
		]
	}).datagrid('enableCellEditing').datagrid('gotoCell', {
		index: 0,
		field: 'id'
	});

	$('#dgdarahfollowup').datagrid({
		width: '400',
		height: 'auto',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		//url:'registerspesifik/dataoptions?type=darah', 
		columns: [
			[{
					field: 'nama_options',
					title: 'Item',
					width: 200,
					align: 'left'
				},
				{
					field: 'jml',
					title: 'Jml',
					width: 100,
					align: 'left',
					editor: 'text'
				},
				{
					field: 'ket',
					title: 'Satuan',
					width: 80,
					align: 'left'
				}
			]
		]
	}).datagrid('enableCellEditing').datagrid('gotoCell', {
		index: 0,
		field: 'id'
	});

	$('#dgjenisfollowup').datagrid({
		width: '400',
		height: 'auto',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		//url :'registerspesifik/dataoptions?type=jenis darah', 
		columns: [
			[{
					field: 'nama_options',
					title: 'Jenis',
					width: 200,
					align: 'left'
				},
				{
					field: 'jml',
					title: 'Jml',
					width: 100,
					align: 'left',
					editor: 'text'
				},
				{
					field: 'ket',
					title: 'Satuan',
					width: 80,
					align: 'center'
				}
			]
		]
	}).datagrid('enableCellEditing').datagrid('gotoCell', {
		index: 0,
		field: 'id'
	});

	$('#dgpenyerta').datagrid({
		width: '350',
		height: '200',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		//url: 'subgrup/read', 
		columns: [
			[{
					field: 'penyertaid',
					title: 'Id',
					width: 50,
					align: 'center',
					hidden: true
				},
				{
					field: 'keluhan_penyerta',
					title: 'Keluhan Penyerta',
					width: 200,
					align: 'left'
				},
				{
					field: 'tanggal',
					title: 'Tanggal',
					width: 150,
					halign: 'center',
					align: 'left'
				}
			]
		]
	});

	$('#keluhan_utama').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showother(row.nama_options)
		},
		//url:'registerspesifik/keluhanutama',
	});

	$('#keluhan_penyerta').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		editable: false,
		//url:'registerspesifik/keluhanpenyerta',
	});

	$('#sindrom_penyerta_lainnya').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		editable: false,
		//url:'registerspesifik/penyertalaiinya',
	});

	$('#nonkuratif').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showtrnonkuratif(row.nama_options)
		},
		//url:'registerspesifik/penyertalaiinya',
	});

	$('#lokasi_radioterapi').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showtrradioterapi(row.nama_options)
		},
		//url:'registerspesifik/penyertalaiinya',
	});

	$('#optpaliatif').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'registerspesifik/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox('options');
			return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', true);
			showoptpaliatif(row[opts.textField], true)
		},
		onUnselect: function (row) {
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', false);
			showoptpaliatif(row[opts.textField], false)
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

	$('#optpain').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'registerspesifik/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox('options');
			return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', true);
			showtrtrpain(row[opts.textField], true)
		},
		onUnselect: function (row) {
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', false);
			showtrtrpain(row[opts.textField], false)
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

	$('#search').keyup(function () {

		doSearchregisterspesifik();

	});

	$('#diagnosisid').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'dasardiagnosis',
		fitColumns: true,
		editable: false,
		url: 'registerspesifik/diagnosis',
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
		url: 'registerspesifik/tatalaksana',
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

	$('#pemeriksaan_fisik').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'registerspesifik/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox('options');
			return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', true);
			showother3(row[opts.textField], true)
		},
		onUnselect: function (row) {
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', false);
			showother3(row[opts.textField], false)
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

	$('#infeksi').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'registerspesifik/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox('options');
			return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', true);
			showtrinfeksi(row[opts.textField], true)
		},
		onUnselect: function (row) {
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', false);
			showtrinfeksi(row[opts.textField], false)
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

	$('#non_infeksi').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'registerspesifik/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox('options');
			return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', true);
			showtrnon_infeksi(row[opts.textField], true)
		},
		onUnselect: function (row) {
			var opts = $(this).combobox('options');
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find('input.combobox-checkbox')._propAttr('checked', false);
			showtrnon_infeksi(row[opts.textField], false)
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
		url: 'registerspesifik/tatalaksana',
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

	$('#protokol').combobox({
		panelWidth: 200,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'registerspesifik/pemeriksaanfisik',
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

	$('#jenis_obat').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'registerspesifik/pemeriksaanfisik',
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

	$('#optkomplikasi_kemo').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showother(row.nama_options)
		},
		//url:'registerspesifik/keluhanutama',
	});

	$('#dgkomplikasi').datagrid({
		width: '350',
		height: '150',
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: 'id',
		nowrap: false,
		//url: 'subgrup/read', 
		columns: [
			[{
					field: 'kuratifid ',
					title: 'Id',
					width: 50,
					align: 'center',
					hidden: true
				},
				{
					field: 'nama_komplikasi',
					title: 'Komplikasi',
					width: 200,
					align: 'left'
				},
				{
					field: 'nama_obat',
					title: 'Obat',
					width: 150,
					halign: 'center',
					align: 'left'
				}
			]
		]
	});

	$('#dgsuportif').datagrid({
			width: '350',
			height: '300',
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: 'id',
			nowrap: false,
			//url: 'subgrup/read', 
			columns: [
				[
					// {field:'ck ',checkbox:true},
					{
						field: 'terapiid ',
						title: 'Id',
						width: 50,
						align: 'center',
						hidden: true
					},
					{
						field: 'nama_options',
						title: 'Jenis Terapi',
						width: 200,
						align: 'left'
					},
					{
						field: 'dosis',
						title: 'Dosis',
						width: 150,
						halign: 'center',
						align: 'left',
						editor: 'text'
					},
					{
						field: 'minggu',
						title: 'Minggu',
						width: 150,
						halign: 'center',
						align: 'left',
						editor: 'text'
					}
				]
			]
		})
		.datagrid('enableCellEditing').datagrid('gotoCell', {
			index: 0,
			field: 'id',
			singleSelect: false,
		});

	$('#kelengkapan_kemo').combobox({
		panelWidth: 250,
		panelHeight: 'auto',
		valueField: 'id',
		loadMsg: 'Please Wait..',
		textField: 'nama_options',
		fitColumns: true,
		// editable:false,
		// onSelect:function(row){
		//     showtrradioterapi(row.nama_options)
		// },
		//url:'registerspesifik/penyertalaiinya',
	});

})

function hidedefault() {
	$('#dgpenyerta').datagrid('loadData', {
		"total": 0,
		"rows": []
	});

	document.getElementById("lainnya_utama").style.display = 'none';
	$('#keluhan_utama_lainnya').textbox('clear');
	document.getElementById("lainnya_penyerta").style.display = 'none';
	$('#keluhan_penyerta_lainnya').textbox('clear');
	document.getElementById("trlimpa").style.display = 'none';
	$('#nama_limfadenopati').textbox('clear');
	document.getElementById("trhepar").style.display = 'none';
	$('#besar_hepar').textbox('clear');
	document.getElementById("trspleen").style.display = 'none';
	$('#besar_spleen').textbox('clear');
	$('#besar_schuffner').textbox('clear');
	document.getElementById("lainnya_fisik").style.display = 'none';
	$('#pemeriksaan_fisik_lainnya').textbox('clear');
	document.getElementById("trinfeksi").style.display = 'none';
	$('#infeksi_lainnya').textbox('clear');
	document.getElementById("trnon_infeksi").style.display = 'none';
	$('#non_infeksi_lainnya').textbox('clear');
	document.getElementById("trpain").style.display = 'none';
	$('#pain_lainnya').textbox('clear');
	document.getElementById("trkuratif").style.display = 'none';
	$('#alasan_tidak_lainnya').textbox('clear');
	document.getElementById("trnonkuratif").style.display = 'none';
	$('#nonkuratif').combobox('clear')
	document.getElementById("trpaliatif").style.display = 'none';
	$('#optpaliatif').combobox('clear')
	document.getElementById("trradioterapi").style.display = 'none';
	$('#radioterapi_lainnya').textbox('clear');
	document.getElementById("trhepar").style.display = 'none';
	$('#besar_hepar').textbox('clear');
	document.getElementById("trsymtoms").style.display = 'none';
	$('#optpain').combobox('clear');
	document.getElementById("trpain").style.display = 'none';
	$('#pain_lainnya').textbox('clear');
	document.getElementById("trobatkemo").style.display = 'none';
	document.getElementById("trtglmulaikemo").style.display = 'none';
	document.getElementById("trtglakhirkemo").style.display = 'none';
	document.getElementById("trjmlsiklus").style.display = 'none';
	$('#obat_kemo').textbox('clear');
	$('#jml_siklus').textbox('clear');
	$('#tgl_mulaikemo').datebox('clear');
	$('#tgl_selesaikemo').datebox('clear');
	document.getElementById("trterapi").style.display = 'none';
	$('#lokasi_radioterapi').combobox('clear');
	document.getElementById("trradioterapi").style.display = 'none';
}

function showother(isi) {
	if (isi == 'Lainnya') {
		document.getElementById("lainnya_utama").style.display = '';
		$('#keluhan_utama_lainnya').textbox('textbox').focus();
	} else {
		document.getElementById("lainnya_utama").style.display = 'none';
		$('#keluhan_utama_lainnya').textbox('clear');
	}
}

function showother2(isi) {
	if (isi == 'Lainnya') {
		document.getElementById("lainnya_penyerta").style.display = '';
		$('#keluhan_penyerta_lainnya').textbox('textbox').focus();
	} else {
		document.getElementById("lainnya_penyerta").style.display = 'none';
		$('#keluhan_penyerta_lainnya').textbox('clear');
	}
}

function showother3(isi, cek) {

	if (isi == 'Limfadenopati' && cek == true) {
		document.getElementById("trlimpa").style.display = '';
		$('#nama_limfadenopati').textbox('textbox').focus();
	} else if (isi == 'Limfadenopati' && cek == false) {
		document.getElementById("trlimpa").style.display = 'none';
		$('#nama_limfadenopati').textbox('clear');
	}

	if (isi == 'Hepatomegali' && cek == true) {
		document.getElementById("trhepar").style.display = '';
		$('#besar_hepar').textbox('textbox').focus();
	} else if (isi == 'Hepatomegali' && cek == false) {
		document.getElementById("trhepar").style.display = 'none';
		$('#besar_hepar').textbox('clear');
	}

	if (isi == 'Splenomegali' && cek == true) {
		document.getElementById("trspleen").style.display = '';
		$('#besar_spleen').textbox('textbox').focus();
	} else if (isi == 'Splenomegali' && cek == false) {
		document.getElementById("trspleen").style.display = 'none';
		$('#besar_spleen').textbox('clear');
		$('#besar_schuffner').textbox('clear');
	}

	if (isi == 'Lainnya' && cek == true) {
		document.getElementById("lainnya_fisik").style.display = '';
		$('#pemeriksaan_fisik_lainnya').textbox('textbox').focus();
	} else if (isi == 'Lainnya' && cek == false) {
		document.getElementById("lainnya_fisik").style.display = 'none';
		$('#pemeriksaan_fisik_lainnya').textbox('clear');
	}

}

function showtrinfeksi(isi, cek) {

	if (isi == 'Lainnya' && cek == true) {
		document.getElementById("trinfeksi").style.display = '';
		$('#infeksi_lainnya').textbox('textbox').focus();
	} else if (isi == 'Lainnya' && cek == false) {
		document.getElementById("trinfeksi").style.display = 'none';
		$('#infeksi_lainnya').textbox('clear');
	}
}

function showtrnon_infeksi(isi, cek) {

	if (isi == 'Lainnya' && cek == true) {
		document.getElementById("trnon_infeksi").style.display = '';
		$('#non_infeksi_lainnya').textbox('textbox').focus();
	} else if (isi == 'Lainnya' && cek == false) {
		document.getElementById("trnon_infeksi").style.display = 'none';
		$('#non_infeksi_lainnya').textbox('clear');
	}
}

function showtrtrpain(isi, cek) {

	if (isi == 'Lainnya' && cek == true) {
		document.getElementById("trpain").style.display = '';
		$('#pain_lainnya').textbox('textbox').focus();
	} else if (isi == 'Lainnya' && cek == false) {
		document.getElementById("trpain").style.display = 'none';
		$('#pain_lainnya').textbox('clear');
	}
}

function showtrkuratif(isi) {

	if (isi == 'n') {
		document.getElementById("trkuratif").style.display = '';
	} else {
		document.getElementById("trkuratif").style.display = 'none';
		$('#alasan_tidak_lainnya').textbox('clear');
		document.getElementById("trnonkuratif").style.display = 'none';
		$('#alasan_tidak_lainnya').textbox('clear');
		$('#nonkuratif').combobox('clear')
	}
}

function showtrpaliatif(isi) {

	if (isi == 'y') {
		document.getElementById("trpaliatif").style.display = '';
	} else {
		document.getElementById("trpaliatif").style.display = 'none';
		$('#optpaliatif').combobox('clear')
	}
}

function showtrnonkuratif(isi) {
	if (isi == 'Lainnya') {
		document.getElementById("trnonkuratif").style.display = '';
		$('#alasan_tidak_lainnya').textbox('textbox').focus();
	} else {
		document.getElementById("trnonkuratif").style.display = 'none';
		$('#alasan_tidak_lainnya').textbox('clear');
	}
}

function showtrradioterapi(isi) {
	if (isi == 'Lainnya') {
		document.getElementById("trradioterapi").style.display = '';
		$('#radioterapi_lainnya').textbox('textbox').focus();
	} else {
		document.getElementById("trradioterapi").style.display = 'none';
		$('#radioterapi_lainnya').textbox('clear');
	}
}

function showhepatomegali(isi, cek) {
	if (isi == 'Hepatomegali' && cek == true) {
		document.getElementById("trhepar").style.display = '';
		$('#besar_hepar').textbox('textbox').focus();
	} else if (isi == 'Hepatomegali' && cek == false) {
		document.getElementById("trhepar").style.display = 'none';
		$('#besar_hepar').textbox('clear');
	}
}

function showoptpaliatif(isi, cek) {
	if (isi == 'Pain/Symptoms management' && cek == true) {
		document.getElementById("trsymtoms").style.display = '';
	} else if (isi == 'Pain/Symptoms management' && cek == false) {
		document.getElementById("trsymtoms").style.display = 'none';
		$('#optpain').combobox('clear');
		document.getElementById("trpain").style.display = 'none';
		$('#pain_lainnya').textbox('clear');
	}

	if (isi == 'Kemoterapi' && cek == true) {
		document.getElementById("trobatkemo").style.display = '';
		document.getElementById("trtglmulaikemo").style.display = '';
		document.getElementById("trtglakhirkemo").style.display = '';
		document.getElementById("trjmlsiklus").style.display = '';
		$('#obat_kemo').textbox('textbox').focus();
	} else if (isi == 'Kemoterapi' && cek == false) {
		document.getElementById("trobatkemo").style.display = 'none';
		document.getElementById("trtglmulaikemo").style.display = 'none';
		document.getElementById("trtglakhirkemo").style.display = 'none';
		document.getElementById("trjmlsiklus").style.display = 'none';
		$('#obat_kemo').textbox('clear');
		$('#jml_siklus').textbox('clear');
		$('#tgl_mulaikemo').datebox('clear');
		$('#tgl_selesaikemo').datebox('clear');
	}

	if (isi == 'Radioterapi' && cek == true) {
		document.getElementById("trterapi").style.display = '';
	} else if (isi == 'Radioterapi' && cek == false) {
		document.getElementById("trterapi").style.display = 'none';
		$('#lokasi_radioterapi').combobox('clear');
		document.getElementById("trradioterapi").style.display = 'none';
		$('#radioterapi_lainnya').textbox('clear');
	}

}

function deleteRiwayat(index) {
	$('#dgriwayat').datagrid('deleteRow', index);
	//$('#dgriwayat').datagrid('reload');
}

function tampilkan(isi) {
	if (isi == 'y') {
		document.getElementById("tgriwayat").style.display = '';
		document.getElementById("btnriwayat").style.display = '';
		document.getElementById("btnriwayat2").style.display = '';
	} else if (isi == 'n') {
		document.getElementById("tgriwayat").style.display = 'none';
		document.getElementById("btnriwayat").style.display = 'none';
		document.getElementById("btnriwayat2").style.display = 'none';
		$('#dgriwayat').datagrid('loadData', {
			"total": 0,
			"rows": []
		});
	} else {
		document.getElementById("tgriwayat").style.display = 'none';
		document.getElementById("btnriwayat").style.display = 'none';
		document.getElementById("btnriwayat2").style.display = 'none';
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
		// document.getElementById("btnriwayat2").style.display = '';
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
		// document.getElementById("btnriwayat2").style.display = 'none';
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
		// document.getElementById("btnriwayat2").style.display = 'none';
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

function searchvalidate(v) {
	$('#dgregisterspesifik').datagrid('reload', {
		validate: v
	});
}

function doSearch(value) {

	var value = $('#search').val();
	$('#dgregisterspesifik').datagrid('reload', {
		search: value
	});
}

function no_registerspesifik() {
	//  var noregisterspesifik ='';
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
	$.getJSON('registerspesifik/no_registerspesifik', {
		get_param: 'value'
	}, function (data) {
		document.getElementById('nourut').value = data.nourut;
	});

	noregisterspesifik = nounit + j + no;
	//$('#dlg').dialog({title : nounit});
	document.getElementById('noregisterspesifik').value = noregisterspesifik;
}

function cariSubgrup() {
	$('#dlg-subreg').dialog('open').dialog('setTitle', 'Pencarian Data Tumor');
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

function tambahpenyerta() {
	var a = $('#keluhan_penyerta').combobox('getValue'),
		b = $('#keluhan_penyerta').combobox('getText'),
		c = $('#tgl_keluhan').datebox('getValue')

	if (b && c) {
		$('#dgpenyerta').datagrid('appendRow', {
			penyertaid: a,
			keluhan_penyerta: b,
			tanggal: c
		});
		//if(b=='Lainnya'){
		showother2(b)
		//}
		$('#keluhan_penyerta').combobox('setValue', '');
	} else {
		$.messager.alert('warning', 'mohon isi kolom keluhan penyerta terlebih dahulu', 'warning');
	}
}

function progress() {
	$.messager.progress({
		title: 'Mohon Tunggu',
		msg: 'Simpan data...'
	});
}

function kosongkanpenyerta() {
	$('#dgpenyerta').datagrid('loadData', {
		"total": 0,
		"rows": []
	});
	document.getElementById("lainnya_penyerta").style.display = 'none';
	$('#keluhan_penyerta_lainnya').textbox('clear');
}

function entryspesifik(row) {
	//var row = $('#searchPasien').combogrid('getSelected');
	$('#dlg').dialog('open').dialog('setTitle', 'Register Spesifik : ' + row.subgrup);
	$('#fm').form('clear');
	document.getElementById("t1").checked = true;
	document.getElementById("pb").checked = true;
	document.getElementById("b1").checked = true;
	document.getElementById("l1").checked = true;
	document.getElementById("s1").checked = true;
	document.getElementById("hr").checked = true;
	document.getElementById("fy").checked = true;
	document.getElementById("ku").checked = true;
	document.getElementById("pu").checked = true;
	document.getElementById('registrasiid').value = row.id;
	if (row.jenis_kelamin == 'l') {
		document.getElementById('label_jkelamin').innerHTML = 'Laki-laki';
	} else if (row.jenis_kelamin == 'p') {
		document.getElementById('label_jkelamin').innerHTML = 'Perempuan';
	}
	hidedefault()
	document.getElementById('label_namalengkap').innerHTML = row.nama;
	document.getElementById('label_nik').innerHTML = row.nik;
	document.getElementById('label_ttl').innerHTML = row.ttl;
	document.getElementById('label_noregistrasi').innerHTML = row.noregistrasi;
	document.getElementById('label_norekam').innerHTML = row.no_rekam;
	document.getElementById('label_nohp').innerHTML = row.no_hp;
	with(new Date) {
		$('#tgl_diagnosis').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}

	with(new Date) {
		$('#tgl_periksa_tulangbelakang').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}

	with(new Date) {
		$('#tgl_keluhan').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_periksadarah').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_periksaurin').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_serebrospinal').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	with(new Date) {
		$('#tgl_diagnosis').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
	}
	var urlkeluhan = 'registerspesifik/dataoptions?type=keluhan utama';
	$('#keluhan_utama').combobox('reload', urlkeluhan);

	var urlpenyerta = 'registerspesifik/dataoptions?type=keluhan penyerta';
	$('#keluhan_penyerta').combobox('reload', urlpenyerta);
	var urlpenyertalainnya = 'registerspesifik/dataoptions?type=penyerta lainnya';
	$('#sindrom_penyerta_lainnya').combobox('reload', urlpenyertalainnya);
	var urlfisik = 'registerspesifik/dataoptions?type=Pemeriksaan Fisik';
	$('#pemeriksaan_fisik').combobox('reload', urlfisik);

	var urlinfeksi = 'registerspesifik/dataoptions?type=infeksi';
	$('#infeksi').combobox('reload', urlinfeksi);
	var urlnon_infeksi = 'registerspesifik/dataoptions?type=non infeksi';
	$('#non_infeksi').combobox('reload', urlnon_infeksi);
	var urlnonkuratif = 'registerspesifik/dataoptions?type=non kuratif';
	$('#nonkuratif').combobox('reload', urlnonkuratif);
	var urlpaliatif = 'registerspesifik/dataoptions?type=paliatif';
	$('#optpaliatif').combobox('reload', urlpaliatif);
	var urlpain = 'registerspesifik/dataoptions?type=pain';
	$('#optpain').combobox('reload', urlpain);
	var urlradioterapi = 'registerspesifik/dataoptions?type=lokasi radioterapi';
	$('#lokasi_radioterapi').combobox('reload', urlradioterapi);

	$('#btnlink').linkbutton({
		text: 'Simpan'
	});
	url = 'registerspesifik/save';
}

function save() {

	var fisik = $('#pemeriksaan_fisik').combobox('getValues');
	var infeksi = $('#infeksi').combobox('getValues');
	var non_infeksi = $('#non_infeksi').combobox('getValues');
	var optpaliatif = $('#optpaliatif').combobox('getValues');
	var optpain = $('#optpain').combobox('getValues');

	//ambil data dg diagnosis
	var getdata = $('#dgpenyerta').datagrid('getRows');
	var datadetail = JSON.stringify(getdata);
	var detail1 = '?datajson1=' + encodeURIComponent(datadetail);

	//ambil data dg darah
	var getdata2 = $('#dgdarah').datagrid('getRows');
	var datadetail2 = JSON.stringify(getdata2);
	var detail2 = '&datajson2=' + encodeURIComponent(datadetail2);

	//ambil data dg jenis
	var getdata3 = $('#dgjenis').datagrid('getRows');
	var datadetail3 = JSON.stringify(getdata3);
	var detail3 = '&datajson3=' + encodeURIComponent(datadetail3);

	progress() // show the message box
	$('#fm').form('submit', {

		url: url + detail1 + detail2 + detail3 + '&fisik=' + fisik + '&infeksi=' + infeksi + '&non_infeksi=' + non_infeksi + '&optpaliatif=' + optpaliatif + '&optpain=' + optpain,

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
				$.messager.alert('Info', 'Data Sukses Disimpan', '');
				$('#searchPasien').combogrid('grid').datagrid('reload');
				$('#searchPasien').combogrid('setValue', '');
				$('#dlg').dialog('close'); // close the dialog
				$('#dgregisterspesifik').datagrid('reload'); // reload the user data
			}
		}
	});
}

function edit() {
	//var ui = document.getElementById("uid").value;
	var row = $('#dgregisterspesifik').datagrid('getSelected');
	//alert(ui);
	if (row) {
		$('#dlg').dialog('open').dialog('setTitle', 'Edit Register Spesifik');
		$('#fm').form('load', row);

		if (row.jenis_kelamin == 'l') {
			document.getElementById('label_jkelamin').innerHTML = 'Laki-laki';
		} else if (row.jenis_kelamin == 'p') {
			document.getElementById('label_jkelamin').innerHTML = 'Perempuan';
		}
		document.getElementById('label_namalengkap').innerHTML = row.nama;
		document.getElementById('label_nik').innerHTML = row.nik;
		document.getElementById('label_ttl').innerHTML = row.ttl;
		document.getElementById('label_noregistrasi').innerHTML = row.noregistrasi;
		document.getElementById('label_norekam').innerHTML = row.no_rekam;
		document.getElementById('label_nohp').innerHTML = row.no_hp;

		var urlkeluhan = 'registerspesifik/dataoptions?type=keluhan utama';
		$('#keluhan_utama').combobox('reload', urlkeluhan);
		$('#dgpenyerta').datagrid('reload', 'registerspesifik/getdatapenyerta?spesifikid=' + row.id);
		$('#dgdarah').datagrid('reload', 'registerspesifik/getdatadarah?spesifikid=' + row.id);
		$('#dgjenis').datagrid('reload', 'registerspesifik/getdatajenis?spesifikid=' + row.id);

		var urlpenyerta = 'registerspesifik/dataoptions?type=keluhan penyerta';
		$('#keluhan_penyerta').combobox('reload', urlpenyerta);
		var urlpenyertalainnya = 'registerspesifik/dataoptions?type=penyerta lainnya';
		$('#sindrom_penyerta_lainnya').combobox('reload', urlpenyertalainnya);
		var urlfisik = 'registerspesifik/dataoptions?type=Pemeriksaan Fisik';
		$('#pemeriksaan_fisik').combobox('reload', urlfisik);
		var urlinfeksi = 'registerspesifik/dataoptions?type=infeksi';
		$('#infeksi').combobox('reload', urlinfeksi);
		var urlnon_infeksi = 'registerspesifik/dataoptions?type=non infeksi';
		$('#non_infeksi').combobox('reload', urlnon_infeksi);
		var urlnonkuratif = 'registerspesifik/dataoptions?type=non kuratif';
		$('#nonkuratif').combobox('reload', urlnonkuratif);
		var urlpaliatif = 'registerspesifik/dataoptions?type=paliatif';
		$('#optpaliatif').combobox('reload', urlpaliatif);
		var urlpain = 'registerspesifik/dataoptions?type=pain';
		$('#optpain').combobox('reload', urlpain);
		var urlradioterapi = 'registerspesifik/dataoptions?type=lokasi radioterapi';
		$('#lokasi_radioterapi').combobox('reload', urlradioterapi);

		$('#btnlink').linkbutton({
			text: 'Update'
		});
		url = 'registerspesifik/update/' + row.id;
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau diedit', 'warning');
	}
}

function remove() {
	var row = $('#dgregisterspesifik').datagrid('getSelected');
	if (row) {
		$.messager.confirm('Konfirmasi', 'Apakah anda yakin akan menghapus data spesifik \"' + row.nama + '\" ?', function (r) {
			if (r) {
				$.post('registerspesifik/delete', {
						id: row.id
					},
					function (result) {
						if (result.success) {
							$.messager.alert('info', 'Data Registerspesifik\"' + row.nama + '\" telah di hapus !', 'info');
							$('#dgregisterspesifik').datagrid('reload');
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
		$.messager.alert('Warning', 'Pilih data yang mau dihapus', 'warning');
	}

}

function updateluaran() {
	var row = $('#dgregisterspesifik').datagrid('getSelected');
	if (row) {
		$('#dlg-luaran').dialog('open').dialog('setTitle', 'Update Data Luaran');
		$('#fmluaran').form('clear');
		$('#dgluaran').datagrid('reload', 'registerspesifik/readluaran?registerspesifikid=' + row.id)
		document.getElementById('labelnoreg').innerHTML = row.noregisterspesifik;
		document.getElementById('labelnama').innerHTML = row.nama;
		document.getElementById('registerspesifikid').value = row.id;
		with(new Date) {
			$('#tgl_abstraksi').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
		}
		$('#lnk').linkbutton({
			text: 'Simpan'
		});
		url = 'registerspesifik/saveluaran';
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
					url = 'registerspesifik/saveluaran';
					$.messager.alert('Info', 'Data Sukses Disimpan', '');
					$('#fmluaran').form('clear');

					document.getElementById('registerspesifikid').value = $('#dgregisterspesifik').datagrid('getSelected').id;
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
		$('#tindakan').combobox('reload', 'registerspesifik/gettatalaksana?id=' + row.idtindakan)
		url = 'registerspesifik/updateluaran/' + row.id;
		$('#lnk').linkbutton({
			text: 'Update'
		});
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau diedit', 'warning');
	}
}

function deletefollowup(id) {
	if (id) {
		$.messager.confirm('Konfirmasi', 'yakin akan menghapus data ini ?', function (r) {
			if (r) {
				$.post('registerspesifik/deletefollowup', {
						id: id
					},
					function (result) {
						if (result.success) {
							$.messager.alert('info', 'Data telah di hapus !', 'info');
							$('#dgfollowup').datagrid('reload');
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

function deletekuratif(id) {
	if (id) {
		$.messager.confirm('Konfirmasi', 'yakin akan menghapus data kuratif ini ?', function (r) {
			if (r) {
				$.post('registerspesifik/deletekuratif', {
						id: id
					},
					function (result) {
						if (result.success) {
							$.messager.alert('info', 'Data telah di hapus !', 'info');
							$('#dgkuratif').datagrid('reload');
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

function deleteLuaran(id) {
	if (id) {
		$.messager.confirm('Konfirmasi', 'yakin akan menghapus data ini ?', function (r) {
			if (r) {
				$.post('registerspesifik/deleteluaran', {
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

function editkuratif() {
	var row = $('#dgkuratif').datagrid('getSelected');
	if (row) {
		$('#fm-kuratif').form('load', row);
		$('#dgkomplikasi').datagrid('reload', 'registerspesifik/getdatakomplikasi/' + row.id);
		$('#dgsuportif').datagrid('reload', 'registerspesifik/getdatasuportif/' + row.id);
		url = 'registerspesifik/updatekuratif/' + row.id;
		$('#btnlinkkuratif').linkbutton({
			text: 'Update'
		});
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau diedit', 'warning');
	}
}

function manajemenkuratif() {
	var row = $('#dgregisterspesifik').datagrid('getSelected');
	if (row) {
		$('#dlg-kuratif').dialog('open').dialog('setTitle', 'Manajemen Kuratif');
		$('#fm-kuratif').form('clear');
		document.getElementById('register_spesifikid').value = row.id;
		document.getElementById('label_noregistrasi2').innerHTML = row.noregistrasi;
		document.getElementById('label_namalengkap2').innerHTML = row.nama;
		document.getElementById("an").checked = true;
		document.getElementById("s_unknow").checked = true;
		document.getElementById("e_unknow").checked = true;
		document.getElementById("g_unknow").checked = true;
		document.getElementById("t_unknow").checked = true;
		document.getElementById("mrd_u").checked = true;
		document.getElementById("tam_t").checked = true;
		if (row.jenis_kelamin == 'l') {
			document.getElementById('label_jkelamin2').innerHTML = 'Laki-laki';
		} else if (row.jenis_kelamin == 'p') {
			document.getElementById('label_jkelamin2').innerHTML = 'Perempuan';
		}
		document.getElementById('label_nohp2').innerHTML = row.no_hp;
		with(new Date) {
			$('#tgl_mulai').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
		}
		with(new Date) {
			$('#tgl_selesai').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
		}
		var urlprotokol = 'registerspesifik/dataoptions?type=protokol lla';
		$('#protokol').combobox('reload', urlprotokol);
		var urljenis = 'registerspesifik/dataoptions?type=jenis obat';
		$('#jenis_obat').combobox('reload', urljenis);
		var urlkomplikasi = 'registerspesifik/dataoptions?type=komplikasi kemo';
		$('#optkomplikasi_kemo').combobox('reload', urlkomplikasi);
		var urlsuportif = 'registerspesifik/dataoptions?type=jenis terapi';
		$('#dgsuportif').datagrid('reload', urlsuportif);
		var urlkelengkapan = 'registerspesifik/dataoptions?type=kelengkapan kemo';
		$('#kelengkapan_kemo').combobox('reload', urlkelengkapan);

		var urldgkuratif = 'registerspesifik/readkuratif?id=' + row.id;
		$('#dgkuratif').datagrid('reload', urldgkuratif);

		$('#btnlinkkuratif').linkbutton({
			text: 'Simpan'
		});
		url = 'registerspesifik/savekuratif';
	} else {
		$.messager.alert('warning', 'pilih data terlebih dahulu', 'warning')
	}
}

function tambahkomplikasi() {
	var a = $('#optkomplikasi_kemo').combobox('getValue'),
		b = $('#optkomplikasi_kemo').combobox('getText'),
		c = $('#nama_obat').textbox('getValue')

	if (b && c) {
		$('#dgkomplikasi').datagrid('appendRow', {
			kuratifid: a,
			nama_komplikasi: b,
			nama_obat: c
		});
		//if(b=='Lainnya'){
		//showother2(b)
		//}
		$('#optkomplikasi_kemo').combobox('setValue', '');
		$('#nama_obat').textbox('setValue', '');
	} else {
		$.messager.alert('warning', 'mohon isi kolom komplikasi terlebih dahulu', 'warning');
	}
}

function kosongkankomplikasi() {
	$('#dgkomplikasi').datagrid('loadData', {
		"total": 0,
		"rows": []
	});
	var row = $('#dgregisterspesifik').datagrid('getSelected');
	document.getElementById('register_spesifikid').value = row.id;
}

function savekuratif() {

	var optjenis = $('#jenis_obat').combobox('getValues');
	var optprotokol = $('#protokol').combobox('getValues');
	//ambil data dg komplikasi
	var getdata = $('#dgkomplikasi').datagrid('getRows');
	var datadetail = JSON.stringify(getdata);
	var detail = '?datakomplikasi=' + encodeURIComponent(datadetail);

	//ambil data dg suportif
	var getdata2 = $('#dgsuportif').datagrid('getRows');
	var datadetail2 = JSON.stringify(getdata2);
	var detail2 = '&datasuportif=' + encodeURIComponent(datadetail2);

	progress() // show the message box
	$('#fm-kuratif').form('submit', {
		url: url + detail + detail2 + '+&optjenis=' + optjenis + '&optprotokol=' + optprotokol,

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
				$.messager.alert('Info', 'Data Sukses Disimpan', '');
				$('#fm-kuratif').form('clear');
				kosongkankomplikasi()
				var urlsuportif = 'registerspesifik/dataoptions?type=jenis terapi';
				$('#dgsuportif').datagrid('reload', urlsuportif);
				document.getElementById("an").checked = true;
				document.getElementById("s_unknow").checked = true;
				document.getElementById("e_unknow").checked = true;
				document.getElementById("g_unknow").checked = true;
				document.getElementById("t_unknow").checked = true;
				document.getElementById("mrd_u").checked = true;
				document.getElementById("tam_t").checked = true;
				with(new Date) {
					$('#tgl_mulai').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				with(new Date) {
					$('#tgl_selesai').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				with(new Date) {
					$('#tgl_remisi').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				with(new Date) {
					$('#tgl_periksa_tulang').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				with(new Date) {
					$('#tgl_periksa_mrd').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				$('#btnlinkkuratif').linkbutton({
					text: 'Simpan'
				});
				url = 'registerspesifik/savekuratif';
				//$('#dlg-kuratif').dialog('close');        // close the dialog
				$('#dgkuratif').datagrid('reload'); // reload the user data
			}
		}
	});
}

function followup() {
	var row = $('#dgregisterspesifik').datagrid('getSelected');
	if (row) {
		$('#dlg-followup').dialog('open').dialog('setTitle', 'Follow Up');
		$('#fm-followup').form('clear');
		document.getElementById('register_spesifikid2').value = row.id;
		document.getElementById('label_noregistrasi3').innerHTML = row.noregistrasi;
		document.getElementById('label_namalengkap3').innerHTML = row.nama;

		var urljenis = 'registerspesifik/dataoptions?type=jenis darah';
		$('#dgjenisfollowup').datagrid('reload', urljenis);
		var urldarah = 'registerspesifik/dataoptions?type=darah';
		$('#dgdarahfollowup').datagrid('reload', urldarah);

		document.getElementById("s_unknow2").checked = true;
		document.getElementById("e_unknow2").checked = true;
		document.getElementById("g_unknow2").checked = true;
		document.getElementById("t_unknow2").checked = true;

		if (row.jenis_kelamin == 'l') {
			document.getElementById('label_jkelamin3').innerHTML = 'Laki-laki';
		} else if (row.jenis_kelamin == 'p') {
			document.getElementById('label_jkelamin3').innerHTML = 'Perempuan';
		}
		document.getElementById('label_nohp3').innerHTML = row.no_hp;
		with(new Date) {
			$('#tgl_abstraksi').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
		}
		with(new Date) {
			$('#tgl_periksa_darah').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
		}

		var urldgfollowup = 'registerspesifik/readfollowup?id=' + row.id;
		$('#dgfollowup').datagrid('reload', urldgfollowup);

		$('#btnlinkfollowup').linkbutton({
			text: 'Simpan'
		});
		url = 'registerspesifik/savefollowup';
	} else {
		$.messager.alert('warning', 'pilih data terlebih dahulu', 'warning')
	}
}

function savefollowup() {

	//ambil data dg komplikasi
	var getdata = $('#dgdarahfollowup').datagrid('getRows');
	var datadetail = JSON.stringify(getdata);
	var detail = '?datadarah=' + encodeURIComponent(datadetail);

	//ambil data dg suportif
	var getdata2 = $('#dgjenisfollowup').datagrid('getRows');
	var datadetail2 = JSON.stringify(getdata2);
	var detail2 = '&datajenis=' + encodeURIComponent(datadetail2);

	progress() // show the message box
	$('#fm-followup').form('submit', {

		url: url + detail + detail2,

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
				$.messager.alert('Info', 'Data Sukses Disimpan', '');
				$('#fm-followup').form('clear');
				//kosongkandarah()
				var row = $('#dgregisterspesifik').datagrid('getSelected');
				document.getElementById('register_spesifikid2').value = row.id;
				var urljenis = 'registerspesifik/dataoptions?type=jenis darah';
				$('#dgjenisfollowup').datagrid('reload', urljenis);
				var urldarah = 'registerspesifik/dataoptions?type=darah';
				$('#dgdarahfollowup').datagrid('reload', urldarah);

				document.getElementById("s_unknow2").checked = true;
				document.getElementById("e_unknow2").checked = true;
				document.getElementById("g_unknow2").checked = true;
				document.getElementById("t_unknow2").checked = true;

				with(new Date) {
					$('#tgl_abstraksi').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				with(new Date) {
					$('#tgl_periksa_darah').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}
				with(new Date) {
					$('#tgl_periksa_tulang').datebox('setValue', getFullYear() + "-" + (getMonth() + 1 < 10 ? '0' : '') + (getMonth() + 1) + "-" + (getDate() < 10 ? '0' : '') + getDate());
				}

				$('#btnlinkfollowup').linkbutton({
					text: 'Simpan'
				});
				url = 'registerspesifik/savefollowup';
				//$('#dlg-kuratif').dialog('close');        // close the dialog
				$('#dgfollowup').datagrid('reload'); // reload the user data
			}
		}
	});
}

function editfollowup() {
	var row = $('#dgfollowup').datagrid('getSelected');
	if (row) {
		$('#fm-followup').form('load', row);
		$('#dgdarahfollowup').datagrid('reload', 'registerspesifik/getdatadarahfollowup/' + row.id);
		$('#dgjenisfollowup').datagrid('reload', 'registerspesifik/getdatajenisfollowup/' + row.id);
		url = 'registerspesifik/updatefollowup/' + row.id;
		$('#btnlinkfollowup').linkbutton({
			text: 'Update'
		});
	} else {
		$.messager.alert('Warning', 'Pilih data yang mau diedit', 'warning');
	}
}
