<?php
require ("header.php");
require ("fungsi.php");
if(isset($_GET['id'])){
  $id=$_GET['id'];
  
  
?>
<body>
  <div><h2 align='center'>Proses Tokenisasi</h2></div>
    <div class="dataanggota">
      <?php
      tokenize($id);
      ?>    
  </div>
<?php 
}else{
  echo "";
}
 ?>