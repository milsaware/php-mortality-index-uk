<?php
class appModel {
	
	public static function icd_whitelist(){
		return array('1','2','3','4','5','6','7','8','9','10','11','12','13');
	}

	public static function fetch_desc($icd){
		$icd = preg_replace('#[^0-9]#', '', $icd);
		$icd_whitelist = appModel::icd_whitelist();

		if(in_array($icd, $icd_whitelist)){
			$cod = array();
			$db = new SQLite3(SYS.'db'.DS.$icd.'.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT code, desc
				FROM desc
				ORDER BY desc ASC
			';

			if($query = $db->prepare($query)){
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$cod[] = array(   
						'code' => $row['code'],
						'desc' => $row['desc']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();

			return $cod;
		}
	}

	public static function fetch_list($icd, $mtype){
		$mtype = preg_replace('#[^a-zA-Z0-9()]#', '', $mtype);
		$icd = preg_replace('#[^0-9]#', '', $icd);
		$icd_whitelist = appModel::icd_whitelist();

		if(in_array($icd, $icd_whitelist)){
			$rates = array();
			$db = new SQLite3(SYS.'db'.DS.$icd.'.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT code, yr, sex, age, ndths
				FROM rates
				WHERE code = :code
			';

			if($query = $db->prepare($query)){
				$query->bindValue(':code', $mtype);
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$rates[] = array(   
						'code' => $row['code'],
						'yr' => $row['yr'],
						'sex' => $row['sex'],
						'age' => preg_replace('#[^0-9\-<]#', '', $row['age']),
						'ndths' => $row['ndths']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();

			return $rates;
		}
	}

	public static function fetch_years($icd, $mtype){
		$mtype = preg_replace('#[^a-zA-Z0-9()]#', '', $mtype);
		$icd = preg_replace('#[^0-9]#', '', $icd);
		$icd_whitelist = appModel::icd_whitelist();

		if(in_array($icd, $icd_whitelist)){
			$years = array();
			$db = new SQLite3(SYS.'db'.DS.$icd.'.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT DISTINCT yr
				FROM rates
				WHERE code = :code
			';

			if($query = $db->prepare($query)){
				$query->bindValue(':code', $mtype);
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$years[] = array(
						'year' => $row['yr']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();

			return $years;
		}
	}
	
	public static function mortality_year_age($icd, $yearf, $yeart, $age){
		$icd = preg_replace('#[^0-9]#', '', $icd);
		$icd_whitelist = appModel::icd_whitelist();

		if(in_array($icd, $icd_whitelist)){
			$group = array();
			$db = new SQLite3(SYS.'db'.DS.$icd.'.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT ndths, SUM(ndths) as tdths
				FROM rates
				WHERE age = :age
				AND yr between :yearf AND :yeart
			';

			if($query = $db->prepare($query)){
				$query->bindValue(':yearf', $yearf);
				$query->bindValue(':yeart', $yeart);
				$query->bindValue(':age', $age);
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$group[] = array(
						'ndths' => $row['ndths'],
						'tdths' => $row['tdths']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();

			return $group;
		}
	}
	
	public static function cause_by_age_year($icd, $yearf, $yeart, $age){
		$icd = preg_replace('#[^0-9]#', '', $icd);
		$icd_whitelist = appModel::icd_whitelist();

		if(in_array($icd, $icd_whitelist)){
			$group = array();
			$db = new SQLite3(SYS.'db'.DS.$icd.'.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT DISTINCT rates.code, desc.desc
				FROM rates
				INNER JOIN desc
				ON rates.code = desc.code
				WHERE rates.age = :age
				AND rates.yr between :yearf AND :yeart
				ORDER BY desc.desc ASC
			';

			if($query = $db->prepare($query)){
				$query->bindValue(':yearf', $yearf);
				$query->bindValue(':yeart', $yeart);
				$query->bindValue(':age', $age);
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$group[] = array(
						'desc' => $row['desc']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();
			
			return $group;
		}
	}
	
	public static function n_by_age($icd, $yearf, $yeart, $age){
		$total_deaths = 0;
		$icd = preg_replace('#[^0-9]#', '', $icd);
		$icd_whitelist = appModel::icd_whitelist();

		if(in_array($icd, $icd_whitelist)){
			$group = array();
			$db = new SQLite3(SYS.'db'.DS.$icd.'.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT SUM(ndths) as tdths
				FROM rates
				WHERE age = :age
				AND yr between :yearf AND :yeart
			';

			if($query = $db->prepare($query)){
				$query->bindValue(':yearf', $yearf);
				$query->bindValue(':yeart', $yeart);
				$query->bindValue(':age', $age);
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$total_deaths = $row['tdths'];
				}

				$result->finalize();
				$query->close();
			}

			$db->close();
			
			return $total_deaths;
		}
	}
	
	public static function fetch_by_age_total($yearf, $yeart, $age){
		$group = array();
		$db = new SQLite3(SYS.'db'.DS.'trending'.DS.'totals.db', SQLITE3_OPEN_READONLY);
		$query = '
			SELECT dba.year,dba.age,dba.tdths,lb.tlbths
			FROM dba
			INNER JOIN lb
			ON dba.year = lb.year
			WHERE dba.age = "'.$age.'"
			AND dba.year BETWEEN "'.$yearf.'" AND "'.$yeart.'"
		';

		if($query = $db->prepare($query)){

			$result = $query->execute();

			while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
				$group[] = array(
					'year' => $row['year'],
					'age' => $row['age'],
					'tdths' => $row['tdths'],
					'tlbths' => $row['tlbths']
				);

			}

			$result->finalize();
			$query->close();
		

		$db->close();
		}
			
		return $group;
	}
	
	public static function fetch($icd, $code, $y){
		$where = '';
		$codes = explode(",",$code);
		$i = 1;
		foreach($codes as $code){
			$where .= ($i == 1)? 'WHERE (code = "'.$code.'"' : ' OR code = "'.$code.'"';
			$i++;
		}
		$where .= ')';
		//echo $where;die;
		$tdths = 0;
		$icd = preg_replace('#[^0-9]#', '', $icd);
		$icd_whitelist = appModel::icd_whitelist();

		if(in_array($icd, $icd_whitelist)){
			$db = new SQLite3(SYS.'db'.DS.$icd.'.db', SQLITE3_OPEN_READONLY);
			$query = '
			SELECT SUM(ndths) as tdths
			FROM rates '.$where.' AND yr = "'.$y.'"
			';

			if($query = $db->prepare($query)){
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$tdths = $row['tdths'];
				}

				$result->finalize();
				$query->close();
				$db->close();
			}
		}
		return $tdths;
	}
	
	public static function add_to_db($year, $age, $tdths){
		$db = new SQLite3(SYS.'db'.DS.'trending'.DS.'totals.db', SQLITE3_OPEN_READWRITE);
		$query = 'INSERT INTO deaths_by_age ("year", "age", "tdths") VALUES (:year, :age, :tdths)';

		if($query = $db->prepare($query)){
			$query->bindValue(':year', $year);
			$query->bindValue(':age', $age);
			$query->bindValue(':tdths', $tdths);
			$result = $query->execute();
			$result->finalize();
			$query->close();
		}

		$db->close();
	}
}