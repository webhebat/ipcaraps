<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/menu.js"></script>
    </head>
    <body>
        <h2>List menu
            <a href="menu" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
            <a style="float:right;" href="menu" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
        </h2>   
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onclick="add()">Tambah</a>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onclick="edit()">Edit</a>    
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>              
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">
                                      
                        <!--<span style="float:right;font-size: 12"> Active 
                            <select class="easyui-combobox" name="keyactive" id="keyactive" style="width:60px;" panelHeight="auto">
                                    <option value="" selected="selected">-All-</option>
                                    <option value="y">Aktif</option>
                                    <option value="n">InAktif</option>
                                </select>
                        <span>-->      
                    </td>                      
                </tr>
            </table>
        </div>
        <br>
        <table id="dgmenu"></table>
    
        <div id="dlg" class="easyui-dialog" style="width:450px;top: 100px" closed="true" buttons="#dlg-buttons" modal="true">
            <form id="fm" method="post" novalidate style="margin:0; padding:20px">
                <table>
                    <tr>
                        <td>Nama Menu</td><td>:</td><td><input name="nama_menu" id="nama_menu" class="easyui-textbox" required="true" style="width: 250px" ></td>
                    </tr>
                    <tr>
                        <td>Level Menu</td><td>:
                        <td><select name="level_menu" id="level_menu" class="easyui-combobox" style="width:120px" data-options="panelHeight:50, onChange: function(rec){
                            showlevel(rec);
                        }" required="true">
                                <option value="utama">Utama</option>
                                <option value="submenu">Sub Menu</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Menu Parent</td><td>:</td><td><input id="id_parent" name="id_parent" style="width: 250px" required="true" /></td>
                    </tr>
                    <tr>
                        <td>Nama File</td><td>:</td><td><input name="nama_file" id="nama_file" class="easyui-textbox" style="width: 250px" required="true"></td>
                    </tr>
                    <tr>
                        <td>Icon</td><td>:</td><td><input name="icon" id="icon" class="easyui-textbox" style="width: 200px"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td><td>:</td><td><input name="keterangan" id="keterangan" class="easyui-textbox" style="width: 250px" ></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
        </div>
   
    </body>
</html>