<?php require 'View/partials/app.php'; ?>
        <main>
            <table style="font-size: 12px;">
                <tr class="large-font">
                    <b>Detail Penerima</b>
                </tr>
                <tr>
                  <tbody>
                    <tr style="height:25px;">
                        <td rowspan="7" width="250px"><img src="img/ftL1.jpg" width="250px"></td>
                      <td width="350px"><b>NIK</b></td>
                      <td>893749823</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Nama</b></td>
                      <td>Bambang</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Jenis Kelamin</b></td>
                      <td>Laki-Laki</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Tempat, Tanggal Lahir</b></td>
                      <td>Fakfak, 12 Agustus 1999</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Agama</b></td>
                      <td>Islam</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Alamat</b></td>
                      <td>Jl.Pattimura</td>
                    </tr>
                  </tbody>
            </table>

            <table class="table table-striped">
                <thead>

                    <th colspan="6">Detail Anggota Keluarga</th>
                    <th colspan="6"></th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">Data Suami</td>
                        <td colspan="3">Data Istri</td>
                        <td colspan="3">Data Anak</td>
                    </tr>
                    <tr>
                        <td>Nama</td><td>:</td><td>Bambang</td>
                        <td>Nama</td><td>:</td><td>Siti Aisyah</td>
                        <td>Nama</td><td>:</td><td>Ahmad</td>
                    </tr>

                    <tr>
                        <td>TTL</td><td>:</td><td>Jakarta</td>
                        <td>TTL</td><td>:</td><td>Bandung</td>
                        <td>TTL</td><td>:</td><td>Fakfak</td>
                    </tr>

                    <tr>
                        <td>Pekerjaan</td><td>:</td><td>Nelayan</td>
                        <td>Pekerjaan</td><td>:</td><td>Ibu Rumah Tangga</td>
                        <td>Pekerjaan</td><td>:</td><td>Mahasiswi</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-striped">
                <thead>
                    <th colspan="6">Dokumentasi</th><br>
                    <th colspan="6">Jenis Bantuan</th>


                    <!-- Teks "Bukti penerima bantuan" diperkecil -->
                  
                    <tr style="height: 50px;">
                        <!-- Wrapper untuk gambar dan list bantuan menggunakan flex -->
                        <td colspan="3">
                            <div class="bantuan-container">
                                <!-- Gambar penerima bantuan -->
                                <div class="bantuan-image">
                                    <img src="PB.jpg" width="250px" alt="Foto Penerima Bantuan">
                                </div>
            
                                <!-- Daftar jenis bantuan yang diterima -->
                                <div class="jenis-bantuan-list">
                                    <ul>
                                        <li>Sembako</li>
                                        <li>Uang Tunai</li>
                                        <li>Bantuan Pengobatan</li>
                                        <li>Bantuan Pendidikan</li>
                                        <li>Bantuan Tempat Tinggal</li>
                                        <li>Pakaian</li>
                                        <li>Lainnya</li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
               
        </main>
    </div>

    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="penerima_bantuan.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
