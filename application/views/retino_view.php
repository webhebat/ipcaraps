<html>

<head>
    <meta charset="UTF-8">
    <title>Retinoblastoma</title>
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/main.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/color.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/demo/demo.css">
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/datagrid-cellediting.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/retino.js"></script>
    <script type="text/javascript">
        function loadsessi() {
            document.getElementById("ssnya").value = "<?php echo $this->session->userdata('nounit'); ?>";
            document.getElementById("uid").value = "<?php echo $this->session->userdata('unitid'); ?>";
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
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="addretino()">Tambah Data</a>
                    <?php if ($this->session->userdata('grupid') == '1' || $this->session->userdata('grupid') == '3') { ?>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>
                    <?php }  ?>
                    <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:250px">
                    <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="" onclick="clearSearch()">Hapus Filter</a>
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="manajemenkuratif()">Manajemen Kuratif</a>
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="luaran()">Luaran</a>
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="followup()">Follow Up</a>
                </td>
                <td>
                    <a style="float:right;" href="retino" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                    <a style="float:right" ; href="retino" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                </td>
            </tr>
            <!-- <tr>
                    <table id="dgshowpasien"></table>
                </tr> -->
        </table>
    </div>

    <br>

    <input type="hidden" id="ssnya">
    <input type="hidden" id="uid">
    <input type="hidden" id="usernamenya">
    <table id="dgretino"></table>

    <div id="dlg" class="easyui-dialog" style="height:95%; width: 100%;top: 30px;" closed="true" buttons="#dlg-buttons" modal="true">
        <form id="fm" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><span id="label_namalengkap"></span></strong>&nbsp;&nbsp;<a class="easyui-linkbutton" value="cari" data-options="iconCls:'icon-search'" onclick="caripasien()" alt="Cari Pasien" id="btncari">cari</a></td>
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="hidden" name="registrasiid" id="registrasiid"></td>
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
                            <td valign="top" style="padding-right: 20px">
                                <table>
                                    <tr>
                                        <td>Presentasi Klinis</td>
                                        <td>:</td>
                                        <td><input name="presentasi_klinis" id="presentasi_klinis" class="easyui-textbox" style="width:250px;height:40px;" required></td>
                                    </tr>
                                    <tr id="klinis_lainnya" style="display: none">
                                        <td valign="top">Presentasi Klinis Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="presentasi_klinis_lainnya" id="presentasi_klinis_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr id="lainnya_utama" style="display: none">
                                        <td valign="top">Keluhan Utama Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="keluhan_utama_lainnya" id="keluhan_utama_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Usia Saat Keluhan Muncul</td>
                                        <td>:</td>
                                        <td><input name="thn_keluhan" id="thn_keluhan" class="easyui-textbox" style="width:50px"> Thn <input name="bln_keluhan" id="bln_keluhan" class="easyui-textbox" style="width:50px"> Bln</td>
                                    </tr>
                                    <tr>
                                        <td>Durasi Penyakit</td>
                                        <td>:</td>
                                        <td><input name="durasi_penyakit" id="durasi_penyakit" class="easyui-textbox" style="width:50"> Bulan</td>
                                    </tr>
                                    <tr>
                                        <td>Mata yang terkena</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="mk" id="mk1" value="1"><label for="mk1">Kanan</label>
                                            <input type="radio" name="mk" id="mk2" value="2"><label for="mk2">Kiri</label>
                                            <input type="radio" name="mk" id="mk3" value="3"><label for="mk3">Keduanya</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keluhan utama progresif</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="kup" id="kup1" value="y"><label for="kup1">Ya</label>
                                            <input type="radio" name="kup" id="kup2" value="t"><label for="kup2">Tidak</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keluhan Penyerta</td>
                                        <td>:</td>
                                        <td><input id="keluhan_penyerta" name="keluhan_penyerta" style="width:250px;height:40px"> </td>
                                    </tr>
                                    <tr id="penyerta_lainnya" style="display: none;">
                                        <td valign="top">Keluhan Penyerta Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="keluhan_penyerta_lainnya" id="keluhan_penyerta_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Riwayat Prenatal</td>
                                        <td>:</td>
                                        <td><input id="riwayat_prenatal" name="riwayat_prenatal" style="width:250px;height:40px"> </td>
                                    </tr>
                                    <tr>
                                        <td>Perawatan rubela saat ibu hamil</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="rubela" id="rub1" value="y"><label for="rub1">Ya</label>
                                            <input type="radio" name="rubela" id="rub2" value="t"><label for="rub2">Tidak</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Berat badan lahir</td>
                                        <td>:</td>
                                        <td><input name="bbl" id="bbl" class="easyui-textbox" style="width:50"> Gram</td>
                                    </tr>
                                    <tr>
                                        <td>Usia gestasi lahir</td>
                                        <td>:</td>
                                        <td><input name="ugl" id="ugl" class="easyui-textbox" style="width:50"> Minggu</td>
                                    </tr>
                                    <tr>
                                        <td>Pemberian oksigen saat <br />resusitasi/masa neonatus</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="neonatus" id="neo1" value="y"><label for="neo1">Ya</label>
                                            <input type="radio" name="neonatus" id="neo2" value="t"><label for="neo2">Tidak</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Perawatan dlm inkubator</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="inkubator" id="ink1" value="y"><label for="ink1"> Ya <input name="t_inkubator" id="t_inkubator" class="easyui-textbox" style="width:50"> hari/minggu</label>
                                            <input type="radio" name="inkubator" id="ink2" value="t"><label for="ink2">Tidak</label>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table>
                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <div class="ftitle">Mata Kanan</div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <input class="easyui-textbox" name="p_tanpabantuan" id="p_tanpabantuan" label="Penglihatan tanpa bantuan:" labelPosition="top" style="width:250px">
                                        </div>
                                    </tr>
                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <input class="easyui-textbox" name="p_kacamata" id="p_kacamata" label="Penglihatan dengan kacamata/pin hole:" labelPosition="top" style="width:250px">
                                        </div>
                                    </tr>
                                    <tr>
                                        <div>
                                            Fungsi penglihatan :
                                        </div>
                                        <div style="margin-bottom:10px">
                                            <input type="radio" name="penglihatan" id="p_1" value="1"><label for="p_1">Normal</label>
                                            <input type="radio" name="penglihatan" id="p_2" value="2"><label for="p_2">Gangguan</label>
                                            <input type="radio" name="penglihatan" id="p_3" value="3"><label for="p_3">Kebutaan</label>
                                        </div>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table>
                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <div class="ftitle">Mata Kiri</div>
                                        </div>
                                    </tr>
                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <input class="easyui-textbox" name="p_tanpabantuan2" id="p_tanpabantuan2" label="Penglihatan tanpa bantuan:" labelPosition="top" style="width:250px">
                                        </div>
                                    </tr>
                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <input class="easyui-textbox" name="p_kacamata2" id="p_kacamata2" label="Penglihatan dengan kacamata/pin hole:" labelPosition="top" style="width:250px">
                                        </div>
                                    </tr>
                                    <tr>
                                        <div>
                                            Fungsi penglihatan :
                                        </div>
                                        <div style="margin-bottom:10px">
                                            <input type="radio" name="penglihatan2" id="p_12" value="1"><label for="p_12">Normal</label>
                                            <input type="radio" name="penglihatan2" id="p_22" value="2"><label for="p_22">Gangguan</label>
                                            <input type="radio" name="penglihatan2" id="p_32" value="3"><label for="p_32">Kebutaan</label>
                                        </div>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table>
                    </table>
                </div>
                <div title="Pemeriksaan & Klasifikasi" style="padding:10px">
                    <table>
                        <tr>
                            <td valign="top" style="padding-right: 30px">
                                <table>
                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <div class="ftitle">Mata Kanan</div>
                                        </div>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Klinis</td>
                                        <td>:</td>
                                        <td><input name="pemeriksaan_klinis" id="pemeriksaan_klinis" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="pemklinis_lainnya" style="display: none">
                                        <td valign="top">pemeriksaan Klinis Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="pemeriksaan_klinis_lainnya" id="pemeriksaan_klinis_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran bola mata</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="ubm" id="ubm1" value="l"><label for="ubm1">Normal</label>
                                            <input type="radio" name="ubm" id="ubm2" value="2"><label for="ubm2">Membesar</label>
                                            <input type="radio" name="ubm" id="ubm3" value="3"><label for="ubm3">Mengecil</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Slit Lamp</td>
                                        <td>:</td>
                                        <td><input name="pemeriksaan_slitlamp" id="pemeriksaan_slitlamp" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="slitlamp_lainnya" style="display: none">
                                        <td valign="top">pemeriksaan Slitlamp Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="pemeriksaan_slitlamp_lainnya" id="pemeriksaan_slitlamp_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Segmen Posterior</td>
                                        <td>:</td>
                                        <td><input name="pem_posterior" id="pem_posterior" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="des_lesi" style="display: none">
                                        <td>Deskripsi Lesi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="lesi" id="lesi1" value="l"><label for="lesi1">endofitik</label>
                                            <input type="radio" name="lesi" id="lesi2" value="2"><label for="lesi2">eksofitik</label>
                                            <input type="radio" name="lesi" id="lesi3" value="3"><label for="lesi3">campuran</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran Tumor(DD)</td>
                                        <td>:</td>
                                        <td><input name="u_tumor" id="u_tumor" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi Tumor</td>
                                        <td>:</td>
                                        <td><input name="l_tumor" id="l_tumor" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Tampilan Tumor</td>
                                        <td>:</td>
                                        <td><input name="t_tumor" id="t_tumor" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Pola Pembuluh Darah</td>
                                        <td>:</td>
                                        <td><input name="pp_darah" id="pp_darah" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Pembuluh Darah Baru</td>
                                        <td>:</td>
                                        <td><input name="pem_darah_baru" id="pem_darah_baru" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Detachment Retina</td>
                                        <td>:</td>
                                        <td><input name="det_retina" id="det_retina" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Vitreous/Subretinal seeds</td>
                                        <td>:</td>
                                        <td><input name="vitreous" id="vitreous" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Grup</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="grup" id="grupa" value="a"><label for="grupa">A</label>
                                            <input type="radio" name="grup" id="grupb" value="b"><label for="grupb">B</label>
                                            <input type="radio" name="grup" id="grupc" value="c"><label for="grupc">C</label>
                                            <input type="radio" name="grup" id="grupd" value="d"><label for="grupd">D</label>
                                            <input type="radio" name="grup" id="grupe" value="e"><label for="grupe">E</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Tumor</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="jmltumor" id="jtumora" value="a"><label for="jtumora">O 0-2</label>
                                            <input type="radio" name="jmltumor" id="jtumorb" value="b"><label for="jtumorb">O 2-4</label>
                                            <input type="radio" name="jmltumor" id="jtumorc" value="c"><label for="jtumorc">O 4-6</label>
                                            <input type="radio" name="jmltumor" id="jtumord" value="d"><label for="jtumord">O >6</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CT-scan</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="ctscan" id="ctscant" value="t" onClick="showcombo('t','tr_ctscankanan1','ctscankanan1')"><label for="ctscant">Tidak</label>
                                            <input type="radio" name="ctscan" id="ctscany" value="y" onClick="showcombo('y','tr_ctscankanan1','ctscankanan1')"><label for="ctscany">Ya</label>
                                        </td>
                                    </tr>
                                    <tr id="tr_ctscankanan1" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="ctscankanan1" id="ctscankanan1" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="tr_ctscankanan2" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="ctscankanan2" id="ctscankanan2" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr>
                                        <td>MRI</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="mri" id="mrit" value="t" onClick="showcombo('t','tr_mrikanan1','mrikanan1')"><label for="mrit">Tidak</label>
                                            <input type="radio" name="mri" id="mriy" value="y" onClick="showcombo('y','tr_mrikanan1','mrikanan1')"><label for="mriy">Ya</label>
                                        </td>
                                    </tr>
                                    <tr id="tr_mrikanan1" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="mrikanan1" id="mrikanan1" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="tr_mrikanan2" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="mrikanan2" id="mrikanan2" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr>
                                        <td>USG Dasar/base(mm)</td>
                                        <td>:</td>
                                        <td> T<input name="usg_dasar_t_kanan" id="usg_dasar_t_kanan" class="easyui-textbox" style="width:100"> L<input name="usg_dasar_l_kanan" id="usg_dasar_l_kanan" class="easyui-textbox" style="width:100"></td>
                                    </tr>
                                    <tr>
                                        <td>USG Tinggi/height(mm)</td>
                                        <td>:</td>
                                        <td> T<input name="usg_tinggi_t_kanan" id="usg_tinggi_t_kanan" class="easyui-textbox" style="width:100"> L<input name="usg_tinggi_l_kanan" id="usg_tinggi_l_kanan" class="easyui-textbox" style="width:100"></td>
                                    </tr>
                                    <tr>
                                        <td>Staging (IIRC)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="staging_iirc_kanan" id="staging_iirc_kanana" value="a"><label for="staging_iirc_kanana">Grup A</label>
                                            <input type="radio" name="staging_iirc_kanan" id="staging_iirc_kananb" value="b"><label for="staging_iirc_kananb">Grup B</label>
                                            <input type="radio" name="staging_iirc_kanan" id="staging_iirc_kananc" value="c"><label for="staging_iirc_kananc">Grup C</label>
                                            <input type="radio" name="staging_iirc_kanan" id="staging_iirc_kanand" value="d"><label for="staging_iirc_kanand">Grup D</label>
                                            <input type="radio" name="staging_iirc_kanan" id="staging_iirc_kanane" value="e"><label for="staging_iirc_kanane">Grup E</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staging (IERC)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="staging_ierc_kanan" id="staging_ierc_kanana" value="a"><label for="staging_ierc_kanana">Grup A</label>
                                            <input type="radio" name="staging_ierc_kanan" id="staging_ierc_kananb" value="b"><label for="staging_ierc_kananb">Grup B</label>
                                            <input type="radio" name="staging_ierc_kanan" id="staging_ierc_kananc" value="c"><label for="staging_ierc_kananc">Grup C</label>
                                            <input type="radio" name="staging_ierc_kanan" id="staging_ierc_kanand" value="d"><label for="staging_ierc_kanand">Grup D</label>
                                            <input type="radio" name="staging_ierc_kanan" id="staging_ierc_kanane" value="e"><label for="staging_ierc_kanane">Grup E</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Infeksi</td>
                                        <td>:</td>
                                        <td><input name="diagnosis_infeksi_kanan" id="diagnosis_infeksi_kanan" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Non Infeksi</td>
                                        <td>:</td>
                                        <td><input name="diagnosis_noninfeksi_kanan" id="diagnosis_noninfeksi_kanan" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" style="padding-right: 30px">
                                <table>
                                    <tr>
                                        <div style="margin-bottom:10px">
                                            <div class="ftitle">Mata Kiri</div>
                                        </div>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Klinis</td>
                                        <td>:</td>
                                        <td><input name="pemeriksaan_klinis2" id="pemeriksaan_klinis2" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="pemklinis_lainnya2" style="display: none">
                                        <td valign="top">pemeriksaan Klinis Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="pemeriksaan_klinis_lainnya2" id="pemeriksaan_klinis_lainnya2" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran bola mata</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="ubm2" id="ubm12" value="l"><label for="ubm12">Normal</label>
                                            <input type="radio" name="ubm2" id="ubm22" value="2"><label for="ubm22">Membesar</label>
                                            <input type="radio" name="ubm2" id="ubm32" value="3"><label for="ubm32">Mengecil</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Slit Lamp</td>
                                        <td>:</td>
                                        <td><input name="pemeriksaan_slitlamp2" id="pemeriksaan_slitlamp2" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="slitlamp_lainnya2" style="display: none">
                                        <td valign="top">pemeriksaan Slitlamp Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="pemeriksaan_slitlamp_lainnya2" id="pemeriksaan_slitlamp_lainnya2" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Segmen Posterior</td>
                                        <td>:</td>
                                        <td><input name="pem_posterior_kiri" id="pem_posterior_kiri" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="des_lesi_kiri" style="display: none">
                                        <td>Deskripsi Lesi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="lesi_kiri" id="lesi_kiri1" value="l"><label for="lesi_kiri1">endofitik</label>
                                            <input type="radio" name="lesi_kiri" id="lesi_kiri2" value="2"><label for="lesi_kiri2">eksofitik</label>
                                            <input type="radio" name="lesi_kiri" id="lesi_kiri3" value="3"><label for="lesi_kiri3">campuran</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran Tumor(DD)</td>
                                        <td>:</td>
                                        <td><input name="u_tumor_kiri" id="u_tumor_kiri" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi Tumor</td>
                                        <td>:</td>
                                        <td><input name="l_tumor_kiri" id="l_tumor_kiri" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Tampilan Tumor</td>
                                        <td>:</td>
                                        <td><input name="t_tumor_kiri" id="t_tumor_kiri" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Pola Pembuluh Darah</td>
                                        <td>:</td>
                                        <td><input name="pp_darah_kiri" id="pp_darah_kiri" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Pembuluh Darah Baru</td>
                                        <td>:</td>
                                        <td><input name="pem_darah_baru_kiri" id="pem_darah_baru_kiri" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Detachment Retina</td>
                                        <td>:</td>
                                        <td><input name="det_retina_kiri" id="det_retina_kiri" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Vitreous/Subretinal seeds</td>
                                        <td>:</td>
                                        <td><input name="vitreous_kiri" id="vitreous_kiri" class="easyui-textbox" style="width:250"></td>
                                    </tr>
                                    <tr>
                                        <td>Grup</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="grup_kiri" id="grup_kiria" value="a"><label for="grup_kiria">A</label>
                                            <input type="radio" name="grup_kiri" id="grup_kirib" value="b"><label for="grup_kirib">B</label>
                                            <input type="radio" name="grup_kiri" id="grup_kiric" value="c"><label for="grup_kiric">C</label>
                                            <input type="radio" name="grup_kiri" id="grup_kirid" value="d"><label for="grup_kirid">D</label>
                                            <input type="radio" name="grup_kiri" id="grup_kirie" value="e"><label for="grup_kirie">E</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Tumor</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="jmltumor_kiri" id="jtumor_kiria" value="a"><label for="jtumor_kiria">O 0-2</label>
                                            <input type="radio" name="jmltumor_kiri" id="jtumor_kirib" value="b"><label for="jtumor_kirib">O 2-4</label>
                                            <input type="radio" name="jmltumor_kiri" id="jtumor_kiric" value="c"><label for="jtumor_kiric">O 4-6</label>
                                            <input type="radio" name="jmltumor_kiri" id="jtumor_kirid" value="d"><label for="jtumor_kirid">O >6</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CT-scan</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="ctscan_kiri" id="ctscan_kirit" value="t" onClick="showcombo('t','tr_ctscankiri1','ctscankiri1')"><label for="ctscan_kirit">Tidak</label>
                                            <input type="radio" name="ctscan_kiri" id="ctscan_kiriy" value="y" onClick="showcombo('y','tr_ctscankiri1','ctscankiri1')"><label for="ctscan_kiriy">Ya</label>
                                        </td>
                                    </tr>
                                    <tr id="tr_ctscankiri1" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="ctscankiri1" id="ctscankiri1" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="tr_ctscankiri2" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="ctscankiri2" id="ctscankiri2" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr>
                                        <td>MRI</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="mri_kiri" id="mri_kirit" value="t" onClick="showcombo('t','tr_mrikiri1','mrikiri1')"><label for="mrit">Tidak</label>
                                            <input type="radio" name="mri_kiri" id="mri_kiriy" value="y" onClick="showcombo('y','tr_mrikiri1','mrikiri1')"><label for="mriy">Ya</label>
                                        </td>
                                    </tr>
                                    <tr id="tr_mrikiri1" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="mrikiri1" id="mrikiri1" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr id="tr_mrikiri2" style="display: none">
                                        <td></td>
                                        <td></td>
                                        <td><input name="mrikiri2" id="mrikiri2" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                    </tr>
                                    <tr>
                                        <td>USG Dasar/base(mm)</td>
                                        <td>:</td>
                                        <td> T<input name="usg_dasar_t_kiri" id="usg_dasar_t_kiri" class="easyui-textbox" style="width:100"> L<input name="usg_dasar_l_kiri" id="usg_dasar_l_kiri" class="easyui-textbox" style="width:100"></td>
                                    </tr>
                                    <tr>
                                        <td>USG Tinggi/height(mm)</td>
                                        <td>:</td>
                                        <td> T<input name="usg_tinggi_t_kiri" id="usg_tinggi_t_kiri" class="easyui-textbox" style="width:100"> L<input name="usg_tinggi_l_kiri" id="usg_tinggi_l_kiri" class="easyui-textbox" style="width:100"></td>
                                    </tr>
                                    <tr>
                                        <td>Staging (IIRC)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="staging_iirc_kiri" id="staging_iirc_kiria" value="a"><label for="staging_iirc_kiria">Grup A</label>
                                            <input type="radio" name="staging_iirc_kiri" id="staging_iirc_kirib" value="b"><label for="staging_iirc_kirib">Grup B</label>
                                            <input type="radio" name="staging_iirc_kiri" id="staging_iirc_kiric" value="c"><label for="staging_iirc_kiric">Grup C</label>
                                            <input type="radio" name="staging_iirc_kiri" id="staging_iirc_kirid" value="d"><label for="staging_iirc_kirid">Grup D</label>
                                            <input type="radio" name="staging_iirc_kiri" id="staging_iirc_kirie" value="e"><label for="staging_iirc_kirie">Grup E</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staging (IERC)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="staging_ierc_kiri" id="staging_ierc_kiria" value="a"><label for="staging_ierc_kiria">Grup A</label>
                                            <input type="radio" name="staging_ierc_kiri" id="staging_ierc_kirib" value="b"><label for="staging_ierc_kirib">Grup B</label>
                                            <input type="radio" name="staging_ierc_kiri" id="staging_ierc_kiric" value="c"><label for="staging_ierc_kiric">Grup C</label>
                                            <input type="radio" name="staging_ierc_kiri" id="staging_ierc_kirid" value="d"><label for="staging_ierc_kirid">Grup D</label>
                                            <input type="radio" name="staging_ierc_kiri" id="staging_ierc_kirie" value="e"><label for="staging_ierc_kirie">Grup E</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Infeksi</td>
                                        <td>:</td>
                                        <td><input name="diagnosis_infeksi_kiri" id="diagnosis_infeksi_kiri" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Non Infeksi</td>
                                        <td>:</td>
                                        <td><input name="diagnosis_noninfeksi_kiri" id="diagnosis_noninfeksi_kiri" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <table>
                                <tr>
                                    <td>Pemeriksaan Metastatik</td>
                                    <td>:</td>
                                    <td><input name="metastatik" id="metastatik" class="easyui-textbox" style="width:250px;height:40px;"></td>
                                </tr>
                                <tr id="tr_hasil1" style="display: none">
                                    <td>Hasil Aspirasi sumsum tulang</td>
                                    <td>:</td>
                                    <td><input name="hasil_aspirasi" id="hasil_aspirasi" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                </tr>
                                <tr id="tr_hasil2" style="display: none">
                                    <td>Hasil Analisis CSS</td>
                                    <td>:</td>
                                    <td><input name="hasil_css" id="hasil_css" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                </tr>
                                <tr id="tr_hasil3" style="display: none">
                                    <td>Hasil Lainnya</td>
                                    <td>:</td>
                                    <td><input name="hasil_lainnya" id="hasil_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                </tr>
                                <tr>
                                    <td>Genetik (darah)</td>
                                    <td>:</td>
                                    <td>
                                        <input type="radio" name="genetik" id="genetikt" value="t" onClick="showrdbutton('t','tr_genetik','rdgenetik')"><label for="genetikt">Tidak</label>
                                        <input type="radio" name="genetik" id="genetiky" value="y" onClick="showrdbutton('y','tr_genetik','rdgenetik')"><label for="genetiky">Ya</label>
                                    </td>
                                </tr>
                                <tr id="tr_genetik" style="display: none">
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="radio" name="rdgenetik" id="rdgenetiky" value="y"><label for="rdgenetiky">Positif</label>
                                        <input type="radio" name="rdgenetik" id="rdgenetikt" value="n"><label for="rdgenetikt">Negatif</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diagnosis Kerja</td>
                                    <td>:</td>
                                    <td><input name="diagnosis_kerja" id="diagnosis_kerja" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                </tr>
                                <tr>
                                    <td>Tgl Diagnosis</td>
                                    <td>:</td>
                                    <td><input name="tgl_diagnosis" id="tgl_diagnosis" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true"></td>
                                </tr>
                            </table>
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
                                        <td>Jenis Operasi</td>
                                        <td>:</td>
                                        <td>
                                            <input style="width:250px;" id="jenis_operasi" name="jenis_operasi">
                                        </td>
                                    </tr>
                                    <tr id="troperasilainnya" style="display: none">
                                        <td>Jenis Lainnya</td>
                                        <td>:</td>
                                        <td><input name="jenisoperasi_lainnya" id="jenisoperasi_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
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
        <a href="javascript:void(0)" id="btnlink" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="confirm1()" style="width:90px">Simpan</a>
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
            <br>
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Kemoterapi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="stat_kemo" id="stat_kemo1" value="y"><label for="stat_kemo1">Ya</label>
                                    <input type="radio" name="stat_kemo" id="stat_kemo2" value="n"><label for="stat_kemo2">Tidak</label>
                                    <input type="hidden" name="retinoid" id="retinoid">
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Kemoterapi</td>
                                <td>:</td>
                                <td><input name="tgl_kemo" id="tgl_kemo" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                                <td width="20px"></td>
                            </tr>
                            <tr>
                                <td>Jenis Kemoterapi</td>
                                <td>:</td>
                                <td> <input id="jenis_kemo" class="easyui-combobox" name="jenis_kemo" style="width:200px;" data-options="
	
                                data: [{
                                    id: '1',
                                    nama_options: 'Kemoterapi Sistemik'
                                },{
                                    id: '2',
                                    nama_options: 'Injeksi Kemoterapi Okular'
                                }]" />

                                </td>
                            </tr>
                            <tr>
                                <td>Siklus</td>
                                <td>:</td>
                                <td><input name="siklus" id="siklus" class="easyui-textbox" style="width:100px"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td> <input id="opt_okular" class="easyui-combobox" name="opt_okular" style="width:200px;" data-options="
	
                                data: [{
                                    id: '1',
                                    nama_options: 'Injeksi Subtenon'
                                },{
                                    id: '2',
                                    nama_options: 'Injeksi Intravitral'
                                }]" />

                                </td>
                            </tr>
                            <tr>
                                <td>Mata Kanan</td>
                                <td>:</td>
                                <td><input name="xkanan" id="xkanan" class="easyui-textbox" style="width:100px"> kali</td>
                            </tr>
                            <tr>
                                <td>Mata Kiri</td>
                                <td>:</td>
                                <td><input name="xkiri" id="xkiri" class="easyui-textbox" style="width:100px"> kali</td>
                            </tr>
                            <tr>
                                <td>Pengobatan Tradisional</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="tradisional" id="tradisional1" value="y"><label for="tradisional1">Ya</label>
                                    <input type="radio" name="tradisional" id="tradisional2" value="n"><label for="tradisional2">Tidak</label>
                                </td>
                            </tr>

                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <div style="margin-bottom:10px">
                                    <div class="ftitle">Mata Kanan</div>
                                </div>
                            </tr>
                            <tr>
                                <td>Enukleasi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="enukleasi_kanan" id="enukleasi_kanan1" value="y"><label for="enukleasi_kanan1">Ya</label>
                                    <input type="radio" name="enukleasi_kanan" id="enukleasi_kanan2" value="n"><label for="enukleasi_kanan2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Hasil HPE</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="hasilhpe_kanan" id="hasilhpe_kanan1" value="y"><label for="hasilhpe_kanan1">Intraokular
                                        (tdk ada ekstensi
                                        ekstraokular)
                                    </label>
                                    <input type="radio" name="hasilhpe_kanan" id="hasilhpe_kanan2" value="n"><label for="hasilhpe_kanan2">Dengan ekstensi
                                        ekstraokular
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input id="ekstraokular_kanan" name="ekstraokular_kanan" style="width:250px;height:40px"> </td>
                            </tr>
                            <tr>
                                <td>Terapi fokal</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="fokal_kanan" id="fokal_kanan1" value="y"><label for="fokal_kanan1">Ya</label>
                                    <input type="radio" name="fokal_kanan" id="fokal_kanan2" value="n"><label for="fokal_kanan2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td> <input id="opt_fokal_kanan" class="easyui-combobox" name="opt_fokal_kanan" style="width:200px;" data-options="
	
                                data: [{
                                    id: '1',
                                    nama_options: 'Laser'
                                },{
                                    id: '2',
                                    nama_options: 'Krioterapi'
                                }]" />

                                </td>
                            </tr>
                            <tr>
                                <td>Radio Terapi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="radioterapi_kanan" id="radioterapi_kanan1" value="y"><label for="radioterapi_kanan1">Ya</label>
                                    <input type="radio" name="radioterapi_kanan" id="radioterapi_kanan2" value="n"><label for="radioterapi_kanan2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input id="opt_radioterapi_kanan" name="opt_radioterapi_kanan" style="width:250px;height:40px"> </td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <div style="margin-bottom:10px">
                                    <div class="ftitle">Mata Kiri</div>
                                </div>
                            </tr>
                            <tr>
                                <td>Enukleasi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="enukleasi_kiri" id="enukleasi_kiri1" value="y"><label for="enukleasi_kiri1">Ya</label>
                                    <input type="radio" name="enukleasi_kiri" id="enukleasi_kiri2" value="n"><label for="enukleasi_kiri2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Hasil HPE</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="hasilhpe_kiri" id="hasilhpe_kiri1" value="y"><label for="hasilhpe_kiri1">Intraokular
                                        (tdk ada ekstensi
                                        ekstraokular)
                                    </label>
                                    <input type="radio" name="hasilhpe_kiri" id="hasilhpe_kiri2" value="n"><label for="hasilhpe_kiri2">Dengan ekstensi
                                        ekstraokular
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input id="ekstraokular_kiri" name="ekstraokular_kiri" style="width:250px;height:40px"> </td>
                            </tr>
                            <tr>
                                <td>Terapi fokal</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="fokal_kiri" id="fokal_kiri1" value="y"><label for="fokal_kiri1">Ya</label>
                                    <input type="radio" name="fokal_kiri" id="fokal_kiri2" value="n"><label for="fokal_kiri2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td> <input id="opt_fokal_kiri" class="easyui-combobox" name="opt_fokal_kiri" style="width:200px;" data-options="
	
                                data: [{
                                    id: '1',
                                    nama_options: 'Laser'
                                },{
                                    id: '2',
                                    nama_options: 'Krioterapi'
                                }]" />

                                </td>
                            </tr>
                            <tr>
                                <td>Radio Terapi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="radioterapi_kiri" id="radioterapi_kiri1" value="y"><label for="radioterapi_kiri1">Ya</label>
                                    <input type="radio" name="radioterapi_kiri" id="radioterapi_kiri2" value="n"><label for="radioterapi_kiri2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input id="opt_radioterapi_kiri" name="opt_radioterapi_kiri" style="width:250px;height:40px"> </td>
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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-kuratif').dialog('close')" style="width:90px">Tutup</a>
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
                                <td><strong><span id="label_noregistrasi3"></span></strong></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><span id="label_namalengkap3"></span></strong></td>
                                <td width="50px"></td>
                            </tr>

                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><strong><span id="label_jkelamin3"></span></strong></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><strong><span id="label_nohp3"></span></strong><input type="hidden" name="retinoid3" id="retinoid3"></td>

                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <div style="margin-bottom:10px">
                                    <div class="ftitle">Mata Kanan</div>
                                </div>
                            </tr>
                            <tr>
                                <td>Penglihatan Tanpa Bantuan</td>
                                <td>:</td>
                                <td><input name="ptb_kanan" id="ptb_kanan" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Penglihatan Dengan Kacamata/pin hole</td>
                                <td>:</td>
                                <td><input name="pdk_kanan" id="pdk_kanan" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Penglihatan Tampak</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="tampak_kanan" id="tampak_kanan1" value="1"><label for="tampak_kanan1">Penglihatan Normal</label>
                                    <input type="radio" name="tampak_kanan" id="tampak_kanan2" value="2"><label for="tampak_kanan2">Gangguan Penglihatan</label>
                                    <input type="radio" name="tampak_kanan" id="tampak_kanan3" value="3"><label for="tampak_kanan3">Kebutaan</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Remisi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="remisi_kanan" id="remisi_kanan1" value="1"><label for="remisi_kanan1">Tidak ada regresi</label>
                                    <input type="radio" name="remisi_kanan" id="remisi_kanan2" value="2"><label for="remisi_kanan2">Regresi Parsial</label>
                                    <input type="radio" name="remisi_kanan" id="remisi_kanan3" value="3"><label for="remisi_kanan3">Regresi Komplit</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input id="tipe_regresi_kanan" name="tipe_regresi_kanan" style="width:250px;height:40px"> </td>
                            </tr>
                            <tr>
                                <td>Rekurensi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="rekurensi_kanan" id="rekurensi_kanan1" value="1"><label for="rekurensi_kanan1">Ya</label>
                                    <input type="radio" name="rekurensi_kanan" id="rekurensi_kanan2" value="2"><label for="rekurensi_kanan2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Durasi sejak terapi pertama kali</td>
                                <td>:</td>
                                <td><input name="durasi_kanan" id="durasi_kanan" class="easyui-textbox" style="width:50px"> Bulan</td>
                            </tr>
                            <tr>
                                <td>Komplikasi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="komplikasi_kanan" id="komplikasi_kanan1" value="1"><label for="komplikasi_kanan1">Ya</label>
                                    <input type="radio" name="komplikasi_kanan" id="komplikasi_kanan2" value="2"><label for="komplikasi_kanan2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan</td>
                                <td>:</td>
                                <td><input id="opt_komplikasi_kanan" name="opt_komplikasi_kanan" style="width:250px;height:40px"> </td>
                            </tr>
                            <tr>
                                <td>Ket Socket/Prostesis</td>
                                <td>:</td>
                                <td><input name="ket_socket_kanan" id="ket_socket_kanan" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Ket Kemoterapi</td>
                                <td>:</td>
                                <td><input name="ket_kemoterapi_kanan" id="ket_kemoterapi_kanan" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Ket Penyakitnya</td>
                                <td>:</td>
                                <td><input name="ket_penyakit_kanan" id="ket_penyakit_kanan" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Ket Radiasi</td>
                                <td>:</td>
                                <td><input name="ket_radiasi_kanan" id="ket_radiasi_kanan" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <div style="margin-bottom:10px">
                                    <div class="ftitle">Mata Kiri</div>
                                </div>
                            </tr>
                            <tr>
                                <td>Penglihatan Tanpa Bantuan</td>
                                <td>:</td>
                                <td><input name="ptb_kiri" id="ptb_kiri" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Penglihatan Dengan Kacamata/pin hole</td>
                                <td>:</td>
                                <td><input name="pdk_kiri" id="pdk_kiri" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Penglihatan Tampak</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="tampak_kiri" id="tampak_kiri1" value="1"><label for="tampak_kiri1">Penglihatan Normal</label>
                                    <input type="radio" name="tampak_kiri" id="tampak_kiri2" value="2"><label for="tampak_kiri2">Gangguan Penglihatan</label>
                                    <input type="radio" name="tampak_kiri" id="tampak_kiri3" value="3"><label for="tampak_kiri3">Kebutaan</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Remisi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="remisi_kiri" id="remisi_kiri1" value="1"><label for="remisi_kiri1">Tidak ada regresi</label>
                                    <input type="radio" name="remisi_kiri" id="remisi_kiri2" value="2"><label for="remisi_kiri2">Regresi Parsial</label>
                                    <input type="radio" name="remisi_kiri" id="remisi_kiri3" value="3"><label for="remisi_kiri3">Regresi Komplit</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input id="tipe_regresi_kiri" name="tipe_regresi_kiri" style="width:250px;height:40px"> </td>
                            </tr>
                            <tr>
                                <td>Rekurensi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="rekurensi_kiri" id="rekurensi_kiri1" value="1"><label for="rekurensi_kiri1">Ya</label>
                                    <input type="radio" name="rekurensi_kiri" id="rekurensi_kiri2" value="2"><label for="rekurensi_kiri2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Durasi sejak terapi pertama kali</td>
                                <td>:</td>
                                <td><input name="durasi_kiri" id="durasi_kiri" class="easyui-textbox" style="width:50px"> Bulan</td>
                            </tr>
                            <tr>
                                <td>Komplikasi</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="komplikasi_kiri" id="komplikasi_kiri1" value="1"><label for="komplikasi_kiri1">Ya</label>
                                    <input type="radio" name="komplikasi_kiri" id="komplikasi_kiri2" value="2"><label for="komplikasi_kiri2">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Berhubungan dengan</td>
                                <td>:</td>
                                <td><input id="opt_komplikasi_kiri" name="opt_komplikasi_kiri" style="width:250px;height:40px"> </td>
                            </tr>
                            <tr>
                                <td>Ket Socket/Prostesis</td>
                                <td>:</td>
                                <td><input name="ket_socket_kiri" id="ket_socket_kiri" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Ket Kemoterapi</td>
                                <td>:</td>
                                <td><input name="ket_kemoterapi_kiri" id="ket_kemoterapi_kiri" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Ket Penyakitnya</td>
                                <td>:</td>
                                <td><input name="ket_penyakit_kiri" id="ket_penyakit_kiri" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Ket Radiasi</td>
                                <td>:</td>
                                <td><input name="ket_radiasi_kiri" id="ket_radiasi_kiri" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <table id="dgluaran" style="padding-right:10px"></table>
    </div>

    <div id="dlg-buttons-luaran">
        <a href="javascript:void(0)" id="btnlinkluaran" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="saveluaran()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-luaran').dialog('close')" style="width:90px">Tutup</a>
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
                                <td><strong><span id="label_noregistrasi4"></span></strong></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><span id="label_namalengkap4"></span></strong></td>
                                <td width="50px"></td>
                            </tr>
                            <tr>
                                <td>Tgl Abstraksi</td>
                                <td>:</td>
                                <td><input name="tgl_abstraksi" id="tgl_abstraksi" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true"></td>
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
                                <td><strong><span id="label_nohp4"></span></strong><input type="hidden" name="retinoid4" id="retinoid4"></td>

                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <div style="margin-bottom:10px">
                                    <div class="ftitle">Mata Kanan</div>
                                </div>
                            </tr>
                            <tr>
                                <td>Evaluasi Klinis</td>
                                <td>:</td>
                                <td><input name="evaluasi_klinis_kanan" id="evaluasi_klinis_kanan" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>Pemeriksaan Slit lamp</td>
                                <td>:</td>
                                <td><input name="pemeriksaan_slitlamp_kanan" id="pemeriksaan_slitlamp_kanan" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <div style="margin-bottom:10px">
                                    <div class="ftitle">Mata Kiri</div>
                                </div>
                            </tr>
                            <tr>
                                <td>Evaluasi Klinis</td>
                                <td>:</td>
                                <td><input name="evaluasi_klinis_kiri" id="evaluasi_klinis_kiri" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>Pemeriksaan Slit lamp</td>
                                <td>:</td>
                                <td><input name="pemeriksaan_slitlamp_kiri" id="pemeriksaan_slitlamp_kiri" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <div style="margin-bottom:10px;margin-top: 10px">
                                    <div class="ftitle">Hasil Pemeriksaan</div>
                                </div>
                            </tr>
                            <tr>
                                <td>Tgl CT-Scan</td>
                                <td>:</td>
                                <td><input name="tgl_ctscan" id="tgl_ctscan" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true"></td>
                                <td>Kesan : <input name="kesan_ctscan" id="kesan_ctscan" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                            <tr>
                                <td>Tgl MRI</td>
                                <td>:</td>
                                <td><input name="tgl_mri" id="tgl_mri" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true"></td>
                                <td>Kesan : <input name="kesan_mri" id="kesan_mri" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <table id="dgfollowup" style="padding-right:10px"></table>
    </div>

    <div id="dlg-buttons-followup">
        <a href="javascript:void(0)" id="btnlinkfollowup" class="easyui-linkbutton c6" iconCls="icon-save16" onclick="savefollowup()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-followup').dialog('close')" style="width:90px">Tutup</a>
    </div>

    <div id="dlg-pasien" class="easyui-dialog" style="width:80%;height: 450px; top: 20px" modal="true" closed="true" closable="false" buttons="#dlg-buttons-pasien" title="Filter Pencarian">
        <form id="fm-pasien" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <input class="easyui-searchbox" id="search-pasien" name="search-pasien" data-options="prompt:'Please Search Here..',searcher:doSearchPasien" style="width:200px">
            <input type="hidden" name="modedlg" id="modedlg">
            <table id="datapasien"></table>
        </form>
    </div>

    <div id="dlg-buttons-pasien">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" style="width:80px" onClick="pilihPasien()">Pilih</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-pasien').dialog('close')" style="width:80px">Tutup</a>
    </div>
</body>

</html>