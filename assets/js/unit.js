
$(function(){
	//var url = <?php echo $base_url()'unit/unit_read';?>;
	$('#dgunit').datagrid({ 
        width: '700px', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        idField: 'id', 
        url: 'unit/read', 
        title: 'Data unit',
		columns:[[   
            {field:'no_unit',title:'No Unit',width:100,align:'center'},
            {field:'id',title:'UnitId',width:100,align:'center'},
            {field:'nama_unit',title:'Nama Unit',width:350,align:'left'},
			{field:'alamat',title:'Alamat',width:350,align:'left'},
            {field:'kode',title:'Kode RS',width:150,align:'left'}  
			//{field:'status',title:'Aktif',width:80,align:'left'}
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
    $('#dgunit').datagrid('reload',{  
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
    $('#dlg').dialog('open').dialog('setTitle','Tambah Unit');
    $('#fm').form('clear');
    $.getJSON('unit/no_unit', { get_param: 'value' }, function(data) {
        document.getElementById('labelnounit').innerHTML = data.nourut;
        //$('#no_unit').textbox('setValue',data.nourut);
        document.getElementById('no_unit').value = data.nourut;
    });
    url = 'unit/save';
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
                $('#dgunit').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgunit').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Ubah Unit');
        $('#fm').form('load',row);
        document.getElementById('labelnounit').innerHTML = row.no_unit;
        url = 'unit/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgunit').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus data \"'+row.nama_unit+'\" ?',function(r){ 
            if (r){ 
                $.post('unit/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.nama_unit+'\" telah di hapus !','info');
                    $('#dgunit').datagrid('reload'); 
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
    var row = $('#dgunit').datagrid('getSelected'); 
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


