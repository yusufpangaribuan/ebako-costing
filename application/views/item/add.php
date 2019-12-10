<div style="width: 400px">
    <table align="center" border="0" width="100%">
        <tr>
            <td width="30%" align="right"><span class="labelelement">Class :</span></td>
            <td>
                <select id="isstock" style="width: 100px;">
                    <option value="true">STOCK</option>
                    <option value="false">NON STOCK</option>                            
                </select>                        
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Group :</span></td>
            <td>
                <select id="groupid" style="width: 100%;">
                    <option value="0">--Group--</option>
                    <?php
                    foreach ($group as $result) {
                        echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
                    }
                    ?>
                </select>
                <input type="hidden" id="flag" value="1" />
            </td>
        </tr>                
        <tr style="display: none" id="woodidtemp">
            <td align="right"><span class="labelelement">Wood Type :</span></td>
            <td id="woodtemp"><input type="hidden" value="0" id="wood"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Code :</span></td>
            <td><input type="text" name="partnumber" id="partnumber" style="width: 100%;"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Yield :</span></td>
            <td><input type="text" size="2" maxlength="3" style="text-align: center;" value="0" id="yield" style="width: 100px;"/> %</td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Description :</span></td>
            <td><textarea id="description" style="width: 100%; height: 40px;"></textarea></td>  
        </tr>                
        <tr valign="top">
            <td align="right"><span class="labelelement">Smallest Unit :</span></td>
            <td>
                <select name="unitid" id="unitid" style="width: 100px;">
                    <option value="0">--Unit--</option>
                    <?php
                    foreach ($unit as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->codes . "</option>";
                    }
                    ?>
                </select>                        
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Re-order Point :</span></td>
            <td><input type="tex" name="reorderpoint" id="reorderpoint" size="5" style="text-align: center;width: 100px" value="1" onchange="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                        alert('Required NUMBER and Not Allow 0 or NULL');
                        $(this).val(1)
                    }"/> *In Smallest Unit</td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">MOQ :</span></td>
            <td><input type="text" name="moq" id="moq" size="5" value="1" style="text-align: center;width: 100px;" 
                       onchange="if ($(this).val() == '' || isNaN($(this).val())) {
                                   alert('Required NUMBER and Not Allow NULL');
                                   $(this).val(1)
                               }"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Lead Time :</span></td>
            <td><input type="text" name="lt" id="lt" size="5" style="text-align: center;width: 100px;"/></td>
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
                <input type="text" name="expdate" id="expdate" size="10" style="text-align: center;width: 100px"/>
            </td>
        </tr>                
        <tr>
            <td align="right"><span class="labelelement">Warehouse :</span></td>
            <td>
                <?php
                foreach ($warehouse as $result) {
                    ?>
                    <input type="checkbox" value="<?php echo $result->id ?>" name="whs[]" id="wh1<?php echo $result->id ?>" style="vertical-align: middle"/> <?php echo $result->name ?> &nbsp; |&nbsp; STOCK : <input type="text" size="5" value="0" name="balance[]" style="text-align: center;"  onchange="if ($(this).val() == '' || isNaN($(this).val())) {
                                alert('Required NUMBER and Not Allow NULL');
                                $(this).val(0)
                            }"/><br/>
                                                                                                                                                                                                                       <?php
                                                                                                                                                                                                                   }
                                                                                                                                                                                                                   ?>
            </td>
        </tr>                
        <tr>
            <td align="right"><span class="labelelement">Rack :</span></td>
            <td><input type="text" name="rack" id="rack" size="8" style="text-align: center;width: 100px"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Receiving Type :</span></td>
            <td>
                <input type="checkbox" name="qccheck" id="qccheck" value="TRUE"  style="vertical-align: middle"/> Check by Quality Control &nbsp;
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Image :</span></td>
            <td><input type="file" name="fileupload" id="fileupload" size="20"/></td>
        </tr>
    </table>
</div>