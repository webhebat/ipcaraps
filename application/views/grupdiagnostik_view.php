<html>
    <head>
        <meta charset="UTF-8">
        <title>Grup Diagnostik</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/grupdiagnostik.js"></script>
    </head>
    <body>  
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onclick="add()">Tambah</a>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onclick="edit()">Edit</a>    
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>              
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">    
                    </td>  
                    <td>
                        <a style="float:right;" href="grupdiagnostik" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                        <a style="float:right"; href="grupdiagnostik" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                    </td>                    
                </tr>
            </table>
        </div>
        <br>
        <table id="dggrupdiagnostik"></table>

        <div id="dlg" class="easyui-dialog" style="auto;top: 50px"
            closed="true" buttons="#dlg-buttons" modal="true">
            <form id="fm" method="post" novalidate style="margin:0; padding:20px">
                <table>
                    <tr>
                        <td>Kode</td><td>:</td><td><input name="kode" id="kode" class="easyui-numberbox" style="width:100px" required="true"><input type="hidden" name="h_kode" id="h_kode"></td>
                    </tr>
                    <tr>
                        <td>Grup Diagnostik</td><td>:</td><td><input name="grupdiagnostik" id="grupdiagnostik" class="easyui-textbox" style="width:100%;height:50px" data-options="multiline:true" required="true"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Simpan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Batal</a>
        </div>
   
    </body>
</html>