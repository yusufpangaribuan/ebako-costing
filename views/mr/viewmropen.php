<div style="width:500px">
    <div style="margin-bottom: 5px">
        <span class="labelelement">MW</span><input type="text" name="mrno_s" id="mrno_s" size="10" onkeypress="if(event.keyCode==13){mr_searchmropen()}"/>
        <span class="labelelement">Dept.</span>
        <select name="departmentid_s" id="departmentid_s" onchange="mr_searchmropen()">
            <option value="0"></option>
            <?php
            foreach ($department as $result) {
                echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
            }
            ?>
        </select>
        <span class="labelelement">Date</span>
        <script type="text/javascript" >
            $(function() {
                $("#date_s").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function() {
                    $("#date_s").datepicker("show");
                });
            });
        </script>
        <input type="text" size="10" name="date_s" id="date_s" style="text-align: center" onkeypress="if(event.keyCode==13){mr_searchmropen()}"/>
        <button onclick="mr_searchmropen()" style="font-family: Calibri;">Search</button>
    </div>
    <table class="tablesorter" width="100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">MR</th>
                <th width="50%">Department</th>
                <th width="20%">Date</th>
                <th width="5%">Action</th>
            </tr>
        </thead>
        <tbody id="datamropen">
            <?php
            $no = 1;
            foreach ($mr as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++ ?></td>
                    <td align="center"><?php echo $result->number ?></td>
                    <td><?php echo $result->departmentname ?></td>
                    <td align="center"><?php echo $result->date ?></td>
                    <td align="center"><img src="images/check.png" onclick="stockout_mrchoose(<?php echo $result->id ?>,1)" class="miniaction"/></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>