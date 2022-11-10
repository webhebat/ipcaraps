$(function(){

    // $.getJSON('reminder/getjmlkunjungan', { get_param: 'value' }, function(data) {
    //     $('#link-hijau').linkbutton({text:data.jml+' Hijau'});
    //     $('#link-kuning').linkbutton({text:data.jml2+' Kuning'});
    //     $('#link-merah').linkbutton({text:data.jml3+' Merah'});
    // });

	$('#dgreminder').datagrid({ 
        width: '100%', 
        height: '500', 
        singleSelect: true, 
        pagination: true, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: true, 
        nowrap:false,
        idField: 'id', 
        url: 'reminder/read', 
        title: 'Rekam Medik Reminder',
        onDblClickRow:function(){
            showreminder();
        },
        columns:[[ 
            // {field:'id',title:'id',width:30,align:'left'},  
            {field:'nama',title:'Nama Pasien',width:150,align:'left'},
            {field:'subgrup',title:'Subgrup',width:150,align:'left'},
            {field:'jmlkunjungan',title:'Jml Kunjungan',width:70,align:'center'},
            {field:'tgl_kunjungan',title:'Tgl Kunjungan Terakhir',width:120,align:'center'},
            {field:'tgl_kunjungan_berikutnya',title:'Tgl Kunjungan Berikutnya',width:130,align:'center'},
            {field:'selisih',title:'Sisa Hari',width:50,align:'center',styler:cellStyler},
            {field:'followup',title:'Followup',width:60,align:'center'},
            {field:'keterangan_reminder',title:'Keterangan',width:100,align:'left'},
            {field:'action',title:'Stop',width:50,align:'center',formatter:function(value,row,index)
                {  
                    return  '<a href="javascript:void(0)" style="text-decoration: none" title="Stop Reminder?" onClick="deletereminder(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> '; }  
            },
            {field:'nama_unit',title:'Unit',width:100,align:'left'}, 
        ]]
    });

    $('#key_subgrupid').combobox({
        panelWidth:200,
        panelHeight:'300',
        valueField: 'id',
        editable:false,
        loadMsg:'Please Wait..',
        textField: 'subgrup', 
        fitColumns:true,
        url:'registrasi/optionsubgrup',
    });

})

function myformatter(date){
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function myparser(s){
    if (!s) return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0],10);
    var m = parseInt(ss[1],10);
    var d = parseInt(ss[2],10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
        return new Date(y,m-1,d);
    } else {
        return new Date();
    }
}

function moresearch(){
    $('#dlg-search').dialog('open');
    $('#fm-search').form('clear');
    document.getElementById("semua").checked=true;
    document.getElementById("all").checked=true;
}

function searchkunjungan(v){
     $('#dgreminder').datagrid('reload',{  
        kunjungan: v              
    }); 
}

function cellStyler (value,row,index){
    if (value < 1){
        return 'background-color:red;color:#fff;font-weight:bold;';
    }
    if (value > 0 && value < 8 ){
        return 'background-color:yellow;color:#000;font-weight:bold;';
    }
    if (value > 7 ){
        return 'background-color:green;color:#fff;font-weight:bold;';
    }                 
}

function progress(){
    $.messager.progress({
    title:'Mohon Tunggu',
    msg:'Simpan data...'
    });
}

function doSearch(value){
    var value = $('#search').val();
    var tglkunjungan = $('#key_tglkunjungan').val();
    var tglkunjungan2 = $('#key_tglkunjungan2').val();
    var followup = $("input[name='key_followup']:checked").val();
    var hari = $("input[name='key_hari']:checked").val();
    var subgrupid = $('#key_subgrupid').val();
    
    $('#dgreminder').datagrid('reload',{  
        search: value,
        tglkunjungan : tglkunjungan,
        tglkunjungan2 : tglkunjungan2,
        followup : followup,
        hari : hari,
        subgrupid : subgrupid             
    }); 
}

function clearSearch(){

    $('#search').searchbox('clear');
    $('#fm-search').form('clear')
    
    $('#dgreminder').datagrid('reload',{  
        search: '',
        tglkunjungan : '',
        tglkunjungan2 : '',
        followup : '',
        hari : ''              
    }); 
}

// var url ='reminder/save';
// var mode = 'save';

function savereminder(){
    //alert(url)
    //url = 'reminder/save';
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

                $.messager.alert('Info','Data Sukses Diupdate','');
                $('#dlg').dialog('close')     // close the dialog
                $('#dgreminder').datagrid('reload');    // reload the user data
            }
        }
    });
}

function showreminder(){
    var row = $('#dgreminder').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Reminder Detail');
        $('#fm').form('load',row)
        document.getElementById('label_noregistrasi').innerHTML = row.noregistrasi;
        document.getElementById('label_nama').innerHTML = row.nama;
        document.getElementById('label_hp').innerHTML = row.no_hp;
        document.getElementById('label_hp2').innerHTML = row.no_hp2;
        url = 'reminder/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function deletereminder(id){ 
    if(id){
        $.messager.confirm('Konfirmasi','anda yakin akan stop reminder untuk data ini ?',function(r){ 
            if (r){ 
                $.post('reminder/delete',
                    {id:id},
                    function(result){ 
                    if (result.success){ 
                        $.messager.alert('info','Reminder sudah  dihapus !','info');
                    $('#dgreminder').datagrid('reload'); 
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


