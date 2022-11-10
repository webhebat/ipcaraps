<html>

<head>
    <meta charset="UTF-8">
    <title>Register Spesifik Nheproblastoma</title>
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/main.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/color.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/demo/demo.css">
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/datagrid-cellediting.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/nheproblastoma.js"></script>
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

                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="luaran()">Luaran dan Komplikasi</a>
                </td>
                <td>
                    <a style="float:right;" href="nheproblastoma" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                    <a style="float:right" ; href="nheproblastoma" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
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
    <table id="dgnheproblastoma"></table>

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
                                        <td>Lokasi</td>
                                        <td>:</td>
                                        <td><input type="checkbox" name="lokasi1" id="lokasi1" value="1"><label for="lokasi1">Abdomen dextra</label><input type="checkbox" name="lokasi2" id="lokasi2" value="1"><label for="lokasi2">Abdomen sinistra</label><input type="checkbox" name="lokasi3" id="lokasi3" value="1"><label for="lokasi3">Bilateral</label></td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Fisik</td>
                                        <td>:</td>
                                        <td><input style="width:250px;height:40px;" id="pemeriksaan_fisik" name="pemeriksaan_fisik"></td>
                                    </tr>
                                    <tr id="trlimpa" style="display: none">
                                        <td>Limfadenopati</td>
                                        <td>:</td>
                                        <td><input type="text" class="easyui-textbox" id="nama_limfadenopati" name="nama_limfadenopati" style="width: 250px"></td>
                                    </tr>
                                    <tr id="trhepar" style="display: none">
                                        <td>Besar Hepar</td>
                                        <td>:</td>
                                        <td><input type="text" class="easyui-textbox" id="besar_hepar" name="besar_hepar" style="width: 100px"> cm BAC</td>
                                    </tr>
                                    <tr id="trspleen" style="display: none">
                                        <td>Besar Spleen</td>
                                        <td>:</td>
                                        <td><input type="text" class="easyui-textbox" id="besar_spleen" name="besar_spleen" style="width: 100px"> cm /schuffner <input type="text" class="easyui-textbox" id="besar_schuffner" name="besar_schuffner" style="width: 100px"> </td>
                                    </tr>
                                    <tr id="trbimanual" style="display: none">
                                        <td>Ket Bimanual Ginjal</td>
                                        <td>:</td>
                                        <td><input type="text" class="easyui-textbox" id="bimanual_ginjal" name="bimanual_ginjal" style="width: 250px"> </td>
                                    </tr>
                                    <tr id="lainnya_fisik" style="display: none">
                                        <td valign="top">Pemeriksaan Fisik Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="pemeriksaan_fisik_lainnya" id="pemeriksaan_fisik_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>

                                    <tr>
                                        <td>Sindrom Penyerta Lainnya</td>
                                        <td>:</td>
                                        <td><input name="sindrom_penyerta_lainnya" id="sindrom_penyerta_lainnya" class="easyui-textbox" style="width:200px"></td>
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
                                        <td valign="top">Hitung Jenis</td>
                                        <td valign="top">:</td>
                                        <td>
                                            <table id="dgjenis"></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>

                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <td valign="top" style="padding-right: 30px">
                                <table>
                                    <tr>
                                        <td>Tgl Periksa Urine</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_periksa_urine" id="tgl_periksa_urine" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Warna Urine</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="warna_urine" id="keruh" value="1"><label for="keruh">Keruh</label>
                                            <input type="radio" name="warna_urine" id="pasir" value="2"><label for="pasir">Pasir</label>
                                            <input type="radio" name="warna_urine" id="buih" value="3"><label for="buih">Buih</label>
                                            <input type="radio" name="warna_urine" id="kuning" value="5"><label for="kuning">Kuning</label>
                                            <input type="radio" name="warna_urine" id="jernih" value="6"><label for="jernih">Jernih</label>
                                            <input type="radio" name="warna_urine" id="u_unknow" value="4"><label for="u_unknow">Tidak Diketahui</label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Berat Jenis</td>
                                        <td>:</td>
                                        <td><input name="berat_jenis" id="berat_jenis" class="easyui-textbox" style="width:150px"></td>
                                    </tr>
                                    <tr>
                                        <td>Eritrosit</td>
                                        <td>:</td>
                                        <td><input name="eritrosit" id="eritrosit" class="easyui-textbox" style="width:150px"></td>
                                    </tr>
                                    <tr>
                                        <td>Leukosit</td>
                                        <td>:</td>
                                        <td><input name="leukosit" id="leukosit" class="easyui-textbox" style="width:150px"></td>
                                    </tr>
                                    <tr>
                                        <td>Albumin</td>
                                        <td>:</td>
                                        <td><input name="albumin" id="albumin" class="easyui-textbox" style="width:150px"></td>
                                    </tr>
                                    <tr>
                                        <td>Glukosa</td>
                                        <td>:</td>
                                        <td><input name="glukosa" id="glukosa" class="easyui-textbox" style="width:150px"></td>
                                    </tr>
                                    <tr>
                                        <td>Bilirubin</td>
                                        <td>:</td>
                                        <td><input name="bilirubin" id="bilirubin" class="easyui-textbox" style="width:150px"></td>
                                    </tr>
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
                                            <td><input name="massa_primer" id="massa_primer" class="easyui-textbox" style="width:200px"> Ukuran <input name="ukuran_primer" id="ukuran_primer" class="easyui-textbox" style="width:100px"></td>
                                        </tr>
                                        <tr>
                                            <td>Konsistensi massa</td>
                                            <td>:</td>
                                            <td><input name="konsistensi_massa" id="konsistensi_massa" class="easyui-textbox" style="width:200px"></td>
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
                                            <td valign="top">Metastasis</td>
                                            <td valign="top">:</td>
                                            <td>
                                                <input type="radio" name="metastasis_usg" id="metastasis1_usg" value="n"><label for="metastasis1_usg">Tidak</label>
                                                <input type="radio" name="metastasis_usg" id="metastasis2_usg" value="y"><label for="metastasis2_usg">Ya</label>&nbsp;<input name="metastasis_usg_ket" id="metastasis_usg_ket" class="easyui-textbox" style="width:200px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>USG Droppler</td>
                                            <td>:</td>
                                            <td><input name="usg_dropler" id="usg_dropler" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan Lainnya</td>
                                            <td>:</td>
                                            <td><input name="ket_usg" id="ket_usg" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
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
                                        <td><input name="lokasi_primer_ctscan" id="lokasi_primer_ctscan" class="easyui-textbox" style="width:150px"> Ukuran <input name="ukuran_ctscan" id="ukuran_ctscan" class="easyui-textbox" style="width:100px"></td>
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
                                        <td valign="top">Pelvokalises</td>
                                        <td valign="top">:</td>
                                        <td>
                                            <input type="radio" name="pelvokalises" id="pelvokalises1" value="n"><label for="pelvokalises1">Tidak</label>
                                            <input type="radio" name="pelvokalises" id="pelvokalises2" value="y"><label for="pelvokalises2">Ya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Metastasis</td>
                                        <td valign="top">:</td>
                                        <td>
                                            <input type="radio" name="metastasis_ctscan" id="metastasis1_ctscan" value="n"><label for="metastasis1_ctscan">Tidak</label>
                                            <input type="radio" name="metastasis_ctscan" id="metastasis2_ctscan" value="y"><label for="metastasis2_ctscan">Ya</label>&nbsp;<input name="ket_metastasis_ctscan" id="ket_metastasis_ctscan" class="easyui-textbox" style="width:200px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan lainnya</td>
                                        <td>:</td>
                                        <td><input name="ket_ctscan" id="ket_ctscan" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Histopatologi</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_histopatologi" id="tgl_histopatologi" data-options="formatter:myformatter,parser:myparser" style="width:120px">&nbsp;<input name="histopatologi" id="histopatologi" class="easyui-textbox" style="width:200px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Molekular</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="molekular" id="molekular1" value="n"><label for="molekular1">Negatif</label>
                                            <input type="radio" name="molekular" id="molekular2" value="y"><label for="molekular2">Positif</label>&nbsp;<input class="easyui-textbox" style="width:190px;" id="opt_molekular" name="opt_molekular">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NWTS(sebelum kemoterapi)</td>
                                        <td>:</td>
                                        <td><input name="nwts" id="nwts" style="width:200px;"></td>
                                    </tr>
                                    <tr>
                                        <td>SIOP(sesudah kemoterapi)</td>
                                        <td>:</td>
                                        <td><input name="siop" id="siop" class="easyui-textbox" style="width:200px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Stratifikasi</td>
                                        <td>:</td>
                                        <td><input name="stratifikasi" id="stratifikasi" class="easyui-textbox" style="width:250px;height: 40px"></td>
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
                                <td>Protokol</td>
                                <td>:</td>
                                <td><input name="protokol" id="protokol" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Tgl Mulai</td>
                                <td>:</td>
                                <td><input name="tgl_mulai" id="tgl_mulai" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"><input type="hidden" name="nheproblastomaid" id="nheproblastomaid"></td>
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
                                <td>Radioterapi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="radioterapi" id="radioterapi1" value="y"><label for="radioterapi1">Ya</label>
                                    <input type="radio" name="radioterapi" id="radioterapi2" value="n"><label for="radioterapi2" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Lokasi radioterapi</td>
                                <td>:</td>
                                <td><input name="lokasiradioterapi" id="lokasiradioterapi" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Metode</td>
                                <td>:</td>
                                <td><input name="metoderadioterapi" id="metoderadioterapi" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Dosis</td>
                                <td>:</td>
                                <td><input name="dosisradioterapi" id="dosisradioterapi" class="easyui-textbox" style="width:200px;"></td>
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
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Pengobatan Tradisional</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="tradisional" id="tradisional1" value="y"><label for="tradisional1">Ya</label>
                                    <input type="radio" name="tradisional" id="tradisional2" value="n"><label for="tradisional2" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Pengobatan</td>
                                <td>:</td>
                                <td><input name="nama_pengobatan" id="nama_pengobatan" class="easyui-textbox" style="width:250px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </form>
        <table id="dgkuratif" style="padding-right:10px"></table>
    </div>
    <div id="dlg-buttons-kuratif">
        <a href="javascript:void(0)" id="btnlinkkuratif" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="savekuratif()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-kuratif').dialog('close')" style="width:90px">Close</a>
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
                                <td><strong><span id="label_noregistrasi4"></span></strong><input type="hidden" name="nheproblastomaid3" id="nheproblastomaid3"></td>
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