<?php 
	//load json 
	$json_data = $_POST['json_text'];
	//convert json to array
	$json_array=json_decode($json_data,true);
	//check if data is valid json otherwise don't continue
	if(!is_array($json_array))
	{
		echo 'Invalid JSON array sent';
		exit();
	}
	//shuffle array to randomly sort it
	shuffle($json_array);

	$sorted_array=array();
	$from_array=array();
	$to_array=array();
	//populate from and to columns of array into separate array
	foreach($json_array as $arr)
	{
		$from_array[]=$arr['from'];
		$to_array[]=$arr['to'];
	}
	//find difference of both from and to arrays and find the starting point (the point which is not present in `to` column is our starting point)
	$start=array_diff($from_array,$to_array);
	//get key of start row
	$key=array_keys($start);
	$key=$key[0];
	//place first row in sorted array and remove it from json array
	$sorted_array[0]=$json_array[$key];
	unset($json_array[$key]);
	$i=0;
	//while json array's rows are present keep looping
	while(count($json_array)>0)
	foreach($json_array as $key=>$arr)
	{
		//get next stop matching sorted array's `to` to json array's `from`
		if($arr['from']==$sorted_array[$i]['to'])
		{
			$i++;
			$sorted_array[$i]=$arr;
			//keep removing rows from json array which are already sorted to sorted_array
			unset($json_array[$key]);
		}
	}
	//print sorted array's response
	$i=0;
	$html='';
	foreach($sorted_array as $sorted)
	{
		$i++;
		$html.=$i.'. ';
		//type, number, from and to
		if($sorted['type']=='train')
		{
			$html.='Take '.$sorted['type'].' '.$sorted['number'].' from '.$sorted['from'].' to '.$sorted['to'].'. ';
		}
		if($sorted['type']=='bus')
		{
			$html.='Take the '.$sorted['number'].' '.$sorted['type'].' from '.$sorted['from'].' to '.$sorted['to'].'. ';
		}
		if($sorted['type']=='airplane')
		{
			$html.='From '.$sorted['from'].', take '.$sorted['number'].' to '.$sorted['to'].'. ';
		}
		//seat and gate
		if($sorted['gate']&&$sorted['seat'])
			$html.='Gate '.$sorted['gate'].', seat '.$sorted['seat'].'. ';
		else if($sorted['seat'])
			$html.='Sit in seat '.$sorted['seat'].'. ';
		else 
			$html.='No seat assignment. ';
		//counter for airplane
		if($sorted['type']=='airplane'&&$sorted['counter'])
			$html.='Baggage drop at ticket counter '.$sorted['counter'].'. ';
		else if($sorted['type']=='airplane'&&$sorted['counter']==null)
			$html.='Baggage will be automatically transferred from your last leg.';
		$html.='<br/>';
	}
	$i++;
	$html.=$i.'. You have arrived at your final destination.<br/>';
	echo $html;
?>