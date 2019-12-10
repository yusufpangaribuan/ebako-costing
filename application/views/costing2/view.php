<h4>* Costing</h4>
<center>
    <div style="width: 99.5%;">      
        <div align="left"  style="margin-top: 5px;margin-bottom: 5px;">                
            <label class="labelelement">Code :</label><input type="text" size="10" id="code_search" onkeypress="if(event.keyCode==13){costing_search(0)}"/>
            <label class="labelelement">Cust.Code :</label><input type="text" size="10" id="custcode_search" onkeypress="if(event.keyCode==13){costing_search(0)}"/>
            <label class="labelelement">Customer :</label>
            <select id="customerid_search" style="width: 100px;" onchange="costing_search(0)">
                <option value="0"></option>
                <?php
                foreach ($customer as $result) {
                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                }
                ?>
            </select>
            <label class="labelelement">Date From :</label>                
            <script type="text/javascript" >
                $(function() {
                    $("#datefrom").datepicker({
                        dateFormat: "yy-mm-dd",
                        changeMonth: true,
                        changeYear:true
                    }).focus(function() {
                        $("#datefrom").datepicker("show");
                    }); 
                    $("#dateto").datepicker({
                        dateFormat: "yy-mm-dd",
                        changeMonth: true,
                        changeYear:true
                    }).focus(function() {
                        $("#dateto").datepicker("show");
                    });
                });
            </script>
            <input type="text" size="10" name="datefrom" id="datefrom" value="" readonly="" style="text-align: center"/>
            <label class="labelelement">To :</label>
            <input type="text" size="10" name="dateto" id="dateto" value="" readonly="" style="text-align: center"/>
            <button onclick="costing_search(0)">Search</button>
            <?php
            if ($this->session->userdata('department') == 9) {
                if (in_array('add', $accessmenu)) {
                    echo "<button onclick='costing_createnew()'>Create</button>";
                }
            }
            ?>

        </div>
        <div id="datacosting" style="width: 100%;">
            <?php $this->load->view('costing/search'); ?>
        </div>
    </div>
</center>