<?php require 'View/partials/app.php'; ?>        <main>
            <table>
                <tr class="large-font">
                    <td colspan="7" style="text-align: center;">
                        <h2><b>YANG TELAH MENERIMA BANTUAN SOSIAL</b></h2>
                    </td>
                </tr>
                <tr>
                    <table class="table table-striped">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Tambah penerima bantuan
                        </button>
                        <thead style="background-color: #D9D9D9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor KK</th>
                                <th scope="col">Nama Kepala Keluarga</th>
                                <th scope="col">RT / RW</th>
                                <th scope="col">Jumlah Keluarga</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="redirectToDetail('PenerimanBantuan.html')" style="cursor: pointer;">
                                <td>1</td>
                                <td>979868758769</td>
                                <td>Bambang</td>
                                <td>07/08</td>
                                <td>4 orang</td>
                                <td>
                                    <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                                    <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                                    <i class="fa-solid fa-eye mr-2" style="color: #2ad53e;" data-bs-toggle="modal" data-bs-target="#modal1"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
            </table>
        </main>

        <!-- Modal untuk detail bantuan sosial -->
        <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTitle">Bukti penerima bantuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="PB.jpg" alt="" style="width: 100%; height: auto;">
                        <p id="modalDescription">Keterangan bantuan...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk menambahkan penerima bantuan -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5"
id="staticBackdropLabel">Tambah Penerima Bantuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="nomorKK" class="form-label">Nomor KK</label>
                                <input type="text" class="form-control" id="nomorKK" placeholder="Masukkan Nomor KK">
                            </div>
                            <div class="mb-3">
                                <label for="namaKK" class="form-label">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control" id="namaKK" placeholder="Masukkan Nama Kepala Keluarga">
                            </div>
                            <div class="mb-3">
                                <label for="rtRw" class="form-label">RT / RW</label>
                                <input type="text" class="form-control" id="rtRw" placeholder="Masukkan RT/RW">
                            </div>
                            <div class="mb-3">
                                <label for="jumlahKeluarga" class="form-label">Jumlah Keluarga</label>
                                <input type="text" class="form-control" id="jumlahKeluarga" placeholder="Masukkan Jumlah Keluarga">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menggunakan Bootstrap dan jQuery dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function redirectToDetail(url) {
            window.location.href = url;
        }

        // Script untuk menangani modal image dan description
        $('.fa-eye').click(function() {
            var imageSrc = $(this).data('image');
            var description = $(this).data('description');
            $('#modalImage').attr('src', imageSrc);
            $('#modalDescription').text(description);
        });
        
    </script>
</body>
</html>