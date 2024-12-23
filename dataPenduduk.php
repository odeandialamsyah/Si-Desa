<?php require 'View/partials/app.php'; ?>
        <main>
            <table>
                <tr class="large-font">
            <td colspan="7" style="text-align: center; border:0px !important">
                <h2><b>DATA PENDUDUK</b></h2>
            </td>
        </tr>
            <tr>
                <td colspan="7" style="text-align: right;  border:0px !important">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPendudukModal">
                        Tambah Penduduk
                    </button>
                </td>
            </tr>
                    <table class="table table-hover">
                        <thead style="background-color: #D9D9D9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIK</th>
								<th scope="col">NAMA</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tempat, Tanggal Lahir</th>
                                <th scope="col">Riwayat pekerjaan</th>
                                <th scope="col">gaji/bulan</th>
                                <th scope="col">RT / RW</th>
								<th scope="col">Jumlah Keluarga</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="redirectToDetail('dtlPdk1.html')">
                                <td>1</td>
                                <td>893749823</td>
								<td>Bambang</td>
                                <td>LAKI-LAKI</td>
                                <td>Fakfak, 10 Juni 2005</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>5</td>



                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>
                            <tr onclick="redirectToDetail('dtlPdk2.html')">
                                <td>2</td>
                                <td>893749813</td>
								<td>Sinta</td>
                                <td>PEREMPUAN</td>
                                <td>Fakfak, 12 Juli 2000</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>5</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>
							<tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>3</td>
                                <td>893749823</td>
								<td>Nurhaliza</td>
                                <td>PEREMPUAN</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>5</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>

                            <tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>4</td>
                                <td>893749823</td>
								<td>Anggara</td>
                                <td>Laki-Laki</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>3</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>
							
                            <tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>5</td>
                                <td>893749823</td>
								<td>Rahmat Dahlan</td>
                                <td>Laki-Laki</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>4</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>

                            <tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>6</td>
                                <td>893749823</td>
								<td>Rian Pratama</td>
                                <td>PEREMPUAN</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>2</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>

                            <tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>7</td>
                                <td>893749823</td>
								<td>Arlin Sijaya</td>
                                <td>Laki-Laki</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>5</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>

                            <tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>8</td>
                                <td>893749823</td>
								<td>Amira Nia</td>
                                <td>PEREMPUAN</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>5</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>

                            <tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>9</td>
                                <td>893749823</td>
								<td>Nirmala April</td>
                                <td>PEREMPUAN</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>5</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>

                            <tr onclick="redirectToDetail('dtlPdk3.html')">
                                <td>10</td>
                                <td>893749823</td>
								<td>Yunita Sulestio</td>
                                <td>PEREMPUAN</td>
                                <td>Fakfak, 21 Agustus 1998</td>
								<td>Petani</td>
								<td>Rp.1.500.000</td>
								<td>004/005</td>
								<td>5</td>
                                <td><i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i><i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i><i class="fa-solid fa-eye mr-2" style="color: #2ad53e;"></i></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <thead>
                                <td colspan="6">Pendapatan Rata-rata</td><td colspan="4">Rp.6.000.000 perbulan</td>
                            </thead>
                        </tfoot>
                    </table>
                </tr>
            </table>
        </main>

        <div class="modal fade" id="addPendudukModal" tabindex="-1" aria-labelledby="addPendudukModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPendudukModalLabel">Tambah Data Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAddPenduduk">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ttl" class="form-label">Tempat, Tanggal Lahir</label>
                            <input type="text" class="form-control" id="ttl" name="ttl" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="ONLINE">ONLINE</option>
                                <option value="OFFLINE">OFFLINE</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <script>
            function redirectToDetail(url) {
                window.location.href = url;
            }
        </script>
            <script>
        function redirectToDetail(url) {
            window.location.href = url;
        }

        document.getElementById('formAddPenduduk').addEventListener('submit', function(event) {
            event.preventDefault();
            // Simulate form submission
            alert('Data penduduk berhasil ditambahkan!');
            // Close the modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('addPendudukModal'));
            modal.hide();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script type="text/javascript" src="index.js"></script>
        <script type="text/javascript" src="dataAnggota.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>
</html>