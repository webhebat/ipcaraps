
$(function(){
	//var url = <?php echo $base_url()'staging/staging_read';?>;
	$('#dgstaging').datagrid({ 
        width: '600px', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        url: 'staging/read', 
        title: 'Data staging',
		columns:[[ 
            {field:'jenis',title:'Jenis',width:150,align:'left'},
            {field:'tingkat',title:'Tingkat',width:100,align:'left'},  
            {field:'staging',title:'Staging',width:350,align:'left'}
		]], 
		showFooter:true
		//onDblClickRow:function(row,index){
			//EditOutlet();
		//rowStyler:function(index,row){
		//	if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
		//}		
	});

	$('#search').keyup(function(){

	doSearch();
			
    });
});

function doSearch(value){
	if(value){
		
	$('#search').val('');	
    }
    $('#dgstaging').datagrid('reload',{  
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
    $('#dlg').dialog('open').dialog('center').dialog('setTitle','tambah staging');
    $('#fm').form('clear');
    url = 'staging/save';
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
                $('#dgstaging').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgstaging').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','ubah staging');
        $('#fm').form('load',row);

        if(row.jenis == 'Toronto'){
            document.getElementById("jenis1").checked = true;
        }else if(row.jenis == 'TNM'){
            document.getElementById("jenis2").checked = true;
        }

        if(row.tingkat=='Pertama'){
            document.getElementById("tingkat1").checked = true;
        }else if(row.tingkat=='Kedua'){
            document.getElementById("tingkat2").checked = true;
        }else{
            document.getElementById("tingkat3").checked = true;
        }

        url = 'staging/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgstaging').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus data \"'+row.staging+'\" ?',function(r){ 
            if (r){ 
                $.post('staging/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.staging+'\" telah di hapus !','info');
                    $('#dgstaging').datagrid('reload'); 
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
    var row = $('#dgstaging').datagrid('getSelected'); 
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


