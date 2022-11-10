
$(function(){
	//var url = <?php echo $base_url()'subgrup/subgrup_read';?>;
	$('#dgsubgrup').datagrid({ 
        width: 'auto', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        nowrap:false,
        url: 'subgrup/read', 
        title: 'Sub Grup',
		columns:[[   
            {field:'grupdiagnostik',title:'Grup Diagnostik',width:200,align:'left'}, 
            {field:'kodesubgrup',title:'Kode',width:50,align:'center'}, 
            {field:'subgrup',title:'Sub Grup',width:400,align:'left'},
            {field:'stagingid',title:'Staging',width:200,align:'left'}
		]], 
		showFooter:true,
        onLoadSuccess:function(data) {
            //Merge all columns
            //$(this).datagrid("autoMergeCells");
            //Specify columns for merging operations  
            $(this).datagrid("autoMergeCells", ['grupdiagnostik', '']);
        }	
	});

    $('#grupdiagnostikid').combobox({
        url:'subgrup/optgrup',
        panelWidth:400,
        valueField:'id',
        textField:'grupdiagnostik',
        // editable:true,
        // pagination:false,
        // loadMsg:'Please Wait..',
        mode:'remote',
        formatter: formatItem
    })

    $('#key_jenis').combobox({
        onSelect:function(){
        
        }
    });

    $('#dgstaging').datagrid({ 
        width: '500', 
        height: '300px',  
        singleSelect: false, 
        pagination: false, 
        rownumbers: false, 
        collapsible: false, 
        fitColumns: true,
        nowrap:false,
        idField: 'id', 
        url: 'subgrup/readstaging', 
        title: 'Pilih Staging',
        columns:[[
            {field:'ck',checkbox:'true'},
            {field:'jenis',title:'Jenis',width:150,align:'left'},
            {field:'tingkat',title:'Tingkat',width:150,align:'left'},
            {field:'staging',title:'Nama Staging',width:300,align:'left'}
        ]], 
        showFooter:true,
        onLoadSuccess: function (data) {
            for (i=0;i < data.rows.length;++i) {
                if (data.rows[i]['ck']==1) {
                    $(this).datagrid('checkRow', i);
                }
            }
        }
        //onDblClickRow:function(row,index){
            //EditOutlet();
        //rowStyler:function(index,row){
        //  if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
        //}     
    });

	$('#search').keyup(function(){

	doSearch();
			
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
});

function formatItem(row){
    var s = '<span style="font-weight:bold">kode : ' + row.kode + '</span><br/>' +
            '<span style="color:#888">'+ row.grupdiagnostik + '</span>';
    return s;
}

function doSearch(value){
	if(value){
		
	$('#search').val('');	
    }
    $('#dgsubgrup').datagrid('reload',{  
		search: value              
    }); 
    $('#search').focus();
}

function doSearch2(value){
    var jenis = $('#key_jenis').combobox('getValue'),
        tingkat = $('#key_tingkat').combobox('getValue');
    if(value){
        
        $('#key_search').val('');   
    }
    $('#dgstaging').datagrid('reload',{  
        search:value,
        jenis:jenis,
        tingkat:tingkat              
    }); 
    $('#key_search').focus();
}

var url;

function progress(){
    var win = $.messager.progress({
        title:'Please waiting',
        msg:'Saving data...'
    });
}

function add(){
    $('#dlg').dialog('open').dialog('setTitle','tambah sub grup');
    $('#fm').form('clear');
    $('#dgstaging').datagrid('clearSelections');
    url = 'subgrup/save';
}

function save(){
    var stag=[];
    var rows=$('#dgstaging').datagrid('getSelections');
    for(var i=0;i<rows.length;i++){
        var row=rows[i];
        stag.push(row.id);
    }

    if(rows!=''){
        $('#fm').form('submit',{

        url: url+'?staging_id='+stag,
        
        onSubmit: function(){
            return $(this).form('validate');
            //progress();
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
            	//$.messager.progress('close');
                $.messager.show({
                    title : 'Error',
                    msg : result.errorMsg,
                    timeout:2000
                });
            } else {
            	//$.messager.progress('close');
            	$.messager.alert('Info','Data Sukses Disimpan','');
                $('#dlg').dialog('close');        // close the dialog
                $('#dgsubgrup').datagrid('reload');    // reload the user data
            }
        }
    });
    }else{
        $.messager.alert('warning','tentukan staging untuk sub grup','warning');
    }
}

function edit(){
    var row = $('#dgsubgrup').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit sub grup');
        $('#fm').form('load',row);
        document.getElementById('h_kode').value = row.kodesubgrup;
         $('#grupdiagnostikid').combobox('reload', {
          q: row.grupdiagnostikid
        });
        $('#dgstaging').datagrid('clearSelections');
        $('#dgstaging').datagrid('reload', {
            staging_id: row.stagingid
        });
        // dg.datagrid('reload', {
        //   q: row.grupdiagnostikid
        // });
        url = 'subgrup/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgsubgrup').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Konfirmasi','Apakah anda yakin akan menghapus data \"'+row.subgrup+'\" ?',function(r){ 
            if (r){ 
                $.post('subgrup/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.subgrup+'\" telah di hapus !','info');
                    $('#dgsubgrup').datagrid('reload'); 
                } else { 
                    $.messager.show({ title: 'Error', msg: result.msg }); 
                    } 
                },'json'); 
                    $('#dlg').dialog('close'); } 
        });
    }else{
        $.messager.alert('Warning','Pilih data yang mau dihapus','warning');
    }
     
} 

function removedata(){ 
    var row = $('#dgsubgrup').datagrid('getSelected'); 
    var aktif; 
    if (row.aktif=='y'){ 
        aktif ='n'; 
        var str = 'nonaktifkan'; 
        } else{ 
            aktif='y'; 
            var str = 'aktifkan'; 
        } 
        $.messager.confirm('Confirm','Apakah Anda yakin akan '+str+' donatur '+row.muzakki+' ?',function(r){ 
            if (r){ $.post('?mod=COREZ&file=Muzakki&m=remove',{id_muzakki:row.id_muzakki,aktif:aktif},function(result)
            { 
                if (result.success){ 
                $.messager.show({ 
                    title: 'Information', msg: 'Muzakki \"'+row.muzakki+'\" telah di '+str+' !' }); $('#dgMuzakki').datagrid('reload');
                } else { 
                    $.messager.show({ title: 'Error', msg: result.msg }); } },'json'); 
                    $('#dlgAction').dialog('close'); 
                } 
        }); 
} 


