<?php
echo "L'administrateur  ". htmlspecialchars($log) . " a été supprimé";
require_once File::build_path(array("view", "Admin", "list.php")); 