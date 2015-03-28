<?php // content="text/plain; charset=utf-8"
	//echo 'Fist post variable is '.$_POST['time1'].$_POST['time2'];
	
/*	for($i=0;$i<10;$i++)
  	{  
	    $time='time'.($i+1);
	    $_POST[$time]=5.045+$i;
	}
*/	
		//header('Location:graph.php');
		$time=array();
		$size=array();
		for ($i=0; $i < 5; $i++) 
		{ 
			$tname='three_des_time'.($i+1);
			$sname='size'.($i+1);
			$time[$i]=$_POST[$tname];
			$size[$i]=$_POST[$sname];
		}
	  	//$time1=$_POST['time1'];
		require_once ('../src/jpgraph.php');
		require_once ('../src/jpgraph_scatter.php');
		 
		// Make a circle with a scatterplot
		//$steps=5;
		//$datax=array();
		$datax=array($time[0],$time[1],$time[2],$time[3],$time[4]);
		$datay=array($size[0],$size[1],$size[2],$size[3],$size[4]);
		/*for($i=0;$i<10;$i++)
		{
			$k='time'.($i+1);
			$datax[$i]=$_POST[$k];	
		}	
		foreach ($datax as $value) 
		{
			echo $value.'<br>';
		}*/
		   
		
		 
		$graph = new Graph(1350,650);
		$graph->SetScale('linlin');
		$graph->SetShadow();
		$graph->SetAxisStyle(AXSTYLE_BOXIN);
		 
		$graph->img->SetMargin(50,50,60,40);
		 
		$graph->title->Set("******|   SGcrypter  |******\n\nTHREE DES decryption graph by :\nProf. Shaligram Prajapat and Gaurav Parmar");
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->subtitle->Set("Here X = execution time(in seconds) and Y = file size(in kb)\n\n");
		$graph->subtitle->SetFont(FF_FONT1,FS_NORMAL);
		 
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
