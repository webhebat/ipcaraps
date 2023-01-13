<html>

<head>
    <meta charset="UTF-8">
    <title>Register Spesifik Tumor Testis</title>
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/main.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/color.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/demo/demo.css">
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/datagrid-cellediting.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/tumortestis.js"></script>
    <script type="text/javascript">
        function loadsessi() {
            document.getElementById("ssnya").value = "<?php echo $this->session->userdata('nounit'); ?>";
            document.getElementById("usernamenya").value = "<?php echo $this->session->userdata('grupid'); ?>";
        }
    </script>
    <style type="text/css">
        .datagrid-header-row .datagrid-cell {
            line-height: normal;
            height: auto;
            white-space: normal;
        }
    </style>
</head>

<body onload="loadsessi()">
    <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
                <td>
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="tambahspesifik()">Tambah Spesifik</a>
                    <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:250px">
                    <?php if ($this->session->userdata('grupid') == '1' || $this->session->userdata('grupid') == '3') { ?>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>
                    <?php }  ?>
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="manajemenkuratif()">Manajemen Kuratif</a>

                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="followup()">Follow Up</a>
                </td>
                <td>
                    <a style="float:right;" href="tumortestis" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                    <a style="float:right" ; href="tumortestis" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                </td>
            </tr>
            <!-- <tr>
                    <table id="dgshowpasien"></table>
                </tr> -->
        </table>
    </div>

    <br>

    <input type="hidden" id="ssnya">
    <input type="hidden" id="usernamenya">
    <table id="dgtumortestis"></table>

    <div id="dlg" class="easyui-dialog" style="height:95%; width: 100%;top: 30px;" closed="true" buttons="#dlg-buttons" modal="true">
        <form id="fm" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>
                                    Cari Pasien
                                </td>
                                <td>:</td>
                                <td><a class="easyui-linkbutton" value="cari" data-options="iconCls:'icon-user'" onclick="showPasien()">cari</a><input type="hidden" name="registrasiid" id="registrasiid"></td>
                            </tr>
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
            <br>
            <div class="easyui-tabs" data-options="tabWidth:250" style="width:auto;height:auto;">
                <div title="Manifestasi Klinis" style="padding:10px">
                    <table>
                        <tr>
                            <td valign="top" style="padding-right: 30px">
                                <table>
                                    <tr>
                                        <td>Keluhan Utama</td>
                                        <td>:</td>
                                        <td><input name="keluhan_utama" id="keluhan_utama" class="easyui-textbox" style="width:200px;" required></td>
                                    </tr>
                                    <tr id="lainnya_utama" style="display: none">
                                        <td valign="top">Keluhan Utama Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="keluhan_utama_lainnya" id="keluhan_utama_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Usia Saat Keluhan Muncul</td>
                                        <td>:</td>
                                        <td><input name="thn_keluhan" id="thn_keluhan" class="easyui-textbox" style="width:50px"> Thn <input name="bln_keluhan" id="bln_keluhan" class="easyui-textbox" style="width:50px"> Bln <input name="hari_keluhan" id="hari_keluhan" class="easyui-textbox" style="width:50px"> Hari</td>
                                    </tr>
                                    <tr>
                                        <td>Durasi Penyakit</td>
                                        <td>:</td>
                                        <td><input name="durasi_penyakit" id="durasi_penyakit" class="easyui-textbox" style="width:50"> Bulan</td>
                                    </tr>
                                    <tr>
                                        <td>Keluhan Penyerta</td>
                                        <td>:</td>
                                        <td><input id="keluhan_penyerta" name="keluhan_penyerta" style="width:150px"> <input class="easyui-datebox" id="tgl_keluhan" name="tgl_keluhan" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:110px">&nbsp;<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-down'" onclick="tambahpenyerta()">simpan</a></td>
                                    </tr>
                                    <tr id="tgdiagnosis">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <table id="dgpenyerta"></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-delete'" onClick="kosongkanpenyerta()">Hapus</a></td>
                                    </tr>
                                    <tr id="lainnya_penyerta" style="display: none;">
                                        <td valign="top">Keluhan Penyerta Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="keluhan_penyerta_lainnya" id="keluhan_penyerta_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table>
                                    <tr>
                                        <td>Lokasi Tumor</td>
                                        <td>:</td>
                                        <td><input name="lokasi_tumor" id="lokasi_tumor" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi Tumor Lainnya</td>
                                        <td>:</td>
                                        <td><input name="lokasi_tumor_lainnya" id="lokasi_tumor_lainnya" class="easyui-textbox" style="width:250px"></td>
                                    </tr>

                                    <tr>
                                        <td>Suhu</td>
                                        <td>:</td>
                                        <td><input name="suhu" id="suhu" class="easyui-textbox" style="width:75px"> &#8451;</td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Fisik</td>
                                        <td>:</td>
                                        <td><input style="width:250px;height:40px;" id="pemeriksaan_fisik" name="pemeriksaan_fisik"></td>
                                    </tr>
                                    <tr id="trtransilu" style="display: none">
                                        <td>Status Transiluminasi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="transilu" id="transilu1" value="y"><label for="transilu1">Positif</label>
                                            <input type="radio" name="transilu" id="transilu2" value="n"><label for="transilu2">Negatif</label>
                                            <input type="radio" name="transilu" id="transilu3" value="u"><label for="transilu3">Belum Diketahui</label>
                                        </td>
                                    </tr>
                                    <tr id="trlimpa" style="display: none">
                                        <td>Limfadenopati</td>
                                        <td>:</td>
                                        <td><input type="text" class="easyui-textbox" id="nama_limfadenopati" name="nama_limfadenopati" style="width: 250px"></td>
                                    </tr>

                                    <tr id="lainnya_fisik" style="display: none">
                                        <td valign="top">Pemeriksaan Fisik Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="pemeriksaan_fisik_lainnya" id="pemeriksaan_fisik_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>

                                    <tr>
                                        <td>Jenis Pemeriksaan</td>
                                        <td>:</td>
                                        <td><input name="jenis_pemeriksaan" id="jenis_pemeriksaan" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr id="lainnya_jpemeriksaan" style="display: none">
                                        <td valign="top">Isi Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="jenis_pemeriksaan_lainnya" id="jenis_pemeriksaan_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran</td>
                                        <td>:</td>
                                        <td><input name="ukuran" id="ukuran" class="easyui-textbox" style="width:75px"> cm</td>
                                    </tr>
                                    <tr>
                                        <td>Permukaan</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="permukaan" id="permukaan1" value="l"><label for="permukaan1">Rata</label>
                                            <input type="radio" name="permukaan" id="permukaan2" value="2"><label for="permukaan2">Berbenjol</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Konsistensi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="konsistensi" id="konsistensi1" value="l"><label for="konsistensi1">Padat</label>
                                            <input type="radio" name="konsistensi" id="konsistensi2" value="2"><label for="konsistensi2">Sebagian padat</label>
                                            <input type="radio" name="konsistensi" id="konsistensi3" value="3"><label for="konsistensi3">Kristik</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobilitas</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="mobilitas" id="mobilitas1" value="l"><label for="mobilitas1">Mobile</label>
                                            <input type="radio" name="mobilitas" id="mobilitas2" value="2"><label for="mobilitas2">Immobile</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nyeri tekan</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="nyeritekan" id="nyeritekan1" value="l"><label for="nyeritekan1">Positif</label>
                                            <input type="radio" name="nyeritekan" id="nyeritekan2" value="2"><label for="nyeritekan2">Negatif</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanner Stage</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="tanner_stage" id="t1" value="l"><label for="t1">1</label>
                                            <input type="radio" name="tanner_stage" id="t2" value="2"><label for="t2">2</label>
                                            <input type="radio" name="tanner_stage" id="t3" value="3"><label for="t3">3</label>
                                            <input type="radio" name="tanner_stage" id="t4" value="4"><label for="t4">4</label>
                                            <input type="radio" name="tanner_stage" id="t5" value="5"><label for="t5">5</label>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table>
                    </table>
                </div>
                <div title="Pemeriksaan & Staging" style="padding:10px">
                    <table>
                        <tr>
                            <td valign="top" style="padding-right: 30px">
                                <table>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">Pemeriksaan Darah</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Periksa Darah</td>
                                        <td>:</td>
                                        <td><input name="tgl_periksadarah" id="tgl_periksadarah" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Pemeriksaan darah dan elektrolit</td>
                                        <td valign="top">:</td>
                                        <td>
                                            <table id="dgdarah"></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">Pemeriksaan Penanda Tumor</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Pemeriksaan</td>
                                        <td>:</td>
                                        <td><input name="tgl_periksatumor" id="tgl_periksatumor" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                                    </tr>
                                    <tr>
                                        <td>AFP</td>
                                        <td>:</td>
                                        <td><input name="afp" id="afp" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>LDH</td>
                                        <td>:</td>
                                        <td><input name="ldh" id="ldh" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>HCG</td>
                                        <td>:</td>
                                        <td><input name="hcg" id="hcg" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>Ca 125</td>
                                        <td>:</td>
                                        <td><input name="ca125" id="ca125" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>Ca 19-9</td>
                                        <td>:</td>
                                        <td><input name="ca199" id=" " class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>CEA</td>
                                        <td>:</td>
                                        <td><input name="cea" id="cea" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>Lainnya</td>
                                        <td>:</td>
                                        <td><input name="lainnya_tumor" id="lainnya_tumor" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" style="padding-right: 30px">
                                <table>

                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">USG</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>USG</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="usg" id="usg1" value="n"><label for="usg1">Tidak</label>
                                            <input type="radio" name="usg" id="usg2" value="y"><label for="usg2">Ya</label>
                                        </td>
                                    </tr>
                                    <div style="display: none">
                                        <tr>
                                            <td>Tgl USG</td>
                                            <td>:</td>
                                            <td><input class="easyui-datebox" name="tgl_usg" id="tgl_usg" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi massa primer</td>
                                            <td>:</td>
                                            <td><input name="massa_primer" id="massa_primer" class="easyui-textbox" style="width:250px"> </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">Keterlibatan KGB Regional</td>
                                            <td valign="top">:</td>
                                            <td>
                                                <input type="radio" name="kgb" id="kgb1" value="n"><label for="kgb1">Tidak</label>
                                                <input type="radio" name="kgb" id="kgb2" value="y"><label for="kgb2">Ya</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan Lainnya</td>
                                            <td>:</td>
                                            <td><input name="usg_lainnya" id="usg_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                        </tr>
                                    </div>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">CT SCAN</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CT SCAN</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="ctscan" id="ctscan1" value="n"><label for="ctscan1">Tidak</label>
                                            <input type="radio" name="ctscan" id="ctscan2" value="y"><label for="ctscan2">Ya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl CT SCAN</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_ctscan" id="tgl_ctscan" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi massa primer</td>
                                        <td>:</td>
                                        <td><input name="lokasi_primer_ctscan" id="lokasi_primer_ctscan" class="easyui-textbox" style="width:250px"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Keterlibatan KGB Regional</td>
                                        <td valign="top">:</td>
                                        <td>
                                            <input type="radio" name="kgb_ctscan" id="kgb1_ctscan" value="n"><label for="kgb1_ctscan">Tidak</label>
                                            <input type="radio" name="kgb_ctscan" id="kgb2_ctscan" value="y"><label for="kgb2_ctscan">Ya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Abnormalitas Genitourinary</td>
                                        <td valign="top">:</td>
                                        <td>
                                            <input type="radio" name="abnormalitas_ctscan" id="abnormalitas1_ctscan" value="n"><label for="abnormalitas1_ctscan">Tidak</label>
                                            <input type="radio" name="abnormalitas_ctscan" id="abnormalitas2_ctscan" value="y"><label for="abnormalitas2_ctscan">Ya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan lainnya</td>
                                        <td>:</td>
                                        <td><input name="ctscan_lainnya" id="ctscan_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">MRI</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MRI</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="mri" id="mri1" value="n"><label for="mri1">Tidak</label>
                                            <input type="radio" name="mri" id="mri2" value="y"><label for="mri2">Ya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl CT SCAN</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_mri" id="tgl_mri" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi massa primer</td>
                                        <td>:</td>
                                        <td><input name="lokasi_primer_mri" id="lokasi_primer_mri" class="easyui-textbox" style="width:250px"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Keterlibatan KGB Regional</td>
                                        <td valign="top">:</td>
                                        <td>
                                            <input type="radio" name="kgb_mri" id="kgb1_mri" value="n"><label for="kgb1_mri">Tidak</label>
                                            <input type="radio" name="kgb_mri" id="kgb2_mri" value="y"><label for="kgb2_mri">Ya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan lainnya</td>
                                        <td>:</td>
                                        <td><input name="mri_lainnya" id="mri_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">Chest X-ray</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Chest X-ray</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="xray" id="xray1" value="n"><label for="xray1">Tidak</label>
                                            <input type="radio" name="xray" id="xray2" value="y"><label for="xray2">Ya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl X-ray</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_xray" id="tgl_xray" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><input name="opt_xray" id="opt_xray" class="easyui-textbox" style="width:200px"></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan lainnya</td>
                                        <td>:</td>
                                        <td><input name="xray_lainnya" id="xray_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">Histopatologi</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Histopatologi</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_histopatologi" id="tgl_histopatologi" data-options="formatter:myformatter,parser:myparser" style="width:120px">&nbsp;<input type="radio" name="histopatologi" id="histopatologi1" value="n"><label for="histopatologi1">Teratoma Matur</label>
                                            <input type="radio" name="histopatologi" id="histopatologi2" value="y"><label for="histopatologi2">Teratoma Imatur</label>&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input name="opt_histopatologi" id="opt_histopatologi" class="easyui-textbox" style="width:200px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan lainnya</td>
                                        <td>:</td>
                                        <td><input name="histopatologi_lainnya" id="histopatologi_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staging FIGO 2018</td>
                                        <td>:</td>
                                        <td><input name="figo2018" id="figo2018" class="easyui-textbox" style="width:250px"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stratifikasi</td>
                                        <td>:</td>
                                        <td><input name="stratifikasi" id="stratifikasi" class="easyui-textbox" style="width:250px"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Infeksi</td>
                                        <td>:</td>
                                        <td><input name="diagnosis_infeksi" id="diagnosis_infeksi" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Non Infeksi</td>
                                        <td>:</td>
                                        <td><input name="diagnosis_noninfeksi" id="diagnosis_noninfeksi" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div title="Pilihan Manajemen" style="padding:10px">
                    <table>
                        <tr>
                            <td valign="top" style="padding-right: 30px">
                                <table>
                                    <tr>
                                        <td width="200">Manajemen Kuratif</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="kuratif" id="ky" value="y" onClick="showtrkuratif('y')"><label for="ky">Ya</label>
                                            <input type="radio" name="kuratif" id="kn" value="n" onClick="showtrkuratif('n')"><label for="kn">Tidak</label>
                                            <input type="radio" name="kuratif" id="ku" value="u" onClick="showtrkuratif('u')"><label for="ku">Belum Diketahui</label>
                                        </td>
                                    </tr>
                                    <tr id="trkuratif" style="display: none">
                                        <td>Alasan Kuratif Tidak Diberikan</td>
                                        <td>:</td>
                                        <td>
                                            <input style="width:250px;" id="nonkuratif" name="nonkuratif">
                                        </td>
                                    </tr>
                                    <tr id="trnonkuratif" style="display:none">
                                        <td valign="top">Alasan Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="alasan_tidak_lainnya" id="alasan_tidak_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Manajemen Paliatif</td>
                                        <td>:</td>
                                        <td width="250">
                                            <input type="radio" name="paliatif" id="py" value="y" onClick="showtrpaliatif('y')"><label for="py">Ya</label>
                                            <input type="radio" name="paliatif" id="pn" value="n" onClick="showtrpaliatif('n')"><label for="pn">Tidak</label>
                                            <input type="radio" name="paliatif" id="pu" value="u" onClick="showtrpaliatif('u')"><label for="pu">Belum Diketahui</label>
                                        </td>
                                    </tr>
                                    <tr id="trpaliatif" style="display: none;">
                                        <td>Pilih Manajemen Paliatif</td>
                                        <td>:</td>
                                        <td>
                                            <input style="width:250px;" id="optpaliatif" name="optpaliatif">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table>
                                    <tr id="trsymtoms" style="display: none;">
                                        <td>Pilih Symtoms Management</td>
                                        <td>:</td>
                                        <td>
                                            <input style="width:250px;" id="optpain" name="optpain">
                                        </td>
                                    </tr>
                                    <tr id="trpain" style="display: none;">
                                        <td>Symtoms Management Lainnya</td>
                                        <td>:</td>
                                        <td><input name="pain_lainnya" id="pain_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr id="trobatkemo" style="display: none;">
                                        <td>Obat Kemoterapi</td>
                                        <td>:</td>
                                        <td><input name="obat_kemo" id="obat_kemo" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr id="trtglmulaikemo" style="display: none;">
                                        <td>Tgl Mulai Kemoterapi</td>
                                        <td>:</td>
                                        <td><input name="tgl_mulaikemo" id="tgl_mulaikemo" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                                    </tr>
                                    <tr id="trtglakhirkemo" style="display: none;">
                                        <td>Tgl Selesai Kemoterapi</td>
                                        <td>:</td>
                                        <td><input name="tgl_selesaikemo" id="tgl_selesaikemo" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                                    </tr>
                                    <tr id="trjmlsiklus" style="display: none;">
                                        <td>Jml Siklus</td>
                                        <td>:</td>
                                        <td><input name="jml_siklus" id="jml_siklus" class="easyui-textbox" style="width:100px"></td>
                                    </tr>
                                    <tr id="trterapi" style="display: none">
                                        <td>Lokasi Radioterapi</td>
                                        <td>:</td>
                                        <td>
                                            <input style="width:250px;" id="lokasi_radioterapi" name="lokasi_radioterapi">
                                        </td>
                                    </tr>
                                    <tr id="trradioterapi" style="display: none">
                                        <td>Lokasi Lainnya</td>
                                        <td>:</td>
                                        <td><input name="radioterapi_lainnya" id="radioterapi_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr id="troperasi" style="display: none">
                                        <td>Pilihan Operasi</td>
                                        <td>:</td>
                                        <td>
                                            <input style="width:250px;" id="lokasi_operasi" name="lokasi_operasi">
                                        </td>
                                    </tr>
                                    <tr id="troperasi_lainnya" style="display: none">
                                        <td>Operasi Lainnya</td>
                                        <td>:</td>
                                        <td><input name="operasi_lainnya" id="operasi_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" id="btnlink" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="save()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Batal</a>
    </div>
    <div id="dlg-kuratif" class="easyui-dialog" style="height:95%; width: 100%;top: 30px;" closed="true" buttons="#dlg-buttons-kuratif" modal="true">
        <form id="fm-kuratif" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>No Registasi</td>
                                <td>:</td>
                                <td><strong><span id="label_noregistrasi2"></span></strong></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><span id="label_namalengkap2"></span></strong></td>
                                <td width="50px"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><strong><span id="label_jkelamin2"></span></strong></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><strong><span id="label_nohp2"></span></strong></td>
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
                                    <div class="ftitle">Kemoterapi</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Kemoterapi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="kemoterapi" id="kemoterapi1" value="y" required><label for="kemoterapi1">Ya</label>
                                    <input type="radio" name="kemoterapi" id="kemoterapi2" value="n"><label for="kemoterapi2" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Fase Kemoterapi</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="fase_kemo" id="fase_kemo" style="width:150px" data-options="editable:false,panelHeight:'auto'" required>
                                        <option value="Induksi">Induksi</option>
                                        <option value="Konsolidasi">Konsolidasi</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Pilihan</td>
                                <td>:</td>
                                <td><input name="protokol" id="protokol" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Siklus</td>
                                <td>:</td>
                                <td><input name="siklus" id="siklus" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Tgl Mulai</td>
                                <td>:</td>
                                <td><input name="tgl_mulai" id="tgl_mulai" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"><input type="hidden" name="tumortestisid" id="tumortestisid"></td>
                                <td width="20px"></td>
                            </tr>
                            <tr>
                                <td>Tgl Selesai</td>
                                <td>:</td>
                                <td><input name="tgl_selesai" id="tgl_selesai" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>

                            <tr>
                                <td>Ketepatan</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="ketepatan" id="ketepatan" style="width:150px" data-options="editable:false,panelHeight:'auto'">
                                        <option value="-">-</option>
                                        <option value="Tepat">Tepat waktu</option>
                                        <option value="Dropout">Drop out</option>
                                        <option value="Intermiten">Intermiten</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Hasil Evaluasi</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="evaluasi" id="evaluasi" style="width:150px" data-options="editable:false,panelHeight:'auto'">
                                        <option value="-">-</option>
                                        <option value="complete">Complete response</option>
                                        <option value="partial">Partial response</option>
                                        <option value="steable">Steable diseas</option>
                                        <option value="progresif">Progresif</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Efek Samping Kemo</td>
                                <td>:</td>
                                <td><input name="efeksamping" id="efeksamping" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Terapi Suportif</td>
                                <td>:</td>
                                <td><input name="terapisuportif" id="terapisuportif" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">Radioterapi</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Radioterapi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="radioterapi" id="radioterapi1" value="y"><label for="radioterapi1">Ya</label>
                                    <input type="radio" name="radioterapi" id="radioterapi2" value="n"><label for="radioterapi2" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Metode</td>
                                <td>:</td>
                                <td><input name="metoderadioterapi" id="metoderadioterapi" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Metode Lainnya</td>
                                <td>:</td>
                                <td><input name="metoderadioterapi_lainnya" id="metoderadioterapi_lainnya" class="easyui-textbox" style="width:200px;"></td>
                            </tr>

                            <tr>
                                <td>Tgl Mulai</td>
                                <td>:</td>
                                <td><input name="tgl_mulairadioterapi" id="tgl_mulairadioterapi" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                                <td width="20px"></td>
                            </tr>
                            <tr>
                                <td>Tgl Selesai</td>
                                <td>:</td>
                                <td><input name="tgl_selesairadioterapi" id="tgl_selesairadioterapi" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Pembedahan</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="pembedahan" id="pembedahan1" value="y"><label for="pembedahan1">Ya</label>
                                    <input type="radio" name="pembedahan" id="pembedahan2" value="n"><label for="pembedahan2" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Pembedahan</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="jenis_pembedahan" id="jenis_pembedahan" style="width:150px" data-options="editable:false,panelHeight:'auto'">
                                        <option value="-">-</option>
                                        <option value="complete">Complete resection</option>
                                        <option value="konservatif">Konservatif</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Pembedahan Lainnya</td>
                                <td>:</td>
                                <td><input name="jenis_pembedahan_lainnya" id="jenis_pembedahan_lainnya" class="easyui-textbox" style="width:250px;"></td>
                            </tr>
                            <tr>
                                <td>Tgl Pembedahan</td>
                                <td>:</td>
                                <td><input name="tgl_pembedahan" id="tgl_pembedahan" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>Temuan intraoperasi</td>
                                <td>:</td>
                                <td><input name="intraoperasi" id="intraoperasi" class="easyui-textbox" style="width:250px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </form>
        <p style="color: red">*untuk edit, double click pada data lalu klik tombol update</p>
        <table id="dgkuratif" style="padding-right:10px"></table>
    </div>
    <div id="dlg-buttons-kuratif">
        <a href="javascript:void(0)" id="btnlinkkuratif" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="savekuratif()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-kuratif').dialog('close')" style="width:90px">Close</a>
    </div>

    <div id="dlg-followup" class="easyui-dialog" style="height:95%; width: 100%;top: 30px;" closed="true" buttons="#dlg-buttons-followup" modal="true">
        <form id="fm-followup" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>No Registasi</td>
                                <td>:</td>
                                <td><strong><span id="label_noregistrasi_f"></span></strong><input type="hidden" name="tumortestisid_f" id="tumortestisid_f"></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><span id="label_namalengkap_f"></span></strong></td>
                                <td width="50px"></td>
                            </tr>

                            <tr>
                                <td>Tgl Abstraksi</td>
                                <td>:</td>
                                <td><input name="tgl_abstraksi_f" id="tgl_abstraksi_f" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><strong><span id="label_jkelamin_f"></span></strong></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><strong><span id="label_nohp_f"></span></strong></td>
                            </tr>
                            <tr>
                                <td>Evaluasi Klinis</td>
                                <td>:</td>
                                <td><input name="evaluasi_klinis" id="evaluasi_klinis" class="easyui-textbox" style="width:100%;height:40px" data-options="multiline:true"></td>
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
                                    <div class="ftitle">USG</div>
                                </td>
                            </tr>
                            <tr>
                                <td>USG</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="usg_f" id="usg_f1" value="n"><label for="usg_f1">Tidak</label>
                                    <input type="radio" name="usg_f" id="usg_f2" value="y"><label for="usg_f2">Ya</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl USG</td>
                                <td>:</td>
                                <td><input class="easyui-datebox" name="tgl_usg_f" id="tgl_usg_f" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                </td>
                            </tr>
                            <tr>
                                <td>Kesan</td>
                                <td>:</td>
                                <td><input name="kesan_usg" id="kesan_usg" class="easyui-textbox" style="width:100%;" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>Penanda Tumor</td>
                                <td>:</td>
                                <td><input name="penanda_tumor" id="penanda_tumor" class="easyui-textbox" style="width:100%;"></td>
                            </tr>
                            <tr>
                                <td>Penanda Tumor Lainnya</td>
                                <td>:</td>
                                <td><input name="penanda_tumor_lainnya" id="penanda_tumor_lainnya" class="easyui-textbox" style="width:100%;" data-options="multiline:true"></td>
                            </tr>

                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">Histopatologi</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Histopatologi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="histopatologi_f" id="histopatologi_f1" value="n"><label for="histopatologi_f1">Tidak</label>
                                    <input type="radio" name="histopatologi_f" id="histopatologi_f2" value="y"><label for="histopatologi_f2">Ya</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Pemeriksaan</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="jenis_histopatologi_f" id="jenis_histopatologi_f" style="width:150px" data-options="editable:false,panelHeight:'auto'">
                                        <option value="-">-</option>
                                        <option value="FNAB">FNAB</option>
                                        <option value="Biopsi">Biopsi Eksisi</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Hispatologi Lainnya</td>
                                <td>:</td>
                                <td><input name="histopatologi_f_lainnya" id="histopatologi_f_lainnya" class="easyui-textbox" style="width:100%;" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>Tgl Pemeriksaan</td>
                                <td>:</td>
                                <td><input class="easyui-datebox" name="tgl_histopatologi_f" id="tgl_histopatologi_f" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                </td>
                            </tr>
                            <tr>
                                <td>Kesan Histopatologi</td>
                                <td>:</td>
                                <td><input name="kesan_histopatologi" id="kesan_histopatologi" class="easyui-textbox" style="width:100%;" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">MRI</div>
                                </td>
                            </tr>
                            <tr>
                                <td>MRI</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="mri_f" id="mri_f1" value="n"><label for="mri_f1">Tidak</label>
                                    <input type="radio" name="mri_f" id="mri_f2" value="y"><label for="mri_f2">Ya</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Pemeriksaan</td>
                                <td>:</td>
                                <td><input class="easyui-datebox" name="tgl_pemeriksaan_mri" id="tgl_pemeriksaan_mri" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                </td>
                            </tr>
                            <tr>
                                <td>Kesan MRI</td>
                                <td>:</td>
                                <td><input name="kesan_mri" id="kesan_mri" class="easyui-textbox" style="width:100%;" data-options="multiline:true"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </form>
        <p style="color: red">*untuk edit, double click pada data lalu klik tombol update</p>
        <table id="dgfollowup" style="padding-right:10px"></table>
    </div>

    <div id="dlg-buttons-followup">
        <a href="javascript:void(0)" id="btnlinkfollowup" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="savefollowup()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-followup').dialog('close')" style="width:90px">Close</a>
    </div>

    <div id="dlg-luaran" class="easyui-dialog" style="height:95%; width: 100%;top: 30px;" closed="true" buttons="#dlg-buttons-luaran" modal="true">
        <form id="fm-luaran" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>No Registasi</td>
                                <td>:</td>
                                <td><strong><span id="label_noregistrasi4"></span></strong><input type="hidden" name="tumortestisid3" id="tumortestisid3"></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><span id="label_namalengkap4"></span></strong></td>
                                <td width="50px"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><strong><span id="label_jkelamin4"></span></strong></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><strong><span id="label_nohp4"></span></strong></td>
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
                                <td>Tgl Abstraksi</td>
                                <td>:</td>
                                <td><input name="tgl_abstraksi" id="tgl_abstraksi" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>Ultrasonografi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="ultrasonografi" id="ultrasonografi1" value="1"><label for="ultrasonografi1">Positif Wilms tumor</label>
                                    <input type="radio" name="ultrasonografi" id="ultrasonografi2" value="2"><label for="ultrasonografi2">Negatif Wilms tumor</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input name="tgl_periksa_sonografi" id="tgl_periksa_sonografi" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>CT SCAN</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="ctscan_l" id="ctscan_l1" value="1"><label for="ctscan_l1">Positif Wilms tumor</label>
                                    <input type="radio" name="ctscan_l" id="ctscan_l2" value="2"><label for="ctscan_l2">Negatif Wilms tumor</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input name="tgl_periksa_ctscan" id="tgl_periksa_ctscan" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">Bagian Kiri</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Remisi</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="remisi" id="remisi" style="width:150px" data-options="editable:false,panelHeight:'auto'">
                                        <option value="0">-</option>
                                        <option value="1">Tidak ada regresi</option>
                                        <option value="2">Regresi parsial</option>
                                        <option value="3">Regresi komplit</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tipe regresi</td>
                                <td>:</td>
                                <td><input name="regresi" id="regresi" class="easyui-textbox" style="width:200px;"></td>

                            </tr>
                            <tr>
                                <td>Rekurensi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="rekurensi" id="rekurensi1" value="y" required><label for="rekurensi1">Ya</label>
                                    <input type="radio" name="rekurensi" id="rekurensi2" value="n"><label for="rekurensi2" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Durasi sejak terapi pertama</td>
                                <td>:</td>
                                <td><input name="bln_rekurensi" id="bln_rekurensi" class="easyui-textbox" style="width:100px"> Bulan</td>
                            </tr>
                            <tr>
                                <td>Komplikasi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="komplikasi" id="komplikasi1" value="y" required><label for="komplikasi1">Ya</label>
                                    <input type="radio" name="komplikasi" id="komplikasi2" value="n"><label for="komplikasi2" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan socket/prostesis</td>
                                <td>:</td>
                                <td>
                                    <input name="b_prostesis" id="b_prostesis" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan kemoterapi</td>
                                <td>:</td>
                                <td>
                                    <input name="b_kemoterapi" id="b_kemoterapi" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan penyakitnya</td>
                                <td>:</td>
                                <td>
                                    <input name="b_penyakitnya" id="b_penyakitnya" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan radiasi</td>
                                <td>:</td>
                                <td>
                                    <input name="b_radiasi" id="b_radiasi" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="3">
                                    <div class="ftitle">Bagian Kanan</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Remisi</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="remisi2" id="remisi2" style="width:150px" data-options="editable:false,panelHeight:'auto'">
                                        <option value="0">-</option>
                                        <option value="1">Tidak ada regresi</option>
                                        <option value="2">Regresi parsial</option>
                                        <option value="3">Regresi komplit</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tipe regresi</td>
                                <td>:</td>
                                <td><input class="easyui-textbox" name="regresi2" id="regresi2" style="width:200px;">
                                </td>
                            </tr>
                            <tr>
                                <td>Rekurensi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="rekurensi2" id="rekurensi11" value="y" required><label for="rekurensi11">Ya</label>
                                    <input type="radio" name="rekurensi2" id="rekurensi22" value="n"><label for="rekurensi22" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Durasi sejak terapi pertama</td>
                                <td>:</td>
                                <td><input name="bln_rekurensi2" id="bln_rekurensi2" class="easyui-textbox" style="width:100px"> Bulan</td>
                            </tr>
                            <tr>
                                <td>Komplikasi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="komplikasi2" id="komplikasi12" value="y" required><label for="komplikasi12">Ya</label>
                                    <input type="radio" name="komplikasi2" id="komplikasi22" value="n"><label for="komplikasi22" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan socket/prostesis</td>
                                <td>:</td>
                                <td>
                                    <input name="b_prostesis2" id="b_prostesis2" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan kemoterapi</td>
                                <td>:</td>
                                <td>
                                    <input name="b_kemoterapi2" id="b_kemoterapi2" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan penyakitnya</td>
                                <td>:</td>
                                <td>
                                    <input name="b_penyakitnya2" id="b_penyakitnya2" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan radiasi</td>
                                <td>:</td>
                                <td>
                                    <input name="b_radiasi2" id="b_radiasi2" class="easyui-textbox" style="width:250px">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </form>
        <p style="color: red">*untuk edit, double click pada data lalu klik tombol update</p>
        <table id="dgluaran" style="padding-right:10px"></table>
    </div>
    <div id="dlg-buttons-luaran">
        <a href="javascript:void(0)" id="btnlinkluaran" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="saveluaran()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-luaran').dialog('close')" style="width:90px">Close</a>
    </div>

    <div id="dlg-pasien" class="easyui-dialog" style="width:80%;height: 450px; top: 20px" modal="true" closed="true" closable="false" buttons="#dlg-buttons-pasien" title="Filter Pencarian">
        <form id="fm-pasien" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <input class="easyui-searchbox" id="search-pasien" name="search-pasien" style="width:200px">
            <table id="datapasien"></table>
        </form>
    </div>

    <div id="dlg-buttons-pasien">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-moresearch" style="width:80px" onclick="selectPasien()">Pilih</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-pasien').dialog('close')" style="width:80px">Tutup</a>
    </div>
</body>

</html>