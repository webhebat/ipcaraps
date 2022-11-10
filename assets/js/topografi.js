
$(function(){
	//var url = <?php echo $base_url()'topografi/topografi_read';?>;
	$('#dgtopografi').datagrid({ 
        width: 'auto', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        nowrap:false,
        url: 'topografi/read', 
        title: 'topografi',
		columns:[[   
            {field:'subgrup',title:'Sub Grup',width:200,align:'left'}, 
            {field:'kodetopografi',title:'Kode',width:50,align:'center'}, 
            {field:'topografi',title:'topografi',width:400,align:'left'}
		]], 
		showFooter:true,
        onLoadSuccess:function(data) {
            //Merge all columns
            //$(this).datagrid("autoMergeCells");
            //Specify columns for merging operations  
            $(this).datagrid("autoMergeCells", ['subgrup', '']);
        }
		//onDblClickRow:function(row,index){
			//EditOutlet();
		//rowStyler:function(index,row){
		//	if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
		//}		
	});

    $('#subgrupid').combogrid({
        url:'topografi/optgrup',
        panelWidth:400,
        idField:'id',
        textField:'subgrup',
        fitColumns: true,
        editable:true,
        // pagination:false,
        loadMsg:'Please Wait..',
        mode:'remote',
        columns: [[
            {field:'kodesubgrup',title:'Kode',halign:'center',align:'center',width:70},
            {field:'subgrup',title:'Sub Grup',width:300}
        ]]
    })

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
    var s = '<span style="font-weight:bold">kode : ' + row.kodesubgrup + '</span><br/>' +
            '<span style="color:#888">'+ row.subgrup + '</span>';
    return s;
}

function doSearch(value){
	if(value){
		
	$('#search').val('');	
    }
    $('#dgtopografi').datagrid('reload',{  
		search: value              
    }); 
    $('#search').focus();
}

var url;

function progress(){
    var win = $.messager.progress({
        title:'Please waiting',
        msg:'Saving data...'
    });
}

function add(){
    $('#dlg').dialog('open').dialog('setTitle','tambah topografi');
    $('#fm').form('clear');
    url = 'topografi/save';
}

function save(){
    $('#fm').form('submit',{

        url: url,
        
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
                $('#dgtopografi').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgtopografi').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit topografi');
        $('#fm').form('load',row);
        // document.getElementById('h_kode').value = row.kodetopografi;
        // $('#subgrupid').combogrid('reload', {
        //   q: row.subgrupid
        // });
        var dg = $('#subgrupid').combogrid('grid');
        dg.datagrid('reload', {
          q: row.subgrupid
        });
        url = 'topografi/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgtopografi').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Konfirmasi','Apakah anda yakin akan menghapus data \"'+row.topografi+'\" ?',function(r){ 
            if (r){ 
                $.post('topografi/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.topografi+'\" telah di hapus !','info');
                    $('#dgtopografi').datagrid('reload'); 
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
    var row = $('#dgtopografi').datagrid('getSelected'); 
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


