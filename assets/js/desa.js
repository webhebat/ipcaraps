$(function(){

	$('#dgdesa').datagrid({ 
        width: '600px', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        url: 'desa/read', 
        title: 'Data desa',
        columns:[[   
            {field:'id_kel',title:'ID Desa',width:350,align:'left'},
            {field:'nama',title:'Nama desa',width:350,align:'left'},
            {field:'kecamatan',title:'Kecamatan',width:350,align:'left'},
            {field:'jenis',title:'Jenis',width:350,align:'left'}
        ]], 
        showFooter:true
        //onDblClickRow:function(row,index){
            //EditOutlet();
        //rowStyler:function(index,row){
        //  if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
        //}     
    });

    $('#camatid').combogrid({
        panelWidth:400,
        idField:'camatid',
        textField:'kecamatan',
        editable:true,
        pagination:false,
        loadMsg:'Please Wait..',
        mode:'remote',
        url:'desa/optionkecamatan',
        columns: [[
            {field:'kecamatan',title:'Nama Kecamatan',width:350}
        ]]
    })

    $('#search').keyup(function(){

    doSearchdesa();
            
    });

})

function doSearch(value){
    if(value){
        
    $('#search').val('');   
    }
    $('#dgdesa').datagrid('reload',{  
        search: value              
    }); 
    $('#search').focus();
}

function add(){
    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Tambah Desa');
    $('#fm').form('clear');
    document.getElementById("no").checked = true;
    url = 'desa/save';
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
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
            	//$.messager.progress('close');
            	$.messager.alert('Info','Data Sukses Disimpan','');
                $('#dlg').dialog('close');        // close the dialog
                $('#dgdesa').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgdesa').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit desa');
        $('#fm').form('load',row);
        var dg = $('#camatid').combogrid('grid');
        dg.datagrid('reload', {
          q: row.camatid
        });
        url = 'desa/update/'+row.desaid;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgdesa').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus data \"'+row.desa+'\" ?',function(r){ 
            if (r){ 
                $.post('desa/delete',{id:row.desaid},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.desa+'\" telah di hapus !','info');
                    $('#dgdesa').datagrid('reload'); 
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
    var row = $('#dgdesa').datagrid('getSelected'); 
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

