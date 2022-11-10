<html>

<head>
    <meta charset="UTF-8">
    <title>Register Spesifik</title>
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/main.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/material/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/themes/color.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>assets/demo/demo.css">
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/datagrid-cellediting.js"></script>
    <script type="text/javascript" src="<?php base_url(); ?>assets/js/registerspesifik.js"></script>
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
                    Cari & Pilih Pasien : <input id="searchPasien" name="searchPasien" style="width: 250px">
                    <?php if ($this->session->userdata('grupid') == '1' || $this->session->userdata('grupid') == '3') { ?>
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>
                    <?php }  ?>
                    <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:250px">
                    <a href="#" class="easyui-linkbutton" style="margin-left: 10px" data-options="" onclick="clearSearch()">Hapus Filter</a>
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="manajemenkuratif()">Manajemen Kuratif</a>
                    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onClick="followup()">Follow Up</a>
                </td>
                <td>
                    <a style="float:right;" href="registerspesifik" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                    <a style="float:right" ; href="registerspesifik" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
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
    <table id="dgregisterspesifik"></table>

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
                                        <td><input name="keluhan_utama" id="keluhan_utama" class="easyui-textbox" style="width:200px"><input type="hidden" name="registrasiid" id="registrasiid"></td>
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
                                        <td><input name="durasi_penyakit" id="durasi_penyakit" class="easyui-textbox" style="width:50"> Minggu</td>
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
                <div title="Pemeriksaan & Diagnosis" style="padding:10px">
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
                                        <td>Tgl Periksa Tulang Belakang</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_periksa_tulangbelakang" id="tgl_periksa_tulangbelakang" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Klasifikasi FAB</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="fab" id="l1" value="1"><label for="l1">ALL L1</label>
                                            <input type="radio" name="fab" id="l2" value="2"><label for="l2">ALL L2</label>
                                            <input type="radio" name="fab" id="l3" value="3"><label for="l3">ALL L3</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mieloblas</td>
                                        <td>:</td>
                                        <td><input name="mieloblas" id="mieloblas" class="easyui-textbox" style="width:100px"> %</td>
                                    </tr>
                                    <tr>
                                        <td>Limfoblas</td>
                                        <td>:</td>
                                        <td><input name="limfoblas" id="limfoblas" class="easyui-textbox" style="width:100px"> %</td>
                                    </tr>
                                    <tr>
                                        <td>Imunofenotipe</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="imunofenotipe" id="pb" value="1"><label for="pb">Pre B</label>
                                            <input type="radio" name="imunofenotipe" id="cb" value="2"><label for="cb">Common B</label>
                                            <input type="radio" name="imunofenotipe" id="st" value="3"><label for="st">Sel T</label>
                                            <input type="radio" name="imunofenotipe" id="mt" value="4"><label for="mt">Mixed Type</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Periksa Cairan Serebrospinal</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_serebrospinal" id="tgl_serebrospinal" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Blast</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="blast" id="b1" value="y"><label for="b1">Positif</label>
                                            <input type="radio" name="blast" id="b2" value="n"><label for="b2">Negatif</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Leukosit</td>
                                        <td>:</td>
                                        <td><input name="leukosit" id="leukosit" class="easyui-textbox" style="width:100px"> %</td>
                                    </tr>
                                    <tr>
                                        <td>Eritrosit</td>
                                        <td>:</td>
                                        <td><input name="eritrosit" id="eritrosit" class="easyui-textbox" style="width:100px"> %</td>
                                    </tr>
                                    <tr>
                                        <td>Jml Sel</td>
                                        <td>:</td>
                                        <td><input name="jml_sel" id="jml_sel" class="easyui-textbox" style="width:100px"> sel/mm<sup>3</sup></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Periksa Urin</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_periksaurin" id="tgl_periksaurin" data-options="formatter:myformatter,parser:myparser" style="width:120px"> pH <input name="ph_urin" id="ph_urin" type="text" class="easyui-textbox" style="width:100px"></td>
                                    </tr>
                                    <tr>
                                        <td>Sitogenetik dan test molekular</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="sitogenetik" id="s1" value="y"><label for="s1">Dilakukan</label>
                                            <input type="radio" name="sitogenetik" id="s2" value="n"><label for="s2">Tidak dilakukan</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stratifikasi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="stratifikasi" id="hr" value="1"><label for="hr">High Risk</label>
                                            <input type="radio" name="stratifikasi" id="sr" value="2"><label for="sr">Standard Risk</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Diagnosis</td>
                                        <td>:</td>
                                        <td><input class="easyui-datebox" name="tgl_diagnosis" id="tgl_diagnosis" data-options="formatter:myformatter,parser:myparser" style="width:120px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Febrile Neutropenia</td>
                                        <td>:</td>
                                        <td>
                                            <input type="radio" name="neutropenia" id="fy" value="y"><label for="fy">Ya</label>
                                            <input type="radio" name="neutropenia" id="fn" value="n"><label for="fn">Tidak</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Infeksi</td>
                                        <td>:</td>
                                        <td><input style="width:260px;height:40;" id="infeksi" name="infeksi"></td>
                                    </tr>
                                    <tr id="trinfeksi" style="display: none">
                                        <td valign="top">Infeksi Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="infeksi_lainnya" id="infeksi_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
                                    </tr>
                                    <tr>
                                        <td>Non Infeksi</td>
                                        <td>:</td>
                                        <td><input style="width:260px;height:40;" id="non_infeksi" name="non_infeksi"></td>
                                    </tr>
                                    <tr id="trnon_infeksi" style="display:none">
                                        <td valign="top">Non Infeksi Lainnya</td>
                                        <td valign="top">:</td>
                                        <td><input name="non_infeksi_lainnya" id="non_infeksi_lainnya" class="easyui-textbox" style="width:250px;height:40px" data-options="multiline:true"></td>
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
                                <td>Fase Kemoterapi</td>
                                <td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="fase_kemo" id="fase_kemo" style="width:150px" data-options="editable:false,panelHeight:'auto'" required>
                                        <option value="Fase Induksi">Fase Induksi</option>
                                        <option value="Fase Konsolidasi">Fase Konsolidasi</option>
                                        <option value="Fase Re-induksi">Fase Re-induksi</option>
                                        <option value="Fase Maintenance">Fase Maintenance</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Protokol</td>
                                <td>:</td>
                                <td><input name="protokol" id="protokol" class="easyui-textbox" style="width:200px;"></td>
                            </tr>
                            <tr>
                                <td>Tgl Mulai</td>
                                <td>:</td>
                                <td><input name="tgl_mulai" id="tgl_mulai" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"><input type="hidden" name="register_spesifikid" id="register_spesifikid"></td>
                                <td width="20px"></td>
                            </tr>
                            <tr>
                                <td>Tgl Selesai</td>
                                <td>:</td>
                                <td><input name="tgl_selesai" id="tgl_selesai" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>Jenis Obat</td>
                                <td>:</td>
                                <td><input name="jenis_obat" id="jenis_obat" class="easyui-textbox" style="width:250px;"></td>
                            </tr>
                            <tr>
                                <td>Tempat Kemoterapi</td>
                                <td>:</td>
                                <td><input name="tempat_kemoterapi" id="tempat_kemoterapi" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Komplikasi Kemoterapi</td>
                                <td>:</td>
                                <td><input id="optkomplikasi_kemo" name="optkomplikasi_kemo" data-options="prompt:'Komplikasi'" style="width:150px"> <input class="easyui-textbox" id="nama_obat" name="nama_obat" data-options="prompt:'nama obat'" style="width:110px">&nbsp;<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-down'" onclick="tambahkomplikasi()">simpan</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <table id="dgkomplikasi"></table>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-delete'" onClick="kosongkankomplikasi()">Hapus</a></td>
                            </tr>
                            <tr id="trkomplikasikuratif" style="display: none">
                                <td>Komplikasi Lainnya</td>
                                <td>:</td>
                                <td><input name="komplikasi_kemo_lainnya" id="komplikasi_kemo_lainnya" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr id="trkomplikasiobatkuratif" style="display: none">
                                <td>Nama Obat</td>
                                <td>:</td>
                                <td><input name="obat_komplikasi_lain" id="obat_komplikasi_lain" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Alergi Obat</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="alergi_obat" id="ay" value="y"><label for="ay">Ya</label>
                                    <input type="radio" name="alergi_obat" id="an" value="n"><label for="an" checked>Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Obat(Alergi)</td>
                                <td>:</td>
                                <td><input name="nama_alergi_obat" id="nama_alergi_obat " class="easyui-textbox" style="width:250px;"></td>
                            </tr>
                            <tr>
                                <td>Hasil Evaluasi</td>
                                <td>:</td>
                                <td><input name="hasil_evaluasi" id="hasil_evaluasi" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Persen Parsial</td>
                                <td>:</td>
                                <td><input name="parsial_persen" id="parsial_persen" class="easyui-textbox" style="width:100px"> %</td>
                            </tr>
                            <tr>
                                <td>Tgl Remisi</td>
                                <td>:</td>
                                <td><input name="tgl_remisi" id="tgl_remisi" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td valign="top">Terapi Suportif</td>
                                <td valign="top">:</td>
                                <td>
                                    <table id="dgsuportif"></table>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Pemeriksaan Sumsum Tulang</td>
                                <td>:</td>
                                <td><input name="tgl_periksa_tulang" id="tgl_periksa_tulang" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>Selularitas</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="selularitas" id="s_normal" value="normal"><label for="s_normal">Normal</label>
                                    <input type="radio" name="selularitas" id="s_hiposeluler" value="hiposeluler"><label for="s_hiposeluler">Hiposeluler</label>
                                    <input type="radio" name="selularitas" id="s_hiperseluler" value="hiperseluler"><label for="s_hiperseluler">Hiperselular</label>
                                    <input type="radio" name="selularitas" id="s_unknow" value="tidak diketahui"><label for="s_unknow">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Eritopoiesis</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="eritopoiesis" id="e_normal" value="normal"><label for="e_normal">Normal</label>
                                    <input type="radio" name="eritopoiesis" id="e_menurun" value="menurun"><label for="e_menurun">Menurun</label>
                                    <input type="radio" name="eritopoiesis" id="e_meningkat" value="meningkat"><label for="e_meningkat">Meningkat</label>
                                    <input type="radio" name="eritopoiesis" id="e_terdesak" value="terdesak"><label for="e_terdesak">Terdesak</label>
                                    <input type="radio" name="eritopoiesis" id="e_unknow" value="tidak diketahui"><label for="e_unknow">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Granulopoeisis</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="granulopoeisis" id="g_normal" value="normal"><label for="g_normal">Normal</label>
                                    <input type="radio" name="granulopoeisis" id="g_menurun" value="menurun"><label for="g_menurun">Menurun</label>
                                    <input type="radio" name="granulopoeisis" id="g_meningkat" value="meningkat"><label for="g_meningkat">Meningkat</label>
                                    <input type="radio" name="granulopoeisis" id="g_terdesak" value="terdesak"><label for="g_terdesak">Terdesak</label>
                                    <input type="radio" name="granulopoeisis" id="g_unknow" value="tidak diketahui"><label for="g_unknow">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Tromobopoeisis</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="tromobopoeisis" id="t_normal" value="normal"><label for="t_normal">Normal</label>
                                    <input type="radio" name="tromobopoeisis" id="t_meningkat" value="meningkat"><label for="t_meningkat">Meningkat</label>
                                    <input type="radio" name="tromobopoeisis" id="t_terdesak" value="terdesak"><label for="t_terdesak">Terdesak</label>
                                    <input type="radio" name="tromobopoeisis" id="t_megakariosit" value="megakariosit"><label for="t_megakariosit">Megakariosit</label>
                                    <input type="radio" name="tromobopoeisis" id="t_unknow" value="tidak diketahui"><label for="t_unknow">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Mieloblas</td>
                                <td>:</td>
                                <td><input name="mieloblas" id="mieloblas " class="easyui-textbox" style="width:100px"> %</td>
                            </tr>
                            <tr>
                                <td>limfoblas</td>
                                <td>:</td>
                                <td><input name="limfoblas" id="limfoblas" class="easyui-textbox" style="width:100px"> %</td>
                            </tr>
                            <tr>
                                <td>Tgl Pemeriksaan MRD</td>
                                <td>:</td>
                                <td><input name="tgl_periksa_mrd" id="tgl_periksa_mrd" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>Status MRD</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="status_mrd" id="mrd_y" value="y"><label for="mrd_y">Positif</label>
                                    <input type="radio" name="status_mrd" id="mrd_n" value="n"><label for="mrd_n" checked>Negatif</label>
                                    <input type="radio" name="status_mrd" id="mrd_u" value="u"><label for="mrd_u" checked>Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Kelengkapan Kemo</td>
                                <td>:</td>
                                <td><input name="kelengkapan_kemo" id="kelengkapan_kemo" class="easyui-textbox" style="width:250px"></td>
                            </tr>
                            <tr>
                                <td>Tambahan Pengobatan Tradisional</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="tambahan_pengobatan" id="tam_y" value="y"><label for="tam_y">Ya</label>
                                    <input type="radio" name="tambahan_pengobatan" id="tam_t" value="n"><label for="tam_t">Tidak</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Pengobatan</td>
                                <td>:</td>
                                <td><input name="nama_pengobatan_tambahan" id="nama_pengobatan_tambahan" class="easyui-textbox" style="width:250px"></td>
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
    <div id="dlg-followup" class="easyui-dialog" style="height:95%; width: 100%;top: 30px;" closed="true" buttons="#dlg-buttons-followup" modal="true">
        <form id="fm-followup" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td>No Registasi</td>
                                <td>:</td>
                                <td><strong><span id="label_noregistrasi3"></span></strong><input type="hidden" name="register_spesifikid2" id="register_spesifikid2"></td>
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
                                <td><strong><span id="label_nohp3"></span></strong></td>
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
                                <td>Tgl Periksa Darah</td>
                                <td>:</td>
                                <td><input name="tgl_periksa_darah" id="tgl_periksa_darah" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <table id="dgdarahfollowup"></table>
                                </td>
                                <td width="20px"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <table id="dgjenisfollowup"></table>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Pemeriksaan <br>Sumsum Tulang</td>
                                <td>:</td>
                                <td><input name="tgl_periksa_tulang" id="tgl_periksa_tulang" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"></td>
                            </tr>
                            <tr>
                                <td>Selularitas</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="selularitas2" id="s_normal2" value="normal"><label for="s_normal2">Normal</label>
                                    <input type="radio" name="selularitas2" id="s_hiposeluler2" value="hiposeluler"><label for="s_hiposeluler2">Hiposeluler</label>
                                    <input type="radio" name="selularitas2" id="s_hiperseluler2" value="hiperseluler"><label for="s_hiperseluler2">Hiposeluler</label>
                                    <input type="radio" name="selularitas2" id="s_unknow2" value="tidak diketahui"><label for="s_unknow2">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Eritopoiesis</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="eritopoiesis2" id="e_normal2" value="normal"><label for="e_normal2">Normal</label>
                                    <input type="radio" name="eritopoiesis2" id="e_menurun2" value="menurun"><label for="e_menurun2">Menurun</label>
                                    <input type="radio" name="eritopoiesis2" id="e_meningkat2" value="meningkat"><label for="e_meningkat2">Meningkat</label>
                                    <input type="radio" name="eritopoiesis2" id="e_terdesak2" value="terdesak"><label for="e_terdesak2">Terdesak</label>
                                    <input type="radio" name="eritopoiesis2" id="e_unknow2" value="tidak diketahui"><label for="e_unknow2">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Granulopoeisis</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="granulopoeisis2" id="g_normal2" value="normal"><label for="g_normal2">Normal</label>
                                    <input type="radio" name="granulopoeisis2" id="g_menurun2" value="menurun"><label for="g_menurun2">Menurun</label>
                                    <input type="radio" name="granulopoeisis2" id="g_meningkat2" value="meningkat"><label for="g_meningkat2">Meningkat</label>
                                    <input type="radio" name="granulopoeisis2" id="g_terdesak2" value="terdesak"><label for="g_terdesak2">Terdesak</label>
                                    <input type="radio" name="granulopoeisis2" id="g_unknow2" value="tidak diketahui"><label for="g_unknow2">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Tromobopoeisis</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="tromobopoeisis2" id="t_normal2" value="normal"><label for="t_normal2">Normal</label>
                                    <input type="radio" name="tromobopoeisis2" id="t_meningkat2" value="meningkat"><label for="t_meningkat2">Meningkat</label>
                                    <input type="radio" name="tromobopoeisis2" id="t_terdesak2" value="terdesak"><label for="t_terdesak2">Terdesak</label>
                                    <input type="radio" name="tromobopoeisis2" id="t_megakariosit2" value="megakariosit"><label for="t_megakariosit2">Megakariosit</label>
                                    <input type="radio" name="tromobopoeisis2" id="t_unknow2" value="tidak diketahui"><label for="t_unknow2">Tidak Diketahui</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Mieloblas</td>
                                <td>:</td>
                                <td><input name="mieloblas2" id="mieloblas2" class="easyui-textbox" style="width:100px"> %</td>
                            </tr>
                            <tr>
                                <td>limfoblas</td>
                                <td>:</td>
                                <td><input name="limfoblas2" id="limfoblas2" class="easyui-textbox" style="width:100px"> %</td>
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
</body>

</html>