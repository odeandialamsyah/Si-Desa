<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dataAnggota.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
		body {
    font-family: sans-serif;
    background-color: #f2f2f2;
  }
  
  .container {
    width: 500px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input[type="text"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
  }
  
  .button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    width: 100px;
  }
  
  .button:hover {
    background-color: #3e8e41;
  }
	</style>
	<title>Sistem Informasi Desa</title>
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3><b>SID</b><span><b>esa</b></span></h3>
        </div>

                <div class="side-content">
            <div class="profile">
                <!-- Bungkus gambar dengan tag <a> -->
                <a href="dtlAdmn.html">
                    <div class="profile-img bg-img" style="background-image: url('img/admn.jpg'); cursor: pointer;"></div>
                </a>
                <h4 style="color: white;"><b>Cindy Mala Puput</b></h4>
            </div>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="index.html" style="text-decoration: none;">
                        <span class="fa fa-compass"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="dataKlasifikasi.html" style="text-decoration: none;">
                        <span class="fa fa-users"></span>
                        <small>Data Klasifikasi</small>
                    </a>
                </li>
               
                <li>
                    <a href="dataPenduduk.html" style="text-decoration: none;">
                        <span class="fa fa-user"></span>
                        <small>Data Penduduk</small>
                    </a>
                </li>
                <li>
                    <a href="BantuanSosial.html" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small>Bantuan Sosial</small>
                    </a>
                </li>
                <li>
                    <a href="laporan.html" class="active" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Laporan</small>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="fa-solid fa-bars mt-3" style="color: rgb(255, 255, 255);"></span>
                </label>

                <div class="dropdown">
                    <span><i class="fa-solid fa-user mr-1" style="color: rgb(255, 255, 255);"></i></span>
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color: rgb(255, 255, 255);">
                        <b>Admin</b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="dtlAdmn.html">Profile</a></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main>
            <table>
                <tr class="large-font">
            <td colspan="7" style="text-align: center;">
                <h2><b>LAPORAN</b></h2>
            </td>
        </tr>
                <tr>
					<table>
						<tr>
							<td><b>KK</b></td>
							<td>
								<select class="form-select" aria-label="Default select example">
									<option selected>Pilih Kartu Keluarga</option>
									<option value="1">12350-Ugar</option>
									<option value="2">12351-Arguni</option>
									<option value="2">12352-Werpigan</option>
									<option value="2">12353-Kinam</option>
									<option value="2">12354-Tomage</option>
									<option value="2">12360-Otoweri</option>
								  </select>
							</td>
						</tr>
						<tr>
							<td><b>Agama</b></td>
							<td>
								<select class="form-select" aria-label="Default select example">
									<option selected>Pilih Agama</option>
									<option value="1">Islam</option>
									<option value="2">Kristen</option>
									<option value="2">Katolik</option>
									<option value="2">Hindu</option>
									<option value="2">Budha</option>
									<option value="2">Konhucu</option>
								  </select>
							</td>
						</tr>
						<tr>
							<td><b>Klasifikasi</b></td>
							<td>
								<select class="form-select" aria-label="Default select example">
									<option selected>Pilih Klasifikasi</option>
									<option value="1">Desa Ugar</option>
									<option value="2">Desa Arguni</option>
									<option value="2">Desa Werpigan</option>
									<option value="2">Desa Kinam</option>
									<option value="2">Desa Tomage</option>
									<option value="2">Desa Otoweri</option>
								  </select>							
							</td>
						</tr>
					</table>
                </tr>
            </table>

			<button type="submit" class="btn btn-primary mb-3">Submit</button>

        </main>

        <script type="text/javascript" src="index.js"></script>
        <script type="text/javascript" src="dataAnggota.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>
</html>