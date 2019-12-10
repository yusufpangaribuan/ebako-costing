
<div style="width: 550px">
    <table align="center" border="0">    
        <tr>
            <td align="right"><span class="labelelement">Code :</span></td>
            <td><input size='15' type='text' name='partnumber' id='partnumber' value="<?php echo $component->partnumber ?>"/></td>
        </tr>
        <tr valign="top">
            <td align="right"><span class="labelelement">Description&nbsp;&nbsp;:</span></td>
            <td>
                <input type="hidden" name="id" id="id" value="<?php echo $component->id ?>"/>
                <textarea id="description" name="description" style="height: 20px;width: 250px;"><?php echo $component->description ?></textarea>
            </td>  
        </tr>            
        <tr>
            <td align="right"><span class="labelelement">Material&nbsp;&nbsp;:</span></td>
            <td>
                <input type="hidden" id="itemid0" name="itemid0" value="<?php echo $component->itemid ?>"/>
                <input type="text" id="description0" name="description0" value="<?php echo $component->itemdescription ?>"/>                    
                &nbsp;&nbsp;<img src="images/list.png" class="miniaction" onclick="item_listSearch(0)"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Veneer&nbsp;&nbsp;:</span></td>
            <td>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center"><b>TYPE</b></td>
                        <td align="center"><b>S1S</b></td>
                        <td align="center"><b>DGB</b></td>
                        <td align="center"><b>S2S</b></td>
                        <td align="center"><b>SQ.m For</b></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" id="itemid1" name="itemid1" value="<?php echo $component->ven_itemid ?>"/>
                            <input type="text" style="width: 70px;text-align: center;" id="description1" value="<?php echo $component->ven_type ?>"/>
                            <img src="images/list.png" class="miniaction" onclick="item_listSearch(1)"/>
                            &nbsp;</td>
                        <td><input type="text" style="width: 50px;text-align: center;" id="ven_s1s" value="<?php echo $component->ven_s1s ?>"/>&nbsp;</td>
                        <td><input type="text" style="width: 50px;text-align: center;" id="ven_dgb" value="<?php echo $component->ven_dgb ?>"/>&nbsp;</td>
                        <td><input type="text" style="width: 50px;text-align: center;" id="ven_s2s" value="<?php echo $component->ven_s2s ?>"/>&nbsp;</td>                            
                        <td>&nbsp;&nbsp;
                            <?php
                            $sq_ven_a_checked = ($component->sq_ven_a == 't' ? 'checked' : '');
                            $sq_ven_dgb_checked = ($component->sq_ven_dgb == 't' ? 'checked' : '');
                            ?>
                            <input type="checkbox" id="sq_ven_a" <?php echo $sq_ven_a_checked ?> style="vertical-align: middle" value="1"/>&nbsp;A&nbsp;&nbsp;
                            <input type="checkbox" id="sq_ven_dgb" <?php echo $sq_ven_dgb_checked ?> style="vertical-align: middle"/>&nbsp;DGB</td>
                    </tr>
                </table>
            </td>  
        </tr>
        <tr valign="middle">
            <td align="right"><span class="labelelement">Process&nbsp;&nbsp;:</span></td>
            <td>
                <table>
                    <tr>
                        <td align="center"><b>Turn</b></td>
                        <td align="center"><b>Lam</b></td>
                        <td align="center"><b>Carv</b></td>
                        <td align="center"><b>Mall</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" style="width: 50px;text-align: center;" id="turn" value="<?php echo $component->turn ?>"/></td>
                        <td><input type="text" style="width: 50px;text-align: center;" id="lam" value="<?php echo $component->lam ?>"/></td>
                        <td><input type="text" style="width: 50px;text-align: center;" id="carv" value="<?php echo $component->carv ?>"/></td>
                        <td><input type="text" style="width: 50px;text-align: center;" id="mall" value="<?php echo $component->mall ?>"/></td>
                    </tr>
                </table>
            </td>  
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Final size&nbsp;&nbsp;:</span></td>
            <td>
                <b>T:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="ft" value="<?php echo $component->ft ?>" onkeyup="component_set_increase_size('t')"/>&nbsp;
                <b>W:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="fw" value="<?php echo $component->fw ?>" onkeyup="component_set_increase_size('t')"/>&nbsp;
                <b>L:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="fl" value="<?php echo $component->fl ?>" onkeyup="component_set_increase_size('t')"/>&nbsp;
            </td>  
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Increase size&nbsp;&nbsp;:</span></td>
            <td>
                <b>T:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="it" value="<?php echo ($component->rt - $component->ft) ?>" onkeyup="component_set_increase_size('t')"/>&nbsp;
                <b>W:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="iw" value="<?php echo ($component->rw - $component->fw) ?>"  onkeyup="component_set_increase_size('w')"/>&nbsp;
                <b>L:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="il"  value="<?php echo ($component->rl - $component->fl) ?>" onkeyup="component_set_increase_size('l')"/>&nbsp;
            </td>  
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Rough size&nbsp;&nbsp;:</span></td>
            <td>
                <b>T:</b>&nbsp;<input type="text" value="<?php echo $component->rt ?>" style="width: 50px;text-align: center;" id="rt"/>&nbsp;
                <b>W:</b>&nbsp;<input type="text" value="<?php echo $component->rw ?>" style="width: 50px;text-align: center;" id="rw"/>&nbsp;
                <b>L:</b>&nbsp;<input type="text" value="<?php echo $component->rl ?>" style="width: 50px;text-align: center;" id="rl"/>&nbsp;
            </td>  
        </tr>

        <tr>
            <td align="right"><span class="labelelement">MH/MD/ (EURO/OAK)&nbsp;&nbsp;:</span></td>
            <td><input type="text" name="mhmd" id="mhmd" style="text-align: center;width: 50px" value="<?php echo $component->mhmd ?>"/></td>  
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Image :</span></td>
            <td>
                <input type="hidden" id="filename" name="filename" value="<?php echo $component->image ?>"/>
                <input type="file" name="fileupload" id="fileupload" size="30"/>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <br/>            
                <button onclick="component_update()" style="font-size: 11px;">Update</button>
                <button onclick="$('#dialog3').dialog('close')" style="font-size: 11px;">Cancel</button>
                <button onclick="component_edit(<?php echo $component->id ?>)" style="font-size: 11px;">Reset</button>
                <br/><br/>
            </td>
        </tr>
    </table>
</div>