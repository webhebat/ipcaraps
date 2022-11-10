$(function(){

	$('#dgkecamatan').datagrid({ 
        width: '600px', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        url: 'kecamatan/read', 
        title: 'Data kecamatan',
        columns:[[   
            {field:'kecamatan',title:'Nama kecamatan',width:350,align:'left'},
            {field:'kabupaten',title:'Kabupaten',width:350,align:'left'}
        ]], 
        showFooter:true
        //onDblClickRow:function(row,index){
            //EditOutlet();
        //rowStyler:function(index,row){
        //  if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
        //}     
    });

    $('#search').keyup(function(){

    doSearchkecamatan();
            
    });

    $('#kabid').combogrid({
        panelWidth:400,
        idField:'kabid',
        textField:'kabupaten',
        editable:true,
        pagination:false,
        loadMsg:'Please Wait..',
        mode:'remote',
        url:'kecamatan/optionkab',
        columns: [[
            {field:'kabupaten',title:'Nama Kabupaten',width:350}
        ]]
    })

})

function doSearch(value){
    if(value){
        
    $('#search').val('');   
    }
    $('#dgkecamatan').datagrid('reload',{  
        search: value              
    }); 
    $('#search').focus();
}

function add(){
    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Tambah Kecamatan');
    $('#fm').form('clear');
    url = 'kecamatan/save';
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
                $('#dgkecamatan').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgkecamatan').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit Kecamatan');
        $('#fm').form('load',row);
        var dg = $('#kabid').combogrid('grid');
        dg.datagrid('reload', {
          q: row.kabid
        });
        url = 'kecamatan/update/'+row.camatid;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgkecamatan').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus data \"'+row.kecamatan+'\" ?',function(r){ 
            if (r){ 
                $.post('kecamatan/delete',{id:row.camatid},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.kecamatan+'\" telah di hapus !','info');
                    $('#dgkecamatan').datagrid('reload'); 
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
    var row = $('#dgkecamatan').datagrid('getSelected'); 
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

