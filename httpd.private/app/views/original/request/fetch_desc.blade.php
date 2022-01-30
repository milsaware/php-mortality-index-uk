<?php
echo '<option selected disabled>Cause of death</option>';
foreach($mortality_type as $row){
	echo '<option value="'.$row['code'].'">'.$row['desc'].'</option>';
}