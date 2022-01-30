<select id="icd_timeline">
	<option disabled>Timeline</option>
	<option value="12">2001 - 2009</option>
	<option value="13">2010 - 2018</option>
</select>
-
<select id="icd_chapter">
	<option selected disabled>Select chapter</option>
	<?php foreach($chapters as $row){
		echo '<option value="'.$row['chapter'].'">'.$row['desc'].'</option>';
	}?>
</select>

<select id="icd_parent"></select>
<select id="icd_child"></select>

<div id="container"></div>
<script src="<?php echo '/assets/'.SKIN.'/js/icd10.js';?>"></script>