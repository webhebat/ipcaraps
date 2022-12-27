$( document ).ready(function(){
    $.getJSON('rekammedik/getjmlvalidasi', { get_param: 'value' }, function(data) {
        $('#link-validate').linkbutton({text:data.jml+' Sudah Divalidasi'});
        $('#link-nonvalidate').linkbutton({text:data.jml2+' Belum Divalidasi'});
    });

    $('#searchPasien').combogrid({
        panelWidth:600,
        idField:'id',
        textField:'nama',
        editable:true,
        pagination:true,
        nowrap:false,
        loadMsg:'Please Wait..',
        mode:'remote',
        url:'rekammedik/caripasien',
        columns: [[
            {field:'noregistrasi',title:'No Registrasi',width:120},
            {field:'nama',title:'Nama Lengkap',width:200,align:'left',formatter:function(value,row,index){  
                if(row.validate=='y'){
                return  '<img src=\'assets/themes/icons/correct.png\' border=\'0\'/ class="item-img"></img>'+' '+row.nama+' ';
                }else{
                    return '<img src=\'assets/themes/icons/uncheck.png\' border=\'0\'/ class="item-img"></img>'+' '+row.nama+' ';
                }  
                }
            },
            {field:'subgrup',title:'Subgrup',width:300,align:'left'},
            {field:'morfologi',title:'Morfologi',width:150,align:'left'},
            {field:'topografi',title:'Topografi',width:150,align:'left'},
            {field:'no_rekam',title:'No Rekam Medis',width:200,align:'left'},
            {field:'jkelamin',title:'Jenis Kelamin',width:120,align:'left'},
            {field:'alamat',title:'Alamat',width:200,align:'left'}, 
        ]], 
        onSelect: function(index,row){
        entryrekammedik(row)
    }
    })

	$('#dgrekammedik').datagrid({ 
        //width: 'auto', 
        height: '400', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: false,
        nowrap:false, 
        idField: 'id', 
        url: 'rekammedik/read', 
        title: 'Data Rekam Medik',
        onDblClickRow:function(){
            edit();
        },
        frozenColumns:[[
            {field:'noregistrasi',title:'No Reg',width:100,align:'left'},
            {field:'nama',title:'Nama Lengkap',width:200,align:'left'}, 
        ]],
        columns:[[ 
            {field:'tgl_kunjungan',title:'Tgl Kunjungan',width:150,align:'center',formatter:function(value,row,index){  
                if(row.validate=='y'){
                    return  '<img src=\'assets/themes/icons/correct.png\' border=\'0\'/ class="item-img"></img>'+' '+row.tgl_kunjungan+' ';
                }else{
                    return '<img src=\'assets/themes/icons/uncheck.png\' border=\'0\'/ class="item-img"></img>'+' '+row.tgl_kunjungan+' ';
                }  
                }
            },
            {field:'datakeluhanutama',title:'Keluhan Utama',width:200,align:'left'},
            {field:'sikluske',title:'Siklus Ke',width:100,align:'center'},
            {field:'komplikasi_penyakit_dasar',title:'Komplikasi Penyakit Dasar',width:150,align:'left'},
            {field:'komplikasikemo',title:'Komplikasi Kemoterapi',width:150,align:'left'},
            {field:'infeksi_kemo',title:'Infeksi Kemo',width:150,align:'left'},
            {field:'non_infeksi_kemo',title:'Non Infeksi Kemo',width:150,align:'left'},
            {field:'evaluasipengobatan',title:'Evaluasi Pengobatan',width:100,align:'left'},
            {field:'tgl_evaluasi',title:'Tgl Evaluasi',width:100,align:'left'},
            {field:'evaluasi_pengobatan_lain',title:'Evaluasi Pengobatan Lain',width:250,align:'left'},
            {field:'keluhan_utama_lainnya',title:'Keluhan/Tujuan Lain',width:180,align:'left'},
            {field:'periksafisik',title:'Pemeriksaan Fisik',width:150,align:'left'},
            {field:'ukuran_tumor',title:'Ukuran Tumor',width:150,align:'center'},
            {field:'lokasi_tumor',title:'Lokasi Limfadenompati',width:150,align:'left'},
            {field:'besar_hepar',title:'Besar Hepar',width:180,align:'center'},
            {field:'besar_lien',title:'Besar Lien',width:150,align:'center'},
            {field:'schuffner',title:'Schuffner',width:120,align:'center'},
            {field:'fisik_lainnya',title:'Pemeriksaan Fisik Lainnya',width:150,align:'left'},
            {field:'tgl_periksa_lab',title:'Tgl Periksa Lab',width:180,align:'left'},
            {field:'hemoglobin',title:'Hemoglobin',width:150,align:'center'},
            {field:'leukosit',title:'Leukosit',width:150,align:'center'},
            {field:'trombosit',title:'Trombosit',width:150,align:'center'},
            {field:'blast',title:'Blast',width:100,align:'center'},
            {field:'tumor_marker',title:'Tumor Marker',width:150,align:'left'},
            {field:'hasil',title:'Limfoblas',width:150,align:'left'},
            {field:'tambahan_infeksi',title:'Tambahan Infeksi',width:200,align:'left'},
            {field:'tambahan_non_infeksi',title:'Tambahan Non Infeksi',width:200,align:'left'},
            {field:'dataplan',title:'Plan',width:150,align:'left'},
            {field:'plan_lainnya',title:'Plan Lainnya',width:150,align:'left'},
            {field:'nama_unit',title:'Unit',width:150,align:'left'}
         ]],
        // showFooter:true,
        // onLoadSuccess:function(data) {
        //     //Merge all columns
        //     //$(this).datagrid("autoMergeCells");
        //     //Specify columns for merging operations  
        //     $(this).datagrid("autoMergeCells", ['noregistrasi', 'nama']);
        // }    
    });

    $('#dghistory').datagrid({ 
        //width: 'auto', 
        height: '400', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: false,
        nowrap:false, 
        idField: 'id', 
        //url: 'rekammedik/readhistory', 
        title: 'Data Rekam Medik Pasien',
        onDblClickRow:function(){
            edit();
        },
        columns:[[ 
            {field:'tgl_kunjungan',title:'Tgl Kunjungan',width:150,align:'center',formatter:function(value,row,index){  
                if(row.validate=='y'){
                    return  '<img src=\'assets/themes/icons/correct.png\' border=\'0\'/ class="item-img"></img>'+' '+row.tgl_kunjungan+' ';
                }else{
                    return '<img src=\'assets/themes/icons/uncheck.png\' border=\'0\'/ class="item-img"></img>'+' '+row.tgl_kunjungan+' ';
                }  
                }
            },
            {field:'datakeluhanutama',title:'Keluhan Utama',width:200,align:'left'},
            {field:'sikluske',title:'Siklus Ke',width:100,align:'center'},
            {field:'komplikasi_penyakit_dasar',title:'Komplikasi Penyakit Dasar',width:150,align:'left'},
            {field:'komplikasikemo',title:'Komplikasi Kemoterapi',width:150,align:'left'},
            {field:'infeksi_kemo',title:'Infeksi Kemo',width:150,align:'left'},
            {field:'non_infeksi_kemo',title:'Non Infeksi Kemo',width:150,align:'left'},
            {field:'evaluasipengobatan',title:'Evaluasi Pengobatan',width:100,align:'left'},
            {field:'tgl_evaluasi',title:'Tgl Evaluasi',width:100,align:'left'},
            {field:'evaluasi_pengobatan_lain',title:'Evaluasi Pengobatan Lain',width:250,align:'left'},
            {field:'keluhan_utama_lainnya',title:'Keluhan/Tujuan Lain',width:180,align:'left'},
            {field:'periksafisik',title:'Pemeriksaan Fisik',width:150,align:'left'},
            {field:'ukuran_tumor',title:'Ukuran Tumor',width:150,align:'center'},
            {field:'lokasi_tumor',title:'Lokasi Limfadenompati',width:150,align:'left'},
            {field:'besar_hepar',title:'Besar Hepar',width:180,align:'center'},
            {field:'besar_lien',title:'Besar Lien',width:150,align:'center'},
            {field:'schuffner',title:'Schuffner',width:120,align:'center'},
            {field:'fisik_lainnya',title:'Pemeriksaan Fisik Lainnya',width:150,align:'center'},
            {field:'tgl_periksa_lab',title:'Tgl Periksa Lab',width:180,align:'left'},
            {field:'hemoglobin',title:'Hemoglobin',width:150,align:'center'},
            {field:'leukosit',title:'Leukosit',width:150,align:'center'},
            {field:'trombosit',title:'Trombosit',width:150,align:'center'},
            {field:'blast',title:'Blast',width:100,align:'center'},
            {field:'tumor_marker',title:'Tumor Marker',width:150,align:'left'},
            {field:'hasil',title:'Limfoblas',width:150,align:'left'},
            {field:'tambahan_infeksi',title:'Tambahan Infeksi',width:200,align:'left'},
            {field:'tambahan_non_infeksi',title:'Tambahan Non Infeksi',width:200,align:'left'},
            {field:'dataplan',title:'Plan',width:150,align:'left'},
            {field:'plan_lainnya',title:'Plan Lainnya',width:150,align:'left'}
        ]],
        showFooter:true,
        onLoadSuccess:function(data) {
            //Merge all columns
            //$(this).datagrid("autoMergeCells");
            //Specify columns for merging operations  
            $(this).datagrid("autoMergeCells", ['noregistrasi', 'nama']);
        }    
    });
    
    $('#key_subgrupid').combobox({
        panelWidth:200,
        panelHeight:'300',
        valueField: 'id',
        editable:false,
        loadMsg:'Please Wait..',
        textField: 'subgrup', 
        fitColumns:true,
        url:'rekammedik/optionsubgrup',
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

    $('#key_unitid').combobox({
		panelWidth: 200,
		panelHeight: '200',
		valueField: 'id',
		editable: false,
		loadMsg: 'Please Wait..',
		textField: 'nama_unit',
		formatter: formatUnit,
		fitColumns: true,
		url: 'rekammedik/optionunit',
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

    $('#keluhan_utama').combobox({
        panelWidth:250,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'nama_options', 
        fitColumns:true,
        multiple:true,
        multiline:true,
        editable:false,
        //url:'rekammedik/tatalaksana',
        formatter:function(row){
        var opts = $(this).combobox('options');
        return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
        },onSelect:function(row){
        //console.log(row)
        var opts = $(this).combobox('options');
        var el = opts.finder.getEl(this, row[opts.valueField]);
        el.find('input.combobox-checkbox')._propAttr('checked', true);
        showsiklus(row[opts.textField],true)
        },
          onUnselect:function(row){
            var opts = $(this).combobox('options');
            var el = opts.finder.getEl(this, row[opts.valueField]);
            el.find('input.combobox-checkbox')._propAttr('checked', false);
           showsiklus(row[opts.textField],false)
        },
          onLoadSuccess:function(){
            var opts = $(this).combobox('options');
            var target = this;
            var values = $(target).combobox('getValues');
            $.map(values, function(value){
            var el = opts.finder.getEl(target, value);
            el.find('input.combobox-checkbox')._propAttr('checked', true);
            })
        },
    });

    $('#komplikasi_kemoterapi').combobox({
        panelWidth:250,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'nama_options', 
        fitColumns:true,
        multiple:true,
        multiline:true,
        editable:false,
        url:'rekammedik/dataoptions?type=komplikasi kemo rekam',
        formatter:function(row){
        var opts = $(this).combobox('options');
        return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
        },onSelect:function(row){
        //console.log(row)
            var opts = $(this).combobox('options');
            var el = opts.finder.getEl(this, row[opts.valueField]);
            el.find('input.combobox-checkbox')._propAttr('checked', true);
            showkomplikasi(row[opts.textField],true)
        },
          onUnselect:function(row){
            var opts = $(this).combobox('options');
            var el = opts.finder.getEl(this, row[opts.valueField]);
            el.find('input.combobox-checkbox')._propAttr('checked', false);
            showkomplikasi(row[opts.textField],false)
        },
          onLoadSuccess:function(){
            var opts = $(this).combobox('options');
            var target = this;
            var values = $(target).combobox('getValues');
            $.map(values, function(value){
            var el = opts.finder.getEl(target, value);
            el.find('input.combobox-checkbox')._propAttr('checked', true);
            })
        },
    });

    $('#periksa_fisik').combobox({
        panelWidth:250,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'nama_options', 
        fitColumns:true,
        multiple:true,
        multiline:true,
        editable:false,
        //url:'rekammedik/tatalaksana',
        formatter:function(row){
        var opts = $(this).combobox('options');
        return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
        },onSelect:function(row){
        //console.log(row)
            var opts = $(this).combobox('options');
            var el = opts.finder.getEl(this, row[opts.valueField]);
            el.find('input.combobox-checkbox')._propAttr('checked', true);
            showfisik(row[opts.textField],true)
        },
          onUnselect:function(row){
            var opts = $(this).combobox('options');
            var el = opts.finder.getEl(this, row[opts.valueField]);
            el.find('input.combobox-checkbox')._propAttr('checked', false);
            showfisik(row[opts.textField],false)
        },
          onLoadSuccess:function(){
            var opts = $(this).combobox('options');
            var target = this;
            var values = $(target).combobox('getValues');
            $.map(values, function(value){
            var el = opts.finder.getEl(target, value);
            el.find('input.combobox-checkbox')._propAttr('checked', true);
            })
        },
    });

    $('#plan').combobox({
        panelWidth:250,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'nama_options', 
        fitColumns:true,
        multiple:true,
        multiline:true,
        editable:false,
        //url:'rekammedik/tatalaksana',
        formatter:function(row){
        var opts = $(this).combobox('options');
        return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
        },onSelect:function(row){
        //console.log(row)
        var opts = $(this).combobox('options');
        var el = opts.finder.getEl(this, row[opts.valueField]);
        el.find('input.combobox-checkbox')._propAttr('checked', true);
        showeplanlain(row[opts.textField],true)
        },
          onUnselect:function(row){
            var opts = $(this).combobox('options');
            var el = opts.finder.getEl(this, row[opts.valueField]);
            el.find('input.combobox-checkbox')._propAttr('checked', false);
            showeplanlain(row[opts.textField],false)
        },
          onLoadSuccess:function(){
            var opts = $(this).combobox('options');
            var target = this;
            var values = $(target).combobox('getValues');
            $.map(values, function(value){
            var el = opts.finder.getEl(target, value);
            el.find('input.combobox-checkbox')._propAttr('checked', true);
            })
        },
    });

    $('#evaluasi_pengobatan').combobox({
        panelWidth:250,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'nama_options', 
        fitColumns:true,
        editable:false,
        onSelect:function(row){
            showevaluasilain(row.nama_options)
        },
    });

    //merge cell
    $.extend($.fn.datagrid.methods, {
        autoMergeCells: function(jq, fields) {
            return jq.each(function() {
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
                function(field, colunm) {
                    $.each(colunm,
                    function() {
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

function formatUnit(row) {
	var s = '<span style="font-weight:bold">' + row.nama_unit + '</span><br/>' +
		'<span style="color:#888">' + row.alamat + '</span>';
	return s;
}

function searchvalidate(v){
     $('#dgrekammedik').datagrid('reload',{  
        validate: v              
    }); 
}

function hidedefault(){
    $('#dgpenyerta').datagrid('loadData', {"total":0,"rows":[]});

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

function showother(isi){
    if(isi=='Lainnya'){
        document.getElementById("lainnya_utama").style.display = '';
        $('#keluhan_utama_lainnya').textbox('textbox').focus();
    }else{
        document.getElementById("lainnya_utama").style.display = 'none';
        $('#keluhan_utama_lainnya').textbox('clear');
    }
}

function showsiklus(isi,cek){

    if(isi=='Melanjutkan kemoterapi'&&cek==true){
        document.getElementById("trsiklus").style.display = '';
        $('#sikluske').textbox('textbox').focus();
    }else if(isi=='Melanjutkan kemoterapi'&&cek==false){
        document.getElementById("trsiklus").style.display = 'none';
        $('#sikluske').textbox('clear');
    }

    if(isi=='Komplikasi penyakit dasar'&&cek==true){
        document.getElementById("trkomplikasi").style.display = '';
        $('#komplikasi_penyakit_dasar').textbox('textbox').focus();
    }else if(isi=='Komplikasi penyakit dasar'&&cek==false){
        document.getElementById("trkomplikasi").style.display = 'none';
        $('#komplikasi_penyakit_dasar').textbox('clear');
    }

    if(isi=='Komplikasi kemoterapi'&&cek==true){
        document.getElementById("trkomplikasikemo").style.display = '';
        //$('#infeksi_kemo').combobox('clear');
    }else if(isi=='Komplikasi kemoterapi'&&cek==false){
        document.getElementById("trkomplikasikemo").style.display = 'none';
        $('#komplikasi_kemoterapi').combobox('clear');
    }

    if(isi=='Evaluasi pengobatan'&&cek==true){
        document.getElementById("trevaluasi").style.display = '';
        //$('#infeksi_kemo').combobox('clear');
    }else if(isi=='Evaluasi pengobatan'&&cek==false){
        document.getElementById("trevaluasi").style.display = 'none';
        $('#evaluasi_pengobatan').combobox('clear');
        document.getElementById("trevaluasilain").style.display = 'none';
    }

    if(isi=='Lain - lain'&&cek==true){
        document.getElementById("trkeluhanlain").style.display = '';
        $('#keluhan_utama_lainnya').textbox('textbox').focus();
    }else if(isi=='Lain - lain'&&cek==false){
        document.getElementById("trkeluhanlain").style.display = 'none';
        $('#keluhan_utama_lainnya').textbox('clear');
    }
}

function showkomplikasi(isi,cek){

    if(isi=='Infeksi'&&cek==true){
        document.getElementById("trinfeksi").style.display = '';
        $('#infeksi_kemo').textbox('textbox').focus();
    }else if(isi=='Infeksi'&&cek==false){
        document.getElementById("trinfeksi").style.display = 'none';
        $('#infeksi_kemo').textbox('clear');
    }

    if(isi=='Non Infeksi'&&cek==true){
        document.getElementById("trnoninfeksi").style.display = '';
        $('#non_infeksi_kemo').textbox('textbox').focus();
    }else if(isi=='Non Infeksi'&&cek==false){
        document.getElementById("trnoninfeksi").style.display = 'none';
        $('#non_infeksi_kemo').textbox('clear');
    }
}

function showtrnon_infeksi(isi,cek){

    if(isi=='Lainnya'&&cek==true){
        document.getElementById("trnon_infeksi").style.display = '';
        $('#non_infeksi_lainnya').textbox('textbox').focus();
    }else if(isi=='Lainnya'&&cek==false){
        document.getElementById("trnon_infeksi").style.display = 'none';
        $('#non_infeksi_lainnya').textbox('clear');
    }
}

function showevaluasilain(isi){
    if(isi=='Lainnya'){
        document.getElementById("trevaluasilain").style.display = '';
        $('#evaluasi_pengobatan_lain').textbox('textbox').focus();
    }else{
        document.getElementById("trevaluasilain").style.display = 'none';
        $('#evaluasi_pengobatan_lain').textbox('clear');
    }
}

function showeplanlain(isi,cek){
    if(isi=='Lainnya'&&cek==true){
        document.getElementById("trplanlain").style.display = '';
        $('#plan_lainnya').textbox('textbox').focus();
    }else if(isi=='Lainnya'&&cek==false){
        document.getElementById("trplanlain").style.display = 'none';
        $('#plan_lainnya').textbox('clear');
    }
}

function showfisik(isi,cek){

    if(isi=='Ukuran Massa Tumor(diameter)'&&cek==true){
        document.getElementById("trukuran").style.display = '';
        $('#ukuran_tumor').textbox('textbox').focus();
    }else if(isi=='Ukuran Massa Tumor(diameter)'&&cek==false){
        document.getElementById("trukuran").style.display = 'none';
        $('#ukuran_tumor').textbox('clear');
    }

    if(isi=='Limfadenompati'&&cek==true){
        document.getElementById("trlimpa").style.display = '';
        $('#lokasi_tumor').textbox('textbox').focus();
    }else if(isi=='Limfadenompati'&&cek==false){
        document.getElementById("trlimpa").style.display = 'none';
        $('#lokasi_tumor').textbox('clear');
    }

    if(isi=='Hepatomegali'&&cek==true){
        document.getElementById("trhepar").style.display = '';
        $('#besar_hepar').textbox('textbox').focus();
    }else if(isi=='Hepatomegali'&&cek==false){
        document.getElementById("trhepar").style.display = 'none';
        $('#besar_hepar').textbox('clear');
    }

    if(isi=='Splenomegali'&&cek==true){
        document.getElementById("trlien").style.display = '';
        $('#besar_lien').textbox('textbox').focus();
    }else if(isi=='Splenomegali'&&cek==false){
        document.getElementById("trlien").style.display = 'none';
        $('#besar_lien').textbox('clear');
        $('#schuffner').textbox('clear');
    }

    if(isi=='Lainnya'&&cek==true){
        document.getElementById("trfisiklain").style.display = '';
        $('#fisik_lainnya').textbox('textbox').focus();
    }else if(isi=='Lainnya'&&cek==false){
        document.getElementById("trfisiklain").style.display = 'none';
        $('#fisik_lainnya').textbox('clear');
    }
}

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

function searchvalidate(v){
     $('#dgrekammedik').datagrid('reload',{  
        validate: v              
    }); 
}

function doSearch(value){
    
    var search = $('#search').val();
    var tgl1 = $('#key_tgldatang').val();
    var tgl2 = $('#key_tgldatang2').val();
    var validasi = $("input[name='key_validasi']:checked").val();
    var subgrupid = $('#key_subgrupid').val();
    var unitid = $('#key_unitid').val();
    
    $('#dgrekammedik').datagrid('reload',{  
        search: value,
        tgl1 : tgl1,
        tgl2 : tgl2,
        validate : validasi,
        subgrupid :subgrupid,
        unitid: unitid           
    });  
}
function clearSearch(){

    $('#search').searchbox('clear');
    $('#fm-search').form('clear');
    
    $('#dgrekammedik').datagrid('reload',{  
        search: '',
        tgl1 : '',
        tgl2 : '',
        validate : '', 
        unitid: ''           
    }); 
}

function progress(){
    $.messager.progress({
    title:'Mohon Tunggu',
    msg:'Simpan data...'
    });
}

function kosongkanpenyerta(){
    $('#dgpenyerta').datagrid('loadData', {"total":0,"rows":[]});
    document.getElementById("lainnya_penyerta").style.display = 'none';
    $('#keluhan_penyerta_lainnya').textbox('clear');
}

function entryrekammedik(row){
    //var row = $('#searchPasien').combogrid('getSelected');
    $('#dlg').dialog('open').dialog('setTitle','Entry Rekam Medik');
     var dgPanel = $('#dghistory').datagrid('getPanel');
     dgPanel.panel('setTitle', 'Rekam Medik Pasien '+row.nama);
    $('#fm').form('clear');
    document.getElementById('registrasiid').value = row.id;
    if(row.jenis_kelamin=='l'){
        document.getElementById('label_jkelamin').innerHTML = 'Laki-laki';
    }else if(row.jenis_kelamin=='p'){
        document.getElementById('label_jkelamin').innerHTML = 'Perempuan';
    }
    //hidedefault()
    document.getElementById('label_namalengkap').innerHTML = row.nama;
    document.getElementById('label_nik').innerHTML = row.nik;
    document.getElementById('label_ttl').innerHTML = row.ttl;
    document.getElementById('label_noregistrasi').innerHTML = row.noregistrasi;
    document.getElementById('label_norekam').innerHTML = row.no_rekam;
    document.getElementById('label_nohp').innerHTML = row.no_hp;

    with(new Date){
        $('#tgl_kunjungan').datebox('setValue',getFullYear()+"-"+(getMonth()+1<10?'0':'')+(getMonth()+1)+"-"+(getDate()<10?'0':'')+getDate());
    }
    with(new Date){
        $('#tgl_periksa_lab').datebox('setValue',getFullYear()+"-"+(getMonth()+1<10?'0':'')+(getMonth()+1)+"-"+(getDate()<10?'0':'')+getDate());
    }

    $('#searchPasien').combogrid('grid').datagrid('reload');
    $('#searchPasien').combogrid('setValue','');

    var urlkeluhan = 'rekammedik/dataoptions?type=alasan kedatangan';
    $('#keluhan_utama').combobox('reload',urlkeluhan);
    var urlfisik = 'rekammedik/dataoptions?type=fisik rekam';
    $('#periksa_fisik').combobox('reload',urlfisik);
    var urlplan = 'rekammedik/dataoptions?type=plan';
    $('#plan').combobox('reload',urlplan);
    var urlevaluasi = 'rekammedik/dataoptions?type=evaluasi pengobatan';
    $('#evaluasi_pengobatan').combobox('reload',urlevaluasi);
    var urlhistory = 'rekammedik/readhistory?id='+row.id;
        $('#dghistory').datagrid('reload',urlhistory);

    $('#btnlink').linkbutton({text:'Simpan'});
    url = 'rekammedik/save';
}

function moresearch(){
    $('#dlg-search').dialog('open');
    $('#fm-search').form('clear');
    $('#key_area_id').combobox('reload','area/options');
}

function save(){
    var textbutton = $('#btnlink').text();
    var optutama = $('#keluhan_utama').combobox('getValues');
    var optkomplikasi = $('#komplikasi_kemoterapi').combobox('getValues');
    var optfisik = $('#periksa_fisik').combobox('getValues');
    var optplan = $('#plan').combobox('getValues');

    progress()  // show the message box
    $('#fm').form('submit',{

        url: url+'?optutama='+optutama+'&optkomplikasi='+optkomplikasi+'&optfisik='+optfisik+'&optplan='+optplan,
        
        onSubmit: function(){
            //return $(this).form('validate');
            var v = $(this).form('validate');
              if(!v) $.messager.progress('close');  // close the message box
              return v;
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
                //$.messager.progress('close');
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
                $.messager.progress('close');
                $.messager.alert('Info','Data Sukses Disimpan','');
                countvalidate()
                //$('#dghistory').datagrid('reload'); 
                $('#dlg').dialog('close');    // close the dialog
                $('#dgrekammedik').datagrid('reload');    // reload the user data
            }
        }
    });  
}

function edit(){
   // var grupid = document.getElementById("grupid").value;
    var uid = document.getElementById("uid").value;
    var row = $('#dgrekammedik').datagrid('getSelected');
    if(row){
        // cek apakah data ini data unit yang login??
        if(uid==row.unitid){
        $('#dlg').dialog('open').dialog('setTitle','Edit Rekam Medik');
        $('#fm').form('load',row);
        var dgPanel = $('#dghistory').datagrid('getPanel');
        dgPanel.panel('setTitle', 'Rekam Medik Pasien '+row.nama);
        if(row.jenis_kelamin=='l'){
            document.getElementById('label_jkelamin').innerHTML = 'Laki-laki';
        }else if(row.jenis_kelamin=='p'){
            document.getElementById('label_jkelamin').innerHTML = 'Perempuan';
        }
        document.getElementById('label_namalengkap').innerHTML = row.nama;
        document.getElementById('label_nik').innerHTML = row.nik;
        document.getElementById('label_ttl').innerHTML = row.ttl;
        document.getElementById('label_noregistrasi').innerHTML = row.noregistrasi;
        document.getElementById('label_norekam').innerHTML = row.no_rekam;
        document.getElementById('label_nohp').innerHTML = row.no_hp;

        var urlkeluhan = 'rekammedik/dataoptions?type=alasan kedatangan';
        $('#keluhan_utama').combobox('reload',urlkeluhan);
        var urlfisik = 'rekammedik/dataoptions?type=fisik rekam';
        $('#periksa_fisik').combobox('reload',urlfisik);
        var urlplan = 'rekammedik/dataoptions?type=plan';
        $('#plan').combobox('reload',urlplan);
        var urlevaluasi = 'rekammedik/dataoptions?type=evaluasi pengobatan';
        $('#evaluasi_pengobatan').combobox('reload',urlevaluasi);
        var urlhistory = 'rekammedik/readhistory?id='+row.registrasiid;
        $('#dghistory').datagrid('reload',urlhistory);

        $('#btnlink').linkbutton({text:'Update'});
        url = 'rekammedik/update/'+row.id;
        }else{
            $.messager.alert('Warning', 'Maaf! Anda tidak bisa edit data ini', 'warning');
        }
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function countvalidate(){
    $.getJSON('rekammedik/getjmlvalidasi', { get_param: 'value' }, function(data) {
        $('#link-validate').linkbutton({text:data.jml+' Sudah Divalidasi'});
        $('#link-nonvalidate').linkbutton({text:data.jml2+' Belum Divalidasi'});
    });
}

function validasirekam(){
    var row = $('#dgrekammedik').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Validasi Data Rekam Medik');
        $('#fm').form('load',row);
        
        if(row.jenis_kelamin=='l'){
            document.getElementById('label_jkelamin').innerHTML = 'Laki-laki';
        }else if(row.jenis_kelamin=='p'){
            document.getElementById('label_jkelamin').innerHTML = 'Perempuan';
        }
        document.getElementById('label_namalengkap').innerHTML = row.nama;
        document.getElementById('label_nik').innerHTML = row.nik;
        document.getElementById('label_ttl').innerHTML = row.ttl;
        document.getElementById('label_noregistrasi').innerHTML = row.noregistrasi;
        document.getElementById('label_norekam').innerHTML = row.no_rekam;
        document.getElementById('label_nohp').innerHTML = row.no_hp;

        var urlkeluhan = 'rekammedik/dataoptions?type=alasan kedatangan';
        $('#keluhan_utama').combobox('reload',urlkeluhan);
        var urlfisik = 'rekammedik/dataoptions?type=fisik rekam';
        $('#periksa_fisik').combobox('reload',urlfisik);
        var urlplan = 'rekammedik/dataoptions?type=plan';
        $('#plan').combobox('reload',urlplan);
        var urlevaluasi = 'rekammedik/dataoptions?type=evaluasi pengobatan';
        $('#evaluasi_pengobatan').combobox('reload',urlevaluasi);

        $('#btnlink').linkbutton({text:'Validasi'});
        url = 'rekammedik/validate/'+row.id;
    }else{
        $.messager.alert('Warning','Pilih data yang mau divalidasi','warning');
    }
}

function remove(){ 
    var uid = document.getElementById("uid").value;
    var row = $('#dgrekammedik').datagrid('getSelected'); 
    if(row){
        if (uid == row.unitid) {
        $.messager.confirm('Konfirmasi','Apakah anda yakin akan menghapus data rekam medik ini ?',function(r){ 
            if (r){ 
                $.post('rekammedik/delete',
                    {id:row.id},
                    function(result){ 
                    if (result.success){ 
                        $.messager.alert('info','Data rekammedik\"'+row.nama+'\" telah di hapus !','info');
                    $('#dgrekammedik').datagrid('reload'); 
                } else { 
                    $.messager.show({ title: 'Error', msg: result.msg }); 
                    } 
                }
                ,'json'); 
                    $('#dlg').dialog('close'); } 
        });
    }else{
        $.messager.alert('Warning', 'Maaf! Anda tidak bisa menghapus data ini', 'warning');
    }
    }else{
        $.messager.alert('Warning','Pilih data yang mau dihapus','warning');
    }
     
}





