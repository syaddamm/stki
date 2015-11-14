<?php 
	
	function ambil_berita($url, $awal_judul, $akhir_judul, $awal_tanggal, $akhir_tanggal, $awal_berita, $akhir_berita){
	  	include 'konek.php';
		$html = file_get_contents($url);

		$dom = new DOMDocument();
		@$dom->loadHTML($html);

		// grab all the on the page
		$xpath = new DOMXPath($dom);
		$hrefs = $xpath->evaluate("/html/body//a");

		?>
	  	<table class="table table-striped">
		    <tr>
		      <td>No</td>
		      <td>Link</td>
			  <td>Keterangan</td>
		    </tr>
		<?php 

		$no = 1;

		

		for ($i = 0; $i < $hrefs->length; $i++) {
			$href = $hrefs->item($i);
			$url = $href->getAttribute('href');

			$query="Select * from berita where url='".$url."'";
			$cek=mysqli_query($con, $query) or die();

			if(strlen($url)<=100) continue;  
				if (mysqli_num_rows($cek)==0) {?>
					
					<?php
						$data=file_get_contents($url);
						$isi_judul=explode($awal_judul, $data);
						$isi_judul2=explode($akhir_judul, $isi_judul[1]);

						$judul=$isi_judul2[0];
						$isi_tanggal=explode($awal_tanggal, $data);
						$isi_tanggal2=explode($akhir_tanggal, $isi_tanggal[1]);

						$tanggal=$isi_tanggal2[0];

						$isi_berita=explode($awal_berita, $data);
						$isi_berita2=explode($akhir_berita, $isi_berita[1]);

						$isi_berita=str_replace('"', ' ', $isi_berita2[0]);
						$isi_berita=str_replace("'", "", $isi_berita);
						$isi_berita=strip_tags($isi_berita);

						if(!empty($url) && !empty($judul) && !empty($tanggal) && !empty($isi_berita)){
						$query="INSERT INTO Berita (url,judul,tanggal,isi_berita, status_token) VALUES ('$url','$judul', '$tanggal', '$isi_berita', 0)";
						mysqli_query($con, $query) or die(); ?>
						<tr>
			            <td><?php echo $no; ?></td>
			            <td><?php echo $url; ?></td>
			            <td>
			            <div class="alert alert-success" role="alert"><strong><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Berhasil</strong></div>
			            </td>

			        </tr>

						<?php }

					}else{ ?>
						<tr>
			            <td><?php echo $no; ?></td>
			            <td><?php echo $url; ?></td>
			            <td>
			            <div class="alert alert-danger" role="alert"><strong><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Udah Pernah</strong></div>
			            </td>

			         </tr>
					<?php }
				$no++; 
				}?>
			        
			        </table>

<?php	}


	function daftar_berita(){
		include 'konek.php';
		$query="Select * from berita";

		$hasil=mysqli_query($con, $query);

		?>
	  	<table class="table table-striped">
		    <tr>
		      <td>No</td>
		      <td>Judul</td>
		      <td>Aksi</td>
		    </tr>
		<?php 

		$i=1;
		while($data=mysqli_fetch_assoc($hasil)) {?>
			<tr>
	            <td><?php echo $data['id_berita']; ?></td>
	            <td><b><?php echo $data['judul']; ?></b></td>
	            <td>
	            	<a <?php if($data['status_token']==1){ echo "disabled";} ?> class="btn btn-success" href="tokenize.php?id=<?php echo $data['id_berita']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Tokenize</a>
	            	<?php if($data['status_token']==1){ ?><a class="btn btn-primary" href="hasil.php?id=<?php echo $data['id_berita']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Hasil</a><?php } ?>
	            </td>
	         </tr>
		<?php $i++;
		} ?>
		</table>
	<?php } 

	function tokenize($id){
		include 'konek.php';
		$query="Select * from berita where id_berita =".$id;

		$hasil=mysqli_query($con, $query);
		
		$data=mysqli_fetch_assoc($hasil);
			$id_berita=$data['id_berita'];
			$isi_berita=$data['isi_berita'];
			$isi_berita=strtolower($isi_berita);
			$kata=preg_split('/[ .,]/', $isi_berita);
			$total=count($kata);
			echo $isi_berita."<br><br><br><br>";
			?>
			
			
			<?php
			$i=0;

			for ($i=0; $i <  $total ; $i++) {
				$cek="select * from kata_mentah where id_berita=".$id_berita." and kata='".$kata[$i]."'";
				$hasil=mysqli_query($con, $cek) or die(mysql_error($con));

				if($kata[$i]=="") continue;
				if(mysqli_num_rows($hasil)==0){
					$query="INSERT INTO Kata_mentah (kata, id_berita) VALUES ('$kata[$i]','$id_berita');";
					mysqli_query($con, $query) or die(mysql_error($con));
				}else{
					$query="update kata set frekuensi=(select frekuensi from kata_mentah where kata='$kata[$i]' and id_berita='$id_berita')+1 where kata='$kata[$i]' and id_berita='$id_berita'";
					// mysqli_query($con, $query) or die(mysql_error($con));
					echo $query;

				}
			}

			$query_insert="insert into kata (kata, id_berita) select kata, id_berita from kata_mentah where id_berita=".$id_berita." order by kata asc";
			$query="UPDATE berita set status_token=1 where id_berita=".$id_berita;
			$query_delete="delete from kata_mentah";
			mysqli_query($con, $query) or die(mysql_error($con));
			mysqli_query($con, $query_insert) or die(mysql_error($con));
			mysqli_query($con, $query_delete) or die(mysql_error($con)); ?>

			<div class="alert alert-success" role="alert">
				<strong><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Berhasil Tokenizing :)</strong>
			</div> <?php
	}

	function hasil($id){
		include 'konek.php';
		$query="Select * from kata where id_berita=".$id;

		$hasil=mysqli_query($con, $query);

		?>
	  	<table class="table table-striped">
		    <tr>
		      <td>No</td>
		      <td>Kata</td>
		      <td>Kata Dasar</td>
		    </tr>
		<?php 

		$i=1;
		while($data=mysqli_fetch_assoc($hasil)) {
			if($data['kata']=="" or $data['kata']==" " or $data['kata']=="--") continue;?>
			<tr>
	            <td><?php echo $data['id_kata']; ?></td>
	            <td><?php echo $data['kata']; ?></td>
	            <td><?php echo $data['kata_dasar']; ?></td>
	         </tr>
		<?php $i++;
		} ?>
		</table>
	<?php } 
	?>