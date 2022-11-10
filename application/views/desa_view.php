<html>
    <head>
        <meta charset="UTF-8">
        <title>desa</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/desa.js"></script>
    </head>
    <body>  
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <!-- <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onclick="add()">Tambah</a>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onclick="edit()">Edit</a>    
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>   -->          
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">    
                    </td>  
                    <td>
                        <a style="float:right;" href="desa" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                        <a style="float:right"; href="desa" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                    </td>                    
                </tr>
            </table>
        </div>
        <br>
        <table id="dgdesa"></table>

        <div id="dlg" class="easyui-dialog" style="width:400px;top: 50px"
            closed="true" buttons="#dlg-buttons" modal="true">
            <form id="fm" method="post" novalidate style="margin:0; padding:20px">
                <table>
                    <tr>
                        <td>Nama desa</td><td>:</td><td><input name="desa" id="desa" class="easyui-textbox" style="width:200px" required="true" ></td>
                    </tr>
                    <!-- <tr>
                        <td>Kecamatan</td><td>:</td><td><input name="camatid" id="camatid" style="width: 200px" required="true"></td>
                    </tr> -->
                    <tr>
                        <td>Kelurahan</td><td>:</td>
                        <td><label for="yes"><input type="radio" name="kelurahan" id="yes" value="1">Ya</label>
                            <label for="no"><input type="radio" name="kelurahan" id="no" value="0" checked >Bukan</td></label>
                    </tr>
                    <tr>
                        <td>Latitude</td><td>:</td><td><input name="lat" id="lat" class="easyui-textbox" style="width:200px" ></td>
                    </tr>
                    <tr>
                        <td>Longitude</td><td>:</td><td><input name="lng" id="lng" class="easyui-textbox" style="width:200px"  ></td>
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