<html>
    <head>
        <meta charset="UTF-8">
        <title>Peta Sebaran</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <!-- <link rel="stylesheet" type="text/css" href="<?php //base_url();?>assets/themes/material/main.css"> -->
        <!-- <link rel="stylesheet" type="text/css" href="<?php //base_url();?>assets/themes/material/styles.css"> -->
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php base_url();?>assets/themes/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/all.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/adminlte.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/_small-box.scss">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/_backgrounds.scss"> 
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/leaflet/leaflet.css"/>
        <link rel="stylesheet" href="<?php base_url();?>assets/markercluster/dist/MarkerCluster.css" />
        <link rel="stylesheet" href="<?php base_url();?>assets/markercluster/dist/MarkerCluster.Default.css" />
       
        <style type="text/css">
          #mapid { height: 80%; }
          #mapid2 { height: 80%; }
        </style>

    </head>
    <body>
      <div id="tbOutlet" style="padding:5px;border-radius:5px; border:1px solid #ddd">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
         <tr>
          <td width="100">Berdasarkan :</td>
          <td  style="float: left;">
            <select class="easyui-combobox" name="key_kategori" id="key_kategori" data-options="panelHeight:'auto',editable:false" >
              <option value="propinsi">Propinsi</option>
              <option value="kabupaten">Kabupaten</option>
            </select>
            Subgrup : 
            <input name="key_subgrupid" id="key_subgrupid" >
            <a href="#" class="easyui-linkbutton" iconCls="icon-show" id="button">Tampilkan</a>
          </td>
          <td>
            <a style="float:right;" href="petasebaran" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
            <a style="float:right"; href="petasebaran" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
          </td>                    
        </tr>
      </table>
    </div>
    <br>  

      <!-- Main content -->
      <section class="content">
        <div id="mapid" style="display: '' "></div>
        <div id="mapid2"></div>
      </section>
      <!-- /.content -->
   
    </body>

      <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
      <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
      <script src="<?php base_url();?>assets/leaflet/leaflet.js"></script>
      <script src="<?php base_url();?>assets/markercluster/dist/leaflet.markercluster-src.js"></script>
      <script type="text/javascript" src="<?php base_url();?>assets/js/petasebaran.js"></script>
      
</html>