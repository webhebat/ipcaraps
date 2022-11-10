<html>
    <head>
        <meta charset="UTF-8">
        <title>Validasi</title>
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/main.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/material/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/themes/color.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/demo/demo.css">
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php base_url();?>assets/js/validasi.js"></script>
        <script type="text/javascript">
            function loadsessi(){
                document.getElementById("asx").value = "<?php echo $this->session->userdata('unitid');?>";
                document.getElementById("fff").value = "<?php echo $this->session->userdata('grupid');?>";
            }
        </script>
    </head>
    <body onload="loadsessi()">  
        <div id="tbOutlet" style="padding:5px;border:1px solid #ddd">
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <tr>
                    <td>
                        <?php if($this->session->userdata('grupid')=='4'){ ?>
                        <a href="#" id="btn-validasi" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onClick="showvalidate()" >Validasi</a> 
                        <?php } ?>
                    
                        <a href="#" id="link-validate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-correct'" onClick="searchvalidate('y')"></a>
                        <a href="#" id="link-nonvalidate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-uncheck'" onClick="searchvalidate('n')"></a>
                        <a href="#" id="link-nonvalidate" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reset'" onClick="searchvalidate('')">Semua</a>
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">
                        <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="remove()">Hapus</a>
                    </td>  
                    <!-- <td >
                        <input class="easyui-searchbox" id="search" name="search" data-options="prompt:'Please Search Here..',searcher:doSearch" style="width:300px">
                    </td> -->
                    <td>
                        <a style="float:right;" href="validasi" class="easyui-linkbutton" target="_blank" data-options="plain:true,iconCls:'icon-new-window'"></a>
                        <a style="float:right"; href="validasi" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'"></a>
                        
                    </td>                    
                </tr>
            </table>
        </div>

        <br>
        
        <input type="hidden" id="asx">
        <input type="hidden" id="fff">
        <table id="dgvalidasi"></table>

        <div id="dlg" class="easyui-dialog" style="height:95%; width: 100%;top: 30px" closed="true" buttons="#dlg-buttons" modal="true">
            <form id="fm" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
                <div class="easyui-tabs" data-options="tabWidth:250" style="width:auto;height:auto;">
                    <div title="Identitas" style="padding:10px">
                        <table>
                            <tr>
                                <td valign="top" style="padding-right: 30px">
                                    <table>
                                        <tr>
                                            <td>Nama Lengkap</td><td>:</td><td><input name="nama" id="nama" class="easyui-textbox" style="width:200px" required><input type="hidden" id="no_urut" name="no_urut"></td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td><td>:</td><td><input name="nik" id="nik" class="easyui-textbox" style="width:200px"   ></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td><td>:</td><td><input name="tempat_lahir" id="tempat_lahir" class="easyui-textbox" style="width:200px" required ></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Lahir</td><td>:</td><td><input name="tgl_lahir" id="tgl_lahir" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px" required></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td><td>:</td>
                                            <td><input type="radio" name="jenis_kelamin" id="laki" value="l"><label for="laki">Laki-laki</label>
                                                <input type="radio" name="jenis_kelamin" id="perempuan" value="p"><label for="perempuan">Perempuan</label></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Alamat Tetap</td><td>:</td><td><input name="alamat" id="alamat" class="easyui-textbox" style="width:100%;height:40px" data-options="multiline:true" ></td>
                                        </tr>
                                        <tr>
                                            <td></td><td></td><td>RT <input name="rt" id="rt" class="easyui-textbox" style="width:50px"> RW <input name="rw" id="rw" class="easyui-textbox" style="width:50px"></td>
                                        </tr>
                                        <tr>
                                            <td>Propinsi</td><td>:</td><td><input name="id_prov" id="id_prov" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Kota/Kabupaten</td><td>:</td><td><input name="id_kab" id="id_kab" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td><td>:</td><td><input name="id_kec" id="id_kec" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan/Desa</td><td>:</td><td><input name="id_kel" id="id_kel" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td valign="top">
                                    <table>
                                        <tr>
                                            <td>No. Rekam Medis</td><td>:</td><td><input name="no_rekam" id="no_rekam" class="easyui-textbox" style="width:200px" required ></td>
                                        </tr>
                                        <tr>
                                            <td>No. BPJS</td><td>:</td><td><input name="no_bpjs" id="no_bpjs" class="easyui-textbox" style="width:200px" ></td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td><td>:</td><td><input name="no_hp" id="no_hp" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>No. HP 2</td><td>:</td><td><input name="no_hp2" id="no_hp2" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Status Gizi</td><td>:</td><td>BB <input name="bb" id="bb" class="easyui-textbox" style="width:50px"> Kg , TB <input name="tb" id="tb" class="easyui-textbox" style="width:50px"> Cm </td>
                                        </tr>
                                        <tr>
                                            <td>Kesimpulan</td><td>:</td>
                                            <td>
                                                <select class="easyui-combobox" name="kesimpulan" id="kesimpulan" data-options="panelHeight:'auto',editable:false" style="width:100%;">
                                                    <option value="normal">Normal</option>
                                                    <option value="mals">Malnutrisi Sedang</option>
                                                    <option value="malb">Malnutrisi Berat</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ayah</td><td>:</td><td><input name="nama_ayah" id="nama_ayah" class="easyui-textbox" style="width:200px" ></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ibu</td><td>:</td><td><input name="nama_ibu" id="nama_ibu" class="easyui-textbox" style="width:200px" ></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sementara</td><td>:</td><td><input name="alamat_2" id="alamat_2" class="easyui-textbox" style="width:100%;height:40px" data-options="multiline:true"></td>
                                        </tr>
                                        <tr>
                                            <td></td><td></td><td>RT <input name="rt_2" id="rt_2" class="easyui-textbox" style="width:50px"> RW <input name="rw_2" id="rw_2" class="easyui-textbox" style="width:50px"></td>
                                        </tr>
                                        <tr>
                                            <td>Propinsi</td><td>:</td><td><input name="id_prov_2" id="id_prov_2" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Kota/Kabupaten</td><td>:</td><td><input name="id_kab_2" id="id_kab_2" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td><td>:</td><td><input name="id_kec_2" id="id_kec_2" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan/Desa</td><td>:</td><td><input name="id_kel_2" id="id_kel_2" class="easyui-textbox" style="width:200px"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <!-- <tr>
                                <td>Kecamatan</td><td>:</td><td><input name="camatid" id="camatid" style="width: 200px" required="true"></td>
                            </tr> -->
                        </table>
                    </div>
                    <div title="Data Lain & Perujukan" style="padding:10px">
                        <table>
                            <tr>
                                <td valign="top" style="padding-right: 30px">
                                    <table>
                                        <tr>
                                        <td valign="top" colspan="3">
                                            <div class="ftitle">Data Lain</div>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>Berat Lahir</td><td>:</td>
                                        </tr>
                                        <tr>
                                            <td></td><td></td>
                                            <td>
                                                <input type="radio" name="berat_lahir" id="bnormal" value="bnormal"><label for="bnormal">Bayi berat lahir cukup/normal (<=2500-4000 gram)</label><br>
                                                <input type="radio" name="berat_lahir" id="bbblr" value="bbblr"><label for="bbblr">Bayi berat lahir rendah/BBLR (<2500 gram)</label><br>
                                                <input type="radio" name="berat_lahir" id="bbblsr" value="bbblsr"><label for="bbblsr">Bayi berat lahir sangat rendah/BBLSR (<1500 gram)</label><br>
                                                <input type="radio" name="berat_lahir" id="bbblasr" value="bbblasr"><label for="bbblasr">Bayi berat lahir amat sangat rendah/BBLASR (<1000 gram)</label><br>
                                                <input type="radio" name="berat_lahir" id="blebih" value="blebih"><label for="blebih">Bayi berat lahir lebih(>=4000 gram)</label><br>
                                                <input type="radio" name="berat_lahir" id="bunknow" value="b_u"><label for="bunknow">Tidak diketahui</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Imunisasi</td><td>:</td>
                                        </tr>
                                        <tr>
                                            <td></td><td></td>
                                            <td>
                                                <input type="radio" name="imunisasi" id="imunisasi_y" value="imunisasi_y"><label for="imunisasi_y">Lengkap sesuai usia</label><br>
                                                <input type="radio" name="imunisasi" id="imunisasi_t" value="imunisasi_t"><label for="imunisasi_t">Tidak lengkap</label><br>
                                                <input type="radio" name="imunisasi" id="imunisasi_u" value="imunisasi_u"><label for="imunisasi_u">Tidak diketahui</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ASI ekslusif</td><td>:</td>
                                        </tr>
                                        <tr>
                                            <td></td><td></td>
                                            <td>
                                                <input type="radio" name="asi" id="asi_y" value="asi_y"><label for="asi_y">Ya</label><br>
                                                <input type="radio" name="asi" id="asi_t" value="asi_t"><label for="asi_t">Tidak</label><br>
                                                <input type="radio" name="asi" id="asi_d" value="asi_d"><label for="asi_d">Dalam masa pemberian ASI</label><br>
                                                <input type="radio" name="asi" id="asi_u" value="asi_u"><label for="asi_u">Tidak diketahui</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Riwayat keganasan keluarga</td><td>:</td>
                                        </tr>
                                        <tr>
                                            <td></td><td></td>
                                            <td>
                                                <input type="radio" name="riwayat" id="ry" value="y" onclick="tampilkan('y')"><label for="ry">Ya</label><br>
                                                <input type="radio" name="riwayat" id="rn" value="n" onclick="tampilkan('n')"><label for="rn">Tidak</label><br>
                                                <input type="radio" name="riwayat" id="ru" value="u" onclick="tampilkan('u')"><label for="ru">Tidak diketahui</label>
                                            </td>
                                        </tr>
                                        <tr id="btnriwayat">
                                            <td></td><td></td>
                                            <td><input class="easyui-textbox" name="hubkeluarga" id="hubkeluarga" data-options="prompt:'Hubungan Keluarga..'"> - <input class="easyui-textbox" id="jkanker" name="jkanker" data-options="prompt:'jenis kanker..'">&nbsp;<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-down'" onclick="addtogrid()">simpan</a></td>
                                        </tr>
                                        <tr id="tgriwayat">
                                            <td></td><td></td>
                                            <td><table id="dgriwayat"></table></td>
                                        </tr>
                                    </table>
                                </td>
                                <td valign="top" style="padding-right: 30px">
                                    <table>
                                        <tr>
                                            <td valign="top" colspan="3">
                                                <div class="ftitle">Riwayat Perujukan</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Keluhan Pertama</td>
                                            <td>:</td>
                                            <td><input name="tgl_keluhan_pertama" id="tgl_keluhan_pertama" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true"></td>
                                        </tr>
                                        <tr>
                                            <td>PPK 1</td><td>:</td><td><input name="ppk1" id="ppk1" class="easyui-textbox" style="width:200px" ><input name="tgl_ppk1" id="tgl_ppk1" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px"  ></td>
                                        </tr>
                                        <tr>
                                            <td>PPK 2</td><td>:</td><td><input name="ppk2" id="ppk2" class="easyui-textbox" style="width:200px"><input name="tgl_ppk2" id="tgl_ppk2" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px" ></td>
                                        </tr>
                                        <tr>
                                            <td>PPK 3</td><td>:</td><td><input name="ppk3" id="ppk3" class="easyui-textbox" style="width:200px"><input name="tgl_ppk3" id="tgl_ppk3" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:120px" ></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Pertama Kali Konsultasi<br>kepetugas Kesehatan</td><td>:</td><td><input name="tgl_konsultasi" id="tgl_konsultasi" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true" ></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div title="Data Tumor" style="padding:10px">
                        <table>
                            <tr>
                                <td>Subgrup</td><td>:</td><td><strong><span id="labelkodesubgrup"></span></strong> - <strong><span id="labelsubgrup"></span></strong><input type="hidden" name="subgrupid" id="subgrupid"></td>
                            </tr>
                            <tr>
                                <td>Morfologi</td><td>:</td><td><strong><span id="labelkodemorfologi"></span></strong> - <strong><span id="labelmorfologi"></span></strong><input type="hidden" name="morfologiid" id="morfologiid"></td>
                            </tr>
                            <tr>
                                <td>Topografi</td><td>:</td><td><strong><span id="labelkodetopografi"></span></strong> - <strong><span id="labeltopografi"></span></strong><input type="hidden" name="topografiid" id="topografiid"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-search'" style="width:70px" onclick="cariSubgrup()">Cari</a>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>Literalitas</td><td>:</td>
                                <td>
                                    <select class="easyui-combobox" name="literalitas" id="literalitas" data-options="panelHeight:'auto',editable:false" style="width:50%;">
                                        <option value="l1">Unilateral -kanan</option>
                                        <option value="l2">Unilateral -kiri</option>
                                        <option value="l3">Bilateral</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>Dasar Diagnosis</td><td>:</td><td><input id="diagnosisid" name="diagnosisid" width="250"> <input class="easyui-datebox" id="tgl_diagnosis" name="tgl_diagnosis" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">&nbsp;<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-down'" onclick="adddiagnosis()">simpan</a></td>
                            </tr>
                            <tr id="tgdiagnosis">
                                <td></td><td></td>
                                <td ><table id="dgdiagnosis"></table></td>
                            </tr>
                            <tr>
                                <td>Tatalaksana</td><td>:</td><td><input style="width:260px;height:50px;" id="tatalaksanaid" name="tatalaksanaid"></td>
                            </tr>
                            <tr>
                                <td>Staging</td><td>:</td><td><inpit id="stagingid" name="stagingid"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" id="btnlink" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Simpan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Batal</a>
        </div>

        <div id="dlg-subreg" class="easyui-dialog" style="height:95%; width: 100%;top: 30px; padding:10px" closed="true" buttons="#dlg-buttons-subreg" modal="true">
            <table>
                <tr>
                    <td valign="top">
                        <table id="dgmorfologi"></table>      
                    </td>
                    <td valign="top">
                        <table id="dgtopografi"></table>      
                    </td>
                </tr>
            </table>
        </div>

        <div id="dlg-buttons-subreg">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="tambahkan()" style="width:120px" data-options="iconCls:'icon-down'">Tambahkan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-subreg').dialog('close')" style="width:90px">Batal</a>
        </div>
    
        <div id="toolbar-m">
            <input id="combosubgrup" name="combosubgrup" style="width:33%">
            &emsp;&emsp;&emsp;
            <input class="easyui-searchbox" id="searchmorfologi" name="searchmorfologi" data-options="prompt:'Cari subgrup, kode atau nama morfologi..',searcher:doSearchMorfologi" style="width:50%">
        </div>
        <div id="toolbar-t">
            <input class="easyui-searchbox" id="searchtopografi" name="searchtopografi" data-options="prompt:'Cari kode atau nama topografi..',searcher:loadtopografi" style="width:100%">
        </div>
        <div id="dlg-luaran" class="easyui-dialog" style="height:90%; width: 100%; " closed="true" top="50px" buttons="#dlg-buttons-luaran" modal="true">
            <form id="fmluaran" method="post" enctype="multipart/form-data" novalidate style="margin:0; padding:10px">
            <table>
                <tr>
                    <td valign="top">
                        <table>
                            <tr>
                                <td width="150">No validasi</td><td>:</td><td><strong><span id="labelnoreg"></span></strong><input type="hidden" name="validasiid" id="validasiid"></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td><td>:</td><td><strong><span id="labelnama"></span></strong></td>
                            </tr>
                            <tr>
                                <td>Tgl Abstraksi</td><td>:</td><td><input name="tgl_abstraksi" id="tgl_abstraksi" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px" required="true" ></td>
                            </tr>
                            <tr>
                                <td>Status</td><td>:</td>
                                <td >
                                   <input type="radio" name="status" id="1" value="1" onclick="showstatus('1')"><label for="1">Hidup</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                   <input type="radio" name="status" id="2" value="2" onclick="showstatus('2')"><label for="2">Loss to follow up - </label><input name="date_loss" id="date_loss" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                                <td>
                                </td>
                                <td width="100px"> 
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                   <input type="radio" name="status" id="3" value="3" onclick="showstatus('3')"><label for="3">Meninggal - </label><input name="date_meninggal" id="date_meninggal" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                            </tr>
                            
                            <tr id="sebabkematian" style="display: none">
                                <td>Sebab Kematian</td><td>:</td>
                                <td >
                                   <input id="sebab_kematian" name="sebab_kematian" class="easyui-textbox" style="height:60px" data-options="multiline:true">
                                </td>
                            </tr>

                            <tbody id="statushidup" style="display:none">
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td></td><td></td>
                                <td><input type="radio" name="status2" id="cm" value="cm" onclick="opendate('cm')"><label for="cm">Complete Remission / response </label></td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input name="date_complete" id="date_complete" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input type="radio" name="status2" id="st" value="st" onclick="opendate('st')"><label for="st">Stable Disease </label>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td > 
                                   <input name="date_stable" id="date_stable" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input type="radio" name="status2" id="re" value="re" onclick="opendate('re')"><label for="re">Relaps </label>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input name="date_relaps" id="date_relaps" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input type="radio" name="status2" id="pr" value="pr" onclick="opendate('pr')"><label for="pr">Progresif </label>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td></td>
                                <td >
                                    <input name="date_progresif" id="date_progresif" data-options="formatter:myformatter,parser:myparser" class="easyui-datebox" style="width:120px">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            </tbody>
                            <tr>
                                <td>Nama Rumah Sakit</td><td>:</td>
                                <td >
                                   <input type="text" name="rumah_sakit" id="rumah_sakit" class="easyui-textbox" style="width:200px">
                                </td>
                                <td> 
                                </td>
                            </tr>
                            <tr>
                                <td>Tindakan</td><td>:</td>
                                <td >
                                   <input name="tindakan" id="tindakan" >
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr >
                                <td>Ket Tindakan Lainnya</td><td>:</td>
                                <td >
                                   <input id="ket_lainnya" name="ket_lainnya" class="easyui-textbox" style="height:60px" data-options="multiline:true">
                                </td>
                            </tr>
                            
                        </table>
                    </td>
                    </form>
                    <td valign="top">
                        <table id="dgluaran"></table>
                    </td>
                </tr>
            </table>

        </div>
        <div id="dlg-buttons-luaran">
            <div style="text-align: left">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="saveluaran()" style="width:100px" id="lnk" data-options="iconCls:'icon-save'">Simpan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-luaran').dialog('close')" style="width:90px">Tutup</a>
        </div>
        </div>
        <div id="ft">
            <a href="#" class="easyui-linkbutton" iconCls="icon-delete" plain="true" onClick="kosongkanriwayat()">Hapus</a>
        </div>
        <div id="ft2">
            <a href="#" class="easyui-linkbutton" iconCls="icon-delete" plain="true" onClick="kosongkandiagnosis()">Hapus</a>
        </div>
    </body>

        
</html>