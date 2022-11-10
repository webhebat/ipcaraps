
$(function(){
	//var url = <?php echo $base_url()'grupuser/grupuser_read';?>;
	$('#dggrupuser').datagrid({ 
		width: '700', 
        height: '350', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: true, 
        fitColumns: true,
        nowrap:false,
        idField: 'id', 
        url: 'grupuser/read', 
        title: 'Data grup user',
		columns:[[  
            {field:'id',title:'Grup Id',width:100,align:'center'},
			{field:'name',title:'Nama Grup User',width:200,align:'left'},
            {field:'description',title:'Keterangan',width:250,align:'left'},
            {field:'count_menu',title:'&#931; Menu',width:80,align:'center'}
			//{field:'status',title:'Aktif',width:80,align:'left'}
		]], 
		showFooter:true
		//onDblClickRow:function(row,index){
			//EditOutlet();
		//rowStyler:function(index,row){
		//	if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
		//}		
	});

    $('#dggrupmenu').datagrid({ 
        width: 'auto', 
        height: '300px', 
        singleSelect: false, 
        pagination: false, 
        rownumbers: false, 
        collapsible: false, 
        fitColumns: true,
        nowrap:false,
        idField: 'id', 
        url: 'menu/read2', 
        title: 'Pilih Menu',
        columns:[[
            {field:'ck',checkbox:'true'}, 
            {field:'nama_menu',title:'Nama menu',width:250,align:'left',formatter:function(value,row,index){
                if(row.level_menu=='utama'){
                    value = "<b>"+value+"</b>";
                }else if(row.level_menu=='submenu'){
                    value = "-> "+value;
                }
                return value; 
            }},
            {field:'level_menu',title:'Level Menu',width:250,align:'left'},
            {field:'parent',title:'Menu Parent',width:250,align:'left'},
            {field:'keterangan',title:'Keterangan',width:250,align:'left'}
            //{field:'status',title:'Aktif',width:80,align:'left'}
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

    $('#id_parent').combogrid({
        panelWidth:400,
        idField:'id',
        textField:'nama_grupuser',
        editable:true,
        pagination:false,
        loadMsg:'Please Wait..',
        mode:'remote',
        url:'grupuser/options',
        columns: [[
            {field:'nama_grupuser',title:'Nama grupuser',width:350}
        ]]
    })

	$('#search').keyup(function(){

	doSearch();
			
    });

});

function myformatter(date){
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}

function showlevel(rec){
    var a = $('#level_grupuser').combobox('getValue');
    if(a=='utama'){
        $('#id_parent').combogrid('setValue','');
        $('#id_parent').combogrid('disable');
        $('#nama_file').textbox('disable');
        $('#nama_file').textbox('setValue','');
    }else if(a=='subgrupuser'){
        $('#nama_file').textbox('enable');
        $('#id_parent').combogrid('enable');
    }
}

function myparser(s){
    if (!s) return new Date();
    var ss = s.split('-');
    var y = parseInt(ss[0],10);
    var m = parseInt(ss[1],10);
    var d = parseInt(ss[2],10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
        return new Date(y,m-1,d);
    } else {
        return new Date();
    }
}

function doSearch(value){
	if(value){
		
	$('#search').val('');	
    }
    $('#dggrupuser').datagrid('reload',{  
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
    $('#dlg').dialog('open').dialog('setTitle','New grup user');
    $('#fm').form('clear');
    $('#dggrupmenu').datagrid('clearSelections');
    url = 'grupuser/save';
}

function save(){
    var dgMenu=[];
    var rows=$('#dggrupmenu').datagrid('getSelections');
    for(var i=0;i<rows.length;i++){
        var row=rows[i];
        dgMenu.push(row.id);
    }
    if(rows!=''){
        $('#fm').form('submit',{

        url: url+'?menu_id='+dgMenu,
        
        onSubmit: function(){
            return $(this).form('validate');
            //progress();
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
                //$.messager.progress('close');
                $.messager.alert('Info','Data Sukses Disimpan','');
                $('#dlg').dialog('close');        // close the dialog
                $('#dggrupuser').datagrid('reload');
                $('#id_parent').combogrid('reload');    // reload the user data
            }
        }
    });
    }else{
        $.messager.alert('warning','tidak ada menu yang dipilih','warning');
    }
    
}

function edit(){
    var row = $('#dggrupuser').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit grupuser');
        $('#fm').form('load',row);
        $('#dggrupmenu').datagrid('clearSelections');
        $('#dggrupmenu').datagrid('reload', {
            menu_id: row.menu_id
        });
        url = 'grupuser/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dggrupuser').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus data \"'+row.nama_grupuser+'\" ?',function(r){ 
            if (r){ 
                $.post('grupuser/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.nama_grupuser+'\" telah di hapus !','info');
                    $('#dggrupuser').datagrid('reload'); 
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
    var row = $('#dggrupuser').datagrid('getSelected'); 
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


