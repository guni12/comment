<?php
$title = isset($title) ? $title : "En titel";
$text = isset($text) ? $text : "En text";
$val = isset($val) ? $val : ["En" => "Lista"];
?>
<!doctype html>
<meta charset=utf8>
<title><?= $title ?></title>
<h1><?= $title ?></h1>
<?php foreach ($val as $one => $item) : ?>
    <?= $one ?> <?= $item ?>
<?php endforeach; ?>
<br /><br />
<?=$text ?>
<br /><br />
