<div style="width: 200">
    <table width="100%">
        <tr>
            <td><label class="labelelement">DATE</label></td>
            <td>
                <input id="soid" type="hidden" value="<?php echo $soid?>" />
                <script type="text/javascript" >
                    $(function() {
                        $("#datebom").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function() {
                            $("#datebom").datepicker("show");
                        });
                    });
                </script>
                <input type="text" size="10" name="datebom" id="datebom" style="text-align: center;"/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button onclick="so_dosavebom()">OK</button></td>
        </tr>
    </table>
</div>