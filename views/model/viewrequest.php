<div style="width: 800px;">
    <script type="text/javascript">
        /* make the table scrollable with a fixed header */
        $(function () {
            $('#tbl_model_rquired56_qzx').scrollableFixedHeaderTable('105%', '400');
        });
    </script>
    <table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_model_rquired56_qzx" >
        <thead>
            <tr>
                <th width="2%">No</th>
                <th width="15%">Customer</th>
                <th width="10%">Cust. Code</th>
                <th width="30%">Description</th>
                <th width="13%">Model Reference</th>
                <th width="20%">Attachment</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($model)) {
                $no = 1;
                foreach ($model as $result) {
                    ?>
                    <tr valign="top">
                        <td align="right"><?php echo $no++; ?></td>
                        <td><?php echo $result->customername ?></td>
                        <td><?php echo $result->custcode ?></td>
                        <td><?php echo nl2br($result->description) ?></td>                    
                        <td><?php echo $result->no ?></td>
                        <td>
                            <?php
                            $attachment = $this->model_rfqitemattachment->selectByDetailId($result->id);
                            foreach ($attachment as $result2) {
                                ?>
                                <a href="<?php echo base_url() . 'files/' . $result2->filename ?>" target="blank" style="color: blue;">
                                    <?php echo $result2->title ?>
                                </a><br/>
                                <?php
                            }
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            if (!$this->model_rfqdetail->isProcess($result->modelid, $result->customerid) || ($result->modelid == $result->refmodelid)) {
                                ?>
                                <button onclick="model_setmodelrfqdetail(<?php echo $result->id . "," . $result->refmodelid . "," . $result->customerid . ",'" . $result->custcode . "'" ?>)">Set Model</button>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>