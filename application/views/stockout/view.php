<h4>Stock Out</h4>
<center>
    <div style="width: 100%;">
        <div align="left" style="padding: 2px;">
            <span class="labelelement">Search :</span>
            <input type="text" id="number" name="number" placeholder="Stock Out No" size="9" onkeypress="if (event.keyCode == 13) {
                        stockout_search(0)
                    }"/>            
            <script type="text/javascript" >
                $(function () {
                    $("#date_start").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#date_start").datepicker("show");
                    });
                    $("#date_end").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#date_end").datepicker("show");
                    });
                });
            </script>            
            <input type="text" id="date_start" placeholder="Start Date" size="9" onchange="stockout_search(0)"/>
            <span class="labelelement">-</span>
            <input type="text" id="date_end" size="9" placeholder="End Date" onchange="stockout_search(0)"/>
            <input type="text" id="refno" name="refno" placeholder="Reference / MW NO" size="12" onkeypress="if (event.keyCode == 13) {
                        stockout_search(0)
                    }"/>
            <select id="sto_departmentid_s" onchange="stockout_search(0)" style="font-style: italic">
                <option value="0">--Department--</option>
                <?php
                foreach ($department as $department) {
                    echo "<option value='" . $department->id . "'>" . $department->name . "</option>";
                }
                ?>
            </select>
            <input type="text" id="outby_s" name="outby" placeholder="Out By / Issued By" size="12" onkeypress="if (event.keyCode == 13) {
                        stockout_search(0)
                    }"/>
            <input type="text" id="receiveby" name="receiveby" placeholder="Receive By" size="12" onkeypress="if (event.keyCode == 13) {
                        stockout_search(0)
                    }"/>
            <button onclick="stockout_search(0)">Search</button>
            <button onclick="stockout_printlist()">Print</button>
            <?php
            //if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != "") {
            if ($this->model_user->haspermission($this->session->userdata('id'), 'stockout', 'add')) {
                ?>
                <button onclick="stockout_optionchoosed()">Add</button>
                <?php
            }
//}
            ?>
            <button onclick="stockout_report_form()">Report</button>
        </div>
        <div id="stockoutdata" style="overflow-x: hidden;width: 100%;padding: 2px">
            <?php $this->load->view('stockout/search'); ?>
        </div>
    </div>
</center>

