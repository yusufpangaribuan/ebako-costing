<table class="tablesorter" width="99%">
    <thead>
        <tr>
            <th width="2%" rowspan="2">No</th>
            <th rowspan="2" width="15%">Code</th>
            <th rowspan="2" width="15%">Customer Code</th>
            <th rowspan="2"width="30%">Description</th>
            <th colspan="5">Dimension</th>                        
            <th rowspan="2" width="5%">Color</th>
            <th>Volume</th>
            <th rowspan="2" width="30%">Images</th>
            <th rowspan="2">&nbsp;</th>
        </tr>
        <tr>
            <th width="5%">w</th>
            <th width="5%">d</th>
            <th width="5%">ht</th>
            <th width="5%">sh</th>
            <th width="5%">ah</th>                                    
            <th width="5%">Package</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 1;
        foreach ($model as $result) {
            ?>
            <tr>
                <td align="right" width="1%" onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $counter++ ?></td>
                <td>
                    <?php echo $result->no ?>                                        
                    <input type="hidden" id="code<?php echo $result->id ?>" value="<?php echo $result->no ?>"/>
                    <input type="hidden" id="description<?php echo $result->id ?>" value="<?php echo $result->description ?>"/>
                </td>
                <td><?php echo $result->custcode ?></td>
                <td><?php echo $result->description ?></td>                
                <td align="center"><?php echo $result->dw ?></td>
                <td align="center"><?php echo $result->dd ?></td>
                <td align="center"><?php echo $result->dht ?></td>
                <td align="center"><?php echo $result->dsh ?></td>
                <td align="center"><?php echo $result->dah ?></td>
                <td align="center"><?php echo $result->color ?></td>                
                <td align="center"><?php echo $result->volumepackage ?></td>
                <td align="center">
                    <?php
                    $images = "./files/" . $result->filename;
                    if (!file_exists($images)) {
                        $images = "./images/no-image.jpg";
                    }
                    ?>
                    <img src="<?php echo $images ?>" style="max-width: 100px;max-height: 100px;">
                </td>
                <td><img src="images/check.png" onclick="model_set2(<?php echo $result->id . ",'" . $temp . "'," . $billto ?>)" class="miniaction"/></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>