<?php require 'View/partials/app.php'; ?>
        <main>
            <table>
                <tr class="large-font">
            <td colspan="7" style="text-align: center;">
                <h2><b>DATA KLASIFIKASI</b></h2>
            </td>
        </tr>
                
 <tr style="background-color: #D9D9D9;">
                    <th scope="col">No</th>
                    <th scope="col">Klasifikasi</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Range Umur</th>
                  
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>1</td>
                    <td>Anak-anak</td>
                    <td>50 Orang</td>
                    <td>0-12 Tahun</td>
                   
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>2</td>
                    <td>Remaja</td>
                    <td>30 Orang</td>
                    <td>13-17 Tahun</td>
                    
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>3</td>
                    <td>Dewasa</td>
                    <td>48 Orang</td>
                    <td>18-59 Tahun</td>
                   
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>4</td>
                    <td>Lansia</td>
                    <td>10 Orang</td>
                    <td>60 Tahun ke atas</td>
                    
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

        <script type="text/javascript" src="index.js"></script>
        <script type="text/javascript" src="dataAnggota.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>
</html>