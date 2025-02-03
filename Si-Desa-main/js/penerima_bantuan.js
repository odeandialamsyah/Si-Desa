function showModal(nama, foto, rt_rw, jumlahKeluarga) {
    document.getElementById('modalTitle').innerText = "Bukti Penerima Bantuan: " + nama;
    document.getElementById('modalImage').src = foto;
    document.getElementById('modalDescription').innerText = 
        "Nama: " + nama + "\n" +
        "RT/RW: " + rt_rw + "\n" +
        "Jumlah Keluarga: " + jumlahKeluarga + " orang";
}