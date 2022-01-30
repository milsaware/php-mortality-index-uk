<?php
class icd10Model {
	
	public static function icd_whitelist(){
		return array('12','13');
	}
	
	public static function fetch_chapters(){
		$chapters = array();
		$db = new SQLite3(SYS.'db'.DS.'icd10.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT icd_chap, desc
				FROM desc_chap
				ORDER BY icd_chap ASC
			';

			if($query = $db->prepare($query)){
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$chapters[] = array(   
						'chapter' => $row['icd_chap'],
						'desc' => $row['desc']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();

			return $chapters;
	}
	
	public static function fetch_parent_list($chapter){
		$options = array();
		$chapter = preg_replace('#[^A-Z]#', '', $chapter);
		$db = new SQLite3(SYS.'db'.DS.'icd10.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT icd_par, desc
				FROM desc_par
				WHERE icd_chap = :chapter
				ORDER BY desc ASC
			';

			if($query = $db->prepare($query)){
				$query->bindValue(':chapter', $chapter);
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$options[] = array(   
						'icd_par' => $row['icd_par'],
						'desc' => $row['desc']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();

			return $options;
	}
	
	public static function fetch_child_list($parent_id){
		$options = array();
		$parent_id = preg_replace('#[^A-Za-z0-9]#', '', $parent_id);
		$db = new SQLite3(SYS.'db'.DS.'icd10.db', SQLITE3_OPEN_READONLY);
			$query = '
				SELECT icd_sub, desc
				FROM desc_chi
				WHERE icd_par = :parent_id
				ORDER BY desc ASC
			';

			if($query = $db->prepare($query)){
				$query->bindValue(':parent_id', $parent_id);
				$result = $query->execute();

				while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
					$options[] = array(   
						'icd_sub' => $row['icd_sub'],
						'desc' => $row['desc']
					);
				}

				$result->finalize();
				$query->close();
			}

			$db->close();

			return $options;
	}
}