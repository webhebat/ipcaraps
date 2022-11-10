
$(function(){
	//var url = <?php echo $base_url()'menu/menu_read';?>;
	$('#dgmenu').datagrid({ 
		width: 'auto', 
        height: 'auto', 
        singleSelect: true, 
        pagination: false, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true,
        nowrap:false,
        idField: 'id', 
        url: 'menu/read', 
        title: 'Data menu',
		columns:[[  
			{field:'nama_menu',title:'Nama menu',width:250,align:'left',formatter:function(value,row,index){
                if(row.level_menu=='utama'){
                    value = "<b>"+value+"</b>";
                }else if(row.level_menu=='submenu'){
                    value = "-> "+value;
                }
                return value; 
            }},
            {field:'level_menu',title:'Level',width:250,align:'left'},
            {field:'parent',title:'Menu Parent',width:250,align:'left'},
            {field:'nama_file',title:'Nama File',width:250,align:'left'},
            {field:'keterangan',title:'Keterangan',width:250,align:'left'},
            {field:'icon',title:'Icon',width:100,align:'left'}, 
			{field:'Action',title:'Posisi',width:80,align:'center',formatter: function(value, row, index){
                var up = '<a href="#" onclick="MenuAppsDown(\'' + row.sort + '\',\'U\')"><img src=\'assets/themes/icons/up.png\' border=\'0\'/ class="item-img" title="Keatas"></a>';
                var down = '<a href="#" onclick="MenuAppsDown(\'' + row.sort + '\',\'D\')"><img src=\'assets/themes/icons/down.png\' border=\'0\'/ class="item-img" title="Kebawah"></a>';
                if (row.id > 1) return up + '  ' + down;
                else return  up + '  ' + down;
                }}
		]], 
		showFooter:true
		//onDblClickRow:function(row,index){
			//EditOutlet();
		//rowStyler:function(index,row){
		//	if (JSON.stringify(row)!='{}'){ if (row.active=='n') return 'color:red;'; }
		//}		
	});

    $('#id_parent').combogrid({
        panelWidth:400,
        idField:'id',
        textField:'nama_menu',
        editable:true,
        pagination:false,
        loadMsg:'Please Wait..',
        mode:'remote',
        url:'menu/options',
        columns: [[
            {field:'nama_menu',title:'Nama Menu',width:350}
        ]]
    })

	$('#search').keyup(function(){

	doSearch();
			
    });

});

function MenuAppsDown(sort, tipe) {
    var sort_from = sort;
    var getData = $('#dgmenu').datagrid('getData');
    sort--;
    if (tipe == 'D') {
        sort++;
    } else {
        sort--;
    }
    var data = getData.rows[sort];
    $.post('menu/sort', {
        //id_apps: id_apps,
        sort_from: sort_from,
        sort_to: data.sort
    }, function(result) {
        if (result.success) {
            $('#dgmenu').datagrid('reload');
        } else {
            $.messager.show({
                title: 'Error',
                msg: result.msg
            });
        }
    }, 'json');
}

function myformatter(date){
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}

function showlevel(rec){
    var a = $('#level_menu').combobox('getValue');
    if(a=='utama'){
        $('#id_parent').combogrid('setValue','');
        $('#id_parent').combogrid('disable');
        $('#nama_file').textbox('disable');
        $('#nama_file').textbox('setValue','');
    }else if(a=='submenu'){
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
    $('#dgmenu').datagrid('reload',{  
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
    $('#dlg').dialog('open').dialog('setTitle','New menu');
    $('#fm').form('clear');
    $('#nama_file').textbox('enable');
    $('#id_parent').combogrid('enable');
    url = 'menu/save';
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
                $('#dgmenu').datagrid('reload');
                $('#id_parent').combogrid('reload');    // reload the user data
            }
        }
    });
}

function edit(){
    var row = $('#dgmenu').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Edit menu');
        $('#fm').form('clear');
        $('#fm').form('load',row);
        url = 'menu/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function remove(){ 
    var row = $('#dgmenu').datagrid('getSelected'); 
    if(row){
        $.messager.confirm('Confirm','Apakah anda yakin akan menghapus data \"'+row.nama_menu+'\" ?',function(r){ 
            if (r){ 
                $.post('menu/delete',{id:row.id},function(result){ 
                if (result.success){ 
                    $.messager.alert('info','Data \"'+row.nama_menu+'\" telah di hapus !','info');
                    $('#dgmenu').datagrid('reload'); 
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
    var row = $('#dgmenu').datagrid('getSelected'); 
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


