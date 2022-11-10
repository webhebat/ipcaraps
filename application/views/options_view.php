<html>
    <head>
        <meta charset="UTF-8">
        <title>options</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/options.js"></script>
    </head>
    <body>  
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">    
                    </td>  
                    <td>
                        <a style="float:right;" href="options" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                        <a style="float:right"; href="options" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                    </td>                    
                </tr>
            </table>
        </div>
        <br>
        <form id="fm" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
        <table>
                <tr>
                    <td>Nama Options:
                        <input class="easyui-textbox" id="nama_options" name="nama_options" style="width: 200px" required="true"> 
                        Type: 
                        <input class="easyui-textbox" id="type" name="type" style="width: 150px" required="true">
                        Ket: 
                        <input class="easyui-textbox" id="ket" name="ket" style="width: 150px">
                    </td>
                    <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save16'" id="lnk" onclick="saveOptions()">simpan</a></td>
                </tr>
        </table>
        </form>
        <table id="dgoptions"></table>
    </body>
</html>