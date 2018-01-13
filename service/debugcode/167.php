<?php

$data="how tos split a string using explode";
$splittedstring=explode(" ",$data);
foreach ($splittedstring as $key => $value)
{
echo "splittedstring[".$key."] = ".$value."<br>";
}
?>