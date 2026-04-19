<option value="1">банан</option>
<?php

echo "<option value=" . $inv["id_inventory"] . ">" . $inv["name"] . "</option>";
echo "name \"Alex\"";

?>
name "Alex"
<option value="<?=$inv["id_inventory"]?>"><?=$inv["name"]?></option>
