<div style="width: 400px">
    <form id="gr_print_receipt_form">
        <table width="100%">
            <tr>
                <td width="100%">
                    <span class="labelelement">Supplier :</span>
                    <select style="width: 100%" name="supplier_id" required="true" class="required">
                        <option></option>
                        <?php
                        foreach ($vendor as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="labelelement">Receive Date :</span>
                    <input type="text" name="receive_date" style="width: 100%"  required="true" class="required" readonly=""/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#gr_print_receipt_form input[name='receive_date']").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#gr_print_receipt_form input[name='receive_date']").datepicker("show");
                            });
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="labelelement">DO Number / SJ :</span>
                    <input type="text" name="do_number" style="width: 100%"/>
                </td>
            </tr>
        </table>
    </form>
</div>
