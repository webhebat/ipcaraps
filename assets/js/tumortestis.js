$(document).ready(function () {
	$("#datapasien").datagrid({
		width: "100%",
		height: "300",
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: "id",
		url: "tumortestis/selectspesifik",
		title: "",
		onDblClickRow: function () {
			selectPasien();
		},
		columns: [
			[{
					field: "nama",
					title: "Nama Pasien",
					width: 250,
					align: "left"
				},
				{
					field: "jkelamin",
					title: "J Kelamin",
					width: 200,
					align: "left"
				},
				{
					field: "ttl",
					title: "Tempat/Tgl Lahir",
					width: 200,
					align: "left"
				},
				{
					field: "alamat",
					title: "Alamat",
					width: 200,
					align: "left"
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

	$("#search-pasien").searchbox({
		searcher: function (value) {
			$("#datapasien").datagrid("reload", {
				search: value
			});
		},
		//menu:'#mm',
		prompt: "Search Here.."
	});

	$("#dgtumortestis").datagrid({
		//width: 'auto',
		height: "400",
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: "id",
		url: "tumortestis/read",
		title: "Data Register Spesifik tumortestis",
		onDblClickRow: function () {
			edit();
		},
		frozenColumns: [
			[{
					field: "noregistrasi",
					title: "No Reg",
					width: 100,
					align: "left"
				},
				{
					field: "nama",
					title: "Nama Lengkap",
					width: 200,
					align: "left"
				}
			]
		],
		columns: [
			[{
					field: "keluhan",
					title: "Keluhan Utama",
					width: 200,
					align: "left"
				},
				{
					field: "keluhan_utama_lainnya",
					title: "Keluhan Lainnya",
					width: 180,
					align: "left"
				},
				{
					field: "thn_keluhan",
					title: "Thn Keluhan",
					width: 120,
					align: "center"
				},
				{
					field: "bln_keluhan",
					title: "Bln Keluhan",
					width: 120,
					align: "center"
				},
				{
					field: "hari_keluhan",
					title: "Hr Keluhan",
					width: 120,
					align: "center"
				},
				{
					field: "durasi_penyakit",
					title: "Durasi Penyakit",
					width: 150,
					align: "center"
				},
				{
					field: "periksafisik",
					title: "Pemeriksaan Fisik",
					width: 150,
					align: "left"
				},
				{
					field: "pemeriksaan_fisik_lainnya",
					title: "Pemeriksaan Lainnya",
					width: 180,
					align: "left"
				},
				{
					field: "keluhanpenyerta",
					title: "Keluhan Penyerta",
					width: 160,
					align: "left"
				},
				{
					field: "keluhan_penyerta_lainnya",
					title: "Penyerta Lainnya",
					width: 180,
					align: "left"
				},
				{
					field: "besar_hepar",
					title: "Besar Hepar",
					width: 150,
					align: "left"
				},
				{
					field: "besar_spleen",
					title: "Besar Spleen",
					width: 80,
					align: "left"
				},
				{
					field: "besar_schuffner",
					title: "Besar Schuffner",
					width: 80,
					align: "left"
				},
				{
					field: "nama_limfadenopati",
					title: "Limpadenopati",
					width: 150,
					align: "left"
				},
				{
					field: "tanner_stage",
					title: "Tanner Stage",
					width: 250,
					align: "left"
				},
				{
					field: "morfologi",
					title: "Morfologi",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_periksadarah",
					title: "Tgl Periksa Darah",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_periksa_tulangbelakang",
					title: "Tgl Periksa Tulang Belakang",
					width: 150,
					align: "left"
				},
				{
					field: "selularitas",
					title: "Selularitas ",
					width: 100,
					align: "left"
				},
				{
					field: "eritopoiesis",
					title: "Eritopoiesis",
					width: 100,
					align: "left"
				},
				{
					field: "granulopoeisis",
					title: "Granulopoeisis",
					width: 100,
					align: "left"
				},
				{
					field: "tromobopoeisis",
					title: "Tromobopoeisis",
					width: 100,
					align: "left"
				},
				{
					field: "mieloblas",
					title: "Mieloblas",
					width: 150,
					align: "left"
				},
				{
					field: "limfoblas",
					title: "Limfoblas",
					width: 150,
					align: "left"
				},
				{
					field: "jml_sel",
					title: "Jml Sel",
					width: 150,
					align: "left"
				},
				{
					field: "blast",
					title: "Blast",
					width: 150,
					align: "left"
				},
				{
					field: "leukosit",
					title: "Leukosit",
					width: 150,
					align: "left"
				},
				{
					field: "eritrosit",
					title: "Eritrosit",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_periksaurin",
					title: "Tgl Periksa Urin",
					width: 150,
					align: "left"
				},
				{
					field: "ph_urin",
					title: "Ph Urin",
					width: 150,
					align: "left"
				},
				{
					field: "fab",
					title: "Fab",
					width: 150,
					align: "left"
				},
				{
					field: "sitogenetik",
					title: "Sitogenetik",
					width: 150,
					align: "left"
				},
				{
					field: "stratifikasi",
					title: "Stratifikasi",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_diagnosis",
					title: "Tgl Diagnosis",
					width: 150,
					align: "left"
				},
				{
					field: "neutropenia",
					title: "Neutropenia",
					width: 150,
					align: "left"
				},
				{
					field: "datainfeksi",
					title: "Infeksi",
					width: 150,
					align: "left"
				},
				{
					field: "infeksi_lainnya",
					title: "Infeksi Lainnya",
					width: 150,
					align: "left"
				},
				{
					field: "datanoninfeksi",
					title: "Non Infeksi",
					width: 150,
					align: "left"
				},
				{
					field: "non_infeksi_lainnya",
					title: "Non Infeksi Lainnya",
					width: 150,
					align: "left"
				},
				{
					field: "kuratif",
					title: "Kuratif",
					width: 150,
					align: "left"
				},
				{
					field: "nonkuratif",
					title: "Non Kuratif",
					width: 150,
					align: "left"
				},
				{
					field: "alasan_tidak_lainnya",
					title: "Alasan Tidak Lainnya",
					width: 150,
					align: "left"
				},
				{
					field: "paliatif",
					title: "Paliatif",
					width: 150,
					align: "left"
				},
				{
					field: "datapaliatif",
					title: "Pilihan Paliatif",
					width: 150,
					align: "left"
				},
				{
					field: "datapain",
					title: "Symtoms Management",
					width: 200,
					align: "left"
				},
				{
					field: "pain_lainnya",
					title: "Pain Lainnya",
					width: 150,
					align: "left"
				},
				{
					field: "obat_kemo",
					title: "Obat Kemo",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_mulaikemo",
					title: "Tgl Mulai Kemo",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_selesaikemo",
					title: "Tgl Selesai Kemo",
					width: 150,
					align: "left"
				},
				{
					field: "jml_siklus",
					title: "Jml Siklus",
					width: 150,
					align: "left"
				},
				{
					field: "radioterapi",
					title: "Radioterapi",
					width: 150,
					align: "left"
				},
				{
					field: "lokasi_radioterapi",
					title: "Lokasi Terapi",
					width: 150,
					align: "left"
				},
				{
					field: "radioterapi_lainnya",
					title: "Terapi Lainnya",
					width: 150,
					align: "left"
				},
				{
					field: "nama_unit",
					title: "Unit",
					width: 150,
					align: "left"
				}
			]
		],
		showFooter: true
	});

	$("#dgkuratif").datagrid({
		height: "300",
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: "id",
		nowrap: false,
		//url:'tumortestis/getdata',
		title: "Data Manajemen Kuratif",
		columns: [
			[{
					field: "kemoterapi",
					title: "Kemoterapi",
					width: 100,
					align: "center"
				}, {
					field: "fase_kemo",
					title: "Fase Kemoterapi",
					width: 200,
					align: "left"
				},
				{
					field: "dataprotokol",
					title: "Protokol",
					width: 200,
					align: "left"
				},
				{
					field: "siklus",
					title: "Siklus",
					width: 100,
					align: "left"
				},
				{
					field: "tgl_mulai",
					title: "Tgl Mulai",
					width: 100,
					align: "center"
				},
				{
					field: "tgl_selesai",
					title: "Tgl Selesai",
					width: 100,
					align: "center"
				},
				{
					field: "ketepatan",
					title: "Ketepatan",
					width: 200,
					align: "left"
				},
				{
					field: "evaluasi",
					title: "Hasil Evaluasi",
					width: 200,
					align: "left"
				},
				{
					field: "dataefeksamping",
					title: "Efek Samping Kemo",
					width: 200,
					align: "left"
				},
				{
					field: "datasuportif",
					title: "Terapi Suportif",
					width: 200,
					align: "left"
				},
				{
					field: "radioterapi",
					title: "Radio Terapi",
					width: 100,
					align: "center"
				},
				{
					field: "datametoderadioterapi",
					title: "Metode Radioterapi",
					width: 200,
					align: "left"
				},
				{
					field: "tgl_mulairadioterapi",
					title: "Tgl Mulai Radioterapi",
					width: 200,
					align: "center"
				},
				{
					field: "tgl_selesairadioterapi",
					title: "Tgl Selesai Radioterapi",
					width: 200,
					align: "center"
				},
				{
					field: "pembedahan",
					title: "Pembedahan",
					width: 100,
					align: "center"
				},
				{
					field: "tgl_pembedahan",
					title: "Tgl Pembedahan",
					width: 150,
					align: "center"
				},
				{
					field: "intraoperasi",
					title: "Temuan Intra Operasi",
					width: 200,
					align: "left"
				},
				{field:'action',title:'Hapus',width:80,align:'center',formatter:function(value,row,index){  return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deletekuratif(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> ';  }  
            } 

			]
		],
		onDblClickRow: function () {
			editkuratif();
		}
	});

	$("#dgfollowup").datagrid({
		height: "300",
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: "id",
		nowrap: false,
		//url:'tumortestis/getdata',
		title: "Data Follow Up",
		columns: [
			[{
					field: "tgl_abstraksi_f",
					title: "Tgl Abstaraksi",
					width: 100,
					align: "center"
				}, {
					field: "evaluasi_klinis",
					title: "Evaluasi Klinis",
					width: 200,
					align: "left"
				},
				{
					field: "usg_f",
					title: "Usg",
					width: 100,
					align: "center"
				},
				{
					field: "tgl_usg_f",
					title: "Tgl USG",
					width: 100,
					align: "left"
				},
				{
					field: "kesan_usg",
					title: "Kesan USG",
					width: 150,
					align: "left"
				},
				{
					field: "datapenanda",
					title: "Penanda Tumor",
					width: 200,
					align: "left"
				},
				{
					field: "penanda_tumor_lainnya",
					title: "Penanda Lainnya",
					width: 200,
					align: "left"
				},
				{
					field: "histopatologi_f",
					title: "Histopatologi",
					width: 100,
					align: "cenet"
				},
				{
					field: "tgl_histopatologi_f",
					title: "Tgl Histopatologi",
					width: 100,
					align: "center"
				},
				{
					field: "jenis_histopatologi_f",
					title: "Jenis Histopatologi",
					width: 150,
					align: "left"
				},
				{
					field: "histopatologi_f_lainnya",
					title: "Histopatologi Lainnya",
					width: 150,
					align: "left"
				},
				{
					field: "kesan_histopatologi",
					title: "Kesan Histopatologi",
					width: 200,
					align: "left"
				},
				{
					field: "mri_f",
					title: "MRI",
					width: 100,
					align: "center"
				},
				{
					field: "tgl_pemeriksaan_mri",
					title: "Tgl MRI",
					width: 100,
					align: "center"
				},
				{
					field: "kesan_mri",
					title: "Kesan MRI",
					width: 200,
					align: "left"
				},
				
            {field:'action',title:'Hapus',width:80,align:'center',formatter:function(value,row,index){  return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deletefollowup(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> ';  }  
            } 

			]
		],
		onDblClickRow: function () {
			editfollowup();
		}
	});

	$("#dgluaran").datagrid({
		height: "300",
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: "id",
		nowrap: false,
		//url:'tumortestis/getdata',
		title: "Data Luaran",
		columns: [
			[{
					field: "tgl_abstraksi",
					title: "Tgl Abstraksi",
					width: 150,
					align: "center"
				},
				{
					field: "d_ultrasonografi",
					title: "Ultrasonografi",
					width: 200,
					align: "left"
				},
				{
					field: "d_ctscan",
					title: "CT SCAN",
					width: 200,
					align: "left"
				},
				{
					field: "remisi",
					title: "Remisi",
					width: 150,
					align: "left"
				},
				{
					field: "dataregresi",
					title: "Regresi",
					width: 200,
					align: "left"
				},
				{
					field: "rekurensi",
					title: "Rekurensi",
					width: 100,
					align: "center"
				},
				{
					field: "durasi",
					title: "Durasi",
					width: 150,
					align: "left"
				},
				{
					field: "komplikasi",
					title: "Komplikasi",
					width: 100,
					align: "center"
				},
				{
					field: "b_prostesis",
					title: "Berhubungan dg socket/prostesis",
					width: 200,
					align: "left"
				},
				{
					field: "b_kemoterapi",
					title: "Berhubungan dg kemoterapi",
					width: 200,
					align: "left"
				},
				{
					field: "b_penyakitnya",
					title: "Berhubungan dg penyakitnya",
					width: 200,
					align: "left"
				},
				{
					field: "b_radiasi",
					title: "Berhubungan dg radiasi",
					width: 200,
					align: "left"
				},
				{
					field: "remisi2",
					title: "Remisi 2",
					width: 150,
					align: "left"
				},
				{
					field: "dataregresi2",
					title: "Regresi 2",
					width: 200,
					align: "left"
				},
				{
					field: "rekurensi2",
					title: "Rekurensi 2",
					width: 100,
					align: "center"
				},
				{
					field: "durasi2",
					title: "Durasi 2",
					width: 150,
					align: "left"
				},
				{
					field: "komplikasi2",
					title: "Komplikasi 2",
					width: 100,
					align: "center"
				},
				{
					field: "b_prostesis_2",
					title: "Berhubungan dg socket/prostesis",
					width: 200,
					align: "left"
				},
				{
					field: "b_kemoterapi_2",
					title: "Berhubungan dg kemoterapi",
					width: 200,
					align: "left"
				},
				{
					field: "b_penyakitnya_2",
					title: "Berhubungan dg penyakitnya",
					width: 200,
					align: "left"
				},
				{
					field: "b_radiasi_2",
					title: "Berhubungan dg radiasi",
					width: 200,
					align: "left"
				},
				{
					field: "action",
					title: "Hapus",
					width: 80,
					align: "center",
					formatter: function (value, row, index) {
						return (
							'<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deleteluaran(\'' +
							row.id +
							"');\"><img src='assets/themes/icons/delete-icon24.png' border='0'/ class=\"item-img\"></img></a> "
						);
					}
				}
			]
		],
		onDblClickRow: function () {
			editluaran();
		}
	});

	$("#dgdarah")
		.datagrid({
			width: "400",
			height: "auto",
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: "id",
			nowrap: false,
			//url:'tumortestis/dataoptions?type=darah',
			columns: [
				[{
						field: "nama_options",
						title: "Item",
						width: 200,
						align: "left"
					},
					{
						field: "jml",
						title: "Jml",
						width: 100,
						align: "left",
						editor: "text"
					},
					{
						field: "ket",
						title: "Satuan",
						width: 80,
						align: "left"
					}
				]
			]
		})
		.datagrid("enableCellEditing")
		.datagrid("gotoCell", {
			index: 0,
			field: "id"
		});



	$("#dgdarahluaran")
		.datagrid({
			width: "400",
			height: "auto",
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: "id",
			nowrap: false,
			title: "Pemeriksaan darah dan elektrolit",
			//url:'tumortestis/dataoptions?type=darah',
			columns: [
				[{
						field: "nama_options",
						title: "Item",
						width: 200,
						align: "left"
					},
					{
						field: "jml",
						title: "Jml",
						width: 100,
						align: "left",
						editor: "text"
					},
					{
						field: "ket",
						title: "Satuan",
						width: 80,
						align: "left"
					}
				]
			]
		})
		.datagrid("enableCellEditing")
		.datagrid("gotoCell", {
			index: 0,
			field: "id"
		});

	$("#dgjenisluaran")
		.datagrid({
			width: "400",
			height: "auto",
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: "id",
			nowrap: false,
			title: "Hitung Jenis",
			//url :'tumortestis/dataoptions?type=jenis darah',
			columns: [
				[{
						field: "nama_options",
						title: "Jenis",
						width: 200,
						align: "left"
					},
					{
						field: "jml",
						title: "Jml",
						width: 100,
						align: "left",
						editor: "text"
					},
					{
						field: "ket",
						title: "Satuan",
						width: 80,
						align: "center"
					}
				]
			]
		})
		.datagrid("enableCellEditing")
		.datagrid("gotoCell", {
			index: 0,
			field: "id"
		});

	$("#dgdarahkuratif")
		.datagrid({
			width: "400",
			height: "auto",
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: "id",
			nowrap: false,
			//url:'tumortestis/dataoptions?type=darah',
			columns: [
				[{
						field: "nama_options",
						title: "Item",
						width: 200,
						align: "left"
					},
					{
						field: "jml",
						title: "Jml",
						width: 100,
						align: "left",
						editor: "text"
					},
					{
						field: "ket",
						title: "Satuan",
						width: 80,
						align: "left"
					}
				]
			]
		})
		.datagrid("enableCellEditing")
		.datagrid("gotoCell", {
			index: 0,
			field: "id"
		});

	$("#dgjeniskuratif")
		.datagrid({
			width: "400",
			height: "auto",
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: "id",
			nowrap: false,
			//url :'tumortestis/dataoptions?type=jenis darah',
			columns: [
				[{
						field: "nama_options",
						title: "Jenis",
						width: 200,
						align: "left"
					},
					{
						field: "jml",
						title: "Jml",
						width: 100,
						align: "left",
						editor: "text"
					},
					{
						field: "ket",
						title: "Satuan",
						width: 80,
						align: "center"
					}
				]
			]
		})
		.datagrid("enableCellEditing")
		.datagrid("gotoCell", {
			index: 0,
			field: "id"
		});

	$("#dgpenyerta").datagrid({
		width: "350",
		height: "200",
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: "id",
		nowrap: false,
		//url: 'subgrup/read',
		columns: [
			[{
					field: "penyertaid",
					title: "Id",
					width: 50,
					align: "center",
					hidden: true
				},
				{
					field: "keluhan_penyerta",
					title: "Keluhan Penyerta",
					width: 200,
					align: "left"
				},
				{
					field: "tanggal",
					title: "Tanggal",
					width: 150,
					halign: "center",
					align: "left"
				}
			]
		]
	});

	$("#fase_kemo").combobox({
		onChange: function () {
			var v = $("#fase_kemo").combobox("getValue");
			if (v != "Preephase") {
				var urlsuportif = "tumortestis/dataoptions?type=jenis terapi";
				$("#dgsuportif").datagrid("reload", urlsuportif);
			} else {
				var urlsuportif2 = "tumortestis/dataoptions?type=jenis terapi";
				$("#dgsuportif2").datagrid("reload", urlsuportif2);
			}
		}
	});

	$("#keluhan_utama").combobox({
		panelWidth: 250,
		panelHeight: 200,
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showother(row.nama_options);
		}
		//url:'tumortestis/keluhanutama',
	});

	$("#keluhan_penyerta").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false
		//url:'tumortestis/keluhanpenyerta',
	});

	$("#jenis_pemeriksaan").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showother4(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showother4(row[opts.textField], false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#opt_xray").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			//showother4(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			//showother4(row[opts.textField], false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#nonkuratif").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showtrnonkuratif(row.nama_options);
		}
		//url:'tumortestis/penyertalaiinya',
	});

	$("#lokasi_radioterapi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showtrradioterapi(row.nama_options);
		}
		//url:'tumortestis/penyertalaiinya',
	});

	$("#lokasi_operasi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showtroperasi(row.nama_options);
		}
		//url:'tumortestis/penyertalaiinya',
	});

	$("#optpaliatif").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showoptpaliatif(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showoptpaliatif(row[opts.textField], false);
			//console.log(row)
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#optpain").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showtrtrpain(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showtrtrpain(row[opts.textField], false);
			//console.log(row)
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#search").keyup(function () {
		doSearchtumortestis();
	});

	$("#opt_histopatologi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showtrtrpain(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showtrtrpain(row[opts.textField], false);
			//console.log(row)
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#nwts").combobox({
		panelWidth: 250,
		panelHeight: 200,
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false
	});
	$("#siop").combobox({
		panelWidth: 250,
		panelHeight: 200,
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false
	});

	$("#diagnosisid").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "dasardiagnosis",
		fitColumns: true,
		editable: false,
		url: "tumortestis/diagnosis"
	});

	$("#tatalaksanaid").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "tatalaksana",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "tumortestis/tatalaksana",
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			//console.log(row)
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#pemeriksaan_fisik").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showother3(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showother3(row[opts.textField], false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#stratifikasi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);

		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);

		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#figo2018").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);

		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);

		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#infeksi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showtrinfeksi(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showtrinfeksi(row[opts.textField], false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#non_infeksi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showtrnon_infeksi(row[opts.textField], true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showtrnon_infeksi(row[opts.textField], false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#tindakan").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "tatalaksana",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "tumortestis/tatalaksana",
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			//console.log(row)
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#protokol").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#penanda_tumor").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#efeksamping").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#terapisuportif").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#metoderadioterapi").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#jenis_obat").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#optkomplikasi_kemo").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function (row) {
			showother(row.nama_options);
		}
		//url:'tumortestis/keluhanutama',
	});

	$("#regresi").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#regresi2").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'tumortestis/pemeriksaanfisik',
		formatter: function (row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function (row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function (row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function () {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function (value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#dgkomplikasi").datagrid({
		width: "350",
		height: "150",
		singleSelect: true,
		pagination: false,
		rownumbers: false,
		collapsible: false,
		fitColumns: true,
		idField: "id",
		nowrap: false,
		//url: 'subgrup/read',
		columns: [
			[{
					field: "kuratifid ",
					title: "Id",
					width: 50,
					align: "center",
					hidden: true
				},
				{
					field: "nama_komplikasi",
					title: "Komplikasi",
					width: 200,
					align: "left"
				},
				{
					field: "nama_obat",
					title: "Obat",
					width: 150,
					halign: "center",
					align: "left"
				}
			]
		]
	});

	$("#dgsuportif")
		.datagrid({
			width: "450",
			height: "300",
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: "id",
			nowrap: false,
			//url: 'subgrup/read',
			columns: [
				[
					// {field:'ck ',checkbox:true},
					{
						field: "terapiid ",
						title: "Id",
						width: 50,
						align: "center",
						hidden: true
					},
					{
						field: "nama_options",
						title: "Jenis Terapi",
						width: 200,
						align: "left"
					},
					{
						field: "dosis",
						title: "Dosis",
						width: 150,
						halign: "center",
						align: "left",
						editor: "text"
					},
					{
						field: "minggu",
						title: "Minggu",
						width: 150,
						halign: "center",
						align: "left",
						editor: "text"
					}
				]
			]
		})
		.datagrid("enableCellEditing")
		.datagrid("gotoCell", {
			index: 0,
			field: "id",
			singleSelect: false
		});

	$("#dgsuportif2")
		.datagrid({
			width: "350",
			height: "300",
			singleSelect: true,
			pagination: false,
			rownumbers: false,
			collapsible: false,
			fitColumns: true,
			idField: "id",
			nowrap: false,
			//url: 'subgrup/read',
			columns: [
				[
					// {field:'ck ',checkbox:true},
					{
						field: "terapiid ",
						title: "Id",
						width: 50,
						align: "center",
						hidden: true
					},
					{
						field: "nama_options",
						title: "Jenis Terapi",
						width: 200,
						align: "left"
					},
					{
						field: "siklus",
						title: "Siklus",
						width: 150,
						halign: "center",
						align: "left",
						editor: "text"
					}
				]
			]
		})
		.datagrid("enableCellEditing")
		.datagrid("gotoCell", {
			index: 0,
			field: "id",
			singleSelect: false
		});

	$("#kelengkapan_kemo").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true
		// editable:false,
		// onSelect:function(row){
		//     showtrradioterapi(row.nama_options)
		// },
		//url:'tumortestis/penyertalaiinya',
	});

});

function deletefollowup(id){ 
    if(id){
        $.messager.confirm('Konfirmasi','yakin akan menghapus data ini ?',function(r){ 
            if (r){ 
                $.post('tumortestis/deletefollowup',
                    {id:id},
                    function(result){ 
                    if (result.success){  
                        $.messager.alert('info','Data telah di hapus !','info');
                    $('#dgfollowup').datagrid('reload'); 
                } else { 
                    $.messager.show({ title: 'Error', msg: result.msg }); 
                    } 
                }
                ,'json'); 

            } 
        });
    }else{
        $.messager.alert('Warning','Pilih data yang mau dihapus','warning');
    }  
}

function deletekuratif(id){ 
    if(id){
        $.messager.confirm('Konfirmasi','yakin akan menghapus data ini ?',function(r){ 
            if (r){ 
                $.post('tumortestis/deletekuratif',
                    {id:id},
                    function(result){ 
                    if (result.success){  
                        $.messager.alert('info','Data telah di hapus !','info');
                    $('#dgkuratif').datagrid('reload'); 
                } else { 
                    $.messager.show({ title: 'Error', msg: result.msg }); 
                    } 
                }
                ,'json'); 

            } 
        });
    }else{
        $.messager.alert('Warning','Pilih data yang mau dihapus','warning');
    }  
}

function cekalergi(v) {
	if (v == "y") {
		$("#nama_alergi_obat").textbox({
			disabled: true
		});
	} else {
		$("#nama_alergi_obat").textbox("enable");
	}
}

function selectPasien() {
	var row = $("#datapasien").datagrid("getSelected");
	document.getElementById("label_namalengkap").innerHTML = row.nama;
	document.getElementById("label_nik").innerHTML = row.nik;
	document.getElementById("label_ttl").innerHTML = row.ttl;
	document.getElementById("label_noregistrasi").innerHTML = row.noregistrasi;
	document.getElementById("label_norekam").innerHTML = row.no_rekam;
	document.getElementById("label_nohp").innerHTML = row.no_hp;
	document.getElementById("label_jkelamin").innerHTML = row.jkelamin;
	document.getElementById("registrasiid").value = row.id;
	$("#dlg-pasien").dialog("close");
}

function clearPasien() {
	document.getElementById("label_namalengkap").innerHTML = "";
	document.getElementById("label_nik").innerHTML = "";
	document.getElementById("label_ttl").innerHTML = "";
	document.getElementById("label_noregistrasi").innerHTML = "";
	document.getElementById("label_norekam").innerHTML = "";
	document.getElementById("label_nohp").innerHTML = "";
	document.getElementById("label_jkelamin").innerHTML = "";
	document.getElementById("registrasiid").value = "";
	$("#dlg-pasien").dialog("close");
}

function hidedefault() {
	$("#dgpenyerta").datagrid("loadData", {
		total: 0,
		rows: []
	});

	document.getElementById("lainnya_utama").style.display = "none";
	$("#keluhan_utama_lainnya").textbox("clear");
	document.getElementById("lainnya_penyerta").style.display = "none";
	$("#keluhan_penyerta_lainnya").textbox("clear");
	document.getElementById("trlimpa").style.display = "none";
	$("#nama_limfadenopati").textbox("clear");


	$("#besar_schuffner").textbox("clear");
	document.getElementById("lainnya_fisik").style.display = "none";
	$("#pemeriksaan_fisik_lainnya").textbox("clear");
	document.getElementById("trpain").style.display = "none";
	$("#pain_lainnya").textbox("clear");
	document.getElementById("trkuratif").style.display = "none";
	$("#alasan_tidak_lainnya").textbox("clear");
	document.getElementById("trnonkuratif").style.display = "none";
	$("#nonkuratif").combobox("clear");
	document.getElementById("trpaliatif").style.display = "none";
	$("#optpaliatif").combobox("clear");
	document.getElementById("trradioterapi").style.display = "none";
	$("#radioterapi_lainnya").textbox("clear");
	
	document.getElementById("trsymtoms").style.display = "none";
	$("#optpain").combobox("clear");
	document.getElementById("trpain").style.display = "none";
	$("#pain_lainnya").textbox("clear");
	document.getElementById("trobatkemo").style.display = "none";
	document.getElementById("trtglmulaikemo").style.display = "none";
	document.getElementById("trtglakhirkemo").style.display = "none";
	document.getElementById("trjmlsiklus").style.display = "none";
	$("#obat_kemo").textbox("clear");
	$("#jml_siklus").textbox("clear");
	$("#tgl_mulaikemo").datebox("clear");
	$("#tgl_selesaikemo").datebox("clear");
	document.getElementById("trterapi").style.display = "none";
	$("#lokasi_radioterapi").combobox("clear");
	document.getElementById("trradioterapi").style.display = "none";
}

function showother(isi) {
	if (isi == "Lainnya") {
		document.getElementById("lainnya_utama").style.display = "";
		$("#keluhan_utama_lainnya")
			.textbox("textbox")
			.focus();
	} else {
		document.getElementById("lainnya_utama").style.display = "none";
		$("#keluhan_utama_lainnya").textbox("clear");
	}
}

function showother2(isi) {
	if (isi == "Lainnya") {
		document.getElementById("lainnya_penyerta").style.display = "";
		$("#keluhan_penyerta_lainnya")
			.textbox("textbox")
			.focus();
	} else {
		document.getElementById("lainnya_penyerta").style.display = "none";
		$("#keluhan_penyerta_lainnya").textbox("clear");
	}
}

function showother3(isi, cek) {

	if (isi == "Transiluminasi" && cek == true) {
		document.getElementById("trtransilu").style.display = "";

	} else if (isi == "Transiluminasi" && cek == false) {
		document.getElementById("trtransilu").style.display = "none";
		document.getElementById("transilu1").checked = false;
		document.getElementById("transilu2").checked = false;
	}

	if (isi == "Limfadenopati" && cek == true) {
		document.getElementById("trlimpa").style.display = "";
		$("#nama_limfadenopati")
			.textbox("textbox")
			.focus();
	} else if (isi == "Limfadenopati" && cek == false) {
		document.getElementById("trlimpa").style.display = "none";
		$("#nama_limfadenopati").textbox("clear");
	}

	
	if (isi == "Pemeriksaan bimanual ginjal" && cek == true) {
		document.getElementById("trbimanual").style.display = "";
		$("#bimanual_ginjal")
			.textbox("textbox")
			.focus();
	} else if (isi == "Pemeriksaan bimanual ginjal" && cek == false) {
		document.getElementById("trbimanual").style.display = "none";
		$("#bimanual_ginjal").textbox("clear");
	}

	if (isi == "Lainnya" && cek == true) {
		document.getElementById("lainnya_fisik").style.display = "";
		$("#pemeriksaan_fisik_lainnya")
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("lainnya_fisik").style.display = "none";
		$("#pemeriksaan_fisik_lainnya").textbox("clear");
	}

}

function showother4(isi, cek) {

	if (isi == "Lainnya" && cek == true) {
		document.getElementById("lainnya_jpemeriksaan").style.display = "";
		$("#jenis_pemeriksaan_lainnya")
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("lainnya_jpemeriksaan").style.display = "none";
		$("#jenis_pemeriksaan_lainnya").textbox("clear");
	}
}


function showtrinfeksi(isi, cek) {
	if (isi == "Lainnya" && cek == true) {
		document.getElementById("trinfeksi").style.display = "";
		$("#infeksi_lainnya")
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("trinfeksi").style.display = "none";
		$("#infeksi_lainnya").textbox("clear");
	}
}

function showtrnon_infeksi(isi, cek) {
	if (isi == "Lainnya" && cek == true) {
		document.getElementById("trnon_infeksi").style.display = "";
		$("#non_infeksi_lainnya")
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("trnon_infeksi").style.display = "none";
		$("#non_infeksi_lainnya").textbox("clear");
	}
}

function showtrtrpain(isi, cek) {
	if (isi == "Lainnya" && cek == true) {
		document.getElementById("trpain").style.display = "";
		$("#pain_lainnya")
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("trpain").style.display = "none";
		$("#pain_lainnya").textbox("clear");
	}
}

function showtrkuratif(isi) {
	if (isi == "n") {
		document.getElementById("trkuratif").style.display = "";
	} else {
		document.getElementById("trkuratif").style.display = "none";
		$("#alasan_tidak_lainnya").textbox("clear");
		document.getElementById("trnonkuratif").style.display = "none";
		$("#alasan_tidak_lainnya").textbox("clear");
		$("#nonkuratif").combobox("clear");
	}
}

function showtrpaliatif(isi) {
	if (isi == "y") {
		document.getElementById("trpaliatif").style.display = "";
	} else {
		document.getElementById("trpaliatif").style.display = "none";
		$("#optpaliatif").combobox("clear");
	}
}

function showtrnonkuratif(isi) {
	if (isi == "Lainnya") {
		document.getElementById("trnonkuratif").style.display = "";
		$("#alasan_tidak_lainnya")
			.textbox("textbox")
			.focus();
	} else {
		document.getElementById("trnonkuratif").style.display = "none";
		$("#alasan_tidak_lainnya").textbox("clear");
	}
}

function showtrradioterapi(isi) {
	if (isi == "Lainnya") {
		document.getElementById("trradioterapi").style.display = "";
		$("#radioterapi_lainnya")
			.textbox("textbox")
			.focus();
	} else {
		document.getElementById("trradioterapi").style.display = "none";
		$("#radioterapi_lainnya").textbox("clear");
	}
}

function showtroperasi(isi) {
	if (isi == "Lainnya") {
		document.getElementById("troperasi_lainnya").style.display = "";
		$("#operasi_lainnya")
			.textbox("textbox")
			.focus();
	} else {
		document.getElementById("troperasi_lainnya").style.display = "none";
		$("#operasi_lainnya").textbox("clear");
	}
}



function showoptpaliatif(isi, cek) {
	if (isi == "Pain/Symptoms management" && cek == true) {
		document.getElementById("trsymtoms").style.display = "";
	} else if (isi == "Pain/Symptoms management" && cek == false) {
		document.getElementById("trsymtoms").style.display = "none";
		$("#optpain").combobox("clear");
		document.getElementById("trpain").style.display = "none";
		$("#pain_lainnya").textbox("clear");
	}

	if (isi == "Kemoterapi" && cek == true) {
		document.getElementById("trobatkemo").style.display = "";
		document.getElementById("trtglmulaikemo").style.display = "";
		document.getElementById("trtglakhirkemo").style.display = "";
		document.getElementById("trjmlsiklus").style.display = "";
		$("#obat_kemo")
			.textbox("textbox")
			.focus();
	} else if (isi == "Kemoterapi" && cek == false) {
		document.getElementById("trobatkemo").style.display = "none";
		document.getElementById("trtglmulaikemo").style.display = "none";
		document.getElementById("trtglakhirkemo").style.display = "none";
		document.getElementById("trjmlsiklus").style.display = "none";
		$("#obat_kemo").textbox("clear");
		$("#jml_siklus").textbox("clear");
		$("#tgl_mulaikemo").datebox("clear");
		$("#tgl_selesaikemo").datebox("clear");
	}

	if (isi == "Radioterapi" && cek == true) {
		document.getElementById("trterapi").style.display = "";
	} else if (isi == "Radioterapi" && cek == false) {
		document.getElementById("trterapi").style.display = "none";
		$("#lokasi_radioterapi").combobox("clear");
		document.getElementById("trradioterapi").style.display = "none";
		$("#radioterapi_lainnya").textbox("clear");
	}

	if (isi == "Operasi/Pembedahan" && cek == true) {
		document.getElementById("troperasi").style.display = "";
	} else if (isi == "Operasi/Pembedahan" && cek == false) {
		document.getElementById("troperasi").style.display = "none";
		$("#lokasi_operasi").combobox("clear");
		document.getElementById("troperasi_lainnya").style.display = "none";
		$("#operasi_lainnya").textbox("clear");
	}
}

function deleteRiwayat(index) {
	$("#dgriwayat").datagrid("deleteRow", index);
	//$('#dgriwayat').datagrid('reload');
}

function tampilkan(isi) {
	if (isi == "y") {
		document.getElementById("tgriwayat").style.display = "";
		document.getElementById("btnriwayat").style.display = "";
		document.getElementById("btnriwayat2").style.display = "";
	} else if (isi == "n") {
		document.getElementById("tgriwayat").style.display = "none";
		document.getElementById("btnriwayat").style.display = "none";
		document.getElementById("btnriwayat2").style.display = "none";
		$("#dgriwayat").datagrid("loadData", {
			total: 0,
			rows: []
		});
	} else {
		document.getElementById("tgriwayat").style.display = "none";
		document.getElementById("btnriwayat").style.display = "none";
		document.getElementById("btnriwayat2").style.display = "none";
		$("#dgriwayat").datagrid("loadData", {
			total: 0,
			rows: []
		});
	}
}

function showstatus(v) {
	if (v == 1) {
		document.getElementById("statushidup").style.display = "";
		document.getElementById("sebabkematian").style.display = "none";
		$("#date_loss").datebox("clear");
		$("#date_loss").datebox("readonly");
		$("#date_meninggal").datebox("clear");
		$("#date_meninggal").datebox("readonly");

		$("#date_complete").datebox("clear");
		$("#date_complete").datebox("readonly");
		$("#date_stable").datebox("clear");
		$("#date_stable").datebox("readonly");
		$("#date_relaps").datebox("clear");
		$("#date_relaps").datebox("readonly");
		$("#date_progresif").datebox("clear");
		$("#date_progresif").datebox("readonly");
		// document.getElementById("btnriwayat2").style.display = '';
	} else if (v == 2) {
		document.getElementById("statushidup").style.display = "none";
		document.getElementById("sebabkematian").style.display = "none";
		document.getElementById("cm").checked = false;
		$("#date_complete").datebox("clear");
		$("#date_complete").datebox("readonly");
		document.getElementById("st").checked = false;
		$("#date_stable").datebox("clear");
		$("#date_stable").datebox("readonly");
		document.getElementById("re").checked = false;
		$("#date_relaps").datebox("clear");
		$("#date_relaps").datebox("readonly");
		document.getElementById("pr").checked = false;
		$("#date_progresif").datebox("clear");
		$("#date_progresif").datebox("readonly");
		$("#date_meninggal").datebox("clear");
		$("#rumah_sakit").textbox("clear");
		$("#tindakan").combobox("clear");
		$("#ket_lainnya").textbox("clear");
		$("#sebab_kematian").textbox("clear");
		$("#date_loss").datebox("readonly", false);
		$("#date_meninggal").datebox("readonly");
		// document.getElementById("btnriwayat2").style.display = 'none';
		// $('#dgriwayat').datagrid('loadData', {"total":0,"rows":[]});
	} else if (v == 3) {
		document.getElementById("statushidup").style.display = "none";
		document.getElementById("sebabkematian").style.display = "";
		document.getElementById("cm").checked = false;
		$("#date_complete").datebox("clear");
		$("#date_complete").datebox("readonly");
		document.getElementById("st").checked = false;
		$("#date_stable").datebox("clear");
		$("#date_stable").datebox("readonly");
		document.getElementById("re").checked = false;
		$("#date_relaps").datebox("clear");
		$("#date_relaps").datebox("readonly");
		document.getElementById("pr").checked = false;
		$("#date_progresif").datebox("clear");
		$("#date_progresif").datebox("readonly");
		$("#date_loss").datebox("clear");
		$("#rumah_sakit").textbox("clear");
		$("#tindakan").combobox("clear");
		$("#ket_lainnya").textbox("clear");
		$("#date_loss").datebox("readonly");
		$("#date_meninggal").datebox("readonly", false);
		// document.getElementById("btnriwayat2").style.display = 'none';
		// $('#dgriwayat').datagrid('loadData', {"total":0,"rows":[]});
	}
}

function opendate(v) {
	if (v == "cm") {
		$("#date_complete").datebox("readonly", false);

		$("#date_stable").datebox("clear");
		$("#date_relaps").datebox("clear");
		$("#date_progresif").datebox("clear");

		$("#date_stable").datebox("readonly");
		$("#date_relaps").datebox("readonly");
		$("#date_progresif").datebox("readonly");
	} else if (v == "st") {
		$("#date_stable").datebox("readonly", false);

		$("#date_complete").datebox("clear");
		$("#date_relaps").datebox("clear");
		$("#date_progresif").datebox("clear");

		$("#date_complete").datebox("readonly");
		$("#date_relaps").datebox("readonly");
		$("#date_progresif").datebox("readonly");
	} else if (v == "re") {
		$("#date_relaps").datebox("readonly", false);

		$("#date_complete").datebox("clear");
		$("#date_stable").datebox("clear");
		$("#date_progresif").datebox("clear");

		$("#date_complete").datebox("readonly");
		$("#date_stable").datebox("readonly");
		$("#date_progresif").datebox("readonly");
	} else if (v == "pr") {
		$("#date_progresif").datebox("readonly", false);

		$("#date_complete").datebox("clear");
		$("#date_stable").datebox("clear");
		$("#date_relaps").datebox("clear");

		$("#date_complete").datebox("readonly");
		$("#date_stable").datebox("readonly");
		$("#date_relaps").datebox("readonly");
	}
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

function searchvalidate(v) {
	$("#dgtumortestis").datagrid("reload", {
		validate: v
	});
}

function doSearchx(value) {
	$("#dgshowpasien").datagrid(
		"reload",
		"tumortestis/caripasien?search=" + value
	);
	$("#search").val("");
	$("#search").focus();
}

function doSearch(value) {

	$("#dgtumortestis").datagrid(
		'reload', {
			search: value
		}
	);
	//$("#search").val("");
	//$("#search").focus();
}

function no_tumortestis() {
	//  var notumortestis ='';
	var nounit = document.getElementById("ssnya").value;
	var x = "l"; //document.getElementByName("jeniskelamin").value;
	if (x == "l") {
		j = 1;
	} else if (x == "p") {
		j = 2;
	} else {
		j = 0;
	}
	var no = "";
	$.getJSON(
		"tumortestis/no_tumortestis", {
			get_param: "value"
		},
		function (data) {
			document.getElementById("nourut").value = data.nourut;
		}
	);

	notumortestis = nounit + j + no;
	//$('#dlg').dialog({title : nounit});
	document.getElementById("notumortestis").value = notumortestis;
}

function cariSubgrup() {
	$("#dlg-subreg")
		.dialog("open")
		.dialog("setTitle", "Pencarian Data Tumor");
}

function addtogrid() {
	var d1 = $("#hubkeluarga").textbox("getValue"),
		d2 = $("#jkanker").textbox("getValue");
	if (d1 && d2) {
		$("#dgriwayat").datagrid("appendRow", {
			keluarga: d1,
			jenis_kanker: d2
		});
		$("#hubkeluarga").textbox("setValue", "");
		$("#jkanker").textbox("setValue", "");
	} else {
		$.messager.alert(
			"warning",
			"mohon isi kolom keluarga terlebih dahulu",
			"warning"
		);
	}
}

function tambahpenyerta() {
	var a = $("#keluhan_penyerta").combobox("getValue"),
		b = $("#keluhan_penyerta").combobox("getText"),
		c = $("#tgl_keluhan").datebox("getValue");

	if (b && c) {
		$("#dgpenyerta").datagrid("appendRow", {
			penyertaid: a,
			keluhan_penyerta: b,
			tanggal: c
		});
		//if(b=='Lainnya'){
		showother2(b);
		//}
		$("#keluhan_penyerta").combobox("setValue", "");
	} else {
		$.messager.alert(
			"warning",
			"mohon isi kolom keluhan penyerta terlebih dahulu",
			"warning"
		);
	}
}

function progress() {
	$.messager.progress({
		title: "Mohon Tunggu",
		msg: "Simpan data..."
	});
}

function kosongkanpenyerta() {
	$("#dgpenyerta").datagrid("loadData", {
		total: 0,
		rows: []
	});
	document.getElementById("lainnya_penyerta").style.display = "none";
	$("#keluhan_penyerta_lainnya").textbox("clear");
}

function save() {
	var idnhep = document.getElementById("registrasiid").value;
	if (idnhep) {
		var fisik = $("#pemeriksaan_fisik").combobox("getValues");
		var optjenis = $("#jenis_pemeriksaan").combobox("getValues");
		var optxray = $("#opt_xray").combobox("getValues");
		var opthistopatologi = $("#opt_histopatologi").combobox("getValues");
		var optstaging = $("#figo2018").combobox("getValues");
		var stratifikasi = $("#stratifikasi").combobox("getValues");
		var optpaliatif = $("#optpaliatif").combobox("getValues");
		var optpain = $("#optpain").combobox("getValues");

		//ambil data dg diagnosis
		var getdata = $("#dgpenyerta").datagrid("getRows");
		var datadetail = JSON.stringify(getdata);
		var detail1 = "?datajson1=" + encodeURIComponent(datadetail);

		//ambil data dg darah
		var getdata2 = $("#dgdarah").datagrid("getRows");
		var datadetail2 = JSON.stringify(getdata2);
		var detail2 = "&datajson2=" + encodeURIComponent(datadetail2);

		progress(); // show the message box
		$("#fm").form("submit", {
			url: url +
				detail1 +
				detail2 +
				"&fisik=" +
				fisik +
				"&optjenis=" +
				optjenis +
				"&optxray=" +
				optxray +
				"&opthistopatologi=" +
				opthistopatologi +
				"&optstaging=" +
				optstaging +
				"&optpaliatif=" +
				optpaliatif +
				"&optpain=" +
				optpain +
				"&stratifikasi=" +
				stratifikasi,

			onSubmit: function () {
				//return $(this).form('validate');
				var v = $(this).form("validate");
				if (!v) $.messager.progress("close"); // close the message box
				return v;
			},
			success: function (result) {
				var result = eval("(" + result + ")");
				if (result.errorMsg) {
					//$.messager.progress('close');
					$.messager.show({
						title: "Error",
						msg: result.errorMsg
					});
				} else {
					$.messager.progress("close");
					$.messager.alert("Info", "Data Sukses Disimpan", "");
					$("#dlg").dialog("close"); // close the dialog
					$("#dgtumortestis").datagrid("reload"); // reload the user data
				}
			}
		});
	} else {
		$.messager.alert("warning", "Pilih pasien terlebih dahulu!", "warning");
	}
}

function tambahspesifik() {
	$("#dlg")
		.dialog("open")
		.dialog("setTitle", "Tambah Data Spesifik");
	clearPasien();
	$("#fm").form("clear");
	document.getElementById("ku").checked = true;
	document.getElementById("pu").checked = true;
	document.getElementById("usg1").checked = true;
	document.getElementById("kgb1").checked = true;
	document.getElementById("ctscan1").checked = true;
	document.getElementById("kgb1_ctscan").checked = true;
	document.getElementById("mri1").checked = true;
	document.getElementById("kgb1_mri").checked = true;
	document.getElementById("xray1").checked = true;
	document.getElementById("abnormalitas1_ctscan").checked = true;

	hidedefault();

	with(new Date()) {
		$("#tgl_periksatumor").datebox(
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
		$("#tgl_diagnosis").datebox(
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
		$("#tgl_usg").datebox(
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
		$("#tgl_ctscan").datebox(
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
		$("#tgl_mri").datebox(
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
		$("#tgl_xray").datebox(
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
		$("#tgl_histopatologi").datebox(
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
		$("#tgl_keluhan").datebox(
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
		$("#tgl_periksadarah").datebox(
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
		$("#tgl_periksaurin").datebox(
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
		$("#tgl_serebrospinal").datebox(
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
		$("#tgl_diagnosis").datebox(
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

	var urldarah = "tumortestis/dataoptions?type=darah";
	$("#dgdarah").datagrid("reload", urldarah);

	var urlkeluhan = "tumortestis/dataoptions?type=keluhan utama";
	$("#keluhan_utama").combobox("reload", urlkeluhan);

	var urlpenyerta = "tumortestis/dataoptions?type=keluhan penyerta";
	$("#keluhan_penyerta").combobox("reload", urlpenyerta);

	var urlfisik = "tumortestis/dataoptions?type=fisik_testis";
	$("#pemeriksaan_fisik").combobox("reload", urlfisik);

	var urljperiksa = "tumortestis/dataoptions?type=jperiksa";
	$("#jenis_pemeriksaan").combobox("reload", urljperiksa);

	var urlhxray = "tumortestis/dataoptions?type=xray";
	$("#opt_xray").combobox("reload", urlhxray);

	var urlnonkuratif = "tumortestis/dataoptions?type=non kuratif";
	$("#nonkuratif").combobox("reload", urlnonkuratif);
	var urlpaliatif = "tumortestis/dataoptions?type=paliatif";
	$("#optpaliatif").combobox("reload", urlpaliatif);
	var urlpain = "tumortestis/dataoptions?type=pain";
	$("#optpain").combobox("reload", urlpain);
	var urlradioterapi = "tumortestis/dataoptions?type=lokasi radioterapi";
	$("#lokasi_radioterapi").combobox("reload", urlradioterapi);
	var urloperasi = "tumortestis/dataoptions?type=operasi";
	$("#lokasi_operasi").combobox("reload", urloperasi);
	var urlhistopatologi = "tumortestis/dataoptions?type=histopatologi_testis";
	$("#opt_histopatologi").combobox("reload", urlhistopatologi);
	
	var urlstratifikasi = "tumortestis/dataoptions?type=stratifikasi_testis";
	$("#stratifikasi").combobox("reload", urlstratifikasi);
	var urlfigo2018 = "tumortestis/dataoptions?type=figo2018";
	$("#figo2018").combobox("reload", urlfigo2018);

	$("#btnlink").linkbutton({
		text: "Simpan"
	});
	url = "tumortestis/save";
}

function showPasien() {
	$("#dlg-pasien")
		.dialog("open")
		.dialog("setTitle", "cari data pasien");
	$("#datapasien").datagrid("reload", {
		search: ""
	});
}

function edit() {
	var row = $("#dgtumortestis").datagrid("getSelected");
	if (row) {
		$("#dlg")
			.dialog("open")
			.dialog("setTitle", "Edit Register Spesifik Tumortestis");
		$("#fm").form("load", row);

		if (row.lokasi1 == "1") {
			document.getElementById("lokasi1").checked = true;
		}
		if (row.lokasi2 == "1") {
			document.getElementById("lokasi2").checked = true;
		}

		if (row.jenis_kelamin == "l") {
			document.getElementById("label_jkelamin").innerHTML = "Laki-laki";
		} else if (row.jenis_kelamin == "p") {
			document.getElementById("label_jkelamin").innerHTML = "Perempuan";
		}
		document.getElementById("label_namalengkap").innerHTML = row.nama;
		document.getElementById("label_nik").innerHTML = row.nik;
		document.getElementById("label_ttl").innerHTML = row.ttl;
		document.getElementById("label_noregistrasi").innerHTML = row.noregistrasi;
		document.getElementById("label_norekam").innerHTML = row.no_rekam;
		document.getElementById("label_nohp").innerHTML = row.no_hp;

		var urlkeluhan = "tumortestis/dataoptions?type=keluhan utama";
		$("#keluhan_utama").combobox("reload", urlkeluhan);
		$("#dgpenyerta").datagrid(
			"reload",
			"tumortestis/getdatapenyerta?spesifikid=" + row.id
		);
		$("#dgdarah").datagrid(
			"reload",
			"tumortestis/getdarah?table=tumortestis_darah&tableid=tumortestisid&id=" +
			row.id
		);

		var urlpenyerta = "tumortestis/dataoptions?type=keluhan penyerta";
		$("#keluhan_penyerta").combobox("reload", urlpenyerta);
		var urlfisik = "tumortestis/dataoptions?type=fisik_testis";
		$("#pemeriksaan_fisik").combobox("reload", urlfisik);
		var urlnonkuratif = "tumortestis/dataoptions?type=non kuratif";
		$("#nonkuratif").combobox("reload", urlnonkuratif);
		var urlpaliatif = "tumortestis/dataoptions?type=paliatif";
		$("#optpaliatif").combobox("reload", urlpaliatif);
		var urlpain = "tumortestis/dataoptions?type=pain";
		$("#optpain").combobox("reload", urlpain);
		var urlradioterapi = "tumortestis/dataoptions?type=lokasi radioterapi";
		$("#lokasi_radioterapi").combobox("reload", urlradioterapi);
		var urljperiksa = "tumortestis/dataoptions?type=jperiksa";
		$("#jenis_pemeriksaan").combobox("reload", urljperiksa);		
		var urlhxray = "tumortestis/dataoptions?type=xray";
	    $("#opt_xray").combobox("reload", urlhxray);

		var urloperasi = "tumortestis/dataoptions?type=operasi";
		$("#lokasi_operasi").combobox("reload", urloperasi);

		var urlhistopatologi = "tumortestis/dataoptions?type=histopatologi_testis";
		$("#opt_histopatologi").combobox("reload", urlhistopatologi);

		var urlstratifikasi = "tumortestis/dataoptions?type=stratifikasi_testis";
		$("#stratifikasi").combobox("reload", urlstratifikasi);
		var urlfigo2018 = "tumortestis/dataoptions?type=figo2018";
		$("#figo2018").combobox("reload", urlfigo2018);

		$("#btnlink").linkbutton({
			text: "Update"
		});
		url = "tumortestis/update/" + row.id;
	} else {
		$.messager.alert("Warning", "Pilih data yang mau diedit", "warning");
	}
}

function remove() {
	var row = $("#dgtumortestis").datagrid("getSelected");
	if (row) {
		$.messager.confirm(
			"Konfirmasi",
			'Apakah anda yakin akan menghapus data spesifik "' + row.nama + '" ?',
			function (r) {
				if (r) {
					$.post(
						"tumortestis/delete", {
							id: row.id
						},
						function (result) {
							if (result.success) {
								$.messager.alert(
									"info",
									'Data tumortestis"' + row.nama + '" telah di hapus !',
									"info"
								);
								$("#dgtumortestis").datagrid("reload");
							} else {
								$.messager.show({
									title: "Error",
									msg: result.msg
								});
							}
						},
						"json"
					);
					$("#dlg").dialog("close");
				}
			}
		);
	} else {
		$.messager.alert("Warning", "Pilih data yang mau dihapus", "warning");
	}
}

function updateluaran() {
	var row = $("#dgtumortestis").datagrid("getSelected");
	if (row) {
		$("#dlg-luaran")
			.dialog("open")
			.dialog("setTitle", "Update Data Luaran");
		$("#fmluaran").form("clear");
		$("#dgluaran").datagrid(
			"reload",
			"tumortestis/readluaran?nheproid=" + row.id
		);
		document.getElementById("labelnoreg").innerHTML = row.notumortestis;
		document.getElementById("labelnama").innerHTML = row.nama;
		document.getElementById("tumortestisid").value = row.id;
		with(new Date()) {
			$("#tgl_abstraksi").datebox(
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
		$("#lnk").linkbutton({
			text: "Simpan"
		});
		url = "tumortestis/saveluaran";
	} else {
		$.messager.alert("Warning", "Pilih data terlebih dahulu", "warning");
	}
}

function deleteluaran(id) {
	if (id) {
		$.messager.confirm(
			"Konfirmasi",
			"yakin akan menghapus data ini ?",
			function (r) {
				if (r) {
					$.post(
						"tumortestis/deleteluaran", {
							id: id
						},
						function (result) {
							if (result.success) {
								$.messager.alert("info", "Data telah di hapus !", "info");
								$("#dgluaran").datagrid("reload");
							} else {
								$.messager.show({
									title: "Error",
									msg: result.msg
								});
							}
						},
						"json"
					);
				}
			}
		);
	} else {
		$.messager.alert("Warning", "Pilih data yang mau dihapus", "warning");
	}
}

function editkuratif() {
	var row = $("#dgkuratif").datagrid("getSelected");

	if (row) {
		$("#fm-kuratif").form("load", row);

		url = "tumortestis/updatekuratif/" + row.id;
		$("#btnlinkkuratif").linkbutton({
			text: "Update"
		});
	} else {
		$.messager.alert("Warning", "Pilih data yang mau diedit", "warning");
	}
}

function manajemenkuratif() {
	var row = $("#dgtumortestis").datagrid("getSelected");
	if (row) {
		$("#dlg-kuratif")
			.dialog("open")
			.dialog("setTitle", "Manajemen Kuratif");
		$("#fm-kuratif").form("clear");
		document.getElementById("tumortestisid").value = row.id;
		document.getElementById("label_noregistrasi2").innerHTML = row.noregistrasi;
		document.getElementById("label_namalengkap2").innerHTML = row.nama;
		if (row.jenis_kelamin == "l") {
			document.getElementById("label_jkelamin2").innerHTML = "Laki-laki";
		} else if (row.jenis_kelamin == "p") {
			document.getElementById("label_jkelamin2").innerHTML = "Perempuan";
		}
		document.getElementById("label_nohp2").innerHTML = row.no_hp;
		with(new Date()) {
			$("#tgl_mulai").datebox(
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
			$("#tgl_selesai").datebox(
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
			$("#tgl_mulairadioterapi").datebox(
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
			$("#tgl_selesairadioterapi").datebox(
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
			$("#tgl_pembedahan").datebox(
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
		document.getElementById("kemoterapi2").checked = true;
		document.getElementById("radioterapi2").checked = true;
		document.getElementById("pembedahan2").checked = true;
		
		var urlprotokol = "tumortestis/dataoptions?type=kemotestis";
		$("#protokol").combobox("reload", urlprotokol);
		var urlprotokol = "tumortestis/dataoptions?type=efeksamping";
		$("#efeksamping").combobox("reload", urlprotokol);
		var urlprotokol = "tumortestis/dataoptions?type=terapisuportif";
		$("#terapisuportif").combobox("reload", urlprotokol);
		
		var urlmetode = "tumortestis/dataoptions?type=radiotestis";
		$("#metoderadioterapi").combobox("reload", urlmetode);

		var urldgkuratif = 'tumortestis/readkuratif?id=' + row.id;
		$('#dgkuratif').datagrid('reload', urldgkuratif);
		$('#dgkuratif').datagrid('unselectAll');

		$("#btnlinkkuratif").linkbutton({
			text: "Simpan"
		});
		url = "tumortestis/savekuratif";
	} else {
		$.messager.alert("warning", "pilih data terlebih dahulu", "warning");
	}
}

function tambahkomplikasi() {
	var a = $("#optkomplikasi_kemo").combobox("getValue"),
		b = $("#optkomplikasi_kemo").combobox("getText"),
		c = $("#nama_obat").textbox("getValue");

	if (b && c) {
		$("#dgkomplikasi").datagrid("appendRow", {
			kuratifid: a,
			nama_komplikasi: b,
			nama_obat: c
		});
		//if(b=='Lainnya'){
		//showother2(b)
		//}
		$("#optkomplikasi_kemo").combobox("setValue", "");
		$("#nama_obat").textbox("setValue", "");
	} else {
		$.messager.alert(
			"warning",
			"mohon isi kolom komplikasi terlebih dahulu",
			"warning"
		);
	}
}

function kosongkankomplikasi() {
	$("#dgkomplikasi").datagrid("loadData", {
		total: 0,
		rows: []
	});
	var row = $("#dgtumortestis").datagrid("getSelected");
	document.getElementById("tumortestisid").value = row.id;
}

function savekuratif() {

	var optprotokol = $("#protokol").combobox("getValues");
	var efeksamping = $("#efeksamping").combobox("getValues");
	var terapisuportif = $("#terapisuportif").combobox("getValues");
	var metoderadioterapi = $("#metoderadioterapi").combobox("getValues");

	progress(); //show the message box
	$("#fm-kuratif").form("submit", {
		url: url + "?protokol=" + optprotokol + "&efeksamping=" + efeksamping + "&terapisuportif=" + terapisuportif + "&metoderadioterapi=" + metoderadioterapi,
		onSubmit: function () {
			//return $(this).form('validate');
			var v = $(this).form("validate");
			if (!v) $.messager.progress("close"); // close the message box
			return v;
		},
		success: function (result) {
			var result = eval("(" + result + ")");
			if (result.errorMsg) {
				//$.messager.progress('close');
				$.messager.show({
					title: "Error",
					msg: result.errorMsg
				});
			} else {
				$.messager.progress("close");
				$.messager.alert("Info", "Data Sukses Disimpan", "");
				$("#fm-kuratif").form("clear");

				with(new Date()) {
					$("#tgl_mulai").datebox(
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
					$("#tgl_selesai").datebox(
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
					$("#tgl_mulairadioterapi").datebox(
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
					$("#tgl_selesairadioterapi").datebox(
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
					$("#tgl_pembedahan").datebox(
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
				document.getElementById("kemoterapi2").checked = true;
				document.getElementById("radioterapi2").checked = true;
				document.getElementById("pembedahan2").checked = true;
				
				$("#btnlinkkuratif").linkbutton({
					text: "Simpan"
				});
				url = "tumortestis/savekuratif";
				//$('#dlg-kuratif').dialog('close');        // close the dialog
				$("#dgkuratif").datagrid("reload"); // reload the user data
			}
		}
	});
}

function followup() {
	var row = $("#dgtumortestis").datagrid("getSelected");
	if (row) {
		$("#dlg-followup")
			.dialog("open")
			.dialog("setTitle", "Follow Up");
		$("#fm-followup").form("clear");
		document.getElementById("usg_f1").checked = true;
		document.getElementById("histopatologi_f1").checked = true;
		document.getElementById("mri_f1").checked = true;

		document.getElementById("tumortestisid_f").value = row.id;
		document.getElementById("label_noregistrasi_f").innerHTML = row.noregistrasi;
		document.getElementById("label_namalengkap_f").innerHTML = row.nama;
		if (row.jenis_kelamin == "l") {
			document.getElementById("label_jkelamin_f").innerHTML = "Laki-laki";
		} else if (row.jenis_kelamin == "p") {
			document.getElementById("label_jkelamin_f").innerHTML = "Perempuan";
		}
		document.getElementById("label_nohp_f").innerHTML = row.no_hp;

		with(new Date()) {
			$("#tgl_abstraksi_f").datebox(
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
			$("#tgl_usg_f").datebox(
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
			$("#tgl_histopatologi_f").datebox(
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
			$("#tgl_pemeriksaan_mri").datebox(
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

		var urlpenanda = "tumortestis/dataoptions?type=penandatumor";
		$("#penanda_tumor").combobox("reload", urlpenanda);

		var urldgfollowup = 'tumortestis/readfollowup?id=' + row.id;
		$('#dgfollowup').datagrid('reload', urldgfollowup);
		$('#dgfollowup').datagrid('unselectAll');

		$("#btnlinkfollowup").linkbutton({
			text: "Simpan"
		});
		url = "tumortestis/savefollowup";
	}else{
		$.messager.alert("warning", "pilih data terlebih dahulu", "warning");
	}
}

function savefollowup(){
	var penandatumor = $("#penanda_tumor").combobox("getValues");

	progress(); //show the message box
	$("#fm-followup").form("submit", {
		url: url + "?penanda_tumor=" + penandatumor,
		onSubmit: function () {
			//return $(this).form('validate');
			var v = $(this).form("validate");
			if (!v) $.messager.progress("close"); // close the message box
			return v;
		},
		success: function (result) {
			var result = eval("(" + result + ")");
			if (result.errorMsg) {
				//$.messager.progress('close');
				$.messager.show({
					title: "Error",
					msg: result.errorMsg
				});
			} else {
				$.messager.progress("close");
				$.messager.alert("Info", "Data Sukses Disimpan", "");
				$("#fm-followup").form("clear");

				with(new Date()) {
					$("#tgl_abstraksi_f").datebox(
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
					$("#tgl_usg_f").datebox(
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
					$("#tgl_histopatologi_f").datebox(
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
					$("#tgl_pemeriksaan_mri").datebox(
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

				var urlpenanda = "tumortestis/dataoptions?type=penandatumor";
				$("#penanda_tumor").combobox("reload", urlpenanda);

				document.getElementById("usg_f1").checked = true;
				document.getElementById("histopatologi_f1").checked = true;
				document.getElementById("mri_f1").checked = true;
				
				$("#btnlinkfollowup").linkbutton({
					text: "Simpan"
				});
				url = "tumortestis/savefollowup";
				//$('#dlg-followup').dialog('close');        // close the dialog
				$("#dgfollowup").datagrid("reload"); // reload the user data
			}
		}
	});
}

function editfollowup() {
	var row = $("#dgfollowup").datagrid("getSelected");

	if (row) {
		$("#fm-followup").form("load", row);

		url = "tumortestis/updatefollowup/" + row.id;
		$("#btnlinkfollowup").linkbutton({
			text: "Update"
		});
	} else {
		$.messager.alert("Warning", "Pilih data yang mau diedit", "warning");
	}
}

function luaran() {
	var row = $("#dgtumortestis").datagrid("getSelected");
	if (row) {
		$("#dlg-luaran")
			.dialog("open")
			.dialog("setTitle", "Follow Up");
		$("#fm-luaran").form("clear");
		document.getElementById("tumortestisid3").value = row.id;
		document.getElementById("label_noregistrasi4").innerHTML = row.noregistrasi;
		document.getElementById("label_namalengkap4").innerHTML = row.nama;
		if (row.jenis_kelamin == "l") {
			document.getElementById("label_jkelamin4").innerHTML = "Laki-laki";
		} else if (row.jenis_kelamin == "p") {
			document.getElementById("label_jkelamin4").innerHTML = "Perempuan";
		}
		document.getElementById("label_nohp4").innerHTML = row.no_hp;

		with(new Date()) {
			$("#tgl_abstraksi").datebox(
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
			$("#tgl_periksa_sonografi").datebox(
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
			$("#tgl_periksa_ctscan").datebox(
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

		document.getElementById("rekurensi2").checked = true;
		document.getElementById("rekurensi22").checked = true;
		document.getElementById("komplikasi2").checked = true;
		document.getElementById("komplikasi22").checked = true;
		document.getElementById("ultrasonografi2").checked = true;
		document.getElementById("ctscan_l2").checked = true;

		var urlregresi = "tumortestis/dataoptions?type=regresi";
		$("#regresi").combobox("reload", urlregresi);

		var urlregresi2 = "tumortestis/dataoptions?type=regresi";
		$("#regresi2").combobox("reload", urlregresi2);

		var urldgluaran = "tumortestis/readluaran?id=" + row.id;
		$("#dgluaran").datagrid("reload", urldgluaran);

		$("#btnlinkluaran").linkbutton({
			text: "Simpan"
		});
		url = "tumortestis/saveluaran";
	} else {
		$.messager.alert("warning", "pilih data terlebih dahulu", "warning");
	}
}

function saveluaran() {
	var regresi = $("#regresi").combobox("getValues");
	var regresi2 = $("#regresi2").combobox("getValues");
	progress(); // show the message box
	$("#fm-luaran").form("submit", {
		url: url + "?regresi=" + regresi + "&regresi2=" + regresi2,

		onSubmit: function () {
			//return $(this).form('validate');
			var v = $(this).form("validate");
			if (!v) $.messager.progress("close"); // close the message box
			return v;
		},
		success: function (result) {
			var result = eval("(" + result + ")");
			if (result.errorMsg) {
				//$.messager.progress('close');
				$.messager.show({
					title: "Error",
					msg: result.errorMsg
				});
			} else {
				$.messager.progress("close");
				$.messager.alert("Info", "Data Sukses Disimpan", "");
				$("#fm-luaran").form("clear");
				//kosongkandarah()
				var row = $("#dgtumortestis").datagrid("getSelected");
				document.getElementById("tumortestisid3").value = row.id;

				document.getElementById("rekurensi2").checked = true;
				document.getElementById("rekurensi22").checked = true;
				document.getElementById("komplikasi2").checked = true;
				document.getElementById("komplikasi22").checked = true;

				with(new Date()) {
					$("#tgl_abstraksi").datebox(
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

				$("#btnlinkluaran").linkbutton({
					text: "Simpan"
				});
				url = "tumortestis/saveluaran";
				//$('#dlg-kuratif').dialog('close');        // close the dialog
				$("#dgluaran").datagrid("reload"); // reload the user data
			}
		}
	});
}

function editluaran() {
	var row = $("#dgluaran").datagrid("getSelected");
	if (row) {
		$("#fm-luaran").form("load", row);

		url = "tumortestis/updateluaran/" + row.id;
		$("#btnlinkluaran").linkbutton({
			text: "Update"
		});
	} else {
		$.messager.alert("Warning", "Pilih data yang mau diedit", "warning");
	}
}
