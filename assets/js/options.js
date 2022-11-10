$(function(){

	$('#dgoptions').datagrid({ 
        width: '750px', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        nowrap:false,
        idField: 'id', 
        url: 'options/read', 
        title: 'Data options',
        onDblClickRow:function(){
            editoptions();
        },
        columns:[[   
            {field:'nama_options',title:'Nama Options',width:350,align:'left'},
            {field:'type',title:'Type',width:300,align:'left'},
            {field:'ket',title:'Keterangan',width:200,align:'left'},
            {field:'action',title:'Hapus',width:80,align:'center',formatter:function(value,row,index)
                {  return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deleteOptions(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> '; }  
            } 
        ]], 
        showFooter:true   
    });

    $('#search').keyup(function(){

    doSearchoptions();
            
    });

})

function progress(){
    $.messager.progress({
    title:'Mohon Tunggu',
    msg:'Simpan data...'
    });
}

function doSearch(value){
    if(value){
        
    $('#search').val('');   
    }
    $('#dgoptions').datagrid('reload',{  
        search: value              
    }); 
    $('#search').focus();
}

function clearform(){
    $('#nama_options').textbox('clear');
    $('#type').textbox('clear');
    $('#ket').textbox('clear');
    url = 'options/save';
    mode = 'save';
    $('#lnk').linkbutton({text:'Simpan'});
}

var url ='options/save';
var mode = 'save';
function saveOptions(){
    ////url = 'options/save';
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
                if(mode=='save'){
                    $.messager.alert('Info','Data Sukses Disimpan','');
                }
                if(mode=='edit'){
                    $.messager.alert('Info','Data Sukses Diupdate','');
                }
                clearform()       // close the dialog
                $('#dgoptions').datagrid('reload');    // reload the user data
            }
        }
    });
}

function editoptions(){
    var row = $('#dgoptions').datagrid('getSelected');
    if(row){

        $('#fm').form('load',row);
    
        url = 'options/update/'+row.id;
        $('#lnk').linkbutton({text:'Update'});
        mode = 'edit';
    }else{
        $.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function edit(){
    var row = $('#dgoptions').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit options');
        $('#fm').form('load',row);
        url = 'options/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function deleteOptions(id){ 
    if(id){
        $.messager.confirm('Konfirmasi','yakin akan menghapus data ini ?',function(r){ 
            if (r){ 
                $.post('options/delete',
                    {id:id},
                    function(result){ 
                    if (result.success){ 
                        $.messager.alert('info','Data telah di hapus !','info');
                    $('#dgoptions').datagrid('reload'); 
                } else { 
                    $.messager.show({ title: 'Error', msg: result.msg }); 
                    } 
                }
                ,'json'); 

                    } 
        });
    }else{
        $.messager.alert('Warning','Pilih data yang mau dihapus','warning');
    }
     
} 

function removedata(){ 
    var row = $('#dgoptions').datagrid('getSelected'); 
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

