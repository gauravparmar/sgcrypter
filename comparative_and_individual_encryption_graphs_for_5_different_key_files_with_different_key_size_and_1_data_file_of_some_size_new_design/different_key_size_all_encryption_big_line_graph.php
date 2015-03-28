<?php // content="text/plain; charset=utf-8"
	require_once ('../src/jpgraph.php');
	require_once ('../src/jpgraph_line.php');

	//$file_size=array();
	$des_time=array();
	$three_des_time=array();
	$blowfish_time=array();
	$twofish_time=array();
	$key_size=array();
	
	$data_size=$_POST['data_size'];
	for($i=0;$i<5;$i++)
	{
		$j=$i+1;
		
		$des_time_p_name='des_time'.$j;
		$three_des_time_p_name='three_des_time'.$j;
		$blowfish_time_p_name='blowfish_time'.$j;
		$twofish_time_p_name='twofish_time'.$j;
		$key_size_p_name='key_size'.$j;

		
		$des_time[$i]=$_POST[$des_time_p_name];
		$three_des_time[$i]=$_POST[$three_des_time_p_name];
		$blowfish_time[$i]=$_POST[$blowfish_time_p_name];
		$twofish_time[$i]=$_POST[$twofish_time_p_name];
		$key_size[$i]=$_POST[$key_size_p_name];
	} 
	/*
	$datay1 = array(20,15,23,15,25);
	$datay2 = array(12,9,42,8,30);
	$datay3 = array(5,17,32,24,35);
	$datay4 = array(2,10,28,58,70);*/

	// Setup the graph
	$graph = new Graph(1350,650);
	$graph->SetScale("textlin");

	$theme_class=new UniversalTheme;

	$graph->SetTheme($theme_class);
	$graph->img->SetAntiAliasing(false);
	$graph->img->SetMargin(80,80,120,60);
	$graph->title->SetFont(FF_FONT1,FS_BOLD); //setting title font
	$graph->title->Set("******|   SGcrypter  |******\n\nComparative encryption graph by :\n Prof. Shaligram Prajapat and Gaurav Parmar");
	$graph->subtitle->SetFont(FF_FONT1	); //setting title font
	$graph->subtitle->Set("Here X = Key size (in bytes) and Y = Execution time (in s)\n");
	
	$graph->SetBox(false);

	$graph->img->SetAntiAliasing();

	$graph->yaxis->HideZeroLabel();
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);

	$graph->xgrid->Show();
	$graph->xgrid->SetLineStyle("solid");
	$graph->xaxis->SetTickLabels($key_size);
	$graph->xgrid->SetColor('#E3E3E3');

	// Create the first line
	$p1 = new LinePlot($des_time);
	$graph->Add($p1);
	$p1->SetColor("#6495ED");
	$p1->SetLegend('DES');

	// Create the second line
	$p2 = new LinePlot($three_des_time);
	$graph->Add($p2);
	$p2->SetColor("#B22222");
	$p2->SetLegend('THREE DES');

	// Create the third line
	$p3 = new LinePlot($blowfish_time);
	$graph->Add($p3);
	$p3->SetColor("#FF1493");
	$p3->SetLegend('BLOWFISH');

	// Create the fourth line
	$p4 = new LinePlot($twofish_time);
	$graph->Add($p4);
	$p4->SetColor("#00FF00");
	$p4->SetLegend('TWOFISH');

	//$graph->title->Set('Quality result');
	
	//$graph->SetTitles(array('One','Two'));

	$graph->legend->SetFrameWeight(1);

	// Output line
	$graph->Stroke();
?>