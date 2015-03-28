<!-- 
	Author : Gaurav Parmar
	Project Name : SGcrypter
	Author URL : being-technical.blogspot.in
	Tags : encryption, decryption, cryptography
-->

<!DOCTYPE html>
<html lang="en">
    <head>
      <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link href="../css/bootstrap.css" rel="stylesheet">
      <style type="text/css">
      .alert
      {
      	background-color: black;
      }
      </style>

  </head>
  <body style="color:white;">
      <br>
      <div class="container">
        <div class="well" style="background-color:#4BAAD3;">
          <center><img src="../sgcrypter_logo.png" width="25%"></center><br>	
          <center><a href="../index.php" class="btn btn-success"  style="border-color:black;">HOME</a></center><br>
          <div class="alert alert-success " style="padding:0; background-color:#4BAAD3; color:white;"><center><h3>Encryption Analyzer By : Prof. Shaligram Prajapat and Gaurav Parmar</h3></center></div>
          <div class="row">
              
              <div class="col-md-12">
                <center><h4>Select files for encryption in increasing order of their size</h4></center>
                <center><form action="encryption_from_file2.php" method="POST" enctype="multipart/form-data">
                  <!--<select name="encryption_type" class="form-control">
                    <option selected>Select encryption type</option>
                    <option >DES</option>
                    <option >TRIPLE DES</option>
                    <option >BLOWFISH</option>
                    <option >TWOFISH</option>
                  </select><br>-->
                  <!--<input type="text" name="text" placeholder="Type text to encrypt here" class="form-control" value="<?php if(isset($_POST['text'])) echo mysql_real_escape_string(htmlentities($_POST['text']));?>"><br>-->
                  
                  <div class="row">
                  
                  <div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select file 1 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="txt_file1">
                    </div>
                  <div class="col-md-4"></div>  
                  </div>
                  <div class="row">
                  <div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select file 2 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="txt_file2">    
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                  	<div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select file 3 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="txt_file3">    
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select file 4 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="txt_file4">    
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                  <div class="row">
  					<div class="col-md-4"></div>                
                    <div class="col-md-2">
                      Select file 5 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="txt_file5">    
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <br>
                  <div class="row">
                  	<div class="col-md-3"></div>
                  	<div class="col-md-6">
                  		<input type="text" name="ekey"  placeholder="Type a key here with size less than 57 characters or bytes"  class="form-control" value="<?php if(isset($_POST['ekey'])) echo mysql_real_escape_string(htmlentities($_POST['ekey']));?>"  > <br>
                  <center>
                  	</div>
                  	
                  </div>                  
                  <input type="submit" value="Encrypt" name="encrypt"  class="btn btn-primary"></center>
                </form> </center>
                <?php
                  if(isset($_POST['ekey'])||isset($_POST['encrypt'])||isset($_FILES['txt_file1']['name'])||isset($_FILES['txt_file2']['name'])||isset($_FILES['txt_file3']['name'])||isset($_FILES['txt_file4']['name'])||isset($_FILES['txt_file5']['name']))
                  {
                    echo "<br>";
                    if($_POST['ekey']!=''&&isset($_FILES['txt_file1']['name'])&&isset($_FILES['txt_file2']['name'])&&isset($_FILES['txt_file3']['name'])&&isset($_FILES['txt_file4']['name'])&&isset($_FILES['txt_file5']['name'])&&isset($_FILES['txt_file1']['name'])&&!empty($_FILES['txt_file2']['name'])&&!empty($_FILES['txt_file3']['name'])&&!empty($_FILES['txt_file4']['name'])&&!empty($_FILES['txt_file5']['name']))
                    {
                      $des_encryption_time=array();
                      $three_des_encryption_time=array();
                      $blowfish_encryption_time=array();
                      $twofish_encryption_time=array();
                      $file_size=array();
                      //$encryption_type=mysql_real_escape_string(htmlentities($_POST['encryption_type']));
                      //echo '<div class="alert alert-info"><center><h4>Encryption Type : '.$encryption_type.'</h4></center></div>';
                      for($i=0;$i<5;$i++)
                      {
                        $txt_file_name='txt_file'.($i+1);
                        //echo '<br>Loop'.$i.'<br>'.$txt_file_name;
                        $filename=$_FILES[$txt_file_name]['name'];
                        $tmp_name=$_FILES[$txt_file_name]['tmp_name'];
                        $file_size[$i]=$_FILES[$txt_file_name]['size']/1024;
                        $location='../uploaded_files/';
                        $ekey=mysql_real_escape_string(htmlentities($_POST['ekey']));
                        if(strlen($ekey)>56)
                        {
                        	echo '<div class="alert alert-danger">Please type a key with size less than 57 characters or bytes</div>';
                        }	
                        if(move_uploaded_file($tmp_name,$location.$filename))
                        {
                          //echo "<br>file moved";
                          $handle=fopen($location.$filename,'r');
                          $content=fread($handle,filesize($location.$filename));
                          //echo "<br>Content of file :<br> $content <br>"; 
                          
                          //echo $encryption_type;
                          //$text=mysql_real_escape_string(htmlentities($_POST['text']));
                          
                          /* calculating start time*/
	                         $mtime = microtime();
	                         $mtime = explode(" ",$mtime);
	                         $mtime = $mtime[1] + $mtime[0];
	                         $starttime = $mtime;
                          /*/ calculating start time*/
                          $des_encrypted_text=des_encrypt($content,$ekey);
                          /* calculating end time*/
	                          $mtime = microtime();
	                          $mtime = explode(" ",$mtime);
	                          $mtime = $mtime[1] + $mtime[0];
	                          $endtime = $mtime;
	                          $des_encryption_time[$i] = ($endtime - $starttime); //running time in seconds
                          /*/ calculating end time*/

                          /* calculating start time*/
	                         $mtime = microtime();
	                         $mtime = explode(" ",$mtime);
	                         $mtime = $mtime[1] + $mtime[0];
	                         $starttime = $mtime;
                          /*/ calculating start time*/
                          	$threedes_encrypted_text=threedes_encrypt($content,$ekey);
                          /* calculating end time*/
	                          $mtime = microtime();
	                          $mtime = explode(" ",$mtime);
	                          $mtime = $mtime[1] + $mtime[0];
	                          $endtime = $mtime;
	                          $three_des_encryption_time[$i] = ($endtime - $starttime); //running time in seconds
                          /*/ calculating end time*/

                          /* calculating start time*/
	                         $mtime = microtime();
	                         $mtime = explode(" ",$mtime);
	                         $mtime = $mtime[1] + $mtime[0];
	                         $starttime = $mtime;
                          /*/ calculating start time*/
                          	$blowfish_encrypted_text=blowfish_encrypt($content,$ekey);
                          /* calculating end time*/
	                          $mtime = microtime();
	                          $mtime = explode(" ",$mtime);
	                          $mtime = $mtime[1] + $mtime[0];
	                          $endtime = $mtime;
	                          $blowfish_encryption_time[$i] = ($endtime - $starttime); //running time in seconds
                          /*/ calculating end time*/

                          /* calculating start time*/
	                         $mtime = microtime();
	                         $mtime = explode(" ",$mtime);
	                         $mtime = $mtime[1] + $mtime[0];
	                         $starttime = $mtime;
                          /*/ calculating start time*/
                          	$twofish_encrypted_text=twofish_encrypt($content,$ekey);
                          /* calculating end time*/
	                          $mtime = microtime();
	                          $mtime = explode(" ",$mtime);
	                          $mtime = $mtime[1] + $mtime[0];
	                          $endtime = $mtime;
	                          $twofish_encryption_time[$i] = ($endtime - $starttime); //running time in seconds
                          /*/ calculating end time*/
							                            
                            
                          
                          
                          /*/ calculating end time*/    
                            //$encrypted_text64=base64_encode($encrypted_text);
                          //echo '<br>File name : '.$filename;
                          //echo '<div class="alert alert-success alert-dismissable" style="text-align:center;"><center><h4>Encryption Type : '.$encryption_type.'
                          /*
                          echo '<div class="alert alert-success alert-dismissable" style="text-align:center;"><center><h4>File name : '.$filename.'</h4></center><font color="black">Encryption time : </font>'.$encryption_time[$i].' seconds';
                          echo '<br><font color="black">Encryption key : </font><br><input type="text" class="form-control" value="'.$ekey.'"><br><font color="black">Encrypted text :</font><input type="text" class="form-control" value="'.$encrypted_text.'"></div>';
                          */

                        }
                      }
                      echo '<div class="alert alert-info">';
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results</center></div>';
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For DES</center></div>';
                      echo '<div class="row"><div class="col-md-2">File</div><div class="col-md-5">Encryption Time</div><div class="col-md-5" style="float:right;">File Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-2">'.$j.'</div>';
                        echo '<div class="col-md-5">'.$des_encryption_time[$i].' s</div>';
                        echo '<div class="col-md-5" style="float:right;">'.$file_size[$i].' kb</div>'; 
                        echo "</div>";
                      }
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For THREE DES</center></div>';
					  echo '<div class="row"><div class="col-md-2">File</div><div class="col-md-5">Encryption Time</div><div class="col-md-5" style="float:right;">File Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-2">'.$j.'</div>';
                        echo '<div class="col-md-5">'.$three_des_encryption_time[$i].' s</div>';
                        echo '<div class="col-md-5" style="float:right;">'.$file_size[$i].' kb</div>'; 
                        echo "</div>";
                      }
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For BLOWFISH</center></div>';
					  echo '<div class="row"><div class="col-md-2">File</div><div class="col-md-5">Encryption Time</div><div class="col-md-5" style="float:right;">File Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-2">'.$j.'</div>';
                        echo '<div class="col-md-5">'.$blowfish_encryption_time[$i].' s</div>';
                        echo '<div class="col-md-5" style="float:right;">'.$file_size[$i].' kb</div>'; 
                        echo "</div>";
                      }
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For TWOFISH</center></div>';
					  echo '<div class="row"><div class="col-md-2">File</div><div class="col-md-5">Encryption Time</div><div class="col-md-5" style="float:right;">File Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-2">'.$j.'</div>';
                        echo '<div class="col-md-5">'.$twofish_encryption_time[$i].' s</div>';
                        echo '<div class="col-md-5" style="float:right;">'.$file_size[$i].' kb</div>'; 
                        echo "</div>";
                      }
	                      

                      /*
                      $par_str="parameters='time1=$encryption_time[0]";
                      $string='';
                      for($i=1;$i<10;$i++)
                      {
                        $y=$i+1;
                        $string=$string."&&time$y=$encryption_time[$i]"; 
                      }  
                      $par_str=$par_str.$string."';";
                      
                      echo '<br>'.$par_str;
                      */
                      echo '<br><center><div class="alert alert-warning"><h4>(Note: Refresh the page to regenerate statistics and graph data.)</h4><div></center>';
                      
                      /*Generating graph for DES*/
                      echo '<div class="row">';
                      echo '<div class="col-md-6">';
                      			echo '<center><div class="alert alert-danger"><h4>Small Graphs</h4><hr>';
		                      echo '<form action="des_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check DES Graph"></center></form><hr>';
		                      /*/Generating graph for DES*/

		                      /*Generating graph for THREE DES*/
		                      echo '<form action="three_des_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='three_des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$three_des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check THREE DES Graph"></center></form><hr>';
		                      /*/Generating graph for THREE DES*/

		                      /*Generating graph for BLOWFISH*/
		                      echo '<form action="blowfish_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='blowfish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$blowfish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check BLOWFISH Graph"></center></form><hr>';
		                      /*/Generating graph for BLOWFISH*/

		                      /*Generating graph for TWOFISH*/
		                      echo '<form action="twofish_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='twofish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$twofish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check TWOFISH Graph"></center></form>';
		                      /*/Generating graph for TWOFISH*/
		                      

		                      /*Form sending DES, THREE DES, BLOWFISH and TWOFISH hidden POST values at once*/
				                      echo '<form action="all_encryption_line_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
				                      /*Adding hidden POST values for graph page for THREE DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='three_des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$three_des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for THREE DES*/
				                      /*Adding hidden POST values for graph page for BLOWFISH*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='blowfish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$blowfish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for BLOWFISH*/
				                      /*Adding hidden POST values for graph page for TWOFISH*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='twofish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$twofish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for TWOFISH*/
				                      

				                      echo '<hr><input type="submit" class="btn btn-success" value="Check Comparative Graph For All"></form>';
				                      echo '</div></center></div>';
				                      echo '<div class="col-md-6"';
				                      	echo '<center><div class="alert alert-danger"><center><h4>Big Graphs</h4></center><hr>';
		                      echo '<form action="des_big_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check DES Graph"></center></form><hr>';
		                      /*/Generating graph for DES*/

		                      /*Generating graph for THREE DES*/
		                      echo '<form action="three_des_big_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='three_des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$three_des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check THREE DES Graph"></center></form><hr>';
		                      /*/Generating graph for THREE DES*/

		                      /*Generating graph for BLOWFISH*/
		                      echo '<form action="blowfish_big_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='blowfish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$blowfish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check BLOWFISH Graph"></center></form><hr>';
		                      /*/Generating graph for BLOWFISH*/

		                      /*Generating graph for TWOFISH*/
		                      echo '<form action="twofish_big_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='twofish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$twofish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
		                      echo '<center><input type="submit" class="btn btn-primary" value="Check TWOFISH Graph"></center></form>';
		                      /*/Generating graph for TWOFISH*/
		                      

		                      /*Form sending DES, THREE DES, BLOWFISH and TWOFISH hidden POST values at once*/
				                      echo '<form action="all_encryption_big_line_graph.php" method="POST">';
				                      /*Adding hidden POST values for size of the files*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $sname='size'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$file_size[$j].'" name="'.$sname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for size of the files*/
				                      /*Adding hidden POST values for graph page for DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for DES*/
				                      /*Adding hidden POST values for graph page for THREE DES*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='three_des_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$three_des_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for THREE DES*/
				                      /*Adding hidden POST values for graph page for BLOWFISH*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='blowfish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$blowfish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for BLOWFISH*/
				                      /*Adding hidden POST values for graph page for TWOFISH*/
				                      for ($k=1; $k <6; $k++) 
				                      { 
				                        $tname='twofish_time'.$k;
				                        $j=$k-1;
				                        echo '<input type="text" value="'.$twofish_encryption_time[$j].'" name="'.$tname.'" hidden>';
				                      }
				                      /*/Adding hidden POST values for graph page for TWOFISH*/
				                      

				                      echo '<hr><center><input type="submit" class="btn btn-success" value="Check Comparative Graph For All"></center></form>';
				                      echo '</div></center>';
		                      echo '</div>';
		                      echo '</div>';
                      /*/Form sending DES, THREE DES, BLOWFISH and TWOFISH hidden POST values at once*/

                    } 
                    else
                      echo '<div class="alert alert-warning alert-dismissable">Please provide all the information.</div>';
                  }
                ?>  
              </div>
              
          </div>
        </div>  
      </div>
      </div>
      <div style="background-color:black;line-height:50px;font-family:Times New Roman;">
      	<center>Copyright &copy; Prof. Shaligram Prajapat and Gaurav Parmar</center>
      </div>
      
      	
    
    <script src="../js/jquery-1.10.2.js"></script>
      <script src="../js/bootstrap.js"></script>
  </body>
</html>



<?php
	function tripledes_encrypt($string,$key) {
	    
		$iv = $key;
		
		@$encrypted_string = mcrypt_encrypt(MCRYPT_TRIPLEDES, $key, $string, MCRYPT_MODE_CBC, $iv);
		$encrypted_string=base64_encode($encrypted_string);
	    return $encrypted_string;
	}
	function tripledes_decrypt($encrypted_string,$key) {
	    
		$iv = $key;
		$encrypted_string=base64_decode($encrypted_string);

		@$string = mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $encrypted_string, MCRYPT_MODE_CBC, $iv);
	    return $string;
	}
  function des_encrypt($string,$key) {
     
    $iv = $key;
    
    @$encrypted_string = mcrypt_encrypt(MCRYPT_DES, $key, $string, MCRYPT_MODE_CBC, $iv);
    $encrypted_string=base64_encode($encrypted_string);
      return $encrypted_string;
  }
  function des_decrypt($encrypted_string,$key) {
    $iv = $key;
    $encrypted_string=base64_decode($encrypted_string);

    @$string = mcrypt_decrypt(MCRYPT_DES, $key, $encrypted_string, MCRYPT_MODE_CBC, $iv);
      return $string;
  }
  function blowfish_encrypt($string,$key) {
      
    $iv = $key;
    
    @$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $string, MCRYPT_MODE_CBC, $iv);
    $encrypted_string=base64_encode($encrypted_string);
      return $encrypted_string;
  }
  function blowfish_decrypt($encrypted_string,$key) {
    
    $iv = $key;
    $encrypted_string=base64_decode($encrypted_string);

    @$string = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $encrypted_string, MCRYPT_MODE_CBC, $iv);
      return $string;
  }
  function threedes_encrypt($string,$key) {
    $iv = $key;
    
    @$encrypted_string = mcrypt_encrypt(MCRYPT_3DES, $key, $string, MCRYPT_MODE_CBC, $iv);
    $encrypted_string=base64_encode($encrypted_string);
      return $encrypted_string;
  }
  function threedes_decrypt($encrypted_string,$key) {
      
    $iv = $key;
    $encrypted_string=base64_decode($encrypted_string);

    @$string = mcrypt_decrypt(MCRYPT_3DES, $key, $encrypted_string, MCRYPT_MODE_CBC, $iv);
      return $string;
  }
  function twofish_encrypt($string,$key) {
    $iv = $key;
    
    @$encrypted_string = mcrypt_encrypt(MCRYPT_TWOFISH, $key, $string, MCRYPT_MODE_CBC, $iv);
    $encrypted_string=base64_encode($encrypted_string);
      return $encrypted_string;
  }
  function twofish_decrypt($encrypted_string,$key) {
      
    $iv = $key;
    $encrypted_string=base64_decode($encrypted_string);

    @$string = mcrypt_decrypt(MCRYPT_TWOFISH, $key, $encrypted_string, MCRYPT_MODE_CBC, $iv);
      return $string;
  }
	
?>
