<?php
$age_group = '';
$mftotal = 0;
foreach($years as $yrow){
	$total = 0;
	echo '<div class="year_block">';
	echo '<div class="year_block_head">'.$yrow['year'].'</div>';
	foreach($mtype as $row){
		$mftotal = ($age_group == $row['age'])? $mftotal + $row['ndths'] : $row['ndths'];
		if($row['yr'] == $yrow['year']){
			$total = $total + $row['ndths'];
			$sex = ($row['sex'] == 1)? 'male' : 'female';
			echo '
				<div class="yb_row">'.$row['age'].'</div>
				<div class="yb_row">'.$sex.'</div>
				<div class="yb_row">'.$row['ndths'].'</div>';
			if($age_group == $row['age']){
				echo '<div id="'.$row['age'].'" class="yb_row">'.$mftotal.'</div>';
			}
			echo '<div></div>';
		}

		$age_group = $row['age'];
	}
	echo '
		<div class="ybt">Total:</div>
		<div class="ybtf">'.$total.'</div>
		</div>
	';
}