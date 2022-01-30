<?php
foreach($parent_options as $prow){
	echo '<option value="'.$prow['icd_par'].'">'.$prow['desc'].'</option>';
}