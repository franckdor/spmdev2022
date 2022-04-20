<label for="select-espece">Espece : </label>
<div id="acdiv">
    <input id="espece" name="espece" autocomplete="off" type="text" required>
    <div id="autocompletion"></div>
</div>

<?php
if (isset($tab)) {
    echo $tab;
}
