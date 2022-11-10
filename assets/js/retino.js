$(document).ready(function() {
	$("#searchPasien").combogrid({
		panelWidth: 600,
		idField: "id",
		textField: "nama",
		editable: true,
		pagination: true,
		nowrap: false,
		loadMsg: "Please Wait..",
		mode: "remote",
		url: "retino/caripasien",
		columns: [
			[
				{
					field: "noregistrasi",
					title: "No Registrasi",
					width: 120
				},
				{
					field: "nama",
					title: "Nama Lengkap",
					width: 200,
					align: "left",
					formatter: function(value, row, index) {
						if (row.validate == "y") {
							return (
								"<img src='assets/themes/icons/correct.png' border='0'/ class=\"item-img\"></img>" +
								" " +
								row.nama +
								" "
							);
						} else {
							return (
								"<img src='assets/themes/icons/uncheck.png' border='0'/ class=\"item-img\"></img>" +
								" " +
								row.nama +
								" "
							);
						}
					}
				},
				{
					field: "subgrup",
					title: "Subgrup",
					width: 300,
					align: "left"
				},
				{
					field: "morfologi",
					title: "Morfologi",
					width: 150,
					align: "left"
				},
				{
					field: "topografi",
					title: "Topografi",
					width: 150,
					align: "left"
				},
				{
					field: "no_rekam",
					title: "No Rekam Medis",
					width: 200,
					align: "left"
				},
				{
					field: "jkelamin",
					title: "Jenis Kelamin",
					width: 120,
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
		onSelect: function(index, row) {
			entryretino(row);
		}
	});

	$("#dgretino").datagrid({
		//width: 'auto',
		height: "400",
		singleSelect: true,
		pagination: true,
		rownumbers: true,
		collapsible: false,
		fitColumns: false,
		nowrap: false,
		idField: "id",
		url: "retino/read",
		title: "Data Retinoblastoma",
		onDblClickRow: function() {
			edit();
		},
		frozenColumns: [
			[
				{
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
			[
				{
					field: "presentasiklinis",
					title: "Presentasi Klinis",
					width: 200,
					align: "left"
				},
				{
					field: "presentasi_klinis_lainnya",
					title: "Klinis Lainnya",
					width: 180,
					align: "left"
				},
				{
					field: "thn_keluhan",
					title: "Thn Keluhan",
					width: 100,
					align: "center"
				},
				{
					field: "bln_keluhan",
					title: "Bln Keluhan",
					width: 100,
					align: "center"
				},
				{
					field: "durasi_penyakit",
					title: "Durasi Penyakit",
					width: 100,
					align: "center"
				},
				{
					field: "m_kena",
					title: "Mata Yg Terkena",
					width: 100,
					align: "left"
				},
				{
					field: "k_up",
					title: "Keluhan Progresif",
					width: 120,
					align: "left"
				},
				{
					field: "penyerta",
					title: "Keluhan Penyerta",
					width: 160,
					align: "left"
				},
				{
					field: "keluhan_penyerta_lainnya",
					title: "Keluhan Lainnya",
					width: 160,
					align: "left"
				},
				{
					field: "prenatal",
					title: "Riwayat Prenatal",
					width: 160,
					align: "left"
				},
				{
					field: "rub",
					title: "Rubela",
					width: 100,
					align: "left"
				},
				{
					field: "bbl",
					title: "BB Lahir",
					width: 80,
					align: "left"
				},
				{
					field: "ugl",
					title: "Gestasi Lahir",
					width: 80,
					align: "left"
				},
				{
					field: "stat_neonatus",
					title: "Nenonatus",
					width: 80,
					align: "left"
				},
				{
					field: "stat_inkubator",
					title: "Inkubator",
					width: 80,
					align: "left"
				},
				{
					field: "t_inkubator",
					title: "Waktu Inkubator",
					width: 50,
					align: "left"
				},
				{
					field: "p_tanpabantuan",
					title: "Penglihatan Tanpa bantuan (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "p_kacamata",
					title: "Penglihatan Dg Kacamata(kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "stat_penglihatan",
					title: "Fungsi Penglihatan(kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "p_tanpabantuan2",
					title: "Penglihatan Tanpa bantuan(Kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "p_kacamata2",
					title: "Penglihatan Dg Kacamata(kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "stat_penglihatan2",
					title: "Fungsi Penglihatan(kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "data_klinis",
					title: "Pemeriksaan Klinis(kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "pemeriksaan_klinis_lainnya",
					title: "Lainnya(kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "stat_ubm",
					title: "U Bola Mata(kanan)",
					width: 100,
					align: "left"
				},
				{
					field: "data_slitlamp",
					title: "Slit Lamp(kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "pemeriksaan_slitlamp_lainnya",
					title: "Lainnya(kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "data_posterior",
					title: "Posterior(kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "data_klinis2",
					title: "Pemeriksaan Klinis(kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "pemeriksaan_klinis_lainnya2",
					title: "Lainnya(kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "stat_ubm2",
					title: "U Bola Mata(kiri)",
					width: 100,
					align: "left"
				},
				{
					field: "data_slitlamp",
					title: "Slit Lamp(kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "pemeriksaan_slitlamp_lainnya",
					title: "Lainnya(kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "data_posterior",
					title: "Posterior(kiri)",
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
		url: "retino/caripasien",
		title: "",
		onDblClickRow: function() {
			pilihPasien();
		},
		columns: [
			[
				{
					field: "noregistrasi",
					title: "No Registrasi",
					width: 120
				},
				{
					field: "nama",
					title: "Nama Lengkap",
					width: 250,
					align: "left",
					formatter: function(value, row, index) {
						if (row.validate == "y") {
							return (
								"<img src='assets/themes/icons/correct.png' border='0'/ class=\"item-img\"></img>" +
								" " +
								row.nama +
								" "
							);
						} else {
							return (
								"<img src='assets/themes/icons/uncheck.png' border='0'/ class=\"item-img\"></img>" +
								" " +
								row.nama +
								" "
							);
						}
					}
				},
				{
					field: "no_rekam",
					title: "No Rekam Medis",
					width: 150,
					align: "left"
				},
				{
					field: "jkelamin",
					title: "Jenis Kelamin",
					width: 120,
					align: "left"
				},
				{
					field: "alamat",
					title: "Alamat",
					width: 300,
					align: "left"
				}
			]
		]
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
		//url:'retino/getdata',
		title:
			"Data Manajemen Kuratif - untuk proses ubah, double klik pada data lalu klik tombol update",
		columns: [
			[
				{
					field: "statkemo",
					title: "Kemoterapi",
					width: 100,
					align: "left"
				},
				{
					field: "tgl_kemo",
					title: "Tgl kemo",
					width: 100,
					align: "left"
				},
				{
					field: "optjeniskemo",
					title: "Jenis Kemo",
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
					field: "optokular",
					title: "Okular",
					width: 200,
					align: "left"
				},
				{
					field: "xkanan",
					title: "Jml kanan",
					width: 80,
					align: "left"
				},
				{
					field: "xkiri",
					title: "Jml kiri",
					width: 80,
					align: "left"
				},
				{
					field: "statenukleasi_kanan",
					title: "Enukleasi Kanan",
					width: 100,
					align: "left"
				},
				{
					field: "stathasilhpe_kanan",
					title: "Hasil HPE Kanan",
					width: 200,
					align: "left"
				},
				{
					field: "dataekstraokular_kanan",
					title: "Ekstra Okular Kanan",
					width: 150,
					align: "left"
				},
				{
					field: "statfokal_kanan",
					title: "Fokal Kanan",
					width: 100,
					align: "center"
				},
				{
					field: "optfokalkanan",
					title: "Opsi Fokal Kanan",
					width: 150,
					align: "center"
				},
				{
					field: "statradioterapi_kanan",
					title: "Radioterapi kanan",
					width: 100,
					align: "left"
				},
				{
					field: "dataradioterapi_kanan",
					title: "Opsi Radioterapi Kanan",
					width: 150,
					align: "left"
				},
				{
					field: "statenukleasi_kanan",
					title: "Enukleasi kiri",
					width: 100,
					align: "left"
				},
				{
					field: "stathasilhpe_kiri",
					title: "Hasil HPE kiri",
					width: 200,
					align: "left"
				},
				{
					field: "dataekstraokular_kiri",
					title: "Ekstra Okular kiri",
					width: 150,
					align: "left"
				},
				{
					field: "statfokal_kiri",
					title: "Fokal Kiri",
					width: 100,
					align: "center"
				},
				{
					field: "optfokalkiri",
					title: "Opsi Fokal kiri",
					width: 150,
					align: "center"
				},
				{
					field: "statradioterapi_kiri",
					title: "Radioterapi kiri",
					width: 100,
					align: "left"
				},
				{
					field: "dataradioterapi_kiri",
					title: "Opsi Radioterapi kiri",
					width: 150,
					align: "left"
				},
				{
					field: "stattradisional",
					title: "Pengobatan Tradisional",
					width: 150,
					align: "left"
				},
				{
					field: "action",
					title: "Hapus",
					width: 80,
					align: "center",
					formatter: function(value, row, index) {
						return (
							'<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Kuratif" onClick="deletekuratif(\'' +
							row.id +
							"');\"><img src='assets/themes/icons/delete-icon24.png' border='0'/ class=\"item-img\"></img></a> "
						);
					}
				}
			]
		],
		onDblClickRow: function() {
			editkuratif();
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
		//url:'retino/getdata',
		title:
			"Data Luaran - untuk proses ubah, double klik pada data lalu klik tombol update",
		columns: [
			[
				{
					field: "ptb_kanan",
					title: "Penglihatan Tanpa Bantuan (kanan)",
					width: 200,
					align: "left"
				},
				{
					field: "ptb_kiri",
					title: "Penglihatan Tanpa Bantuan (kiri)",
					width: 200,
					align: "left"
				},
				{
					field: "pdk_kanan",
					title: "Penglihatan Dengan Bantuan (kanan)",
					width: 200,
					align: "left"
				},
				{
					field: "pdk_kiri",
					title: "Penglihatan Dengan Bantuan (kiri)",
					width: 200,
					align: "left"
				},
				{
					field: "stattampak_kanan",
					title: "Penglihatan Tampak (kanan)",
					width: 200,
					align: "left"
				},
				{
					field: "stattampak_kiri",
					title: "Penglihatan Tampak (kiri)",
					width: 200,
					align: "left"
				},
				{
					field: "statremisi_kanan",
					title: "Remisi (kanan)",
					width: 100,
					align: "left"
				},
				{
					field: "statremisi_kiri",
					title: "Remisi (kiri)",
					width: 100,
					align: "left"
				},
				{
					field: "dataregresi_kanan",
					title: "Tipe Regresi (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "dataregresi_kiri",
					title: "Tipe Regresi (kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "statrekurensi_kanan",
					title: "Rekurensi (kanan)",
					width: 100,
					align: "left"
				},
				{
					field: "statrekurensi_kiri",
					title: "Rekurensi (kiri)",
					width: 100,
					align: "left"
				},
				{
					field: "durasi_kanan",
					title: "Durasi (kanan)",
					width: 100,
					align: "left"
				},
				{
					field: "durasi_kiri",
					title: "Durasi (kiri)",
					width: 100,
					align: "left"
				},
				{
					field: "statkomplikasi_kanan",
					title: "Komplikasi (kanan)",
					width: 100,
					align: "left"
				},
				{
					field: "statkomplikasi_kiri",
					title: "Komplikasi (kiri)",
					width: 100,
					align: "left"
				},
				{
					field: "datakomplikasi_kanan",
					title: "Opsi Komplikasi (kanan)",
					width: 200,
					align: "left"
				},
				{
					field: "datakomplikasi_kiri",
					title: "Opsi Komplikasi (kiri)",
					width: 200,
					align: "left"
				},
				{
					field: "ket_socket_kanan",
					title: "Ket Socket (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "ket_socket_kiri",
					title: "Ket Socket (kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "ket_kemoterapi_kanan",
					title: "Ket kemoterapi (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "ket_kemoterapi_kiri",
					title: "Ket kemoterapi (kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "ket_penyakit_kanan",
					title: "Ket penyakit (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "ket_penyakit_kiri",
					title: "Ket penyakit (kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "ket_radiasi_kanan",
					title: "Ket radiasi (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "ket_radiasi_kiri",
					title: "Ket radiasi (kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "Aksi",
					title: "Hapus",
					width: 80,
					align: "center",
					formatter: function(value, row, index) {
						return (
							'<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Luaran" onClick="deleteluaran(\'' +
							row.id +
							"');\"><img src='assets/themes/icons/delete-icon24.png' border='0'/ class=\"item-img\"></img></a> "
						);
					}
				}
			]
		],
		onDblClickRow: function() {
			editluaran();
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
		//url:'retino/getdata',
		title:
			"Data Follow Up - untuk proses ubah, double klik pada data lalu klik tombol update",
		columns: [
			[
				{
					field: "tgl_abstraksi",
					title: "Tgl Abstraksi",
					width: 150,
					align: "center"
				},
				{
					field: "evaluasi_klinis_kanan",
					title: "Evaluasi Klinis (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "evaluasi_klinis_kanan",
					title: "Evaluasi Klinis (kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "pemeriksaan_slitlamp_kanan",
					title: "Slitlamp (kanan)",
					width: 150,
					align: "left"
				},
				{
					field: "pemeriksaan_slitlamp_kiri",
					title: "Slitlamp (kiri)",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_ctscan",
					title: "Tgl CT-Scan",
					width: 150,
					align: "left"
				},
				{
					field: "kesan_ctscan",
					title: "Kesan CT-Scan",
					width: 150,
					align: "left"
				},
				{
					field: "tgl_mri",
					title: "Tgl MRI",
					width: 150,
					align: "left"
				},
				{
					field: "kesan_mri",
					title: "Kesan MRI",
					width: 150,
					align: "left"
				},
				{
					field: "action",
					title: "Aksi",
					width: 80,
					align: "center",
					formatter: function(value, row, index) {
						return (
							'<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deletefollowup(\'' +
							row.id +
							"');\"><img src='assets/themes/icons/delete-icon24.png' border='0'/ class=\"item-img\"></img></a> "
						);
					}
				}
			]
		],
		onDblClickRow: function() {
			editfollowup();
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
			url: "retino/dataoptions?type=darah",
			columns: [
				[
					{
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

	$("#dgjenis")
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
			url: "retino/dataoptions?type=jenis darah",
			columns: [
				[
					{
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

	$("#dgdarahfollowup")
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
			//url:'retino/dataoptions?type=darah',
			columns: [
				[
					{
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
			[
				{
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

	$("#ctscankanan1").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan1",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya2(row[opts.textField], true, "tr_ctscankanan2", "ctscankanan2");
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya2(row[opts.textField], false, "tr_ctscankanan2", "ctscankanan2");
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#ctscankanan2").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan2",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#ctscankiri1").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan1",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya2(row[opts.textField], true, "tr_ctscankiri2", "ctscankiri2");
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya2(row[opts.textField], false, "tr_ctscankiri2", "ctscankiri2");
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#ctscankiri2").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan2",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#mrikanan1").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan1",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya2(row[opts.textField], true, "tr_mrikanan2", "mrikanan2");
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya2(row[opts.textField], false, "tr_mrikanan2", "mrikanan2");
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#mrikanan2").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan2",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#mrikiri1").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan1",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya2(row[opts.textField], true, "tr_mrikiri2", "mrikiri2");
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya2(row[opts.textField], false, "tr_mrikiri2", "mrikiri2");
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#mrikiri2").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ctscan2",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#keluhan_utama").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function(row) {
			showother(row.nama_options);
		}
		//url:'retino/keluhanutama',
	});

	$("#sindrom_penyerta_lainnya").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false
		//url:'retino/penyertalaiinya',
	});

	$("#nonkuratif").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function(row) {
			showtrnonkuratif(row.nama_options);
		}
		//url:'retino/penyertalaiinya',
	});

	$("#lokasi_radioterapi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function(row) {
			showtrradioterapi(row.nama_options);
		}
		//url:'retino/penyertalaiinya',
	});

	$("#jenis_operasi").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		editable: false,
		onSelect: function(row) {
			showtroperasi(row.nama_options);
		}
		//url:'retino/penyertalaiinya',
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
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showoptpaliatif(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showoptpaliatif(row[opts.textField], false);
			//console.log(row)
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
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
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showtrtrpain(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showtrtrpain(row[opts.textField], false);
			//console.log(row)
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#search").keyup(function() {
		doSearchretino();
	});

	$("#diagnosisid").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "dasardiagnosis",
		fitColumns: true,
		editable: false,
		url: "retino/diagnosis"
	});

	$("#metastatik").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=metastatik",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya3(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya3(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
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
		url: "retino/tatalaksana",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			//console.log(row)
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#keluhan_penyerta").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showother2(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showother2(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#riwayat_prenatal").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showother2(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showother2(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#pem_posterior_kiri").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			ceklesi2(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			ceklesi2(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#pem_posterior").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			ceklesi(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			ceklesi(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#pemeriksaan_slitlamp").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya(
				row[opts.textField],
				true,
				"slitlamp_lainnya",
				"pemeriksaan_slitlamp_lainnya"
			);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya(
				row[opts.textField],
				false,
				"slitlamp_lainnya",
				"pemeriksaan_slitlamp_lainnya"
			);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#pemeriksaan_slitlamp2").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya(
				row[opts.textField],
				true,
				"slitlamp_lainnya2",
				"pemeriksaan_slitlamp_lainnya2"
			);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya(
				row[opts.textField],
				false,
				"slitlamp_lainnya2",
				"pemeriksaan_slitlamp_lainnya2"
			);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#pemeriksaan_klinis").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya(
				row[opts.textField],
				true,
				"pemklinis_lainnya",
				"pemeriksaan_klinis_lainnya"
			);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya(
				row[opts.textField],
				false,
				"pemklinis_lainnya",
				"pemeriksaan_klinis_lainnya"
			);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#pemeriksaan_klinis2").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			lainnya(
				row[opts.textField],
				true,
				"pemklinis_lainnya2",
				"pemeriksaan_klinis_lainnya2"
			);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			lainnya(
				row[opts.textField],
				false,
				"pemklinis_lainnya2",
				"pemeriksaan_klinis_lainnya2"
			);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#presentasi_klinis").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showother(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showother(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
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
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showother3(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showother3(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
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
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showtrinfeksi(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showtrinfeksi(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
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
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
			showtrnon_infeksi(row[opts.textField], true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			showtrnon_infeksi(row[opts.textField], false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
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
		url: "retino/tatalaksana",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
			//console.log(row)
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
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
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#jenis_kemo").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#opt_okular").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#ekstraokular_kanan").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ekstraokular",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#ekstraokular_kiri").combobox({
		panelWidth: 250,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=ekstraokular",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#opt_fokal_kanan").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#opt_fokal_kiri").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		//url:'retino/pemeriksaanfisik',
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#opt_radioterapi_kanan").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=optradioterapi",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#opt_radioterapi_kiri").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=optradioterapi",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#tipe_regresi_kanan").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=regresi",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#tipe_regresi_kiri").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=regresi",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});

	$("#opt_komplikasi_kanan").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=komplikasi",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
	});
	$("#opt_komplikasi_kiri").combobox({
		panelWidth: 200,
		panelHeight: "auto",
		valueField: "id",
		loadMsg: "Please Wait..",
		textField: "nama_options",
		fitColumns: true,
		multiple: true,
		multiline: true,
		editable: false,
		url: "retino/dataoptions?type=komplikasi",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
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
		url: "retino/dataoptions?type=optradioterapi",
		formatter: function(row) {
			var opts = $(this).combobox("options");
			return (
				'<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' +
				row[opts.textField]
			);
		},
		onSelect: function(row) {
			//console.log(row)
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", true);
		},
		onUnselect: function(row) {
			var opts = $(this).combobox("options");
			var el = opts.finder.getEl(this, row[opts.valueField]);
			el.find("input.combobox-checkbox")._propAttr("checked", false);
		},
		onLoadSuccess: function() {
			var opts = $(this).combobox("options");
			var target = this;
			var values = $(target).combobox("getValues");
			$.map(values, function(value) {
				var el = opts.finder.getEl(target, value);
				el.find("input.combobox-checkbox")._propAttr("checked", true);
			});
		}
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
		//url:'retino/penyertalaiinya',
	});
});

function hidedefault() {
	$("#dgpenyerta").datagrid("loadData", {
		total: 0,
		rows: []
	});

	document.getElementById("lainnya_utama").style.display = "none";
	$("#keluhan_utama_lainnya").textbox("clear");
	document.getElementById("penyerta_lainnya").style.display = "none";
	$("#keluhan_penyerta_lainnya").textbox("clear");

	$("#besar_schuffner").textbox("clear");

	//document.getElementById("trinfeksi").style.display = "none";
	$("#infeksi_lainnya").textbox("clear");
	//document.getElementById("trnon_infeksi").style.display = "none";
	$("#non_infeksi_lainnya").textbox("clear");
	//document.getElementById("trpain").style.display = "none";
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

function lainnya(isi, cek, tr, input) {
	if (isi == "Lainnya" && cek == true) {
		document.getElementById(tr).style.display = "";
		$("#" + input)
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById(tr).style.display = "none";
		$("#" + input)
			.textbox("textbox")
			.focus();
		$("#" + input).textbox("clear");
	}
}

function lainnya2(isi, cek, tr, input) {
	if (isi == "Ekstensi ekstraokular" && cek == true) {
		document.getElementById(tr).style.display = "";
	} else if (isi == "Ekstensi ekstraokular" && cek == false) {
		document.getElementById(tr).style.display = "none";
		$("#" + input).combobox("clear");
	}
}

function lainnya3(isi, cek) {
	if (isi == "Aspirasi sumsum tulang" && cek == true) {
		document.getElementById("tr_hasil1").style.display = "";
	} else if (isi == "Aspirasi sumsum tulang" && cek == false) {
		document.getElementById("tr_hasil1").style.display = "none";
		$("#hasil_aspirasi").textbox("clear");
	}

	if (isi == "Analisis CSS" && cek == true) {
		document.getElementById("tr_hasil2").style.display = "";
	} else if (isi == "Aspirasi sumsum tulang" && cek == false) {
		document.getElementById("tr_hasil2").style.display = "none";
		$("#hasil_css").textbox("clear");
	}

	if (isi == "Lainnya" && cek == true) {
		document.getElementById("tr_hasil3").style.display = "";
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("tr_hasil3").style.display = "none";
		$("#hasil_lainnya").textbox("clear");
	}
}

function ceklesi(isi, cek) {
	if (isi == "Massa lesi" && cek == true) {
		document.getElementById("des_lesi").style.display = "";
	} else if (isi == "Massa lesi" && cek == false) {
		document.getElementById("des_lesi").style.display = "none";
		$("input[name=lesi]").prop("checked", false);
	}
}

function ceklesi2(isi, cek) {
	if (isi == "Massa lesi" && cek == true) {
		document.getElementById("des_lesi_kiri").style.display = "";
	} else if (isi == "Massa lesi" && cek == false) {
		document.getElementById("des_lesi_kiri").style.display = "none";
		$("input[name=lesi_kiri]").prop("checked", false);
	}
}

function showother(isi, cek) {
	if (isi == "Lainnya" && cek == true) {
		document.getElementById("klinis_lainnya").style.display = "";
		$("#presentasi_klinis_lainnya")
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("klinis_lainnya").style.display = "none";
		$("#presentasi_klinis_lainnya")
			.textbox("textbox")
			.focus();
		$("#presentasi_klinis_lainnya").textbox("clear");
	}
}

function showother2(isi, cek) {
	if (isi == "Lainnya" && cek == true) {
		document.getElementById("penyerta_lainnya").style.display = "";
		$("#keluhan_penyerta_lainnya")
			.textbox("textbox")
			.focus();
	} else if (isi == "Lainnya" && cek == false) {
		document.getElementById("penyerta_lainnya").style.display = "none";
		$("#keluhan_penyerta_lainnya")
			.textbox("textbox")
			.focus();
		$("#keluhan_penyerta_lainnya").textbox("clear");
	}
}

function showother3(isi, cek) {
	if (isi == "Limfadenopati" && cek == true) {
		document.getElementById("trlimpa").style.display = "";
		$("#nama_limfadenopati")
			.textbox("textbox")
			.focus();
	} else if (isi == "Limfadenopati" && cek == false) {
		document.getElementById("trlimpa").style.display = "none";
		$("#nama_limfadenopati").textbox("clear");
	}

	if (isi == "Hepatomegali" && cek == true) {
		document.getElementById("trhepar").style.display = "";
		$("#besar_hepar")
			.textbox("textbox")
			.focus();
	} else if (isi == "Hepatomegali" && cek == false) {
		document.getElementById("trhepar").style.display = "none";
		$("#besar_hepar").textbox("clear");
	}

	if (isi == "Splenomegali" && cek == true) {
		document.getElementById("trspleen").style.display = "";
		$("#besar_spleen")
			.textbox("textbox")
			.focus();
	} else if (isi == "Splenomegali" && cek == false) {
		document.getElementById("trspleen").style.display = "none";
		$("#besar_spleen").textbox("clear");
		$("#besar_schuffner").textbox("clear");
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
		document.getElementById("troperasilainnya").style.display = "";
		$("#jenisoperasi_lainnya")
			.textbox("textbox")
			.focus();
	} else {
		document.getElementById("troperasilainnya").style.display = "none";
		$("#jenisoperasi_lainnya").textbox("clear");
	}
}

function showhepatomegali(isi, cek) {
	if (isi == "Hepatomegali" && cek == true) {
		document.getElementById("trhepar").style.display = "";
		$("#besar_hepar")
			.textbox("textbox")
			.focus();
	} else if (isi == "Hepatomegali" && cek == false) {
		document.getElementById("trhepar").style.display = "none";
		$("#besar_hepar").textbox("clear");
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

	if (isi == "Operasi" && cek == true) {
		document.getElementById("troperasi").style.display = "";
	} else if (isi == "Operasi" && cek == false) {
		document.getElementById("troperasi").style.display = "none";
		$("#jenis_operasi").combobox("clear");
		document.getElementById("troperasilainnya").style.display = "none";
		$("#jenisoperasi_lainnya").textbox("clear");
	}
}

function showctscan(isi) {
	if (isi == "y") {
		document.getElementById("tr_ctscan1").style.display = "";
	} else {
		document.getElementById("tr_ctscan1").style.display = "none";
		$("#ctscan1").combobox("clear");
	}
}

function showcombo(v, tr, input) {
	if (v == "y") {
		document.getElementById(tr).style.display = "";
	} else {
		document.getElementById(tr).style.display = "none";
		$("#" + input).combobox("clear");
	}
}

function showrdbutton(v, tr, input) {
	if (v == "y") {
		document.getElementById(tr).style.display = "";
	} else {
		document.getElementById(tr).style.display = "none";
		document.querySelector('input[name="rdgenetik"]:checked').checked = false;
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

function showstatus2(v) {
	if (v == 1) {
		document.getElementById("statushidup").style.display = "";
		document.getElementById("sebabkematian").style.display = "none";

		$("#date_loss").datebox("clear");
		$("#date_loss").datebox("readonly");
		$("#date_meninggal").datebox("clear");
		$("#date_meninggal").datebox("readonly");
	} else if (v == 2) {
		document.getElementById("statushidup").style.display = "none";
		document.getElementById("sebabkematian").style.display = "none";

		$("#date_loss").datebox("readonly", false);
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
	} else if (v == 3) {
		document.getElementById("statushidup").style.display = "none";
		document.getElementById("sebabkematian").style.display = "";

		$("#date_loss").datebox("readonly");
		$("#date_loss").datebox("clear");
		$("#date_meninggal").datebox("readonly", false);

		$("#date_complete").datebox("clear");
		$("#date_complete").datebox("readonly");
		$("#date_stable").datebox("clear");
		$("#date_stable").datebox("readonly");
		$("#date_relaps").datebox("clear");
		$("#date_relaps").datebox("readonly");
		$("#date_progresif").datebox("clear");
		$("#date_progresif").datebox("readonly");
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
	$("#dgretino").datagrid("reload", {
		validate: v
	});
}

function clearSearch() {
	$("#search").searchbox("clear");

	$("#dgretino").datagrid("reload", {
		search: ""
	});
}

function doSearch(value) {
	var value = $("#search").val();
	$("#dgretino").datagrid("reload", {
		search: value
	});
}

function doSearchPasien(value) {
	var value = $("#search-pasien").val();
	$("#datapasien").datagrid("reload", {
		search: value
	});
}

function no_retino() {
	//  var noretino ='';
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
		"retino/no_retino",
		{
			get_param: "value"
		},
		function(data) {
			document.getElementById("nourut").value = data.nourut;
		}
	);

	noretino = nounit + j + no;
	//$('#dlg').dialog({title : nounit});
	document.getElementById("noretino").value = noretino;
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
	document.getElementById("penyerta_lainnya").style.display = "none";
	$("#keluhan_penyerta_lainnya").textbox("clear");
}

function entryretino2() {
	$("#dlg")
		.dialog("open")
		.dialog("setTitle", "Entry Retinoblastoma ");
	$("#fm").form("clear");
}

function pilihPasien() {
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

function caripasien() {
	$("#dlg-pasien")
		.dialog("open")
		.dialog("setTitle", "cari dan pilih pasien retinoblastoma");
	$("#datapasien").datagrid("reload");
}

function addretino() {
	$("#btncari").linkbutton("enable");
	$("#dlg")
		.dialog("open")
		.dialog("setTitle", "Tambah Retinoblastoma");
	document.getElementById("label_namalengkap").innerHTML = "";
	document.getElementById("label_nik").innerHTML = "";
	document.getElementById("label_ttl").innerHTML = "";
	document.getElementById("label_noregistrasi").innerHTML = "";
	document.getElementById("label_norekam").innerHTML = "";
	document.getElementById("label_nohp").innerHTML = "";
	document.getElementById("label_jkelamin").innerHTML = "";
	$("#fm").form("clear");
	document.getElementById("ku").checked = true;
	document.getElementById("pu").checked = true;

	//hidedefault();

	with (new Date()) {
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

	var urlklinis = "retino/dataoptions?type=pklinis";
	$("#presentasi_klinis").combobox("reload", urlklinis);
	var urlprenatal = "retino/dataoptions?type=prenatal";
	$("#riwayat_prenatal").combobox("reload", urlprenatal);
	// var urlkeluhan = "retino/dataoptions?type=keluhan utama";
	// $("#keluhan_utama").combobox("reload", urlkeluhan);
	var urlpenyerta = "retino/dataoptions?type=keluhan penyerta";
	$("#keluhan_penyerta").combobox("reload", urlpenyerta);
	var urlpenyertalainnya = "retino/dataoptions?type=penyerta lainnya";
	$("#sindrom_penyerta_lainnya").combobox("reload", urlpenyertalainnya);
	var urlfisik = "retino/dataoptions?type=Pemeriksaan Fisik";
	$("#pemeriksaan_fisik").combobox("reload", urlfisik);

	var urlpemklinis = "retino/dataoptions?type=pemklinis";
	$("#pemeriksaan_klinis").combobox("reload", urlpemklinis);
	$("#pemeriksaan_klinis2").combobox("reload", urlpemklinis);

	var urlslitlamp = "retino/dataoptions?type=slitlamp";
	$("#pemeriksaan_slitlamp").combobox("reload", urlslitlamp);
	$("#pemeriksaan_slitlamp2").combobox("reload", urlslitlamp);

	var urlposterior = "retino/dataoptions?type=posterior";
	$("#pem_posterior").combobox("reload", urlposterior);
	$("#pem_posterior_kiri").combobox("reload", urlposterior);

	var urlinfeksi = "retino/dataoptions?type=infeksi";
	$("#infeksi").combobox("reload", urlinfeksi);
	var urlnon_infeksi = "retino/dataoptions?type=non infeksi";
	$("#non_infeksi").combobox("reload", urlnon_infeksi);
	var urlnonkuratif = "retino/dataoptions?type=non kuratif";
	$("#nonkuratif").combobox("reload", urlnonkuratif);
	var urlpaliatif = "retino/dataoptions?type=paliatif";
	$("#optpaliatif").combobox("reload", urlpaliatif);
	var urlpain = "retino/dataoptions?type=pain";
	$("#optpain").combobox("reload", urlpain);
	var urlradioterapi = "retino/dataoptions?type=lokasi radioterapi";
	$("#lokasi_radioterapi").combobox("reload", urlradioterapi);
	var urljenisoperasi = "retino/dataoptions?type=jenis operasi";
	$("#jenis_operasi").combobox("reload", urljenisoperasi);

	$("#btnlink").linkbutton({
		text: "Simpan"
	});
	url = "retino/save";
}

function confirm1() {
	var idreg = document.getElementById("registrasiid").value;
	if (idreg != "") {
		$.messager.confirm("Confirm", "Yakin Simpan?", function(r) {
			if (r) {
				save();
			}
		});
	} else {
		$.messager.alert("warning", "pilih pasien terlebih dahulu", "warning");
	}
}

function save() {
	var present = $("#presentasi_klinis").combobox("getValues"),
		penyerta = $("#keluhan_penyerta").combobox("getValues"),
		prenatal = $("#riwayat_prenatal").combobox("getValues"),
		pklinis = $("#pemeriksaan_klinis").combobox("getValues"),
		slitlamp = $("#pemeriksaan_slitlamp").combobox("getValues"),
		posterior = $("#pem_posterior").combobox("getValues"),
		pklinis2 = $("#pemeriksaan_klinis2").combobox("getValues"),
		slitlamp2 = $("#pemeriksaan_slitlamp2").combobox("getValues"),
		posterior2 = $("#pem_posterior_kiri").combobox("getValues"),
		ctscan1 = $("#ctscankanan1").combobox("getValues"),
		ctscan2 = $("#ctscankanan2").combobox("getValues"),
		mri1 = $("#mrikanan1").combobox("getValues"),
		mri2 = $("#mrikanan2").combobox("getValues"),
		mrikiri1 = $("#mrikiri1").combobox("getValues"),
		mrikiri2 = $("#mrikiri2").combobox("getValues"),
		paliatif = $("#optpaliatif").combobox("getValues"),
		pain = $("#optpain").combobox("getValues"),
		metastatik = $("#metastatik").combobox("getValues");

	progress(); // show the message box
	$("#fm").form("submit", {
		url:
			url +
			"?present=" +
			present +
			"&penyerta=" +
			penyerta +
			"&prenatal=" +
			prenatal +
			"&pklinis=" +
			pklinis +
			"&slitlamp=" +
			slitlamp +
			"&posterior=" +
			posterior +
			"&pklinis2=" +
			pklinis2 +
			"&slitlamp2=" +
			slitlamp2 +
			"&posterior2=" +
			posterior2 +
			"&ctscankanan1=" +
			ctscan1 +
			"&ctscankanan2=" +
			ctscan2 +
			"&mrikanan1=" +
			mri1 +
			"&mrikanan2=" +
			mri2 +
			"&mrikiri1=" +
			mrikiri1 +
			"&mrikiri2=" +
			mrikiri2 +
			"&paliatif=" +
			paliatif +
			"&pain=" +
			pain +
			"&metastatik=" +
			metastatik,

		onSubmit: function() {
			//return $(this).form('validate');
			var v = $(this).form("validate");
			if (!v) $.messager.progress("close"); // close the message box
			return v;
		},
		success: function(result) {
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
				$("#datapasien").datagrid("reload");
				$("#dlg").dialog("close"); // close the dialog
				$("#dgretino").datagrid("reload"); // reload the user data
			}
		}
	});
}

function edit() {
	$("#btncari").linkbutton("disable");
	//var ui = document.getElementById("uid").value;
	var row = $("#dgretino").datagrid("getSelected");
	//alert(ui);
	if (row) {
		$("#dlg")
			.dialog("open")
			.dialog("setTitle", "Edit Register retino");
		$("#fm").form("load", row);

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

		var urlklinis = "retino/dataoptions?type=pklinis";
		$("#presentasi_klinis").combobox("reload", urlklinis);
		var urlprenatal = "retino/dataoptions?type=prenatal";
		$("#riwayat_prenatal").combobox("reload", urlprenatal);
		// var urlkeluhan = "retino/dataoptions?type=keluhan utama";
		// $("#keluhan_utama").combobox("reload", urlkeluhan);
		var urlpenyerta = "retino/dataoptions?type=keluhan penyerta";
		$("#keluhan_penyerta").combobox("reload", urlpenyerta);
		var urlpenyertalainnya = "retino/dataoptions?type=penyerta lainnya";
		$("#sindrom_penyerta_lainnya").combobox("reload", urlpenyertalainnya);
		var urlfisik = "retino/dataoptions?type=Pemeriksaan Fisik";
		$("#pemeriksaan_fisik").combobox("reload", urlfisik);

		var urlpemklinis = "retino/dataoptions?type=pemklinis";
		$("#pemeriksaan_klinis").combobox("reload", urlpemklinis);
		$("#pemeriksaan_klinis2").combobox("reload", urlpemklinis);

		var urlslitlamp = "retino/dataoptions?type=slitlamp";
		$("#pemeriksaan_slitlamp").combobox("reload", urlslitlamp);
		$("#pemeriksaan_slitlamp2").combobox("reload", urlslitlamp);

		var urlposterior = "retino/dataoptions?type=posterior";
		$("#pem_posterior").combobox("reload", urlposterior);
		$("#pem_posterior_kiri").combobox("reload", urlposterior);

		var urlinfeksi = "retino/dataoptions?type=infeksi";
		$("#infeksi").combobox("reload", urlinfeksi);
		var urlnon_infeksi = "retino/dataoptions?type=non infeksi";
		$("#non_infeksi").combobox("reload", urlnon_infeksi);
		var urlnonkuratif = "retino/dataoptions?type=non kuratif";
		$("#nonkuratif").combobox("reload", urlnonkuratif);
		var urlpaliatif = "retino/dataoptions?type=paliatif";
		$("#optpaliatif").combobox("reload", urlpaliatif);
		var urlpain = "retino/dataoptions?type=pain";
		$("#optpain").combobox("reload", urlpain);
		var urlradioterapi = "retino/dataoptions?type=lokasi radioterapi";
		$("#lokasi_radioterapi").combobox("reload", urlradioterapi);
		var urljenisoperasi = "retino/dataoptions?type=jenis operasi";
		$("#jenis_operasi").combobox("reload", urljenisoperasi);

		$("#btnlink").linkbutton({
			text: "Update"
		});
		url = "retino/update/" + row.id;
	} else {
		$.messager.alert("Warning", "Pilih data yang mau diedit", "warning");
	}
}

function remove() {
	var row = $("#dgretino").datagrid("getSelected");
	if (row) {
		$.messager.confirm(
			"Konfirmasi",
			'Apakah anda yakin akan menghapus data retino "' + row.nama + '" ?',
			function(r) {
				if (r) {
					$.post(
						"retino/delete",
						{
							id: row.id,
							regid: row.registrasiid
						},
						function(result) {
							if (result.success) {
								$.messager.alert(
									"info",
									'Data retino"' + row.nama + '" telah di hapus !',
									"info"
								);
								$("#dgretino").datagrid("reload");
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
	var row = $("#dgretino").datagrid("getSelected");
	if (row) {
		$("#dlg-luaran")
			.dialog("open")
			.dialog("setTitle", "Update Data Luaran");
		$("#fm-luaran").form("clear");
		$("#dgluaran").datagrid("reload", "retino/readluaran?retinoid=" + row.id);
		document.getElementById("labelnoreg").innerHTML = row.noretino;
		document.getElementById("labelnama").innerHTML = row.nama;
		document.getElementById("retinoid").value = row.id;
		with (new Date()) {
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
		url = "retino/saveluaran";
	} else {
		$.messager.alert("Warning", "Pilih data terlebih dahulu", "warning");
	}
}

function saveluaran() {
	var optregresikanan = $("#tipe_regresi_kanan").combobox("getValues"),
		optregresikiri = $("#tipe_regresi_kiri").combobox("getValues"),
		optkomplikasikanan = $("#opt_komplikasi_kanan").combobox("getValues"),
		optkomplikasikiri = $("#opt_komplikasi_kiri").combobox("getValues");

	progress(); // show the message box
	$("#fm-luaran").form("submit", {
		url:
			url +
			"?optregresikanan=" +
			optregresikanan +
			"&optregresikiri=" +
			optregresikiri +
			"&optkomplikasikanan=" +
			optkomplikasikanan +
			"&optkomplikasikiri=" +
			optkomplikasikiri,

		onSubmit: function() {
			//return $(this).form('validate');
			var v = $(this).form("validate");
			if (!v) $.messager.progress("close"); // close the message box
			return v;
		},
		success: function(result) {
			var result = eval("(" + result + ")");
			if (result.errorMsg) {
				//$.messager.progress('close');
				$.messager.show({
					title: "Error",
					msg: result.errorMsg
				});
			} else {
				$.messager.progress("close");
				$.messager.alert("Info", "Data Luaran Sukses Disimpan", "");
				$("#fm-luaran").form("clear");
				with (new Date()) {
					$("#tgl_kemo").datebox(
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
				url = "retino/saveluaran";
				//$('#dlg-luaran').dialog('close');        // close the dialog
				$("#dgluaran").datagrid("reload"); // reload the user data
			}
		}
	});
}

function editluaran() {
	var row = $("#dgluaran").datagrid("getSelected");
	if (row) {
		$("#fm-luaran").form("load", row);
		//document.getElementById("retinoid3").value = retinoid;
		url = "retino/updateluaran/" + row.id;
		$("#btnlinkluaran").linkbutton({
			text: "Update"
		});
	} else {
		$.messager.alert("Warning", "Pilih data terlebih dahulu", "warning");
	}
}

function deletefollowup(id) {
	if (id) {
		$.messager.confirm(
			"Konfirmasi",
			"yakin akan menghapus data ini ?",
			function(r) {
				if (r) {
					$.post(
						"retino/deletefollowup",
						{
							id: id
						},
						function(result) {
							if (result.success) {
								$.messager.alert("info", "Data telah di hapus !", "info");
								$("#dgfollowup").datagrid("reload");
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

function deletekuratif(id) {
	if (id) {
		$.messager.confirm(
			"Konfirmasi",
			"yakin akan menghapus data kuratif ini ?",
			function(r) {
				if (r) {
					$.post(
						"retino/deletekuratif",
						{
							id: id
						},
						function(result) {
							if (result.success) {
								$.messager.alert("info", "Data telah di hapus !", "info");
								$("#dgkuratif").datagrid("reload");
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

function deleteluaran(id) {
	if (id) {
		$.messager.confirm(
			"Konfirmasi",
			"yakin akan menghapus data ini ?",
			function(r) {
				if (r) {
					$.post(
						"retino/deleteluaran",
						{
							id: id
						},
						function(result) {
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
		url = "retino/updatekuratif/" + row.id;
		$("#btnlinkkuratif").linkbutton({
			text: "Update"
		});
	} else {
		$.messager.alert("Warning", "Pilih data yang mau diedit", "warning");
	}
}

function manajemenkuratif() {
	var row = $("#dgretino").datagrid("getSelected");
	if (row) {
		$("#dlg-kuratif")
			.dialog("open")
			.dialog("setTitle", "Manajemen Kuratif");
		$("#fm-kuratif").form("clear");
		document.getElementById("retinoid").value = row.id;
		document.getElementById("label_noregistrasi2").innerHTML = row.noregistrasi;
		document.getElementById("label_namalengkap2").innerHTML = row.nama;
		if (row.jenis_kelamin == "l") {
			document.getElementById("label_jkelamin2").innerHTML = "Laki-laki";
		} else if (row.jenis_kelamin == "p") {
			document.getElementById("label_jkelamin2").innerHTML = "Perempuan";
		}
		document.getElementById("label_nohp2").innerHTML = row.no_hp;
		with (new Date()) {
			$("#tgl_kemo").datebox(
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

		var urldgkuratif = "retino/readkuratif?id=" + row.id;
		$("#dgkuratif").datagrid("reload", urldgkuratif);

		$("#btnlinkkuratif").linkbutton({
			text: "Simpan"
		});
		url = "retino/savekuratif";
	} else {
		$.messager.alert("warning", "pilih data terlebih dahulu", "warning");
	}
}

function luaran() {
	var row = $("#dgretino").datagrid("getSelected");
	if (row) {
		$("#dlg-luaran")
			.dialog("open")
			.dialog("setTitle", "Luaran & Komplikasi");
		$("#fm-luaran").form("clear");
		document.getElementById("retinoid3").value = row.id;
		document.getElementById("label_noregistrasi3").innerHTML = row.noregistrasi;
		document.getElementById("label_namalengkap3").innerHTML = row.nama;
		if (row.jenis_kelamin == "l") {
			document.getElementById("label_jkelamin3").innerHTML = "Laki-laki";
		} else if (row.jenis_kelamin == "p") {
			document.getElementById("label_jkelamin3").innerHTML = "Perempuan";
		}
		document.getElementById("label_nohp3").innerHTML = row.no_hp;

		var urldgluaran = "retino/readluaran?id=" + row.id;
		$("#dgluaran").datagrid("reload", urldgluaran);

		$("#btnlinkluaran").linkbutton({
			text: "Simpan"
		});
		url = "retino/saveluaran";
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
	var row = $("#dgretino").datagrid("getSelected");
	document.getElementById("register_retinoid").value = row.id;
}

function savekuratif() {
	var optjenis = $("#jenis_kemo").combobox("getValues"),
		optokular = $("#opt_okular").combobox("getValues"),
		optekstraokularkanan = $("#ekstraokular_kanan").combobox("getValues"),
		optfokalkanan = $("#opt_fokal_kanan").combobox("getValues"),
		optradioterapikanan = $("#opt_radioterapi_kanan").combobox("getValues"),
		optekstraokularkiri = $("#ekstraokular_kiri").combobox("getValues"),
		optfokalkiri = $("#opt_fokal_kiri").combobox("getValues"),
		optradioterapikiri = $("#opt_radioterapi_kiri").combobox("getValues");

	progress(); // show the message box
	$("#fm-kuratif").form("submit", {
		url:
			url +
			"?optjenis=" +
			optjenis +
			"&optokular=" +
			optokular +
			"&optekstraokularkanan=" +
			optekstraokularkanan +
			"&optfokalkanan=" +
			optfokalkanan +
			"&optradioterapikanan=" +
			optradioterapikanan +
			"&optekstraokularkiri=" +
			optekstraokularkiri +
			"&optfokalkiri=" +
			optfokalkiri +
			"&optradioterapikiri=" +
			optradioterapikiri,

		onSubmit: function() {
			//return $(this).form('validate');
			var v = $(this).form("validate");
			if (!v) $.messager.progress("close"); // close the message box
			return v;
		},
		success: function(result) {
			var result = eval("(" + result + ")");
			if (result.errorMsg) {
				//$.messager.progress('close');
				$.messager.show({
					title: "Error",
					msg: result.errorMsg
				});
			} else {
				$.messager.progress("close");
				$.messager.alert("Info", "Data Kuratif Sukses Disimpan", "");
				$("#fm-kuratif").form("clear");
				with (new Date()) {
					$("#tgl_kemo").datebox(
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

				$("#btnlinkkuratif").linkbutton({
					text: "Simpan"
				});
				url = "retino/savekuratif";
				//$('#dlg-kuratif').dialog('close');        // close the dialog
				$("#dgkuratif").datagrid("reload"); // reload the user data
			}
		}
	});
}

function followup() {
	var row = $("#dgretino").datagrid("getSelected");
	if (row) {
		$("#dlg-followup")
			.dialog("open")
			.dialog("setTitle", "FOLLOW UP");
		$("#fm-followup").form("clear");
		document.getElementById("retinoid4").value = row.id;
		document.getElementById("label_noregistrasi4").innerHTML = row.noregistrasi;
		document.getElementById("label_namalengkap4").innerHTML = row.nama;
		if (row.jenis_kelamin == "l") {
			document.getElementById("label_jkelamin4").innerHTML = "Laki-laki";
		} else if (row.jenis_kelamin == "p") {
			document.getElementById("label_jkelamin4").innerHTML = "Perempuan";
		}
		document.getElementById("label_nohp4").innerHTML = row.no_hp;

		with (new Date()) {
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
		with (new Date()) {
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
		with (new Date()) {
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

		var urldgfollowup = "retino/readfollowup?id=" + row.id;
		$("#dgfollowup").datagrid("reload", urldgfollowup);

		$("#btnlinkfollowup").linkbutton({
			text: "Simpan"
		});
		url = "retino/savefollowup";
	} else {
		$.messager.alert("warning", "pilih data terlebih dahulu", "warning");
	}
}

function savefollowup() {

	progress(); // show the message box
	$("#fm-followup").form("submit", {
		url: url ,

		onSubmit: function() {
			//return $(this).form('validate');
			var v = $(this).form("validate");
			if (!v) $.messager.progress("close"); // close the message box
			return v;
		},
		success: function(result) {
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
				with (new Date()) {
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
				with (new Date()) {
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
				with (new Date()) {
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

				$("#btnlinkfollowup").linkbutton({
					text: "Simpan"
				});
				url = "retino/savefollowup";
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
		//document.getElementById("retinoid3").value = retinoid;
		url = "retino/updatefollowup/" + row.id;
		$("#btnlinkfollowup").linkbutton({
			text: "Update"
		});
	} else {
		$.messager.alert("Warning", "Pilih data terlebih dahulu", "warning");
	}
}

function deletefollowup(id) {
	if (id) {
		$.messager.confirm(
			"Konfirmasi",
			"yakin akan menghapus data ini ?",
			function(r) {
				if (r) {
					$.post(
						"retino/deletefollowup",
						{
							id: id
						},
						function(result) {
							if (result.success) {
								$.messager.alert("info", "Data telah di hapus !", "info");
								$("#dgfollowup").datagrid("reload");
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
