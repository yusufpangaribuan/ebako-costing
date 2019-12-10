<div style="width: 500px; min-height: 100px;">
    <?php
    foreach ($stockout as $result) {
        ?>
        <table width="100%" class="tablesorter">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: left;">
                        &nbsp;No : <?php echo $result->number ?>&nbsp;
                        &nbsp;Date : <?php echo date('d/m/Y',strtotime($result->date)) ?>&nbsp;
                        &nbsp;From : <?php echo $result->warehousename ?>&nbsp;
                        &nbsp;PiC : <?php echo $result->outby ?>&nbsp;
                        &nbsp;Date : <?php echo date('d/m/Y',  strtotime($result->receivedate)) ?>&nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr style="border: none;">
                    <td style="border: none;">
                        <table width="100%" class="child">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="30%">Code</th>
                                    <th width="40%">Description</th>
                                    <th width="10%">Unit</th>
                                    <th width="10%">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $stockoutdetail = $this->model_stockoutdetail->selectByStockoutId($result->id);
                                foreach ($stockoutdetail as $result2) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no++ ?></td>
                                        <td align="center"><?php echo $result2->code ?></td>
                                        <td><?php echo $result2->descriptions ?></td>                        
                                        <td align="center"><?php echo $result2->unitcode ?></td>                                   
                                        <td align="center"><?php echo $result2->qty ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>                                
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }
    ?>    
    <center><a href='<?php echo base_url()."index.php/mr/printdetailreceive/".$mrid ?>' target="blank"><button>Print</button></a><center>
</div>
