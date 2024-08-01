<?php 
    require "sambungkan.php"; 

    if (isset($_POST['submit'])) {
        $file = $_FILES['userfile']['tmp_name'];

        // Mendapatkan ekstensi file CSV yang akan diimport.
        $ekstensi = explode('.', $_FILES['userfile']['name']);

        // Tampilkan peringatan jika submit tanpa memilih file.
        if (empty($file)) {
            echo 'Data tidak berhasil disimpan. File tidak boleh kosong!';   
        } else {
            // Validasi apakah file yang diupload benar-benar file CSV.
            if (strtolower(end($ekstensi)) === 'csv' && $_FILES["userfile"]["size"] > 0) {

                $i = 0;
                $handle = fopen($file, "r");
                while (($row = fgetcsv($handle, 2048)) ) {
                    $i++;
                    if ($i == 1) continue; // Skip header row

                    // Data yang akan disimpan ke dalam database
                    $sql = "INSERT INTO `2230511066_Reseller` 
                            (`NO_KTP`, `Nama`, `Email`, `NomorTelp`, `JenisKelamin`, `Alamat`) 
                            VALUES 
                            ('" . $row[0] . "', '" . $row[1] . "', '" . $row[2] . "', 
                             '" . $row[3] . "', '" . $row[4] . "', '" . $row[5] . "') 
                            ON DUPLICATE KEY UPDATE 
                            `Nama` = VALUES(`Nama`), 
                            `Email` = VALUES(`Email`), 
                            `NomorTelp` = VALUES(`NomorTelp`), 
                            `JenisKelamin` = VALUES(`JenisKelamin`), 
                            `Alamat` = VALUES(`Alamat`)";

                    if (mysqli_query($conn, $sql)) {
                        echo "Data berhasil disimpan";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
                fclose($handle); 
            } else {
                echo 'Data tidak berhasil disimpan. Format file tidak valid!';
            }
        }
    }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARAPSHOP - Data CSV</title>
    <meta name="description" content="ARAPSHOP - Data CSV Upload">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Styling for the CSV upload box */
        .csv-upload-box {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .csv-upload-box .form-group {
            text-align: left;
            max-width: 400px;
            margin: 0 auto 15px;
        }
        .csv-upload-box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
        }
        .csv-upload-box input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .csv-upload-box button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }
        .csv-upload-box button[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="images/icons/arap.png">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/arapshoplogo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logoarap.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Daftar Menu</h3><!-- /.menu-title -->
                    <li>
                        <a href="create-product.php"> <i class="menu-icon fa fa-plus"></i>Create Products </a>
                    </li>
                    <li>
                        <a href="print-pdf.php"> <i class="menu-icon fa fa-handshake-o"></i>Join Us </a>
                    </li>
                    <li>
                        <a href="data-csv.php"> <i class="menu-icon fa fa-file"></i>Data Reseller - CSV File </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary">9</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/araapp.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>
                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>
                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true"
                            aria-expanded="true">
                            <i class="flag-icon flag-icon-id"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <!-- CSV Upload Box -->
        <div class="csv-upload-box">
            <h2>Upload Data Reseller</h2>
            <form action="upload-csv.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
		<br></br>
                    <label for="file">Masukkan File CSV</label>
                    <input type="file" id="file" name="file" accept=".csv" required>
                </div>
                <button type="submit">Upload Data</button>
            </form>
        </div>
    </div><!-- /#right-panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
