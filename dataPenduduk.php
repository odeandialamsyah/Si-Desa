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
                <?php
                // Ambil data dari tabel penduduk di database
                include 'Back-End/Koneksi/koneksi.php';
                $result = mysqli_query($conn, "SELECT * FROM penduduk");
                $totalGaji = 0;
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalGaji += $row['gaji'];
                    echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>{$row['nik']}</td>
                    <td>{$row['nama_lengkap']}</td>
                    <td>{$row['jenis_kelamin']}</td>
                    <td>{$row['tempat_lahir']}, {$row['tanggal_lahir']}</td>
                    <td>{$row['pekerjaan']}</td>
                    <td>Rp." . number_format($row['gaji'], 0, ',', '.') . "</td>
                    <td>{$row['rt']}/{$row['rw']}</td>
                    <td>{$row['jumlah_keluarga']}</td>
                    <td>
                        <a href='Back-End/update_penduduk.php?nik={$row['nik']}' class='fa-solid fa-pen-to-square mr-2' style='color: #e17833;'></a>
                        <a href='Back-End/delete_penduduk.php?nik={$row['nik']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' class='text-danger'>
                            <i class='fa-solid fa-trash mr-2'></i>
                        </a>
                        <i class='fa-solid fa-eye mr-2' style='color: #2ad53e;'></i>
                    </td>
                </tr>";
                }
                ?>
        </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">Pendapatan Rata-rata</td>
                    <td colspan="4">Rp.<?php echo number_format($totalGaji / ($no - 1), 0, ',', '.'); ?> perbulan</td>
                </tr>
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
                <form id="formAddPenduduk" method="POST" action="Back-End/proses_tambah_penduduk.php">
                    <!-- NIK -->
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                    </div>

                    <!-- Gaji -->
                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji/Bulan</label>
                        <input type="number" class="form-control" id="gaji" name="gaji" step="0.01" required>
                    </div>

                    <!-- RT -->
                    <div class="mb-3">
                        <label for="rt" class="form-label">RT</label>
                        <input type="number" class="form-control" id="rt" name="rt" required>
                    </div>

                    <!-- RW -->
                    <div class="mb-3">
                        <label for="rw" class="form-label">RW</label>
                        <input type="number" class="form-control" id="rw" name="rw" required>
                    </div>

                    <!-- Jumlah Keluarga -->
                    <div class="mb-3">
                        <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                        <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" required>
                    </div>

                    <!-- Submit Button -->
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

    // document.getElementById('formAddPenduduk').addEventListener('submit', function(event) {
    //     event.preventDefault();
    //     // Simulate form submission
    //     alert('Data penduduk berhasil ditambahkan!');
    //     // Close the modal
    //     var modal = bootstrap.Modal.getInstance(document.getElementById('addPendudukModal'));
    //     modal.hide();
    // });
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