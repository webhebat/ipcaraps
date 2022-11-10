<html>
    <head>
        <meta charset="UTF-8">
        <title>user</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/user.js"></script>
    </head>
    <body>
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onclick="add()">Tambah</a>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onclick="edit()">Edit</a>    
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="removedata()">Aktif/Non Aktif</a>              
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">    
                    </td>  
                    <td>
                        <a style="float:right;" href="user" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                        <a style="float:right;" href="user" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
            
                    </td>                    
                </tr>
            </table>
        </div>
        <br>
        <table id="dguser"></table>

        <div id="dlg" class="easyui-dialog" style="top:100px" closed="true" buttons="#dlg-buttons" modal="true">
            <form id="fm" method="post" novalidate style="margin:0; padding:20px;">
                <table>
                    <tr>
                        <td>Grup User</td><td>:</td><td><input name="group" id="group" required="true" style="width: 200px" ></td>
                    </tr>
                    <tr>
                        <td>Unit</td><td>:</td><td><input name="unitid" id="unitid" required="true" style="width: 200px">
                    </tr>
                    <tr>
                        <td>Nama</td><td>:</td><td><input name="first_name" id="first_name" class="easyui-textbox" required="true" style="width: 200px" ></td>
                    </tr>
                    <tr>
                        <td>Email</td><td>:</td><td><input name="email" id="email" class="easyui-textbox" required="true" style="width: 200px" ></td>
                    </tr>
                    <tr>
                        <td>User Name</td><td>:</td><td><input name="username" id="username" class="easyui-textbox" required="true" style="width: 200px" ></td>
                    </tr>
                    <div id="pass">
                    <tr>
                        <td>Password</td><td>:</td><td><input name="password" id="password" class="easyui-textbox" required="true" style="width: 200px" ></td>
                    </tr>
                   </div>
                   <!-- <tr>
                        <td>Aktif</td><td>:</td><td><input type="radio" name="active" id="aktif1" value="1" checked>Yes
                            <input type="radio" name="active" id="aktif2" value="0">No</td>
                    </tr>-->
                </table>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
        </div>
   
    </body>
</html>