<?php
class Security {

    private static $seed = "2cH7qWCYK3";
	public static function hacher($texte_en_clair) {
		$texte_hache = hash('sha256', ''.$texte_en_clair.static::$seed);
		return $texte_hache;
	}

	public static function is_connected() {
		return isset($_SESSION['login']);		
	}
}

?>
