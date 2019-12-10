<div style="width: 400px">
    <table align="center" border="0" width="100%">
        <tr>
            <td width="30%" align="right"><span class="labelelement">Class :</span></td>
            <td width="70%">
                <input type="hidden" name="id" id="id" value="<?php echo $item->id ?>" />
                <select id="isstock"  style="width: 100px;">
                    <?php
                    if ($item->isstock == 't') {
                        echo "<option value=t>STOCK</option>
                                     <option value=f>NON STOCK</option>";
                    } else {
                        echo "<option value=f>NON STOCK</option>
                                     <option value=t>STOCK</option>";
                    }
                    ?>
                </select>                        
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Group :</span></td>
            <td>
                <select id="groupid"  style="width: 100px;">
                    <option value="0">--Group--</option>
                    <?php
                    foreach ($group as $result) {
                        if ($item->groupsid == $result->id) {
                            echo "<option value='" . $result->id . "' selected>[" . $result->codes . "] " . $result->names . "</option>";
                        } else {
                            echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Code :</span></td>
            <td><input type="text" name="partnumber" id="partnumber"  style="width: 100%;" value="<?php echo $item->partnumber ?>"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Yield :</span></td>
            <td><input type="text" size="2" maxlength="3" style="text-align: center;width: 100px;" value="<?php echo $item->yield ?>" id="yield"/> %</td>
        </tr>
        <tr>
            <td valign="top" align="right"><span class="labelelement">Description :</span></td>
            <td><textarea id="description" style="width: 100%;height: 30px;"><?php echo $item->descriptions ?></textarea></td>  
        </tr>                                                                 
        <tr>
            <td align="right"><span class="labelelement">Re-order Point :</span></td>
            <td><input type="tex" name="reorderpoint" id="reorderpoint" size="5" 
                       value="<?php echo $item->reorderpoint ?>" style="text-align: center;" onchange="if ($(this).val() == '' || isNaN($(this).val())) {
                                   alert('Required NUMBER and Not Allow NULL');
                                   $(this).val(0)
                               }"/><span style="font-size: 13px;padding-left: 3px;font-weight: bold;"><?php echo empty($smallestunit) ? '' : $smallestunit->codes ?></span> <span style="color: blue;">(*In Smallest Unit)</span></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">MOQ :</span></td>
            <td><input type="text" name="moq" id="moq" size="5" value="1" style="text-align: center;width: 100px;" value="<?php echo $item->moq ?>" onchange="if ($(this).val() == '' || isNaN($(this).val())) {
                        alert('Required NUMBER and Not Allow NULL');
                        $(this).val(0)
                    }"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Lead Time :</span></td>
            <td><input type="text" name="lt" id="lt" size="5" style="text-align: center;width: 100px;" value="<?php echo $item->lt ?>"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Exp. Date :</span></td>
            <td>
                <script type="text/javascript" >
                    $(function () {
                        $("#expdate").datepicker({
                            dateFormat: "yy-mm-dd",
                            changeMonth: true,
                            changeYear: true
                        }).focus(function () {
                            $("#expdate").datepicker("show");
                        });
                    });
                </script>
                <input type="text" name="expdate" id="expdate" size="10" value="<?php echo $item->expdate ?>" style="text-align: center;width: 100px;"/>
            </td>
        </tr>                
        <tr>
            <td align="right"><span class="labelelement">Rack :</span></td>
            <td>                        
                <input type="text" name="rack" id="rack" size="8" value="<?php echo $item->rack ?>" style="width: 100px;"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Receiving Type :</span></td>
            <td>
                <?php
                $checked = '';
                if ($item->qccheck == 't') {
                    $checked = 'checked';
                }
                ?>
                <input type="checkbox" name="qccheck" id="qccheck" <?php echo $checked ?> value="TRUE"  style="vertical-align: middle;"/> Check by Quality Control &nbsp;
            </td>
        </tr>
        <tr valign="top">
            <td align="right"><span class="labelelement">Image :</span></td>
            <td>
                <input type="hidden" name="image" id="image" value="<?php echo $item->images ?>"/>
                <?php
                if ($item->images != "") {
                    ?>
                    <img src="files/<?php echo $item->images ?>" width="50" height="50"/> 
                    <?php
                } else {
                    ?>
                    <img src="images/no-image.jpg" width="50" height="50"/>
                    <?php
                }
                ?><br/>
                <input type="file" name="fileupload" id="fileupload" size="20"/>
            </td>
        </tr>
    </table>
</div>
