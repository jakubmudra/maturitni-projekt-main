<table>
    <?php
$rows = 6;
$cols = 6;

$products = [ [1,1], [2,2] ];

echo "<tr>";

$col = 1;

for ($i = 1;  $i <= $rows*$cols; $i++)
{
    $x = abs((($col - 1) * $cols) - $i);

    echo "<td>X: " . $x . ", Y: ".$col.", ID: ".$i."</td>";

    if($i  % $cols == 0 && $i != 0) {
        echo "</tr><tr>";
        $col = $col + 1;
    }

}
?>

</table>
