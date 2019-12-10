<div style="width:300px">
    <table width="100%">
        <tr>
            <td align="right" width="30%"><label class="labelelement">Date :</label></td>
            <td>
                <input type="text" size="10" id="date"/>
                <script type="text/javascript" >
                    $(function() {
                        $("#date").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function() {
                            $("#date").datepicker("show");
                        });
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Reviewed By :</label></td>
            <td><input type="text" size="20" id="reviewedby"/></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Notes :</label></td>
            <td><textarea id="notes" style="width: 100%;height: 50px;"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button style="font-size: 11px;" onclick="model_savereviewnotesandhistory()">Save</button></td>
        </tr>
    </table>
</div>


