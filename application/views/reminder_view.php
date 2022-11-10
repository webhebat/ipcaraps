<html>
    <head>
        <meta charset="UTF-8">
        <title>Reminder</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/reminder.js"></script>
        <style type="text/css">
            .datagrid-header-row .datagrid-cell{
              line-height:normal;
              height:auto;
              white-space:normal;
            }
        </style>
    </head>
    <body>  
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">
                        <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="iconCls:'icon-moresearch'" onclick="moresearch()">Filter Pencarian</a>
                        <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="" onclick="clearSearch()">Hapus Filter</a> 
                        <!-- <a href="#" id="link-hijau" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-correct'" onClick="searchkunjungan('hijau')"></a>
                        <a href="#" id="link-kuning" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-uncheck'" onClick="searchkunjungan('kuning')"></a>
                        <a href="#" id="link-merah" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-uncheck'" onClick="searchkunjungan('merah')"></a>
                        <a href="#" id="link-nonvalidate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reset'" onClick="searchkunjungan('')">Semua</a>  -->  
                    </td> 
                    <td>
                        <a style="float:right;" href="reminder" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                        <a style="float:right"; href="reminder" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                    </td>                    
                </tr>
            </table>
        </div>
        <br>
        <table id="dgreminder"></table>

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
                <tr>
                    <td>Followup Pasien</td><td>:</td>
                    <td>
                        <label for="y"><input type="radio" name="followup" id="y" value="y">Sudah</label>
                        <label for="n"><input type="radio" name="followup" id="n" value="n" checked >Belum</label>
                    </td>
                </tr>
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

        <div id="dlg-search" class="easyui-dialog" style="width:500px;height: 270px; top: 100px"
             modal="false" closed="true" closable="false" buttons="#dlg-buttons-search" title="Filter Pencarian">
                <form id="fm-search" method="post"  enctype="multipart/form-data" novalidate style="margin:0; padding:20px">
                    <table>
                        <tr><td>Tgl Kunjungan Terakhir</td><td>:</td><td><input name="key_tglkunjungan" id="key_tglkunjungan" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px" > s/d <input name="key_tglkunjungan2" id="key_tglkunjungan2" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px" ></td>
                        </tr>
                        <tr>
                        <td>Status Followup</td><td>:</td><td><input type="radio" name="key_followup" id="sudah" value="y"><label for="sudah">Sudah</label>
                        <input type="radio" name="key_followup" id="belum" value="n"><label for="belum">Belum</label><input type="radio" name="key_followup" id="semua" value=""><label for="semua">Semua</label></td>
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
                    </table>
                </form>
        </div>

        <div id="dlg-buttons-search">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-moresearch" onclick="doSearch()" style="width:80px">Cari</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-search').dialog('close')" style="width:80px">Tutup</a>
        </div>
    </body>
</html>