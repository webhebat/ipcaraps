<html>

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/easyui.css">
  <!-- <link rel="stylesheet" type="text/css" href="<?php 
                                                    ?>assets/themes/material/main.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?php 
                                                    ?>assets/themes/material/styles.css"> -->
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/color.css">
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/demo/demo.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php base_url(); ?>assets/themes/ionicons.min.css">
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/all.css">
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/adminlte.css">
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/_small-box.scss">
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/_backgrounds.scss">
  <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/highcharts/css/style.css">

  <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.min.js"></script>
  <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="<?php base_url(); ?>assets/js/dashboard.js"></script>
  <script src="<?php base_url(); ?>assets/highcharts/highcharts.js"></script>
  <script src="<?php base_url(); ?>assets/highcharts/data.js"></script>
  <script src="<?php base_url(); ?>assets/highcharts/drilldown.js"></script>
  <script src="<?php base_url(); ?>assets/highcharts/exporting.js"></script>
  <script src="<?php base_url(); ?>assets/highcharts/export-data.js"></script>
  <script src="<?php base_url(); ?>assets/highcharts/accessibility.js"></script>
  <script src="<?php base_url(); ?>assets/highcharts/accounting.min.js"></script>
</head>

<body>
  <div id="tbOutlet" style="padding:5px;border-radius:5px; border:1px solid #ddd">
    <table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="70">Kategori :</td>
        <td style="float: left;">
          <select class="easyui-combobox" name="key_kategori" id="key_kategori" data-options="panelHeight:'auto',editable:false">
            <option value="jkelamin">Jenis Kelamin</option>
            <option value="propinsi">Propinsi</option>
            <option value="subgrup">Subgrup</option>
          </select>
          Subgrup :
          <input name="key_subgrupid" id="key_subgrupid">
          <select class="easyui-combobox" name="key_jtanggal" id="key_jtanggal" data-options="panelHeight:'auto',editable:false">
            <option value="by_tglinput">Tanggal Input</option>
            <option value="by_tgldiagnosis">Tanggal Diagnosis</option>
          </select>
          <input name="key_tgl" id="key_tgl" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px"> s/d <input name="key_tgl2" id="key_tgl2" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px">
          <input name="key_unitid" id="key_unitid" style="width:200px">
          <a href="#" class="easyui-linkbutton" iconCls="icon-show" onClick="show()">Tampilkan</a>
        </td>
        <td>
          <a style="float:right;" href="dashboard" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
          <a style="float:right" ; href="dashboard" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
        </td>
      </tr>
    </table>
  </div>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-10 col-12">
          <div id="container" style="min-width: 310px; min-height: 500px; height:auto, margin: 0 auto"></div>
        </div>
        <div class="col-lg-2 col-12">
          <div class="row">
            <div class="col-lg-12">

              <div class="small-box bg-info">
                <div class="inner">
                  <h3><span id="jmlpasien"></span></h3>
                  <p>Registrasi Pasien</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-stalker"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>

              <div class="small-box bg-success">
                <div class="inner">
                  <h3><span id="validate"></span></h3>
                  <p>Sudah Divalidasi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>

              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><span id="notvalidate"></span></h3>
                  <p>Belum Divalidasi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>

              <!-- <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><span id="unfollowup"></span></h3>
                          <p>Belum Follow up</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-clock"></i>
                        </div>
                         <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
                    </div> -->

            </div>
          </div>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

</body>

</html>