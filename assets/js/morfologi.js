
$(function(){
	//var url = <?php echo $base_url()'morfologi/morfologi_read';?>;
	$('#dgmorfologi').datagrid({ 
        width: 'auto', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        nowrap:false,
        url: 'morfologi/read', 
        title: 'Morfologi',
		columns:[[   
            {field:'subgrup',title:'Sub Grup',width:200,align:'left'}, 
            {field:'kodemorfologi',title:'Kode',width:50,align:'center'}, 
            {field:'morfologi',title:'Morfologi',width:400,align:'left'}
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
        url:'morfologi/optgrup',
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

function onLoadSuccess(data){
    var merges = [{
        index: 2,
        rowspan: 2
    },{
        index: 5,
        rowspan: 2
    },{
        index: 7,
        rowspan: 2
    }];
    for(var i=0; i<merges.length; i++){
        $(this).datagrid('mergeCells',{
            index: merges[i].index,
            field: 'productid',
            rowspan: merges[i].rowspan
        });
    }
}

function formatItem(row){
    var s = '<span style="font-weight:bold">kode : ' + row.kodesubgrup + '</span><br/>' +
            '<span style="color:#888">'+ row.subgrup + '</span>';
    return s;
}

function doSearch(value){
	if(value){
		
	$('#search').val('');	
    }
    $('#dgmorfologi').datagrid('reload',{  
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
    $('#dlg').dialog('open').dialog('setTitle','tambah Morfologi');
    $('#fm').form('clear');
    url = 'morfologi/save';
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
                $('#dgmorfologi').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgmorfologi').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit Morfologi');
        $('#fm').form('load',row);
        // document.getElementById('h_kode').value = row.kodemorfologi;
        // $('#subgrupid').combogrid('reload', {
        //   q: row.subgrupid
        // });
        var dg = $('#subgrupid').combogrid('grid');
        dg.datagrid('reload', {
          q: row.subgrupid
        });
        url = 'morfologi/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgmorfologi').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Konfirmasi','Apakah anda yakin akan menghapus data \"'+row.morfologi+'\" ?',function(r){ 
            if (r){ 
                $.post('morfologi/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.morfologi+'\" telah di hapus !','info');
                    $('#dgmorfologi').datagrid('reload'); 
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
    var row = $('#dgmorfologi').datagrid('getSelected'); 
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


