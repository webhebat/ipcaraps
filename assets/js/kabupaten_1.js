$(function(){

	$('#dgkabupaten').datagrid({ 
        width: '600px', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        url: 'kabupaten/read', 
        title: 'Data kabupaten',
        columns:[[   
            {field:'kabupaten',title:'Nama kabupaten',width:350,align:'left'},
            {field:'ibukota',title:'Ibukota',width:350,align:'left'}
        ]], 
        showFooter:true
        //onDblClickRow:function(row,index){
            //EditOutlet();
        //rowStyler:function(index,row){
        //  if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
        //}     
    });

    $('#search').keyup(function(){

    doSearchkabupaten();
            
    });

})

function doSearch(value){
    if(value){
        
    $('#search').val('');   
    }
    $('#dgkabupaten').datagrid('reload',{  
        search: value              
    }); 
    $('#search').focus();
}

function add(){
    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Add kabupaten');
    $('#fm').form('clear');
    url = 'kabupaten/save';
}

function save(){
    $('#fm').form('submit',{

        url: url,
        
        onSubmit: function(){
            return $(this).form('validate');
            progress();
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
                $('#dgkabupaten').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgkabupaten').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit kabupaten');
        $('#fm').form('load',row);
        url = 'kabupaten/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgkabupaten').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus data \"'+row.nama_kabupaten+'\" ?',function(r){ 
            if (r){ 
                $.post('kabupaten/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.nama_kabupaten+'\" telah di hapus !','info');
                    $('#dgkabupaten').datagrid('reload'); 
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
    var row = $('#dgkabupaten').datagrid('getSelected'); 
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

