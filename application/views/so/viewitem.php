
<table class="tablesorter" width="100%">
    <thead>
        <tr><th width="10" rowspan="2" width="4%">No</th>
            <th rowspan="2"  width="20%">Number</th>            
            <th rowspan="2"  width="20%">Description</th>
            <th colspan="5">Dimension</th>                        
            <th rowspan="2">Color</th>
            <th colspan="2">VOLUME</th>            
            <th rowspan="2">QTY</th>
            <th rowspan="2">REMARK</th>
        </tr>
        <tr>
            <th>W</th>
            <th>D</th>
            <th>HT</th>
            <th>SH</th>
            <th>AH</th>                        
            <th>(CBM)-RF</th>
            <th>PACKAGE</th>
            
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
                <td ><?php echo $result->description ?></td>                            
                <td align="center"><?php echo $result->dw ?></td>
                <td align="center"><?php echo $result->dd ?></td>
                <td align="center"><?php echo $result->dht ?></td>
                <td align="center"><?php echo $result->dsh ?></td>
                <td align="center"><?php echo $result->dah ?></td>
                <td align="center"><?php echo $result->color ?></td>
                <td align="center"><?php echo $result->volumecbmrf ?></td>
                <td align="center"><?php echo $result->volumepackage ?></td>                
                <td align="center"><?php echo $result->qty ?></td>
                <td align="center"><?php echo $result->remark ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>