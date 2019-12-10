<div style="width:350px">
    <table width="100%">
        <tr>
            <td align="right"><label class="labelelement">Number : </label></td>
            <td><input type="text"  id="quotationnumber" style="text-transform: uppercase;"/></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Date : </label></td>
            <td>
                <input type="hidden" id="rfqid" name="rfqid" value="<?php echo $rfqid ?>"/>
                <script type="text/javascript" >
                    $(function() {
                        $("#quotationdate").datepicker({
                            dateFormat: "yy-mm-dd",
                            minDate:0
                        }).focus(function() {
                            $("#quotationdate").datepicker("show");
                        });
                    });
                </script>
                <input type="text"  id="quotationdate" size="10" style="text-align: center" readonly=""/>
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
                <input type="text"  id="quotationvalidity" size="10" style="text-align: center" readonly=""/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button onclick="quotation_save()">Save</button></td>
        </tr>
    </table>
</div>