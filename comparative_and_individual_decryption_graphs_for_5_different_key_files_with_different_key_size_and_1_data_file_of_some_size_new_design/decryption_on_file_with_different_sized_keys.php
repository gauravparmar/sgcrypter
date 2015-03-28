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
        <div class="well"  style="background-color:#4BAAD3;">
        	<center><img src="../sgcrypter_logo.png" width="25%"></center><br>		
          <center><a href="../index.php" class="btn btn-success"  style="border-color:black;">HOME</a></center><br>
          <div class="alert alert-success alert-dismissable" style="padding:0; background-color:#4BAAD3; color:white;"><center><h3>Decryption Analyzer By : Prof. Shaligram Prajapat and Gaurav Parmar</h3></center></div>
          <div class="row">
              
              <div class="col-md-12">
                
                <form action="decryption_on_file_with_different_sized_keys.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                  	<div class="col-md-4"></div>
                    <div class="col-md-2" >
                      Select data file :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="data_file">
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <center><h4>Select different sized key files with size less than 57 bytes or 57 characters</h4></center>
                  <!--<select name="decryption_type" class="form-control">
                    <option selected>Select decryption type</option>
                    <option >DES</option>
                    <option >TRIPLE DES</option>
                    <option >BLOWFISH</option>
                    <option >TWOFISH</option>
                  </select><br>-->
                  <!--<input type="text" name="text" placeholder="Type text to encrypt here" class="form-control" value="<?php if(isset($_POST['text'])) echo mysql_real_escape_string(htmlentities($_POST['text']));?>"><br>-->
                  <div class="row">
                  	<div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select key file 1 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="key_file1">
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                  	<div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select key file 2 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="key_file2">    
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                  	<div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select key file 3 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="key_file3">    
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                  	<div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select key file 4 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="key_file4">    
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                  	<div class="col-md-4"></div>
                    <div class="col-md-2">
                      Select key file 5 :     
                    </div>
                    <div class="col-md-2">
                      <input type="file" name="key_file5">    
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <br>
                  <center><input type="submit" value="Encrypt" name="encrypt"  class="btn btn-primary"></center>
                </form> 
                <?php
                  if(isset($_POST['encrypt'])||isset($_FILES['key_file1']['name'])||isset($_FILES['key_file2']['name'])||isset($_FILES['key_file3']['name'])||isset($_FILES['key_file4']['name'])||isset($_FILES['key_file5']['name'])||isset($_FILES['data_file']['name']))
                  {
                    echo "<br>";
                    if(isset($_FILES['key_file1']['name'])&&isset($_FILES['key_file2']['name'])&&isset($_FILES['key_file3']['name'])&&isset($_FILES['key_file4']['name'])&&isset($_FILES['key_file5']['name'])&&isset($_FILES['data_file']['name'])&&!empty($_FILES['key_file1']['name'])&&!empty($_FILES['key_file2']['name'])&&!empty($_FILES['key_file3']['name'])&&!empty($_FILES['key_file4']['name'])&&!empty($_FILES['key_file5']['name'])&&!empty($_FILES['data_file']['name']))
                    {
                      $des_decryption_time=array();
                      $three_des_decryption_time=array();
                      $blowfish_decryption_time=array();
                      $twofish_decryption_time=array();
                      $key_size=array();
                      //$decryption_type=mysql_real_escape_string(htmlentities($_POST['decryption_type']));
                      //echo '<div class="alert alert-info"><center><h4>Decryption Type : '.$decryption_type.'</h4></center></div>';
                      $data_file_name=$_FILES['data_file']['name'];
                      $data_file_tmp_name=$_FILES['data_file']['tmp_name'];
                      $data_file_size=$_FILES['data_file']['size']/1024;
                      $location='../uploaded_files/';
                      move_uploaded_file($data_file_tmp_name,$location.$data_file_name);
                      $data_file_handle=fopen($location.$data_file_name,'r');
                      $data_file_content=fread($data_file_handle,filesize($location.$data_file_name));
                      
                      
          
                      for($i=0;$i<5;$i++)
                      {
                        //echo "iteration$i";
                        $key_size_par_name='key_file'.($i+1);
                        //echo '<br>Loop'.$i.'<br>'.$key_size_par_name;
                        $key_file_name=$_FILES[$key_size_par_name]['name'];
                        $tmp_name=$_FILES[$key_size_par_name]['tmp_name'];
                        $key_size[$i]=$_FILES[$key_size_par_name]['size'];
                        if($key_size[$i]>56)
                        {  
                          echo '<div class="alert alert-danger">Key size should be less than 57 bytes or 57 characters</div>';
                          die();
                        }
                        
                        //echo "<br>$key_file_name";
                        if(move_uploaded_file($tmp_name,$location.$key_file_name))
                        {

                          //echo "<br>moving";
                          
                          //echo "<br>file moved";
                          $key_file_handle=fopen($location.$key_file_name,'r');
                          $key_file_content=fread($key_file_handle,filesize($location.$key_file_name));
                          
                          /* calculating start time*/
	                         $mtime = microtime();
	                         $mtime = explode(" ",$mtime);
	                         $mtime = $mtime[1] + $mtime[0];
	                         $starttime = $mtime;
                          /*/ calculating start time*/
                          $des_encrypted_text=des_decrypt($data_file_content,$key_file_content);
                          /* calculating end time*/
	                          $mtime = microtime();
	                          $mtime = explode(" ",$mtime);
	                          $mtime = $mtime[1] + $mtime[0];
	                          $endtime = $mtime;
	                          $des_decryption_time[$i] = ($endtime - $starttime); //running time in seconds
                            /**/
                            $dtime=$des_decryption_time[$i];
                            //echo "<br>$dtime<br>";
                            //echo "<br>$key_size[$i]<br>";
                            //**/
                          /*/ calculating end time*/

                          /* calculating start time*/
	                         $mtime = microtime();
	                         $mtime = explode(" ",$mtime);
	                         $mtime = $mtime[1] + $mtime[0];
	                         $starttime = $mtime;
                          /*/ calculating start time*/
                          	$threedes_encrypted_text=threedes_decrypt($data_file_content,$key_file_content);
                          /* calculating end time*/
	                          $mtime = microtime();
	                          $mtime = explode(" ",$mtime);
	                          $mtime = $mtime[1] + $mtime[0];
	                          $endtime = $mtime;
	                          $three_des_decryption_time[$i] = ($endtime - $starttime); //running time in seconds
                          /*/ calculating end time*/

                          /* calculating start time*/
                           $mtime = microtime();
                           $mtime = explode(" ",$mtime);
                           $mtime = $mtime[1] + $mtime[0];
                           $starttime = $mtime;
                          /*/ calculating start time*/
                            $blowfish_encrypted_text=blowfish_decrypt($data_file_content,$key_file_content);
                          /* calculating end time*/
                            $mtime = microtime();
                            $mtime = explode(" ",$mtime);
                            $mtime = $mtime[1] + $mtime[0];
                            $endtime = $mtime;
                            $blowfish_decryption_time[$i] = ($endtime - $starttime); //running time in seconds
                          /*/ calculating end time*/

                          /* calculating start time*/
                           $mtime = microtime();
                           $mtime = explode(" ",$mtime);
                           $mtime = $mtime[1] + $mtime[0];
                           $starttime = $mtime;
                          /*/ calculating start time*/
                            $twofish_encrypted_text=twofish_decrypt($data_file_content,$key_file_content);
                          /* calculating end time*/
                            $mtime = microtime();
                            $mtime = explode(" ",$mtime);
                            $mtime = $mtime[1] + $mtime[0];
                            $endtime = $mtime;
                            $twofish_decryption_time[$i] = ($endtime - $starttime); //running time in seconds
                          /*/ calculating end time*/
                        }
                        //echo "i=$i<br><br>";
                      }
                      
                      echo '<div class="alert alert-info">';
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results</center></div>';
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For DES</center></div>';
                      echo '<div class="row"><div class="col-md-1">File</div><div class="col-md-5">Decryption Time</div><div class="col-md-3">File Size</div><div class="col-md-3">Key Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-1">'.$j.$i.'</div>';
                        echo '<div class="col-md-5">'.$des_decryption_time[$i].' s</div>';
                        echo '<div class="col-md-3">'.$data_file_size.' kb</div>';
                        echo '<div class="col-md-3" style="float:right;">'.$key_size[$i].' bytes</div>'; 
                        echo "</div>";
                      }
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For THREE DES</center></div>';
					            echo '<div class="row"><div class="col-md-1">File</div><div class="col-md-5">Decryption Time</div><div class="col-md-3">File Size</div><div class="col-md-3">Key Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-1">'.$j.'</div>';
                        echo '<div class="col-md-5">'.$three_des_decryption_time[$i].' s</div>';
                        echo '<div class="col-md-3">'.$data_file_size.' kb</div>';
                        echo '<div class="col-md-3" style="float:right;">'.$key_size[$i].' bytes</div>'; 
                        echo "</div>";
                      }
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For BLOWFISH</center></div>';
					            echo '<div class="row"><div class="col-md-1">File</div><div class="col-md-5">Decryption Time</div><div class="col-md-3">File Size</div><div class="col-md-3">Key Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-1">'.$j.'</div>';
                        echo '<div class="col-md-5">'.$blowfish_decryption_time[$i].' s</div>';
                        echo '<div class="col-md-3">'.$data_file_size.' kb</div>';
                        echo '<div class="col-md-3" style="float:right;">'.$key_size[$i].' bytes</div>'; 
                        echo "</div>";
                      }
                      echo '<div class="alert alert-info" style="background-color:#00aaFF; color:white; font-size:18px;"><center>Analysis Results For TWOFISH</center></div>';
					            echo '<div class="row"><div class="col-md-1">File</div><div class="col-md-5">Decryption Time</div><div class="col-md-3">File Size</div><div class="col-md-3">Key Size</div></div>';
                      for ($i=0; $i <5 ; $i++) 
                      { 
                        $j=$i+1;
                        echo '<div class="row">';
                        echo '<div class="col-md-1">'.$j.'</div>';
                        echo '<div class="col-md-5">'.$twofish_decryption_time[$i].' s</div>';
                        echo '<div class="col-md-3">'.$data_file_size.' kb</div>';
                        echo '<div class="col-md-3" style="float:right;">'.$key_size[$i].' bytes</div>'; 
                        echo "</div>";
                      }
	                      

                      /*
                      $par_str="parameters='time1=$decryption_time[0]";
                      $string='';
                      for($i=1;$i<10;$i++)
                      {
                        $y=$i+1;
                        $string=$string."&&time$y=$decryption_time[$i]"; 
                      }  
                      $par_str=$par_str.$string."';";
                      
                      echo '<br>'.$par_str;
                      */
                        echo '<br><center><div class="alert alert-warning"><h4>(Note: Refresh the page to regenerate statistics and graph data.)</h4><div></center>';
                      
                      /*Generating graph for DES*/
                      echo '<div class="row">';
                      echo '<div class="col-md-6">';
                   	  echo '<center><div class="alert alert-danger"><h4>Small Graphs</h4><hr>';
                      echo '<form action="different_key_size_des_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='des_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<center><input type="submit" class="btn btn-primary" value="Check DES Graph"></center></form>';
                      /*/Generating graph for DES*/

                      /*Generating graph for THREE DES*/
                      echo '<form action="different_key_size_three_des_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="'.$data_file_name.'" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='three_des_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$three_des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<hr><center><input type="submit" class="btn btn-primary" value="Check THREE DES Graph"></center></form>';
                      /*/Generating graph for THREE DES*/

                      /*Generating graph for BLOWFISH*/
                      echo '<form action="different_key_size_blowfish_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='blowfish_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$blowfish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<center><hr><input type="submit" class="btn btn-primary" value="Check BLOWFISH Graph"></center></form>';
                      /*/Generating graph for BLOWFISH*/

                      /*Generating graph for TWOFISH*/
                      echo '<form action="different_key_size_twofish_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='twofish_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$twofish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<center><hr><input type="submit" class="btn btn-primary" value="Check TWOFISH Graph"><hr></center></form>';
                      /*/Generating graph for TWOFISH*/
                      

                      /*Form sending DES, THREE DES, BLOWFISH and TWOFISH hidden POST values at once*/
                      echo '<form action="different_key_size_all_decryption_line_graph.php" method="POST">';

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

                          /*Adding hidden POST values for size of the key file*/
                          for ($k=1; $k <6; $k++) 
                          { 
                            $key_size_par_name='key_size'.$k;
                            $j=$k-1;
                            echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
                          }
                          /*/Adding hidden POST values for size of the files*/
                          /*Adding hidden POST values for graph page for DES*/
                          for ($k=1; $k <6; $k++) 
                          { 
                            $time_par_name='des_time'.$k;
                            $j=$k-1;
                            echo '<input type="text" value="'.$des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
                          }
                          /*/Adding hidden POST values for graph page for DES*/
                          /*Adding hidden POST values for graph page for THREE DES*/
                          for ($k=1; $k <6; $k++) 
                          { 
                            $time_par_name='three_des_time'.$k;
                            $j=$k-1;
                            echo '<input type="text" value="'.$three_des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
                          }
                          /*/Adding hidden POST values for graph page for THREE DES*/
                          /*Adding hidden POST values for graph page for BLOWFISH*/
                          for ($k=1; $k <6; $k++) 
                          { 
                            $time_par_name='blowfish_time'.$k;
                            $j=$k-1;
                            echo '<input type="text" value="'.$blowfish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
                          }
                          /*/Adding hidden POST values for graph page for BLOWFISH*/
                          /*Adding hidden POST values for graph page for TWOFISH*/
                          for ($k=1; $k <6; $k++) 
                          { 
                            $time_par_name='twofish_time'.$k;
                            $j=$k-1;
                            echo '<input type="text" value="'.$twofish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
                          }
                          /*/Adding hidden POST values for graph page for TWOFISH*/
                          

                          echo '<center><input type="submit" class="btn btn-success" value="Check Comparative Graph For All"></center></form></div>';
		                      echo '</div></center>';


				              echo '<div class="col-md-6"';
				              echo '<center><div class="alert alert-danger"><center><h4>Big Graphs</h4></center><hr>';
                      echo '<form action="different_key_size_des_big_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='des_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<center><input type="submit" class="btn btn-primary" value="Check DES Graph"></center></form>';
                      /*/Generating graph for DES*/

                      /*Generating graph for THREE DES*/
                      echo '<form action="different_key_size_three_des_big_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="'.$data_file_name.'" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='three_des_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$three_des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<center><hr><input type="submit" class="btn btn-primary" value="Check THREE DES Graph"></center></form>';
                      /*/Generating graph for THREE DES*/

                      /*Generating graph for BLOWFISH*/
                      echo '<form action="different_key_size_blowfish_big_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='blowfish_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$blowfish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<center><hr><input type="submit" class="btn btn-primary" value="Check BLOWFISH Graph"></center></form>';
                      /*/Generating graph for BLOWFISH*/

                      /*Generating graph for TWOFISH*/
                      echo '<form action="different_key_size_twofish_big_graph.php" method="POST">';
		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='twofish_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$twofish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
                      echo '<center><hr><input type="submit" class="btn btn-primary" value="Check TWOFISH Graph"></center></form>';
                      /*/Generating graph for TWOFISH*/
                      

                      /*Form sending DES, THREE DES, BLOWFISH and TWOFISH hidden POST values at once*/
		                      echo '<form action="different_key_size_all_decryption_big_line_graph.php" method="POST">';

                          /*Adding hidden POST values for size of the data file*/
                            echo '<input type="text" value="'.$data_file_size.'" name="data_size" hidden>';
                          /*/Adding hidden POST values for size of the data file*/

		                      /*Adding hidden POST values for size of the key file*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $key_size_par_name='key_size'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$key_size[$j].'" name="'.$key_size_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for size of the files*/
		                      /*Adding hidden POST values for graph page for DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='des_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for DES*/
		                      /*Adding hidden POST values for graph page for THREE DES*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='three_des_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$three_des_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for THREE DES*/
		                      /*Adding hidden POST values for graph page for BLOWFISH*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='blowfish_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$blowfish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for BLOWFISH*/
		                      /*Adding hidden POST values for graph page for TWOFISH*/
		                      for ($k=1; $k <6; $k++) 
		                      { 
		                        $time_par_name='twofish_time'.$k;
		                        $j=$k-1;
		                        echo '<input type="text" value="'.$twofish_decryption_time[$j].'" name="'.$time_par_name.'" hidden>';
		                      }
		                      /*/Adding hidden POST values for graph page for TWOFISH*/
		                      

		                      echo '<hr><center><input type="submit" class="btn btn-success" value="Check Comparative Graph For All"></center></form></div>';
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
      <div style="background-color:black;line-height:50px;font-family:Times New Roman;">
      	<center>Copyright &copy; Prof. Shaligram Prajapat and Gaurav Parmar</center>
      </div>
     
    <script type="text/javascript">
    /*
      function disp_graph()
      {
        alert('Called disp_graph');
        if(window.XMLHttpRequest)
        {
          xmlhttp=new XMLHttpRequest();
        }
        else
        {
          xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange=function()
        { 
          if(xmlhttp.readyState==4 && xmlhttp.status==200)
            document.getElementById('adiv').innerHTML=xmlhttp.responseText;
        } 
        
        <?php
          echo $par_str;
        ?>
        xmlhttp.open('POST','generate_graph.php',true);

        xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xmlhttp.send(parameters);
      }*/
    </script>
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
