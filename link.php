<?php
require ("header.php");
require ("fungsi.php");
if(isset($_POST["url"])){
  $url="http://".$_POST["url"];
  $awal_judul=$_POST['awal_judul'];
  $akhir_judul=$_POST['akhir_judul'];
  $awal_tanggal=$_POST['awal_tanggal'];
  $akhir_tanggal=$_POST['akhir_tanggal'];
  $awal_berita=$_POST['awal_berita'];
  $akhir_berita=$_POST['akhir_berita'];
  
  // ambil_link($url, $awal_judul, $akhir_judul, $awal_tanggal, $akhir_tanggal, $awal_berita, $akhir_berita);
?>

<body>
  <div><h2 align='center'>Daftar Link di <?php echo $url; ?></h2></div>
    <div class="dataanggota">
      <?php
      // tampil_link($url);
      ambil_berita($url, $awal_judul, $akhir_judul, $awal_tanggal, $akhir_tanggal, $awal_berita, $akhir_berita);
      ?>    
  </div>
<?php 
}else{
  $url="";  
}
 ?>