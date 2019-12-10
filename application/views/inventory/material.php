<table class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="2%">NO</th>
            <th width="10%">TYPE</th>
            <th width="18%">CODE</th>       
            <th width="40%">DESCRIPTION</th>
            <th width="20%">UNIT</th>
            <th width="10%">STOCK</th>                        
        </tr>
    </thead>
    <tbody> 
        <?php
        $no = 1;
        foreach ($item as $item) {
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td>MATERIAL</td>
                <td><?php echo $item->partnumber ?></td>
                <td><?php echo $item->descriptions ?></td>
                <td>
                    <?php
                    $altunit = $this->model_item->selectAlternateUnit($item->id);
                    if (!empty($altunit)) {
                        foreach ($altunit as $altunit) {
                            echo $altunit->codes . "<br/>";
                        }
                    }
                    $unit = $this->model_item->selectSmallestUnit($item->id);
                    if (!empty($unit)) {
                        echo $unit->codes;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $allunit = $this->model_item->selectAllUnit($item->id);
                    $temp = 0;
                    if (!empty($allunit)) {                        
                        foreach ($allunit as $allunit) {
                            echo $allunit->codes . " :" . $allunit->stock . "<br/>";
                            $temp += $allunit->stock * $allunit->conversionvalue;
                        }
                    }
                    echo "TOTAL: " . $temp . " " . (!empty($unit) ? $unit->codes : "");
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>    