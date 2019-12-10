<div style="width: 300px;">
    <form id="stockopname_add_form" onsubmit="return false;">
        <table width="100%">
            <tr valign="top">
                <td align="right" width="25%"><span class="labelelement">Date :</span></td>
                <td width="75%">
                    <input type="text" name="date" required="true" readonly="" value="<?php echo date('Y-m-d') ?>" style="width: 100px"/>
                    <script type="text/javascript" >
                        $(function () {
                            $('#stockopname_add_form input[name="date"]').datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $('#stockopname_add_form input[name="date"]').datepicker("show");
                            });
                        });
                    </script>
                </td>
            </tr>
            <?php
            if (($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) || $this->session->userdata('department') != 10) {
                ?>
                <tr valign = "top">
                    <td align = "right"><span class = "labelelement">Warehouse :</span></td>
                    <td>
                        <select name="warehouseid" style="width: 100%" required="true">
                            <option></option>
                            <?php
                            foreach ($warehouse as $result) {
                                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr valign = "top">
                <td align = "right"><span class = "labelelement">Description :</span></td>
                <td>
                    <input type="text" name="description" style = "width: 100%;" required = "true"/>
                    <?php
                    if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
                        ?>
                        <input type="hidden" name="warehouseid" value="<?php echo $this->session->userdata('optiongroup') ?>"/>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </form>
</div>