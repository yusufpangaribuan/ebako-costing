<form id="servicerequest_add_form" style="width: 400px">
    <table align="center" width="100%" border="0">
        <tr>
            <td align="right" width='25%'><label class="labelelement">Date</label></td>
            <td width="1%"><strong>:</strong></td>
            <td width='75%'>
                <script type="text/javascript" >
                    $(function () {
                        $("#date").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function () {
                            $("#date").datepicker("show");
                        });
                    });
                </script>
                <input type="text" name="date" id="date" readonly="" value="<?php echo date('Y-m-d') ?>"/>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>End user</strong></td>
            <td><strong>:</strong></td>
            <td>
                <select name="enduser" style="width: 100%" required="true">
                    <option></option>
                    <?php
                    foreach ($subdepartment as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Must Receive At</label></td>
            <td><strong>:</strong></td>
            <td>
                <script type="text/javascript" >
                    $(function () {
                        $("#mat_req_must_receive_date").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function () {
                            $("#mat_req_must_receive_date").datepicker("show");
                        });
                    });
                </script>
                <input type="text" name="must_receive_date" id="mat_req_must_receive_date" readonly="" value="<?php echo date('Y-m-d') ?>"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Reason Of Requirement</label></td>
            <td><strong>:</strong></td>
            <td><textarea name="reason_requirement" style="width: 100%;height: 40px"></textarea></td>
        </tr>
    </table>
</form>