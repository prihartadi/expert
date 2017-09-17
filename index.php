<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SP Sapi</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <?php 

  $gejala = array("demam tinggi","badan lemah","turun berat badan","aborsi","gangguan syaraf","gangguan reproduksi","diare","kematian","produksi susu menurun","badan gemetar","susah bernafas","mata berwarna gelap","depresi","pernafasan cepat","peningkatan denyut nadi","kejang-kejang","jalan sempoyongan","keluar air liur","infeksi janin","gangguan sistem pernafasan","nafsu makan menurun","darah keluar dari hidung");
	// print_r($gejala);
	// echo "<br>";
	$penyakit = array("brucellosis","infection bovine rinotracheitis","johne's disease","antraks","sapi gila","bovine viral diarhea");
	// print_r($penyakit);
	$rules = array(
				array(1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
				array(0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
				array(0,0,1,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0),
				array(0,0,0,0,0,0,0,1,0,0,1,1,1,1,1,1,1,1,0,0,0,0),
				array(0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,1,1,0),
				array(0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,1,1)
		);

   ?>
   	<div class="container theme-showcase" role="main">
	   	<div class="jumbotron">
	   		<h2>Sistem Pakar Identifikasi Penyakit Sapi</h2>
	   		<p>Aplikasi untuk membantu mengidentifikasi penyakit pada ternak sapi.</p>	
	   	</div>

		   <?php 
		
		if (isset($_POST['submit'])) {
			//echo $_POST['radio1'];
			for($j=0; $j<(count($gejala)); $j++){
				if(isset($_POST['radio'.$j])){
					$input[$j] = $_POST['radio'.$j];
				}
				else{
					$input[$j] = 0;	
				}
			}
			//echo "<br>";
			//print_r($input);
			if(array_sum($input)==0){
				//echo "<br>";
				echo "<div id='hasil' class='alert alert-success' role='alert'><h3>Sapi dalam keadaan <b>sehat</b></h3></div>";
				echo "<br>";
			}
			else{
				//$input = array(1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
				$temp = 0;
				// echo "<br>";
				// echo count($rules);
				// echo "<br>";
				// echo count($gejala);
				for($i=0; $i<(count($rules)); $i++){
					$sum[$i] = 0;
					for($j=0; $j<(count($gejala)); $j++){
						$sum[$i] = $sum[$i] + ($input[$j]*$rules[$i][$j]);
					}
					if($temp<$sum[$i]){
						$temp = $sum[$i];
						$diagnosa = $i;
					} 
				}
				//echo "<br>";
				//print_r($sum);
				// echo $temp;
				//echo "<div id='hasil'>";
				//echo "<br>";
				echo "<div id='hasil' class='alert alert-danger' role='alert'><h3>Sapi diduga menderita penyakit <b><i>".$penyakit[$diagnosa]."</i></b></h3></div>";
				echo "<br>";
				//echo "<button type='button' class='btn btn-danger btn-block'>Kembali</button>";
				//echo "</div>";	
				}
			}
		
		?>
	    
	    <form action="" method="post">
	    	<div id="angket">
	    	<?php 
	    		foreach ($gejala as $key => $val){
	    			echo " 			
	    			<table class='table table-bordered'>
	    				<tr>
	    					<td class='pertanyaan'><p>".($key+1).". Apakah sapi mengalami ".$val."? </p></td>
	    					<td class='pilihan'>
	    						<label class='radio-inline'>
					    			<input type='radio' name='radio".$key."' value='1'>Ya
					    		</label>
					    		<label class='radio-inline'>
					    			<input type='radio' name='radio".$key."' value='0'>Tidak
					    		</label>
	    					</td>
	    				</tr>
	    			</table>
	    			";
	    		}
	    	 ?>
	    	<input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block"/>
	    	<br>
	    	</div>

		</form>

	    
   	</div>
   	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>