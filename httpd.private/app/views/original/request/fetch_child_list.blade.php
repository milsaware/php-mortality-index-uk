<?php
foreach($child_options as $crow){
	echo '<option value="'.$crow['icd_sub'].'">'.$crow['desc'].'</option>';
}