<div style="width: 1000px;height: 600px;">
    <font color="green"><i>All Changes Will Directly Saved To Data Base</i></font>
    <button style="float: right;margin-right: 10px;" onclick="$('#pricecomp_data').dialog('close');">Close</button>
    <br/>
    <table border='0' width='99%' class="tablesorter2">
        <thead>
            <tr>
                <th width="10">No</th>
                <th width="150">Item Description</th>               
                <th width="30">Qty</th>
                <th>Vendor and Unit Price</th>
        </thead>
        <?php
        if (!empty($pritem)) {
            $counter = 1;
            foreach ($pritem as $pritem) {
                ?>
                <tr>
                    <td valign='top' align="right"><?php echo $counter++; ?></td>
                    <td valign='top' ><?php echo "Code: " . $pritem->itempartnumber . "<br/> Description: " . $pritem->itemdescription . "<br/> Unit: " . $pritem->unitname; ?></td>   

                    <td valign='top' align='center'><?php echo $pritem->qty; ?></td>
                    <td valign='top' align='left'>
                        <table class="tablesorter" width="100%">
                            <thead>
                                <tr>                                
                                    <th width="20%">Vendor</th>
                                    <th width="8%">Currency</th>
                                    <th width="15%">Price/Unit</th>
                                    <th width="20%">Total</th>
                                    <th width='17%'>Notes</th>
                                    <th width='25%'>Action</th>                                
                                </tr>
                            </thead>
                            <tbody id="itemcom">
                                <?php
                                $pricecomp = $this->model_pricecomp->selectByItemId($pritem->id);
                                foreach ($pricecomp as $pricecomp) {
                                    ?>
                                    <tr valign="top" style="background: #ffffff;">                                
                                        <td>
                                            <select id="vendorid<?php echo $pricecomp->id ?>" onchange="pricecomp_setvendor(<?php echo $pricecomp->id . "," . $pritem->prid ?>)" style="width: 100%">
                                                <option value="0">--Choose Vendor--</option>
                                                <?php
                                                foreach ($vendor as $resultvendor) {
                                                    if ($pricecomp->vendorid == $resultvendor->id) {
                                                        echo "<option value='" . $resultvendor->id . "' selected>" . $resultvendor->name . "</option>";
                                                    } else {
                                                        echo "<option value='" . $resultvendor->id . "'>" . $resultvendor->name . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div id="messagevendor<?php echo $pricecomp->id ?>"></div>
                                            <?php
                                            if ($pricecomp->used == 1) {
                                                ?>
                                                <img src="images/check.png"/>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <select id="currencyid<?php echo $pricecomp->id ?>" onchange="pricecomp_setcurrency(<?php echo $pricecomp->id . "," . $pritem->prid ?>)" style="width: 100%">
                                                <option value="0">Curr</option>
                                                <?php
                                                foreach ($currency as $resultcurrency) {
                                                    if ($pricecomp->currency == $resultcurrency->curr) {
                                                        echo "<option value='" . $resultcurrency->curr . "' selected>" . $resultcurrency->curr . "</option>";
                                                    } else {
                                                        echo "<option value='" . $resultcurrency->curr . "'>" . $resultcurrency->curr . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div id="messagecurrency<?php echo $pricecomp->id ?>"></div>
                                        </td>
                                        <td valign="top" align="right">
                                            <input type="text" style="width: 100%;text-align: right;" value="<?php echo $pricecomp->price ?>" style="text-align: right" id="price<?php echo $pricecomp->id ?>" onblur="pricecomp_setprice(<?php echo $pricecomp->id . "," . $pritem->prid ?>)"/><div id="messageprice<?php echo $pricecomp->id ?>">&nbsp;</div>                                            
                                        </td>
                                        <td valign="top" align="right">
                                            <input type="hidden" style="width: 100%;text-align: right;" value="<?php echo $pricecomp->price * $pritem->qty; ?>" style="text-align: right" id="price<?php echo $pricecomp->id ?>" onblur="pricecomp_setprice(<?php echo $pricecomp->id . "," . $pritem->prid ?>)"/><div id="messageprice<?php echo $pricecomp->id ?>" />
                                            <input type="text" style="width: 100%;text-align: right;" value="<?php echo $pricecomp->price * $pritem->qty; ?>" style="text-align: right" id="price<?php echo $pricecomp->id ?>" readonly="true"/>                                      
                                        </td>
                                        <td>
                                            <textarea style="width: 100%; height: 40px;" id="note<?php echo $pricecomp->id ?>" onblur="pricecomp_setnote(<?php echo $pricecomp->id . "," . $pritem->prid ?>)"><?php echo $pricecomp->notes ?></textarea>
                                        </td>
                                        <td>
                                            <?php
                                            if ($pricecomp->vendorid != 0 && $pricecomp->currency != "" && ($pricecomp->price != 0)) {
                                                ?>
                                                <a href="javascript:void(0)" onclick="pricecomp_used(<?php echo $pritem->id . "," . $pricecomp->id . "," . $pritem->prid . "," . $pritem->itemid ?>)" ><img src="images/check.png" class="miniaction"/> Choose</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                                <a href="javascript:void(0)" onclick="pricecomp_remove(<?php echo $pritem->id . "," . $pricecomp->id . "," . $pritem->prid ?>)"><img src="images/delete.png" class="miniaction" /> Remove</a>  <br/>
                                                <a href="javascript:void(0)" onclick="pricecomp_set_as_item_price(<?php echo $pricecomp->id . "," . $pritem->itemid ?>)"><img src="images/upload.png" style="margin-top: 3px;"/> Set as Item Price</a>  
                                                    <?php
                                                }
                                                ?>

                                        </td>                                
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
            <!--                    <button onclick="pricecomp_addvendor(<?php //echo //$pritem->id                              ?>)">Add Vendor</button>-->
                    </td>
                </tr>
                <?php
            }
        }
        ?>                    
    </table>

    <br/>
    <br/>
</div>