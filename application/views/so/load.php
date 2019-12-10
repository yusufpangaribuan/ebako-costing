<center>
    <div class="panel" style="width: 50%;" id="">    
        <h4>Sales Order</h4>
        <br/>
        <table width="100%" border="0">
            <tr valign="top">
                <td width="10%" align="right">
                    <span class="labelelement">ORDER BY : </span>
                </td>
                <td width="30%">
                    <select id="billto" style="width: 100%;" onchange="so_changebillto(this)">
                        <option value="0">--Customer--</option>
                        <?php
                        foreach ($customer as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                        }
                        ?>
                    </select><br/>
                    <textarea style="width: 100%;height: 35px" id="billtoaddress"></textarea>
                </td>
                <td width="20%">&nbsp;</td>
                <td width="40%" align="right" colspan="2" rowspan="2">
                    <table width="100%" border="0">
                        <tr>
                            <td align="right" width="30%"><span class="labelelement">SO NUMBER : </span></td>
                            <td width="70%">
                                <input type="text"  id="number" value="<?php echo $this->model_so->getNextSoNumber() ?>" readonly=""/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="30%"><span class="labelelement">SO DATE : </span></td>
                            <td width="70%">
                                <script type="text/javascript" >
                                    $(function() {
                                        $("#date").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function() {
                                            $("#date").datepicker("show");
                                        });
                                        $("#shipdate").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function() {
                                            $("#shipdate").datepicker("show");
                                        });
                                    });
                                </script>
                                <input type="text" size="10" id="date" name="date"/></td>
                        </tr>
                        <tr>
                            <td align="right" width="30%"><span class="labelelement">TERMS : </span></td>
                            <td width="70%"><input type="text" id="terms"/></td>
                        </tr>
                        <tr>
                            <td align="right" width="30%"><span class="labelelement">SHIP DATE : </span></td>
                            <td width="70%"><input type="text" size="10" id="shipdate"/></td>
                        </tr>
                    </table>
                </td>                    
            </tr>
            <tr valign="top">
                <td width="10%" align="right"><span class="labelelement">SHIP TO : </span></td>
                <td width="30%">
                    <select id="shipto" style="width: 100%" onchange="so_changeshipto(this)">
                        <option value="0">--Customer--</option>
                        <?php
                        foreach ($customer as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                        }
                        ?>
                        <textarea style="width: 100%;height: 35px" id="shiptoaddress"></textarea>
                    </select>
                </td>
                <td width="20%">&nbsp;</td>                    
            </tr>
        </table>            
    </div>
</center>