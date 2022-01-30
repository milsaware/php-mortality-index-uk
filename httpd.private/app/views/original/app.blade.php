<select id="timeline">
	<option disabled>Timeline</option>
	<option value="1" selected>1901 - 1910</option>
	<option value="2">1911 - 1920</option>
	<option value="3">1921 - 1930</option>
	<option value="4">1931 - 1939</option>
	<option value="5">1940 - 1949</option>
	<option value="6">1950 - 1957</option>
	<option value="7">1958 - 1967</option>
	<option value="8">1968 - 1978</option>
	<option value="9">1979 - 1984</option>
	<option value="10">1985 - 1993</option>
	<option value="11">1994 - 2000</option>
	<option value="12">2001 - 2009</option>
	<option value="13">2010 - 2018</option>
</select>
-
<select id="cod">
	<option selected disabled>Cause of death</option>
	<?php foreach($mortality_type as $row){
		echo '<option value="'.$row['code'].'">'.$row['desc'].'</option>';
	}?>
</select>

<div id="container"></div>