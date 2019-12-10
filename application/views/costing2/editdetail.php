<div style="width: 1000px">
    <input id="costingid" type="hidden" value="<?php echo $costingid ?>" />
    <table width="98%" class="tablesorter">
        <thead>
            <tr>
                <th width="10%">Material Code</th>
                <th width="20%">Material Description</th>
                <th width="5%">UOM</th>
                <th width="10%">QTY<br/>based on BOM</th>
                <th width="5%">Yield</th>
                <th width="10%">Allowance</th>
                <th width="10%">REQ'D<br/>QTY</th> 
                <th width="10%">U\Price<br/>(RP)</th>            
                <th width="10%">U\Price<br/>(US$)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input id="id" type="hidden" value="<?php echo $id ?>"/>
                    <input id="itemid0" value="<?php echo $costing->itemid ?>" type="hidden"/>                    
                    <input type="text" style="width: 100%" id="materialcode" value="<?php echo $costing->materialcode ?>" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/> 
                    <br/>
                    <input id="partnumber0" value="" type="text" style="background: none;border: none" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/>                    
                    <a href="javascript:void(0)" onclick="item_listSearch(0)"><img src="images/list.png" class="miniaction" />
                        <span style="font-style: italic;">Choose Material Reference</span></a>
                </td>
                <td><textarea style="width: 100%" id="materialdescription"><?php echo $costing->materialdescription ?></textarea></td>
                <td>
                    <select type="text" style="width: 100%;"id="uom">
                        <option value=""></option>
                        <?php
                        foreach ($unit as $result) {
                            if ($costing->uom == $result->codes) {
                                echo "<option value='" . $result->codes . "' selected>" . $result->codes . "</option>";
                            } else {
                                echo "<option value='" . $result->codes . "'>" . $result->codes . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" style="width: 100%;text-align: center;" id="qty" value="<?php echo $costing->qty ?>" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/></td>
                <td>
                    <input type="text" style="width: 100%;text-align: center;" id="yield" value="<?php echo $costing->yield ?>" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/></td>
                <td>
                    <input type="text" style="width: 100%;text-align: center;" id="allowance" value="<?php echo $costing->allowance ?>" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/></td>
                <td>
                    <input type="text" style="width: 100%;text-align: center;" id="req_qty" value="<?php echo $costing->req_qty ?>" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/></td>
                <td>
                    <input type="text" style="width: 100%;text-align: right;" id="unitpricerp" value="<?php echo $costing->unitpricerp ?>" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/></td>
                <td>
                    <input type="text" style="width: 100%;text-align: right;" id="unitpriceusd" value="<?php echo $costing->unitpriceusd ?>" onkeypress="if (event.keyCode === 13) {
                                costing_updatedetail();
                            }"/>
                    <span style="font-size: 9px;color: green;float: right;"><i>Fill This Field to set manually price in US$</i></span>
                </td>            
            </tr>        
        </tbody>
    </table>
    <br/>
    <center>
        <button onclick="costing_updatedetail()" style="font-family: Calibri;font-size: 12px;">Save</button>
        <button onclick="costing_editdetail(<?php echo $id . "," . $costingid . "," . $costingid; ?>)" style="font-family: Calibri;font-size: 12px;">Reset</button>
    </center>
    <br/>
</div>