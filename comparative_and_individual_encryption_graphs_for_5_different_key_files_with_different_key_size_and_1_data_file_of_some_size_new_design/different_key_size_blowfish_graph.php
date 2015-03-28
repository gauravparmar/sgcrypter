<?php // content="text/plain; charset=utf-8"
	//echo 'Fist post variable is '.$_POST['time1'].$_POST['time2'];
	
/*	for($i=0;$i<10;$i++)
  	{  
	    $blowfish_time='time'.($i+1);
	    $_POST[$blowfish_time]=5.045+$i;
	}
*/	
		//header('Location:graph.php');
		$blowfish_time=array();
		$key_size=array();
		for ($i=0; $i < 5; $i++) 
		{ 
			$blowfish_time_par_name='blowfish_time'.($i+1);
			$key_size_par_name='key_size'.($i+1);
			$blowfish_time[$i]=$_POST[$blowfish_time_par_name];
			$key_size[$i]=$_POST[$key_size_par_name];
		}
	  	//$blowfish_time1=$_POST['time1'];
		require_once ('../src/jpgraph.php');
		require_once ('../src/jpgraph_scatter.php');
		 
		// Make a circle with a scatterplot
		//$steps=5;
		//$datax=array();
		$datax=array($key_size[0],$key_size[1],$key_size[2],$key_size[3],$key_size[4]);
		$datay=array($blowfish_time[0],$blowfish_time[1],$blowfish_time[2],$blowfish_time[3],$blowfish_time[4]);
		
		/*for($i=0;$i<10;$i++)
		{
			$k='time'.($i+1);
			$datax[$i]=$_POST[$k];	
		}	
		foreach ($datax as $value) 
		{
			echo $value.'<br>';
		}*/
		   
		
		 
		$graph = new Graph(470,400);
		$graph->SetScale('linlin');
		$graph->SetShadow();
		$graph->SetAxisStyle(AXSTYLE_BOXIN);
		 
		$graph->img->SetMargin(80,80,120,60);
		 
		$graph->title->Set("******|   SGcrypter  |******\n\nBLOWFISH encryption graph by :\n Prof. Shaligram Prajapat and Gaurav Parmar");
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->subtitle->Set("Here X = Key size(in bytes) and Y = Execution time (in s)\n\n");
		 
		// 10% top and bottom grace
		$graph->yscale->SetGrace(5,5);
		$graph->xscale->SetGrace(1,1);
		 
		$sp1 = new ScatterPlot($datay,$datax);
		$sp1->mark->SetType(MARK_FILLEDCIRCLE);
		$sp1->mark->SetFillColor('blue');
		$sp1->SetColor('blue');
		 
		$sp1->mark->SetWidth(4);
		$sp1->link->Show();
		$sp1->link->SetWeight(2);
		$sp1->link->SetColor('blue@0.7');
		 
		 
		$graph->Add($sp1);
		$graph->Stroke();
 	
	//echo '<img src="'.$a.'">; 	
	//echo $a;
?>
