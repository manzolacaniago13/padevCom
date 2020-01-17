<html>

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="">

      <title>STMIK ERESHA (Daftar Skripsi)</title>

      <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

      <!-- Bootstrap core CSS -->
      <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="starter-template.css" rel="stylesheet">

  </head>

  <body>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="https://padevcwebapp.azurewebsites.net/">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="">XXX<span class="sr-only">(current)</span></a>
                  </li>
          </div>
      </nav>

      <main role="main" class="container">
          <div class="starter-template"> <br><br><br>
              <h1>Pengajuan Skripsi STRATA 1 di STMIK ERESHA</h1>
              <span class="border-top my-3"></span>
          </div>

          <form action="index.php" method="POST">
          <div class="form-group">
                  <label for="nim">Nomor Induk Mahasiswa : </label>
                  <input type="text" class="form-control" name="Nim" id="nim" required="">
              </div>
              <div class="form-group">
                  <label for="names">Nama Mahasiswa : </label>
                  <input type="text" class="form-control" name="nama_mahasiswa" id="names" required="">
              </div>
              <div class="form-group">
                  <label for="kode">Kode Kelas : </label>
                  <input type="text" class="form-control" name="kd_kelas" id="kode" required="" maxlength="10">
              </div>
              <div class="form-group">
                  <label for="judul">Judul Pengajuan (Skripsi) : </label>
                  <input type="text" class="form-control" name="judul_skripsih" id="judul" required="">
              </div>

              <input type="submit" class="btn btn-success" name="submit" value="Submit">
          </form>
          <!-- <br><br> -->
          <form action="index.php" method="GET">
              <div class="form-group">
                  <input type="submit" class="btn btn-info" name="load_datah" value="Reload">
              </div>
          </form>

          <?php
            $host = "padevappserver.database.windows.net";
            $user = "padevcdbserver";
            $pass = "P1234566a";
            $db = "submissazure";

            try {
                $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo "Failed: " . $e;
            }

            if (isset($_POST['submit'])) {
                try {
                    $nim = $_POST['Nim'];
                    $names = $_POST['nama_mahasiswa'];
                    $kode = $_POST['kd_kelas'];
                    $judul = $_POST['judul_skripsih'];
                    $date = date("Y-m-d");
                    // Insert data
                    $sql_insert = "INSERT INTO submissazure (Nim, nama_mahasiswa, kd_kelas, judul_skripsih, date) 
                        VALUES (?,?,?,?)";
                    $stmt = $conn->prepare($sql_insert);
                    $stmt->bindValue(1, $nim);
                    $stmt->bindValue(2, $names);
                    $stmt->bindValue(3, $kode);
                    $stmt->bindValue(4, $judul);
                    $stmt->bindValue(5, $date);
                    $stmt->execute();
                } catch (Exception $e) {
                    echo "Failed: " . $e;
                }

                echo "<h3>Your're registered!</h3>";
            } else if (isset($_GET['load_datah'])) {
                try {
                    $sql_select = "SELECT * FROM submissazure";
                    $stmt = $conn->query($sql_select);
                    $dataways = $stmt->fetchAll();
                    if (count($dataways) > 0) {
                        echo "<h2>Mahasiswa yang sudah teregistrasi kendaraannya sebanyak : " . count($dataways) . " Orang</h2>";
                        echo "<table class='table table-hover'><thead>";
                        echo "<tr><th>Name</th>";
                        echo "<th>NIM</th>";
                        echo "<th>TKNB</th>";
                        echo "<th>Date</th></tr></thead><tbody>";
                        foreach ($dataways as $dataway) {
                            echo "<tr><td>" . $dataway['Nim'] . "</td>";
                            echo "<td>" . $dataway['nama_mahasiswa'] . "</td>";
                            echo "<td>" . $dataway['kd_kelas'] . "</td>";
                            echo "<td>" . $dataway['judul_skripsih'] . "</td>";
                            echo "<td>" . $dataway['date'] . "</td></tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<h3>No one is currently registered.</h3>";
                    }
                } catch (Exception $e) {
                    echo "Failed: " . $e;
                }
            }
            ?>
          </div>
      </main><!-- /.container -->

      </tbody>
      </table>

      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="" crossorigin="anonymous"></script>
      <script>
          window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
      </script>
      <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
      <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
  </body>

  </html>
