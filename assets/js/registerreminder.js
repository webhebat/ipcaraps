$(function(){
    document.getElementById('link-3bln').style.cssText = 'color:red;font-weight:bold';

    // $.getJSON('reminder/getjmlkunjungan', { get_param: 'value' }, function(data) {
    //     $('#link-hijau').linkbutton({text:data.jml+' Hijau'});
    //     $('#link-kuning').linkbutton({text:data.jml2+' Kuning'});
    //     $('#link-merah').linkbutton({text:data.jml3+' Merah'});
    // });

	// $('#dgreminder').datagrid({ 
 //        width: '100%', 
 //        height: '500', 
 //        singleSelect: true, 
 //        pagination: true, 
 //        rownumbers: true, 
 //        collapsible: false, 
 //        fitColumns: true, 
 //        nowrap:false,
 //        idField: 'id', 
 //        url: 'registerreminder/read', 
 //        title: 'Register Followup Reminder',
 //        onDblClickRow:function(){
 //            showreminder();
 //        },
 //        columns:[[ 
 //            // {field:'id',title:'id',width:30,align:'left'},  
 //            {field:'nama',title:'Nama Pasien',width:150,align:'left'},
 //            //{field:'jmlkunjungan',title:'Jml Followup',width:70,align:'center'},
 //            {field:'tgl_followup',title:'Tgl Followup',width:100,align:'center'},
 //            //{field:'tgl_3bln',title:'Tgl Followup Berikutnya',width:130,align:'center'},
 //            // {field:'selisih',title:'Sisa Hari',width:50,align:'center',styler:cellStyler},
 //            {field:'3bln',title:'3 Bulan',width:60,align:'center',styler:cellStyler},
 //            {field:'6bln',title:'6 Bulan',width:60,align:'center',styler:cellStyler},
 //            {field:'1thn',title:'1 Tahun',width:60,align:'center',styler:cellStyler},
 //            {field:'2thn',title:'2 Tahun',width:60,align:'center',styler:cellStyler},
 //            {field:'3thn',title:'3 Tahun',width:60,align:'center',styler:cellStyler},
 //            {field:'4thn',title:'4 Tahun',width:60,align:'center',styler:cellStyler},
 //            {field:'5thn',title:'5 Tahun',width:60,align:'center',styler:cellStyler},
 //            //{field:'keterangan_reminder',title:'Keterangan',width:100,align:'left'},
 //            // {field:'action',title:'Stop',width:50,align:'center',formatter:function(value,row,index)
 //            //     {  
 //            //         return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deletereminder(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> '; }  
 //            // } 
 //        ]]
 //    });

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

 $('#tindakan').combobox({
        panelWidth:250,
        panelHeight:'auto',
        valueField: 'id',
        loadMsg:'Please Wait..',
        textField: 'tatalaksana', 
        fitColumns:true,
        multiple:true,
        multiline:true,
        editable:false,
        url:'registrasi/tatalaksana',
        formatter:function(row){
        var opts = $(this).combobox('options');
        return '<input type="checkbox" id="ck" name="ck" class="combobox-checkbox">' + row[opts.textField]
        },onSelect:function(row){
        //console.log(row)
        var opts = $(this).combobox('options');
        var el = opts.finder.getEl(this, row[opts.valueField]);
        el.find('input.combobox-checkbox')._propAttr('checked', true);

        },
          onUnselect:function(row){
            var opts = $(this).combobox('options');
            var el = opts.finder.getEl(this, row[opts.valueField]);
            el.find('input.combobox-checkbox')._propAttr('checked', false);
            //console.log(row)
        },
          onLoadSuccess:function(){
            var opts = $(this).combobox('options');
            var target = this;
            var values = $(target).combobox('getValues');
            $.map(values, function(value){
                var el = opts.finder.getEl(target, value);
                el.find('input.combobox-checkbox')._propAttr('checked', true);
            })
        },
    });

 $('#dgluaran').datagrid({ 
        width: '500', 
        height: '300', 
        singleSelect: true, 
        pagination: false, 
        rownumbers: true, 
        collapsible: false, 
        fitColumns: false,
        nowrap:false, 
        idField: 'id', 
        //url: 'registrasi/readluaran', 
        title: 'Data Luaran Pasien',
        onDblClickRow:function(){
            editluaran();
        },
        columns:[[   
            {field:'newstatus',title:'Status',width:150,align:'left'},
            {field:'tgl_abstraksi',title:'Tgl Abstraksi',width:120,align:'center'},
            {field:'statusnow',title:'Status Lanjutan',width:130,align:'left'},
            {field:'tgl_status',title:'Tanggal',width:120,align:'left'},
            {field:'rumah_sakit',title:'Rumah Sakit',width:150,align:'left'},
            {field:'namatindakan',title:'Tindakan',width:150,align:'left'},
            {field:'ket_lainnya',title:'Tindakan Lain',width:150,align:'left'},
            {field:'date_loss',title:'Tgl Loss',width:120,align:'left'},
            {field:'date_meninggal',title:'Tgl Meninggal',width:120,align:'left'},
            {field:'sebab_kematian',title:'Sebab Kematian',width:150,align:'left'},
            // {field:'action',title:'Hapus',width:80,align:'center',formatter:function(value,row,index){  return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deleteLuaran(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> ';  }  
            // } 
        ]], 
        showFooter:true     
    });

 $('#dgreminder1').datagrid({ 
    width: '100%', 
    height: '500', 
    singleSelect: true, 
    pagination: true, 
    rownumbers: true, 
    collapsible: false, 
    fitColumns: true, 
    nowrap:false,
    idField: 'id', 
    url: 'registerreminder/read1', 
    title: '',
    onDblClickRow:function(){
        //showreminder();
    },
    columns:[[ 
            // {field:'id',title:'id',width:30,align:'left'},  
            {field:'nama',title:'Nama Pasien',width:150,align:'left'},
            {field:'subgrup',title:'Subgrup',width:150,align:'left'},
            //{field:'jmlkunjungan',title:'Jml Followup',width:70,align:'center'},
            {field:'tgl_insert',title:'Tgl Registrasi',width:100,align:'center'},
            {field:'tgl_followup',title:'Tgl Followup',width:100,align:'center'},
            //{field:'tgl_3bln',title:'Tgl Followup Berikutnya',width:130,align:'center'},
            // {field:'selisih',title:'Sisa Hari',width:50,align:'center',styler:cellStyler},
            {field:'selisih',title:'Sisa Hari',width:60,align:'center',styler:cellStyler},
            {field:'nama_unit',title:'Unit',width:100,align:'left'},
            //{field:'followup',title:'Follow up',width:60,align:'center'},
            //{field:'keterangan_reminder',title:'Keterangan',width:100,align:'left'},
            // {field:'action',title:'Stop',width:50,align:'center',formatter:function(value,row,index)
            // {  
            //     return  '<a href="javascript:void(0)" style="text-decoration: none" title="Hapus Data" onClick="deletereminder(\''+row.id+'\');"><img src=\'assets/themes/icons/delete-icon24.png\' border=\'0\'/ class="item-img"></img></a> '; }  
            // }  
            ]]
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
    //document.getElementById("semua").checked=true;
    document.getElementById("all").checked=true;
    document.getElementById("allstatus").checked=true;
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

function styler3bln (value,row,index){
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



function modeinterval(val){
 mode = val;

 if(val=='3bln'){
    //document.getElementById("lbl_interval").innerHTML = ' 3 Bulan';
    document.getElementById('link-3bln').style.cssText = 'color:red;font-weight:bold';
}else{
    document.getElementById('link-3bln').style.cssText = 'color:black;font-weight:normal';
}
if(val=='6bln'){
    document.getElementById('link-6bln').style.cssText = 'color:red;font-weight:bold';
}else{
    document.getElementById('link-6bln').style.cssText = 'color:black;font-weight:normal';
}
if(val=='1thn'){
    document.getElementById('link-1thn').style.cssText = 'color:red;font-weight:bold';
}else{
    document.getElementById('link-1thn').style.cssText = 'color:black;font-weight:normal';
}
if(val=='2thn'){
    document.getElementById('link-2thn').style.cssText = 'color:red;font-weight:bold';
}else{
    document.getElementById('link-2thn').style.cssText = 'color:black;font-weight:normal';
}
if(val=='3thn'){
    document.getElementById('link-3thn').style.cssText = 'color:red;font-weight:bold';
}else{
    document.getElementById('link-3thn').style.cssText = 'color:black;font-weight:normal';
}
if(val=='4thn'){
    document.getElementById('link-4thn').style.cssText = 'color:red;font-weight:bold';
}else{
    document.getElementById('link-4thn').style.cssText = 'color:black;font-weight:normal';
}
if(val=='5thn'){
    document.getElementById('link-5thn').style.cssText = 'color:red;font-weight:bold';
}else{
    document.getElementById('link-5thn').style.cssText = 'color:black;font-weight:normal';
}

doSearch();

}

var mode = '';

function doSearch(){
    var value = $('#search').val();
    var tglkunjungan = $('#key_tglregistrasi').val();
    var tglkunjungan2 = $('#key_tglregistrasi2').val();
    var subgrupid = $('#key_subgrupid').val();
    //var followup = $("input[name='key_followup']:checked").val();
    var hari = $("input[name='key_hari']:checked").val();
    var status = $("input[name='key_status']:checked").val();
    
    $('#dgreminder1').datagrid('reload',{  
        search: value,
        tglkunjungan : tglkunjungan,
        tglkunjungan2 : tglkunjungan2,
        //followup : followup,
        hari : hari,
        subgrupid : subgrupid,
        interval : mode,
        status : status             
    }); 
}

function clearSearch(){

    $('#search').searchbox('clear');
    $('#fm-search').form('clear')
    
    $('#dgreminder1').datagrid('reload',{  
        search: '',
        tglkunjungan : '',
        tglkunjungan2 : '',
        //followup : '',
        hari : '',
        subgrupid : '',
        interval : mode              
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
                $('#dgreminder1').datagrid('reload');    // reload the user data
            }
        }
    });
}

function showreminder(){
    var row = $('#dgreminder1').datagrid('getSelected');
    if(row){
        $('#dlg').dialog('open').dialog('setTitle','Reminder Detail');
        $('#fm').form('load',row)
        document.getElementById('label_noregistrasi').innerHTML = row.noregistrasi;
        document.getElementById('label_nama').innerHTML = row.nama;
        document.getElementById('label_hp').innerHTML = row.no_hp;
        document.getElementById('label_hp2').innerHTML = row.no_hp2;
        url = 'registerreminder/update/'+row.id;
    }else{
    	$.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function deletereminder(id){ 
    if(id){
        $.messager.confirm('Konfirmasi','anda yakin akan stop reminder followup untuk data ini ?',function(r){ 
            if (r){ 
                $.post('registerreminder/delete',
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

function updateluaran(){
    var ui = document.getElementById("uid").value;
    var row = $('#dgreminder1').datagrid('getSelected');
    if(row){
        if(ui==row.unitid){
            $('#dlg-luaran').dialog('open').dialog('setTitle','Update Data Luaran');
            $('#fmluaran').form('clear');
            $('#dgluaran').datagrid('reload','registrasi/readluaran?registrasiid='+row.registerid)
            document.getElementById('labelnoreg').innerHTML = row.noregistrasi;
            document.getElementById('labelnama').innerHTML = row.nama;
            document.getElementById('registrasiid').value = row.registerid;
            with(new Date){
                $('#tgl_abstraksi').datebox('setValue',getFullYear()+"-"+(getMonth()+1<10?'0':'')+(getMonth()+1)+"-"+(getDate()<10?'0':'')+getDate());
            }
            $('#lnk').linkbutton({text:'Simpan'});
            url = 'registrasi/saveluaran'; 
        }else{
            $.messager.alert('Warning','Maaf! Anda tidak bisa edit data ini','warning');
        }
    }else{
        $.messager.alert('Warning','Pilih data terlebih dahulu','warning');
    }
}

function saveluaran(){
    var val = $('#tindakan').combobox('getValues');
    // ubah nilai val jadi string array
    _StrInvitees = String(val);
    $('#tindakan').combobox('setValue', _StrInvitees);

    var st = $("input[name='status']:checked").val();
    if (st){
    progress();  
    $('#fmluaran').form('submit',{

        url: url,
        
        onSubmit: function(){
            //return $(this).form('validate');
            var v = $(this).form('validate');
              if(!v) $.messager.progress('close');  // close the message box
              return v;
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
                $.messager.progress('close');
                $('#lnk').linkbutton({text:'Simpan'});
                url = 'registrasi/saveluaran';
                $.messager.alert('Info','Data Sukses Disimpan','');
                $('#fmluaran').form('clear');

                document.getElementById('registrasiid').value = $('#dgreminder1').datagrid('getSelected').id;
                with(new Date){
                    $('#tgl_abstraksi').datebox('setValue',getFullYear()+"-"+(getMonth()+1<10?'0':'')+(getMonth()+1)+"-"+(getDate()<10?'0':'')+getDate());
                }
                //$('#dlg').dialog('close');        // close the dialog
                $('#dgreminder1').datagrid('reload'); 
                $('#dgluaran').datagrid('reload');    // reload the user data
            }
        }
    });
    }else{
        $.messager.alert('warning','Pilih Status terlebih dahulu','warning');
    }     
}

function editluaran(){
    var row = $('#dgluaran').datagrid('getSelected');
    if(row){

        $('#fmluaran').form('load',row);
        
        opendate(row.status2)
        showstatus2(row.status)
        $('#tindakan').combobox('reload','registrasi/gettatalaksana?id='+row.idtindakan)
        url = 'registrasi/updateluaran/'+row.id;
        $('#lnk').linkbutton({text:'Update'});
    }else{
        $.messager.alert('Warning','Pilih data yang mau diedit','warning');
    }
}

function deleteLuaran(id){ 
    if(id){
        $.messager.confirm('Konfirmasi','yakin akan menghapus data ini ?',function(r){ 
            if (r){ 
                $.post('registrasi/deleteluaran',
                    {id:id},
                    function(result){ 
                    if (result.success){ 
                        $.messager.alert('info','Data telah di hapus !','info');
                    $('#dgluaran').datagrid('reload');
                    $('#dgreminder1').datagrid('reload');  
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

function showstatus2(v){
    if(v==1){
        document.getElementById("statushidup").style.display = '';
        document.getElementById("sebabkematian").style.display = 'none';

        $('#date_loss').datebox('clear');
        $('#date_loss').datebox('readonly');
        $('#date_meninggal').datebox('clear');
        $('#date_meninggal').datebox('readonly');
        
    }else if(v==2){
        document.getElementById("statushidup").style.display = 'none';
        document.getElementById("sebabkematian").style.display = 'none';

        $('#date_loss').datebox('readonly',false);
        $('#date_meninggal').datebox('clear');
        $('#date_meninggal').datebox('readonly');

        $('#date_complete').datebox('clear');
        $('#date_complete').datebox('readonly');
        $('#date_stable').datebox('clear');
        $('#date_stable').datebox('readonly');
        $('#date_relaps').datebox('clear');
        $('#date_relaps').datebox('readonly');
        $('#date_progresif').datebox('clear');
        $('#date_progresif').datebox('readonly');
    
    }else if(v==3){
        document.getElementById("statushidup").style.display = 'none';
        document.getElementById("sebabkematian").style.display = '';
        
        $('#date_loss').datebox('readonly');
        $('#date_loss').datebox('clear');
        $('#date_meninggal').datebox('readonly',false);

        $('#date_complete').datebox('clear');
        $('#date_complete').datebox('readonly');
        $('#date_stable').datebox('clear');
        $('#date_stable').datebox('readonly');
        $('#date_relaps').datebox('clear');
        $('#date_relaps').datebox('readonly');
        $('#date_progresif').datebox('clear');
        $('#date_progresif').datebox('readonly');
    }
}

function showstatus(v){
    if(v==1){
        document.getElementById("statushidup").style.display = '';
        document.getElementById("sebabkematian").style.display = 'none';
        $('#date_loss').datebox('clear');
        $('#date_loss').datebox('readonly');
        $('#date_meninggal').datebox('clear');
        $('#date_meninggal').datebox('readonly');

        $('#date_complete').datebox('clear');
        $('#date_complete').datebox('readonly');
        $('#date_stable').datebox('clear');
        $('#date_stable').datebox('readonly');
        $('#date_relaps').datebox('clear');
        $('#date_relaps').datebox('readonly');
        $('#date_progresif').datebox('clear');
        $('#date_progresif').datebox('readonly');
    }else if(v==2){
        document.getElementById("statushidup").style.display = 'none';
        document.getElementById("sebabkematian").style.display = 'none';
        document.getElementById("cm").checked = false;
        $('#date_complete').datebox('clear');
        $('#date_complete').datebox('readonly');
        document.getElementById("st").checked = false;
        $('#date_stable').datebox('clear');
        $('#date_stable').datebox('readonly');
        document.getElementById("re").checked = false;
        $('#date_relaps').datebox('clear');
        $('#date_relaps').datebox('readonly');
        document.getElementById("pr").checked = false;
        $('#date_progresif').datebox('clear');
        $('#date_progresif').datebox('readonly');
        $('#date_meninggal').datebox('clear');
        $('#rumah_sakit').textbox('clear');
        $('#tindakan').combobox('clear');
        $('#ket_lainnya').textbox('clear');
        $('#sebab_kematian').textbox('clear');
        $('#date_loss').datebox('readonly',false);
        $('#date_meninggal').datebox('readonly');
        // $('#dgriwayat').datagrid('loadData', {"total":0,"rows":[]});
    }else if(v==3){
        document.getElementById("statushidup").style.display = 'none';
        document.getElementById("sebabkematian").style.display = '';
        document.getElementById("cm").checked = false;
        $('#date_complete').datebox('clear');
        $('#date_complete').datebox('readonly');
        document.getElementById("st").checked = false;
        $('#date_stable').datebox('clear');
        $('#date_stable').datebox('readonly');
        document.getElementById("re").checked = false;
        $('#date_relaps').datebox('clear');
        $('#date_relaps').datebox('readonly');
        document.getElementById("pr").checked = false;
        $('#date_progresif').datebox('clear');
        $('#date_progresif').datebox('readonly');
        $('#date_loss').datebox('clear');
        $('#rumah_sakit').textbox('clear');
        $('#tindakan').combobox('clear');
        $('#ket_lainnya').textbox('clear');
        $('#date_loss').datebox('readonly');
        $('#date_meninggal').datebox('readonly',false);
        // $('#dgriwayat').datagrid('loadData', {"total":0,"rows":[]});
    }
    
}

function opendate(v){
    if(v=='cm'){
        $('#date_complete').datebox('readonly',false);

        $('#date_stable').datebox('clear');
        $('#date_relaps').datebox('clear');
        $('#date_progresif').datebox('clear');

        $('#date_stable').datebox('readonly');
        $('#date_relaps').datebox('readonly');
        $('#date_progresif').datebox('readonly');
    }else if(v=='st'){
        $('#date_stable').datebox('readonly',false);

        $('#date_complete').datebox('clear');
        $('#date_relaps').datebox('clear');
        $('#date_progresif').datebox('clear');

        $('#date_complete').datebox('readonly');
        $('#date_relaps').datebox('readonly');
        $('#date_progresif').datebox('readonly');
    }else if(v=='re'){
        $('#date_relaps').datebox('readonly',false);

        $('#date_complete').datebox('clear');
        $('#date_stable').datebox('clear');
        $('#date_progresif').datebox('clear');

        $('#date_complete').datebox('readonly');
        $('#date_stable').datebox('readonly');
        $('#date_progresif').datebox('readonly');
    }else if(v=='pr'){
        $('#date_progresif').datebox('readonly',false);

        $('#date_complete').datebox('clear');
        $('#date_stable').datebox('clear');
        $('#date_relaps').datebox('clear');

        $('#date_complete').datebox('readonly');
        $('#date_stable').datebox('readonly');
        $('#date_relaps').datebox('readonly');
    }
}


