<br/>
<br/>
<center>
    <div style="width: 500px" class="panel">
        <h4>Add component</h4><br/>
        <table align="center" border="0" width="100%">
            <tr>
                <td align="right"><span class="labelelement">Code :</span></td>
                <td><input size='15' type='text' name='partnumber' id='partnumber' /></td>
            </tr>
            <tr valign="top">
                <td align="right"><span class="labelelement">Description&nbsp;&nbsp;:</span></td>
                <td>
                    <input type="hidden" name="id" id="id" value=""/>
                    <textarea id="description" name="description" style="height: 20px;width: 250px;" onfocus="$('#tempcompname').show()" onkeyup="component_filterdescription(this)"></textarea><br/>
                    <select size="60" style="height: 100px;width: 250px;display:none;" id="tempcompname" onclick="$('#description').val($('#tempcompname').val());$('#tempcompname').hide();">
                        <?php
                        foreach ($componentdesc as $result) {
                            echo "<option value='" . $result->description . "'>" . $result->description . "</option>";
                        }
                        ?>
                    </select>
                </td>  
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Material&nbsp;&nbsp;:</span></td>
                <td>
                    <input type="hidden" id="itemid0" name="itemid0" value="0"/>
                    <input type="text" id="description0" name="description0"/>                    
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
                                <input type="hidden" id="itemid1" name="itemid1" value="0"/>
                                <input type="text" style="width: 70px;text-align: center;" id="description1" value=""/>
                                <img src="images/list.png" class="miniaction" onclick="item_listSearch(1)"/>
                                &nbsp;
                            </td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="ven_s1s" value=""/>&nbsp;</td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="ven_dgb" value=""/>&nbsp;</td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="ven_s2s" value=""/>&nbsp;</td>
                            <td>&nbsp;&nbsp;<input type="checkbox" id="sq_ven_a" style="vertical-align: middle" value="1"/>&nbsp;A&nbsp;&nbsp;<input type="checkbox" id="sq_ven_dgb" style="vertical-align: middle"/>&nbsp;DGB</td>
                        </tr>
                    </table>
                </td>  
            </tr>
            <tr valign="middle">
                <td align="right"><span class="labelelement">Process&nbsp;&nbsp;:</span></td>
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center"><b>Turn</b></td>
                            <td align="center"><b>Lam</b></td>
                            <td align="center"><b>Carv</b></td>
                            <td align="center"><b>Mall</b></td>
                        </tr>
                        <tr>
                            <td><input type="text" style="width: 50px;text-align: center;" id="turn" value=""/>&nbsp;</td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="lam" value=""/>&nbsp;</td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="carv" value=""/>&nbsp;</td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="mall" value=""/>&nbsp;</td>
                        </tr>
                    </table>
                </td>  
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Final size&nbsp;&nbsp;:</span></td>
                <td>
                    <b>T:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="ft" onkeyup="component_set_increase_size('t')"/>&nbsp;
                    <b>W:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="fw" onkeyup="component_set_increase_size('w')"/>&nbsp;
                    <b>L:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="fl" onkeyup="component_set_increase_size('l')"/>&nbsp;
                </td>  
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Increase size&nbsp;&nbsp;:</span></td>
                <td>
                    <b>T:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="it" onkeyup="component_set_increase_size('t')"/>&nbsp;
                    <b>W:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="iw" onkeyup="component_set_increase_size('w')"/>&nbsp;
                    <b>L:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="il" onkeyup="component_set_increase_size('l')"/>&nbsp;
                </td>  
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Rough size&nbsp;&nbsp;:</span></td>
                <td>
                    <b>T:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="rt"/>&nbsp;
                    <b>W:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="rw"/>&nbsp;
                    <b>L:</b>&nbsp;<input type="text" style="width: 50px;text-align: center;" id="rl"/>&nbsp;
                </td>  
            </tr>
            <tr>
                <td align="right"><span class="labelelement">MH/MD/ (EURO/OAK)&nbsp;&nbsp;:</span></td>
                <td><input type="text" name="mhmd" id="mhmd" style="text-align: center;width: 50px" value=""/></td>  
            </tr>     
            <tr>
                <td align="right"><span class="labelelement">Image :</span></td>
                <td><input type="file" name="fileupload" id="fileupload" size="30"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <br/>            
                    <button onclick="component_save()">Save</button>
                    <button onclick="component_view()">Cancel</button>
                    <button onclick="component_add()">Reset</button>
                    <br/><br/>
                </td>
            </tr>
        </table>
    </div>
</center>