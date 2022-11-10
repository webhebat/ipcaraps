    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>IP-CAR Indonesian Pediatric Cancer Registry</title>
        <link rel="icon" href="<?= base_url();?>assets/themes/icons/favicon.ico" type="image/ico">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/themes/material/styles.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?= base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url();?>assets/jquery.easyui.min.js"></script>
        <style type="text/css">
    /*zains connect*/
    *{margin: 0;padding: 0;}
    
    #boxscroll {
        padding: 0px;
        height: 100%;
        width: 100%;
        border: 2px solid #669900;
        overflow: auto;
        margin: 0px;
    }
    
    #status {
      position: fixed;
      width: 100%;
      font: bold 1em sans-serif;
      color: #FFF;
      padding: 2.2em;
      text-align: center;
      z-index:99;
      display: none;
    }

    #log {
      padding: 2.5em 0.5em 0.5em;
      font: 1em sans-serif;
    }

    .online {
      background: rgba(0, 255, 0, 0.6);
    }

    .offline {
      background: rgba(255, 0, 0, 0.6);
    }
    
    /*zains*/
    .ftitle{
        font-size:14px;
        font-weight:bold;
        color:#666;
        padding:5px 0;
        margin-bottom:10px;
        border-bottom:1px solid #ccc;
    }       .menu_body4 li.alt{background:#F0F0F0 ;}
    .products{
        overflow:auto;
        height:100%;
    }
    .products ul{
        list-style:none;
        margin:0;
        padding:0px;
    }
    .products li{
        display:inline;
        float:left;
        margin:10px;
    }
    .item{
        text-decoration:none;
    }
    .item img{
        border:1px solid #333;
    }
    .item p{
        margin:0;
        font-weight:bold;
        text-align:center;
        color:black;
    }
    .cart{
        float:right;
        position:relative;
        width:260px;
        height:100%;
        background:#ccc;
        padding:0px 10px;
    }
</style>
    </head>
    <body onload="showMenu('dashboard','Dashboard')" id="LayoutWest" class="easyui-layout layout panel-noscroll" >
            <div data-options="region:'north',border:false" style= "padding:0px; height:73px; padding:0px; ">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                        <td style="vertical-align:bottom;height:65px;">
                            <div style="float:left;width:170px;padding-left:5px;padding-top: 5px"><a href="<?=  base_url();?>"><img src="<?=  base_url();?>assets/login/img/logo.png" height="65" width="140" alt="logo.png"></a></div><br/><br/><br/>
                            <div ><span id="datenow" style="padding-left: 0px;font-size: 11px;></span></div>
                            <div id="menubutton" style="display:none;padding:5px;border:0px solid #ddd;"></div>
                        </td>
                        <td align="right" style="width:400px;vertical-align:top;" >
                            <div style="padding:5px;border:0px solid #ddd;padding-top:15px;">
                                <a href="#" class="easyui-menubutton" data-options="menu:'#xx1',iconCls:'icon-user'"><strong>Hai,</strong> <?=  $this->session->userdata("nama");?><input type="hidden" id="hideuser" name="hideuser"  value="<?=  $this->session->userdata("username"); ?>"><input type="hidden" id="hideid" name="hideid"  value="<?=  $this->session->userdata("user_id"); ?>"><input type="hidden" id="nounit" name="nounit"  value="<?=  $this->session->userdata("nounit"); ?>"></a>
                                <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-help'" onclick="#"><strong>Help</strong></a>
                            </div>
                
                            <div id="xx1" style="width:150px;">
                                <!--<div data-options="iconCls:'icon-profile'">Profile</div>-->
                                <div data-options="iconCls:'icon-changepassword'" onClick="showpassword();" >Ganti Password</div>
                                <div data-options="iconCls:'icon-logout'" class="linkbos" onClick="logout()">Logout</div>
                            </div>
                        
                        </td>
                    </tr>
                </table>
            </div>
            <div align="right" class="accordion-body" style="height:20px; padding:2px; " data-options="region:'south',border:false">
                <span style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:11px;"><?=  $this->session->userdata("namaunit").'('.$this->session->userdata("grupname").')'; ?> IP-Car Indonesian Cancer Registry &copy; <!--[php]--><?=  date("Y"); ?> Powered by tim IT &nbsp; &nbsp; </span>
            </div>
            

            <div id="LayoutCenter" data-options="region:'center'">
                <div class="easyui-tabs" data-options="fit:true,border:false" id="tt" tabPosition="top" style="overflow:hidden !important; -webkit-overflow-scrolling:touch !important;">
                </div>
            </div>
            <div id="dlgcp" class="easyui-dialog" title="Ganti Password" data-options="modal:true,closable:true,maximizable: false,minimizable: false,closed:true,collapsible:false" style="width:300px;height:230px;padding:10px;" buttons="#dlgcp-button">
                    <form id="fmcp" method="post">
                        <div style="padding:5px;">
                            <!--<div style="margin-bottom:20px">
                            <input class="easyui-textbox" id="cpusername" id="cpusername" prompt="Username" iconWidth="28" style="width:100%;height:34px;padding:10px;" readonly="true">
                            </div>-->
                            <input type="hidden" id="iduser" name="iduser">
                            <div style="margin-bottom:20px">
                                <input id="pass" name="pass" class="easyui-passwordbox" prompt="Password baru" iconWidth="28" required="true" style="width:100%;height:34px;padding:10px">
                            </div>
                            <div style="margin-bottom:20px">
                                <input class="easyui-passwordbox" prompt="Ulangi password baru" iconWidth="28" validType="confirmPass['#pass']" required="true" style="width:100%;height:34px;padding:10px">
                            </div>
                        </div>
                    </form>
            </div>
            <div id="dlgcp-button">
                <a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="ChangePassword();">Save</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="$('#dlgcp').dialog('close');">Cancel</a>
            </div>
    </body>
    <script type="text/javascript">
       $(function(){
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var thisDay = date.getDay(),
                thisDay = myDays[thisDay];
            var yy = date.getYear();
            var year = (yy < 1000) ? yy + 1900 : yy;
            var result = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
            document.getElementById('datenow').innerHTML= result;

            $.extend($.fn.validatebox.defaults.rules, {
                confirmPass: {
                    validator: function(value, param){
                        var pass = $(param[0]).passwordbox('getValue');
                        return value == pass;
                    },
                    message: 'Password yang anda inputkan tidak sama'
                }
            })

            LoadMenu('','','');

       });

    function LoadMenu(url_modul,file,menu_name){ 
        for (var i=0;i<10;i++){
            $('#tt').tabs('close',i);
        }   
        for (var i=0;i<10;i++){
            $('#tt').tabs('close',i);
        }               
        /*create accordion*/
        $('#LayoutWest').layout('remove', 'west');
        $('#LayoutWest').layout('add', { id:'content_west', region:'west', width: 180, split:true, title:'DAFTAR MENU', href:'home/menu'});
        $('#w').window('close');  
     
        if (file!='undefined'){
            /*$('#tt').tabs('add',{
                title: menu_name,
                content : '<iframe scrolling=\'yes\' frameborder=\'0\'  src=\'?'+url_modul+'&file='+file+'\' style=\'width:100%;height:100%;\'></iframe>',
                closable: true
            });*/
        }
    }
        
    function logout(){
        window.location.href='<?=  base_url();?>auth/logout';
    }

    function showpassword(){
        $('#dlgcp').dialog('open').dialog('center');
        $('#fmcp').form('clear');
        document.getElementById('iduser').value=$('#hideid').val();
    }

    function ChangePassword(){
        /*var msg='';
        if ($('#password_new').val()!=$('#password_new_c').val()){
            msg +=  'Password do not match !<br>';
        }
        if (($('#password_new').val()) &&($('#password_new').val().length<7)){
            msg +=  'New Password > 6 character !<br>';
        }
        if (($('#password_new_c').val()) &&($('#password_new_c').val().length<7)){
            msg +=  'Confirm New Password > 6 character !<br>';
        }
        if (msg){
            $.messager.show({
                title: 'Information',
                msg: msg,
                maximizable: false
            });         }
        else{*/
            $('#fmcp').form('submit',{
                url: 'auth/changepassword',
                onSubmit: function(){
                    return $(this).form('validate');                    },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                        msg = 'Password sukses diganti, silahkan login dengan password anda yang baru !';
                        $('#dlgcp').dialog('close');
                    } else {
                        msg = result.msg;
                    }
                    $.messager.show({
                        title: 'Information',
                        msg: msg,
                        maximizable: false
                    });
                }
            }); 
            //}
    }

    function showMenu(url_menu,title){
        if ($('#tt').tabs('exists', title)){
           $('#tt').tabs('select', title);
        } else {
            $('#tt').tabs('add',{
                title: title,
                content : '<iframe scrolling=\'yes\' frameborder=\'0\' style=\'width:100%;height:99%;\' src='+url_menu+'></iframe>',
                closable: true
           });
        }
    }

    function addTab(title, url){
    if ($('#tt').tabs('exists', title)){
        $('#tt').tabs('select', title);
    } else {
        var content = '<iframe scrolling="yes" frameborder="0" src="'+url+'" style="width:100%;height:98%;"></iframe>';         
            $('#tt').tabs('add',{
                title:title,
                content:content,
                closable:true
            });
    }
}

    </script>
    </html>