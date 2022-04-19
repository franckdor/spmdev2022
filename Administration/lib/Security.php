<?php
class Security {

    private static $seed = "Odile Do";
	public static function hacher($texte_en_clair) {
		$texte_hache = hash('sha256', ''.$texte_en_clair.static::$seed);
		return $texte_hache;
	}
}

?>
