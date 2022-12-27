<html>

<head>
    <meta charset="UTF-8">
    <title>Rekam Medik</title>
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/main.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/color.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/demo/demo.css">
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/datagrid-cellediting.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/rekammedik.js"></script>
    <script type="text/javascript">
        function loadsessi() {
            document.getElementById("uid").value = "<?php echo $this->session->userdata('unitid'); ?>";
            document.getElementById("grupid").value = "<?php echo $this->session->userdata('grupid'); ?>";
        }
    </script>
</head>

<body onload="loadsessi()">
    <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
                <?php if ($this->session->userdata('grupid') != '4') { ?>
                    <td>
                        Cari & Pilih Pasien : <input id="searchPasien" name="searchPasien" style="width: 250px">

                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>
                    </td>
                <?php }  ?>
                <?php if ($this->session->userdata('grupid') == '4') { ?>
                    <td>
                        <a href="#" id="btn-validasi" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onClick="validasirekam()">Validasi</a>
                        <a href="#" id="link-validate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-correct'" onClick="searchvalidate('y')"></a>
                        <a href="#" id="link-nonvalidate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-uncheck'" onClick="searchvalidate('n')"></a>
                        <a href="#" id="link-nonvalidate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-uncheck'" onClick="searchvalidate('')">Semua</a>
                    </td>
                <?php } ?>
                <td>
                    <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">
                    <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="iconCls:'icon-moresearch'" onclick="moresearch()">Filter Pencarian</a>
                    <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="" onclick="clearSearch()">Hapus Filter</a>
                </td>
                <td>
                    <a style="float:right;" href="rekammedik" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                    <a style="float:right" ; href="rekammedik" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                </td>
            </tr>
            <!-- <tr>
                    <table id="dgshowpasien"></table>
                </tr> -->
        </table>
    </div>

    <br>
    <input type="hidden" id="uid">
    <input type="hidden" id="grupid">

    <table id="dgrekammedik"></table>

    <div id="dlg" class="easyui-dialog" style="height:95%; width: 100%;top: 30px;" closed="true" buttons="#dlg-buttons" modal="true">
        <form id="fm" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><span id="label_namalengkap"></span></strong></td>
                                <td width="50px"></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><strong><span id="label_nik"></span></strong></td>
                            </tr>
                            <tr>
                                <td>Tempat/Tgl Lahir</td>
                                <td>:</td>
                                <td><strong><span id="label_ttl"></span></strong></td>
                            </tr>
                            <tr>
                                <td>No Registasi</td>
                                <td>:</td>
                                <td><strong><span id="label_noregistrasi"></span></strong></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><strong><span id="label_jkelamin"></span></strong></td>
                            </tr>
                            <tr>
                                <td>No Rekam Medis</td>
                                <td>:</td>
                                <td><strong><span id="label_norekam"></span></strong></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><strong><span id="label_nohp"></span></strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">SUBJECT</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Kunjungan</td>
                                <td>:</td>
                                <td><input name="tgl_kunjungan" id="tgl_kunjungan" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"><input type="hidden" name="registrasiid" id="registrasiid"></td>
                                <td width="50px"></td>
                            </tr>
                            <tr>
                                <td>Tujuan / Keluhan Utama Kedatangan</td>
                                <td>:</td>
                                <td><input name="keluhan_utama" id="keluhan_utama" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr id="trsiklus" style="display: none;">
                                <td>Siklus Ke</td>
                                <td>:</td>
                                <td><input name="sikluske" id="sikluske" class="easyui-textbox" style="width:50px"></td>
                            </tr>
                            <tr id="trkomplikasi" style="display: none">
                                <td>Ket Komplikasi Penyakit Dasar</td>
                                <td>:</td>
                                <td><input name="komplikasi_penyakit_dasar" id="komplikasi_penyakit_dasar" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr id="trkomplikasikemo" style="display: none">
                                <td>Komplikasi Kemoterapi</td>
                                <td>:</td>
                                <td><input name="komplikasi_kemoterapi" id="komplikasi_kemoterapi" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr id="trinfeksi" style="display: none">
                                <td>Infeksi</td>
                                <td>:</td>
                                <td><input name="infeksi_kemo" id="infeksi_kemo" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr id="trnoninfeksi" style="display: none">
                                <td>Non Infeksi</td>
                                <td>:</td>
                                <td><input name="non_infeksi_kemo" id="non_infeksi_kemo" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr id="trkeluhanlain" style="display: none">
                                <td>Keluhan/tujuan Lain - lain</td>
                                <td>:</td>
                                <td><input name="keluhan_utama_lainnya" id="keluhan_utama_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr id="trevaluasi" style="display: none">
                                <td>Evaluasi Pengobatan</td>
                                <td>:</td>
                                <td><input name="evaluasi_pengobatan" id="evaluasi_pengobatan" class="easyui-textbox" style="width:200px;"> - <input name="tgl_evaluasi" id="tgl_evaluasi" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr id="trevaluasilain" style="display: none">
                                <td>Evaluasi Lainnya</td>
                                <td>:</td>
                                <td><input name="evaluasi_pengobatan_lain" id="evaluasi_pengobatan_lain" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">ASSESSMENT</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Diagnosis Tambahan Infeksi</td>
                                <td>:</td>
                                <td><input name="tambahan_infeksi" id="tambahan_infeksi" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>Diagnosis Tambahan Non Infeksi</td>
                                <td>:</td>
                                <td><input name="tambahan_non_infeksi" id="tambahan_non_infeksi" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">PLAN</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Plan</td>
                                <td>:</td>
                                <td><input name="plan" id="plan" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr id="trplanlain" style="display: none">
                                <td>Plan Lainnya</td>
                                <td>:</td>
                                <td><input name="plan_lainnya" id="plan_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">OBJECTIVE</div>
                                </td>
                            </tr>
                            <tr>
                                <td width="170">Pemeriksaan Fisik</td>
                                <td>:</td>
                                <td><input name="periksa_fisik" id="periksa_fisik" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr id="trukuran" style="display: none">
                                <td>Ukuran Tumor</td>
                                <td>:</td>
                                <td><input name="ukuran_tumor" id="ukuran_tumor" class="easyui-textbox" style="width:100px"> cm</td>
                            </tr>
                            <tr id="trlimpa" style="display: none">
                                <td>Lokasi Limpadenopati</td>
                                <td>:</td>
                                <td><input name="lokasi_tumor" id="lokasi_tumor" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr id="trhepar" style="display: none">
                                <td>Besar Hepar</td>
                                <td>:</td>
                                <td><input name="besar_hepar" id="besar_hepar" class="easyui-textbox" style="width:100px"> cm BAC</td>
                            </tr>
                            <tr id="trlien" style="display: none">
                                <td>Besar Lien</td>
                                <td>:</td>
                                <td><input name="besar_lien" id="besar_lien" class="easyui-textbox" style="width:100px"> cm - schuffner : <input name="schuffner" id="schuffner" class="easyui-textbox" style="width:100px">
                            </tr>
                            <tr id="trfisiklain" style="display: none">
                                <td>Pemeriksaan Fisik Lainnya</td>
                                <td>:</td>
                                <td><input name="fisik_lainnya" id="fisik_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <td>Tgl Periksa Lab</td>
                            <td>:</td>
                            <td><input name="tgl_periksa_lab" id="tgl_periksa_lab" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                </tr>
                <tr>
                    <td>Hemoglobin</td>
                    <td>:</td>
                    <td><input name="hemoglobin" id="hemoglobin" class="easyui-textbox" style="width:100px"> g/dL</td>
                </tr>
                <tr>
                    <td>Leukosit</td>
                    <td>:</td>
                    <td><input name="leukosit" id="leukosit" class="easyui-textbox" style="width:100px"> x10<sup>3</sup>uL</td>
                </tr>
                <tr>
                    <td>Trombosit</td>
                    <td>:</td>
                    <td><input name="trombosit" id="trombosit" class="easyui-textbox" style="width:100px"> x10<sup>3</sup>uL</td>
                </tr>
                <tr>
                    <td>Blast</td>
                    <td>:</td>
                    <td><input name="blast" id="blast" class="easyui-textbox" style="width:100px"> %</td>
                </tr>
                <tr>
                    <td>Tumor Marker</td>
                    <td>:</td>
                    <td><input name="tumor_marker" id="tumor_marker" class="easyui-textbox" style="width:250px"></td>
                </tr>
                <tr>
                    <td>Hasil</td>
                    <td>:</td>
                    <td><input name="hasil" id="hasil" class="easyui-textbox" style="width:250px"></td>
                </tr>
            </table>
            </td>
            </tr>
            </table>
        </form>
        <br><br><br>
        <table id="dghistory"></table>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" id="btnlink" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="save()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Close</a>
    </div>
    <div id="dlg-search" class="easyui-dialog" style="width:500px;height: 250px; top: 100px" modal="false" closed="true" closable="false" buttons="#dlg-buttons-search" title="Filter Pencarian">
        <form id="fm-search" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:20px">
            <table>
                <tr>
                    <td>Tgl Kunjungan</td>
                    <td>:</td>
                    <td><input name="key_tgldatang" id="key_tgldatang" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px"> s/d <input name="key_tgldatang2" id="key_tgldatang2" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px"></td>
                </tr>
                <tr>
                    <td>Status Validasi</td>
                    <td>:</td>
                    <td><input type="radio" name="key_validasi" id="sudah" value="y"><label for="sudah">Sudah divalidasi</label>
                        <input type="radio" name="key_validasi" id="belum" value="n"><label for="belum">Belum divalidasi</label><input type="radio" name="key_validasi" id="semua" value=""><label for="semua">Semua</label>
                    </td>
                </tr>
                <tr>
                    <td>Subgrup</td>
                    <td>:</td>
                    <td><input name="key_subgrupid" id="key_subgrupid" style="width:200px"></td>
                </tr>
                <tr>
                    <td>Unit</td>
                    <td>:</td>
                    <td><input name="key_unitid" id="key_unitid" style="width:200px"></td>
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