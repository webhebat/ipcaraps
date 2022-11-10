<html>
    <head>
        <meta charset="UTF-8">
        <title>Register Followup Reminder</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/registerreminder.js"></script>
         <script type="text/javascript">
            function loadsessi(){
                document.getElementById("uid").value = "<?php echo $this->session->userdata('unitid');?>";
            }
        </script>
        <style type="text/css">
            .datagrid-header-row .datagrid-cell{
              line-height:normal;
              height:auto;
              white-space:normal;
            }
        </style>
    </head>
    <body onload="loadsessi()">  
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">
                        <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="iconCls:'icon-moresearch'" onclick="moresearch()">Filter Pencarian</a>
                        <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="" onclick="clearSearch()">Hapus Filter</a> 

                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-followup" onclick="updateluaran()">Update / Followup</a>  
                        <!-- <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="iconCls:'icon-moresearch'" onclick="moresearch()">Filter Pencarian</a>
                        <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="" onclick="clearSearch()">Hapus Filter</a> --> 
                        <!-- <a href="#" id="link-hijau" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-correct'" onClick="searchkunjungan('hijau')"></a>
                        <a href="#" id="link-kuning" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-uncheck'" onClick="searchkunjungan('kuning')"></a>
                        <a href="#" id="link-merah" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-uncheck'" onClick="searchkunjungan('merah')"></a>
                        <a href="#" id="link-nonvalidate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reset'" onClick="searchkunjungan('')">Semua</a>  -->  
                    </td> 
                    <td>
                        <a style="float:right;" href="registerreminder" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                        <a style="float:right"; href="registerreminder" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                        
                    </td>                    
                </tr>
            </table>
        </div>
         <input type="hidden" id="uid">
        <!-- <br>
        <table id="dgreminder"></table> -->
        <br>
        <table>
            <tr>
                <td>Pilih Interval Followup :</td>
                <td>
                    <a href="#" id="link-3bln" class="easyui-linkbutton" data-options="plain:true" onClick="modeinterval('3bln')">3 Bulan</a>
                    <a href="#" id="link-6bln" class="easyui-linkbutton" data-options="plain:true" onClick="modeinterval('6bln')">6 Bulan</a>
                    <a href="#" id="link-1thn" class="easyui-linkbutton" data-options="plain:true" onClick="modeinterval('1thn')">1 Tahun</a>
                    <a href="#" id="link-2thn" class="easyui-linkbutton" data-options="plain:true" onClick="modeinterval('2thn')">2 Tahun</a>
                    <a href="#" id="link-3thn" class="easyui-linkbutton" data-options="plain:true" onClick="modeinterval('3thn')">3 Tahun</a>
                    <a href="#" id="link-4thn" class="easyui-linkbutton" data-options="plain:true" onClick="modeinterval('4thn')">4 Tahun</a>
                    <a href="#" id="link-5thn" class="easyui-linkbutton" data-options="plain:true" onClick="modeinterval('5thn')">5 Tahun</a>      
                </td>
            </tr>
        </table>
       <br>
       
       <table id="dgreminder1"></table>
       <div id="dlg" class="easyui-dialog" style="width:450px;top: 50px"
       closed="true" buttons="#dlg-buttons" modal="true">
            <form id="fm" method="post" novalidate style="margin:0; padding:20px">
                <table>
                <tr>
                    <td>No Registrasi</td><td>:</td><td><strong><span id="label_noregistrasi"></span></strong></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td><td>:</td><td><strong><span id="label_nama"></span></strong></td>
                </tr>
                <tr>
                    <td>No HP</td><td>:</td><td><strong><span id="label_hp"></span></strong></td>
                </tr>
                <tr>
                    <td>No HP2</td><td>:</td><td><strong><span id="label_hp2"></span></strong></td>
                </tr>
                <!-- <tr>
                    <td>Followup Pasien</td><td>:</td>
                    <td>
                        <label for="y"><input type="radio" name="followup" id="y" value="y">Sudah</label>
                        <label for="n"><input type="radio" name="followup" id="n" value="n" checked >Belum</label>
                    </td>
                </tr> -->
                <tr>
                    <td valign="top">Keterangan</td><td valign="top">:</td><td><input name="keterangan_reminder" id="keterangan_reminder" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true" ></td>
                </tr>
                </table>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" onclick="savereminder()" style="width:90px">Update</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Close</a>
        </div>

        <div id="dlg-search" class="easyui-dialog" style="width:550px;height: 270px; top: 100px"
             modal="false" closed="true" closable="false" buttons="#dlg-buttons-search" title="Filter Pencarian">
                <form id="fm-search" method="post"  enctype="multipart/form-data" novalidate style="margin:0; padding:20px">
                    <table>
                        <tr><td>Tgl Registrasi</td><td>:</td><td><input name="key_tglregistrasi" id="key_tglregistrasi" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px" > s/d <input name="key_tglregistrasi2" id="key_tglregistrasi2" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px" ></td>
                        </tr>
                        <tr>
                        <td>Kriteria Sisa Hari</td><td>:</td><td>
                            <input type="radio" name="key_hari" id="hijau" value="hijau"><label for="hijau">Hijau</label>
                            <input type="radio" name="key_hari" id="kuning" value="kuning"><label for="kuning">Kuning</label>
                            <input type="radio" name="key_hari" id="merah" value="merah"><label for="merah">Merah</label>
                            <input type="radio" name="key_hari" id="all" value=""><label for="all">Semua</label>
                        </tr>
                        <tr>
                            <td>Subgrup</td><td>:</td><td><input name="key_subgrupid" id="key_subgrupid" style="width:200px" ></td>
                        </tr>
                        <tr>
                        <td>Status </td><td>:</td><td>
                            <input type="radio" name="key_status" id="satu" value="satu"><label for="satu">Hidup</label>
                            <input type="radio" name="key_status" id="dua" value="dua"><label for="dua">Loss to follow up</label>
                            <input type="radio" name="key_status" id="tiga" value="tiga"><label for="tiga">Meninggal</label>
                            <input type="radio" name="key_status" id="allstatus" value=""><label for="allstatus">Semua</label>
                        </tr>
                    </table>
                </form>
        </div>
        <div id="dlg-buttons-search">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-moresearch" onclick="doSearch()" style="width:80px">Cari</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-search').dialog('close')" style="width:80px">Tutup</a>
        </div>

        <div id="dlg-luaran" class="easyui-dialog" style="height:90%; width: 100%; " closed="true" top="50px" buttons="#dlg-buttons-luaran" modal="true">
            <form id="fmluaran" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td width="150">No Registrasi</td><td>:</td><td><strong><span id="labelnoreg"></span></strong><input type="hidden" name="registrasiid" id="registrasiid"></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td><td>:</td><td><strong><span id="labelnama"></span></strong></td>
                            </tr>
                            <tr>
                                <td>Tgl Abstraksi</td><td>:</td><td><input name="tgl_abstraksi" id="tgl_abstraksi" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true" ></td>
                            </tr>
                            <tr>
                                <td>Status</td><td>:</td>
                                <td >
                                   <input type="radio" name="status" id="1" value="1" onclick="showstatus('1')"><label for="1">Hidup</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                   <input type="radio" name="status" id="2" value="2" onclick="showstatus('2')"><label for="2">Loss to follow up - </label><input name="date_loss" id="date_loss" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                                <td>
                                </td>
                                <td width="100px"> 
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                   <input type="radio" name="status" id="3" value="3" onclick="showstatus('3')"><label for="3">Meninggal - </label><input name="date_meninggal" id="date_meninggal" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                            </tr>
                            
                            <tr id="sebabkematian" style="display: none">
                                <td>Sebab Kematian</td><td>:</td>
                                <td >
                                   <input id="sebab_kematian" name="sebab_kematian" class="easyui-textbox" style="height:60px" data-options="multiline:true">
                                </td>
                            </tr>

                            <tbody id="statushidup" style="display:none">
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td></td><td></td>
                                <td><input type="radio" name="status2" id="cm" value="cm" onclick="opendate('cm')"><label for="cm">Complete Remission / response </label></td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input name="date_complete" id="date_complete" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input type="radio" name="status2" id="st" value="st" onclick="opendate('st')"><label for="st">Stable Disease </label>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td > 
                                   <input name="date_stable" id="date_stable" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input type="radio" name="status2" id="re" value="re" onclick="opendate('re')"><label for="re">Relaps </label>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input name="date_relaps" id="date_relaps" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input type="radio" name="status2" id="pr" value="pr" onclick="opendate('pr')"><label for="pr">Progresif </label>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input name="date_progresif" id="date_progresif" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            </tbody>
                            <tr>
                                <td>Nama Rumah Sakit</td><td>:</td>
                                <td >
                                   <input type="text" name="rumah_sakit" id="rumah_sakit" class="easyui-textbox" style="width:200px">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>Tindakan</td><td>:</td>
                                <td >
                                   <input name="tindakan" id="tindakan" >
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr >
                                <td>Ket Tindakan Lainnya</td><td>:</td>
                                <td >
                                   <input id="ket_lainnya" name="ket_lainnya" class="easyui-textbox" style="height:60px" data-options="multiline:true">
                                </td>
                            </tr>
                            
                        </table>
                    </td>
                    </form>
                    <td valign="top">
                        <table id="dgluaran"></table>
                    </td>
                </tr>
            </table>

        </div>
        <div id="dlg-buttons-luaran">
            <div style="text-align: left">
                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="saveluaran()" style="width:100px" id="lnk" data-options="iconCls:'icon-save'">Simpan</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-luaran').dialog('close')" style="width:90px">Tutup</a>
            </div>
        </div>

    </body>
</html>