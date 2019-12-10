<div style="width: 500px;">
    <form id="model_add_component_add_form">
        <table border="0" width="100%">            
            <tr>
                <td align="right" width="25%"><span class="labelelement">Component Code :</span></td>
                <td width="75%">
                    <input type="hidden" name="modelid" id="modelid" value="<?php echo $modelid ?>"/>
                    <script>
                        $(function () {
                            $("#partnumber").autocomplete({
                                source: url + 'model/search_component_autocomplete',
                                minLength: 2,
                                select: function (event, ui) {
                                    $("#partnumber").val(ui.item.label);
                                    $("#description_input_model").val(ui.item.description);
                                    $("#itemid-45").val(ui.item.itemid);
                                    $("#description-45").val(ui.item.item_description);
                                    $("#itemid1").val(ui.item.ven_itemid);
                                    $("#description1").val(ui.item.ven_item_description);


                                    $("#turn").val(ui.item.turn);
                                    $("#lam").val(ui.item.lam);
                                    $("#carv").val(ui.item.carv);
                                    $("#mall").val(ui.item.mall);

                                    $("#ft").val(ui.item.ft);
                                    $("#fw").val(ui.item.fw);
                                    $("#fl").val(ui.item.fl);

                                    $("#rt").val(ui.item.rt);
                                    $("#rw").val(ui.item.rw);
                                    $("#rl").val(ui.item.rl);

                                    $("#ven_s1s").val(ui.item.ven_s1s);
                                    $("#ven_dgb").val(ui.item.ven_dgb);
                                    $("#ven_s2s").val(ui.item.ven_s2s);
                                    $("#mhmd").val(ui.item.mhmd);
                                    $("#sq_ven_a").val(ui.item.sq_ven_a);
                                    $("#sq_ven_dgb").val(ui.item.sq_ven_dgb);
                                    $("#mhmd").val(ui.item.mhmd);
                                }
                            }).data("autocomplete")._renderItem = function (ul, item) {
                                return $("<li>")
                                        .data("item.autocomplete", item)
                                        .append("<a>" + item.label +
                                                "<br>" + item.description +
                                                "<br>Fin Size: " + item.ft + "x" + item.fw + "x" + item.fl + ", Rough Size: " + item.rt + "x" + item.rw + "x" + item.rl + "</a>"
                                                ).appendTo(ul);
                            };
                        });
                    </script>
                    <input size='15' type='text' name='partnumber' id='partnumber' style="width: 100%"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Description&nbsp;&nbsp;:</span></td>
                <td>
                    <input type="hidden" name="id" id="id" value=""/>
                    <textarea id="description_input_model" name="description" style="height: 30px;width: 100%;"></textarea>
                </td>  
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Material&nbsp;&nbsp;:</span></td>
                <td>
                    <input type="hidden" id="itemid-45" name="itemid" value="0"/>
                    <input type="text" id="description-45" name="description" onkeyup="if (event.keyCode === 13) {
                                item_listSearch(-45)
                            }" style="width: 90%"/>                    
                    &nbsp;&nbsp;<img src="images/list.png" class="miniaction" onclick="item_listSearch(-45)"/></td>
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
                                <input type="hidden" id="itemid1" name="ven_id" value="0"/>
                                <input type="text" style="width: 70px;text-align: center;" name="ven_description" id="description1" value=""/>
                                <img src="images/list.png" class="miniaction" onclick="item_listSearch(1)"/>
                                &nbsp;
                            </td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="ven_s1s" name="ven_s1s" value=""/>&nbsp;</td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="ven_dgb" name="ven_dgb" value=""/>&nbsp;</td>
                            <td><input type="text" style="width: 50px;text-align: center;" id="ven_s2s" name="ven_s2s" value=""/>&nbsp;</td>
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
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" style="width: 50px;text-align: center" id="qty" name="qty"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Location :</span></td>
                <td><input type="text" id="location" name="location" style="width: 100%"/></td>
            </tr>
        </table>
        <!--        <br/>
                <center>
                    <button type="button" onclick="model_savebomitem()">Save</button>
                </center>-->
    </form>
</div>