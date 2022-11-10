
$(function(){
	//var url = <?php echo $base_url()'user/user_read';?>;
	$('#dguser').datagrid({ 
		width: 'auto', 
        height: 'auto', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: true, 
        fitColumns: true,
        nowrap:false,
        idField: 'id', 
        url: 'user/read', 
        title: 'Data user',
		columns:[[ 
            {field:'first_name',title:'Nama Lengkap',width:200,align:'left'},
            {field:'username',title:'Username',width:200,align:'left'},
            {field:'name',title:'Grup User',width:200,align:'left'},
            {field:'nama_unit',title:'Unit',width:200,align:'left'},
            {field:'email',title:'Email',width:200,align:'left'},
            {field:'aktif',title:'Aktif',width:100,align:'center'} 
			//{field:'status',title:'Aktif',width:80,align:'left'}
		]], 
		showFooter:true
		//onDblClickRow:function(row,index){
			//EditOutlet();
		//rowStyler:function(index,row){
		//	if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
		//}		
	});

    $('#group').combobox({
        panelWidth:200,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'name', 
        fitColumns:true,
        url:'user/groupoption',
    });

    $('#unitid').combobox({
        panelWidth:200,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'nama_unit', 
        formatter: formatUnit,
        fitColumns:true,
        url:'user/optionunit',
    });

    // $('#unitid').combogrid({
    //     panelWidth:550,
    //     idField:'id',
    //     textField:'unit',
    //     editable:true,
    //     pagination:true,
    //     loadMsg:'Please Wait..',
    //     mode:'remote',
    //     url:'user/optionunit',
    //     columns: [[
    //         {field:'unit',title:'Nama Unit',width:500}
    //     ]],
    //     onSelect: onSelectGrid
    // })

	$('#search').keyup(function(){

	doSearch();
			
    });
});

function formatUnit(row){
    var s = '<span style="font-weight:bold">' + row.nama_unit + '</span><br/>' +
            '<span style="color:#888">' + row.alamat + '</span>';
    return s;
}

function onSelectGrid(index,record) {
    document.getElementById('first_name').value = record.nama_karyawan;
    document.getElementById('email').value = record.email;
}

function myformatter(date){
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
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
    $('#dguser').datagrid('reload',{  
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
    $('#dlg').dialog('open').dialog('setTitle','New user');
    $('#fm').form('clear');

    url = 'user/save';
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
                
                $.messager.alert('Error',result.errorMsg,'Error');
            } else {
            	//$.messager.progress('close');
            	$.messager.alert('Info','Data Sukses Disimpan','');
                $('#dlg').dialog('close');        // close the dialog
                $('#dguser').datagrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dguser').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit user');
        $('#fm').form('load',row);
        $('#group').combobox('setValue',row.idgrup);
        $('#password').textbox('setValue','password tidak bisa di ubah');
        url = 'user/updateuser/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dguser').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus username \"'+row.username+'\" ?',function(r){ 
            if (r){ 
                $.post('user/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.username+'\" telah di hapus !','info');
                    $('#dguser').datagrid('reload'); 
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
    var row = $('#dguser').datagrid('getSelected'); 
    var active; 
    if (row.active==1){ 
        active =0; 
        var str = 'non aktifkan'; 
        } else{ 
            active=1; 
            var str = 'aktifkan'; 
        } 
        $.messager.confirm('Confirm','Apakah Anda yakin akan '+str+' username '+row.username+' ?',function(r){ 
            if (r){ $.post('user/nonaktif',{id:row.id,active:active},function(result)
            { 
                if (result.success){ 
                    $.messager.alert('info','Username \"'+row.username+'\" telah di '+str+' !','info');
                    $('#dguser').datagrid('reload');
                } else { 
                    $.messager.show({ title: 'Error', msg: result.msg }); } },'json'); 
                    $('#dlg').dialog('close'); 
                } 
        }); 
} 


