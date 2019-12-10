<div style="width:250px">
    <table width="100%">
        <tr>
            <td align="right"><label class="labelelement">Number :</label></td>
            <td><input type="text"  id="quotationnumber" value="<?php echo $quotation->quotationnumber?>"/></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Date :</label></td>
            <td>
                <input type="hidden" id="rfqid" name="rfqid" value="<?php echo $rfqid?>" />
                <script type="text/javascript" >
                        $(function() {
                            $("#quotationdate").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function() {
                                $("#quotationdate").datepicker("show");
                            });
                        });
                    </script>
                    <input type="text"  id="quotationdate" value="<?php echo $quotation->quotationdate?>" size="10" style="text-align: center"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Quotation Validity : </label></td>
            <td>                
                <script type="text/javascript" >
                    $(function() {
                        $("#quotationvalidity").datepicker({
                            dateFormat: "yy-mm-dd",
                            changeMonth: true,
                            changeYear:true,
                            minDate:0
                        }).focus(function() {
                            $("#quotationvalidity").datepicker("show");
                        });
                    });
                </script>
                <input type="text"  id="quotationvalidity" value="<?php echo $quotation->quotationvalidity?>" size="10" style="text-align: center" readonly=""/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><br/><button onclick="quotation_update()" style="font-size: 11px;">Save</button></td>
        </tr>
    </table>
</div>