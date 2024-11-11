<?php
require_once "view/header.php";

// Initialize variables
$search_query = "";

// Handle search query
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

// Fetch rooms data
$sql = $pdo->query("SELECT * FROM kamar");
?>

<div id="imgindex">
    <div id="imglog">
        <p><br>>>Kamar<br>&nbsp;</p>
    </div>
</div>

<div id="datakamar2">
    <div>
        <!-- Search form -->
        <form method="POST" action="your-php-file.php">
            <input type="text" name="search" placeholder="Search by Room Name" value="<?php echo $search_query; ?>">
            <button type="submit">Search</button>
        </form>

        <?php
        while ($data = $sql->fetch()) {
            $id = $data['idkamar'];
            $tipe = $data['tipe'];
            $jumlah = $data['jumlah'];
            $harga = $data['harga'];
            $gambar = $data['gambar'];

            // Filter rooms based on search query
            if (empty($search_query) || stripos($tipe, $search_query) !== false) {
                $angka = number_format($harga, 0, ",", ".");

                $sqly = $pdo->query("SELECT * FROM stokkamar WHERE idkamar=$id");
                while ($datay = $sqly->fetch()) {
                    $stok = $datay['stok'];
        ?>

                    <div class="kamar">
                        <table>
                            <tr>
                                <td>
                                    <center>
                                        <div class="idkamar">
                                            <?php echo $tipe ?>
                                        </div>
                                        <div class="tipekamar"><b>Rp. <?php echo $angka ?></div></b>
                                        <img src="simpangambar/<?php echo $gambar ?>" width="200px" height="150px" />
                                        <div class="tipekamar">Tersedia <?php echo $stok ?> Kamar</div>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>
                                        <a href="user/pemesanan"><button style="width:70px;background-color:#000;color:white;font-weight:bold;padding:4px;border:1px solid red;">Pesan</button></a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </div>
        <?php
                }
            }
        }
        ?>
    </div>
</div>

<?php
require_once "view/footer.php";
?>
