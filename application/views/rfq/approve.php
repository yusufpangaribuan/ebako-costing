<div style="width: 500px">
    <table width="100%">
        <tr>
            <td align="right"><label class="labelelement">Date :</label></td>
            <td>
                <input type="hidden" id="rfqid" value="<?php echo $rfqid ?>" /> 
                <script type="text/javascript" >
                    $(function() {
                        $("#dateapprove").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function() {
                            $("#dateapprove").datepicker("show");
                        });
                    });
                </script>
                <input type="text" size="10" id="dateapprove" name="dateapprove" readonly="" style="text-align: center"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">PO Customer :</label></td>
            <td><input type="text" size="20" id="pocustomer" name="pocustomer"/></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Attachment :</label></td>
            <td><input type="file" size="10" id="fileupload" name="fileupload" style="width: 80px"/></td>
        </tr>
    </table><br/>
    <span style="font-size: 11px;"><b>Choose item to approve :</b></span>
    <table class="tablesorter" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Cust. Code</th>
                <th>Description</th>
                <th><input type="checkbox" onclick="rfq_checkAll(this)"/> Check All</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($rfqdetail as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++ ?></td>
                    <td align="center"><?php echo $result->no ?></td>
                    <td align="center"><?php echo $result->custcode ?></td>
                    <td><?php echo $result->description ?></td>
                    <td align="center"><input type="checkbox" name="modelid[]" value="<?php echo $result->id ?>"/></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <br/>
    <center>
        <button onclick="rfq_doapprove();" style="font-size: 11px">OK</button>
        <button onclick="$('#dialog').dialog('close');" style="font-size: 11px">Cancel</button>
    </center>
</div>

