<?php  	
if(isset($_POST["submit"]) && $_POST["date"] != ""):
	$date = new DateTime($_POST["date"]);
	$nextYear = (int)$date->format('Y') + 1;

	$nextY = new DateTime("{$nextYear}-01-01");
	$end = $date->diff($nextY);
	$endDate = $end->format('%R%a');
?>

<div class='days'><p>З <?=$date->format('Y-m-d')?> до <?=$nextY->format('Y-m-d')?></p></div>
<div class='pday'><p>Кількість днів: <img src='image.php?endDate=<?=$endDate?>'/></p></div>

<?php endif; ?>
