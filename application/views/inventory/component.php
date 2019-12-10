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
        foreach ($component as $component) {
            ?>
            <tr>
                <td align="right"><?php echo $no++ ?></td>
                <td>COMPONENT</td>
                <td><?php echo $component->partnumber ?></td>
                <td><?php echo $component->description ?></td>
                <td><?php echo $component->unitcode ?></td>
                <td><?php echo $component->stock ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>       