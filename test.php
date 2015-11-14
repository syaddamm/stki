<?php
require ("header.php");
require ("fungsi.php");
require ("konek.php");
  
?>
<body>
  <div><h2 align='center'>Daftar Link di </h2></div>
    <div class="dataanggota">
      <?php
      // tokenize($id);
      $kata=array('kjgk adh      h',
                  ' lhlshf   skh   ',
                  '  sdhjishf hj     shj        slh');
      $jml=count($kata);
      $i=0;

      echo $kata[0]."<br>";
      echo $kata[1]."<br>";
      echo $kata[2]."<br>";

      echo $jml."<br>";
      for ($i=0; $i < $jml; $i++) { 
        $query="INSERT INTO Kata (kata) VALUES ('$kata[$i]')";
        mysqli_query($con, $query) or die();
      }
      ?>    
  </div>