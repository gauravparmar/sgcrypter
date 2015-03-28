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

      <link href="css/bootstrap.css" rel="stylesheet">
      <style type="text/css">
              
      </style>

  </head>
  <body >
      <div class="well">
        
        <div class="row">
          <center><img src="sgcrypter_logo.png" width="25%"></center><br>  
          <div class="alert alert-info" style="font-size:20px;">  

            <center>
                Select the graph category
            </center>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <center>
              <hr><a class="btn btn-primary" href="comparative_and_individual_encryption_graphs_with_5_data_files_of_different_size_and_1_text_key_of_same size_new_design/encryption_from_file2.php">
                Category I : Data size vs execution time graphs for encryption using a single key and 5 different data files
              </a>
            </center>
          </div>
          <div class="col-md-12">
            <center>
              <hr><a class="btn btn-success" href="comparative_and_individual_decryption_graphs_with_5_data_files_of_different_size_and_1_text_key_of_same size_new_design/decryption_from_file2.php">
                Category II : Data size vs execution time graphs for decryption using a single key and 5 different data files
              </a>
            </center>
          </div>
          <div class="col-md-12">
            <center>
              <hr><a class="btn btn-primary" href="comparative_and_individual_encryption_graphs_for_5_different_key_files_with_different_key_size_and_1_data_file_of_some_size_new_design/encryption_on_file_with_different_sized_keys.php">
                Category III : Key size vs execution time graphs for encryption using a fixed sized data and 5 different key files
              </a>
            </center>
          </div>
          <div class="col-md-12">
            <center>
              <hr><a class="btn btn-success" href="comparative_and_individual_decryption_graphs_for_5_different_key_files_with_different_key_size_and_1_data_file_of_some_size_new_design/decryption_on_file_with_different_sized_keys.php">
                Category IV : Key size vs execution time graphs for decryption using a fixed sized data and 5 different key files
              </a>
            </center>
          </div>
          <div class="col-md-12">
            <center>
              <hr><a class="btn btn-danger" href="test_files.zip">
                Click here to download all the files for testing
              </a><hr>
            </center>
          </div>  
            
          </div>
        <div class="row" style="background-color:black;line-height:50px;font-family:Times New Roman;color:white;">
        	<center>Copyright &copy; Prof. Shaligram Prajapat and Gaurav Parmar</center>
        </div>
      </div>
      	
    
    <script src="js/jquery-1.10.2.js"></script>
      <script src="js/bootstrap.js"></script>
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
