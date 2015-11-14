<?php require 'header.php'; ?>
<!-- Form Untuk Upload File CSV-->
<div class="login-panel panel panel-primary">
  <div class="panel-heading">
  <center>
      <h4><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Ambil Konten</h3>
  </center>
  </div>
  <div class="panel-body">
    <div class="container" style="max-width:460px;">
         <form method="post" action="link.php" enctype="multipart/form-data">
          <div class="form-group">
              <input type="text" name="url" id="email" class="form-control" required placeholder="Alamat URL">
          </div>
          <div class="form-group">
              <input type="text" name="awal_judul" class="form-control" placeholder="Tag Awal Judul" required >
          </div>
          <div class="form-group">
              <input type="text" name="akhir_judul" class="form-control" placeholder="Tag Akhir Judul" required >
          </div>
          <div class="form-group">
              <input type="text" name="awal_tanggal" class="form-control" placeholder="Tag Awal Tanggal" required >
          </div>
          <div class="form-group">
              <input type="text" name="akhir_tanggal" class="form-control" placeholder="Tag Akhir Tanggal" required >
          </div>
          <div class="form-group">
              <input type="text" name="awal_berita" class="form-control" placeholder="Tag Awal Berita" required >
          </div>
          <div class="form-group">
              <input type="text" name="akhir_berita" class="form-control" placeholder="Tag Akhir Berita" required >
          </div>
          <!-- Change this to a button or input when using this as a form -->
          <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span> Buka</button><br>
        </form>
    </div>
  </div>
  <div class="panel-footer">
    <h5 align="center"><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Indira, Indriana, Sita, Syaddam <br> <?php echo date('Y'); ?></h5>
  </div>
</div>

