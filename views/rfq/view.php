<h4>Request For Quotation</h4>
<center>
    <div style="width: 99%;">
        <div align="left"  style="margin-top: 5px;margin-bottom: 5px;">    
            <div style="background: #e4c9c9;min-width: 50px;padding: 4px;float: left;margin: 2px;vertical-align: middle;text-align: center;"><b>No Quotation</b></div>
            <div style="background: #71b8ff;min-width: 50px;padding: 4px;float: left;margin: 2px;vertical-align: middle;text-align: center;"><b>Not Complete Model</b></div>
            <div style="background: #ff8083;min-width: 50px;padding: 4px;float: left;margin: 2px;vertical-align: middle;text-align: center;"><b>Close RFQ</b></div>
            <div style="background: #ffa851;min-width: 50px;padding: 4px;float: left;margin: 2px;vertical-align: middle;text-align: center;"><b>Waiting Customer Approval</b></div>
            <div style="background: #ffff91;min-width: 50px;padding: 4px;float: left;margin: 2px;vertical-align: middle;text-align: center;"><b>New Create</b></div>
            <div style="background: #ccffff;min-width: 50px;padding: 4px;float: left;margin: 2px;vertical-align: middle;text-align: center;"><b>No Costing</b></div><br/><br/>
            <span class="labelelement">RFQ :</span>
            <input type="text" size="9" id="rfqno_s" onkeypress="if(event.keyCode==13){rfq_searh(0)}"/>
            <span class="labelelement">Date From :</span>
            <input type="text" size="9" id="datefrom_s" onkeypress="if(event.keyCode==13){rfq_searh(0)}" style="text-align: center"/>
            <script type="text/javascript" >
                $(function() {
                    $("#datefrom_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function() {
                        $("#datefrom_s").datepicker("show");
                    });
                });
            </script>
            <span class="labelelement">To :</span>
            <input type="text" size="9" id="dateto_s" onkeypress="if(event.keyCode==13){rfq_searh(0)}" style="text-align: center"/>
            <script type="text/javascript" >
                $(function() {
                    $("#dateto_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function() {
                        $("#dateto_s").datepicker("show");
                    });
                });
            </script>
            <select id="customerid_s" style="width: 80px" onchange="rfq_searh(0)">
                <option value="0">--Customer--</option>
                <?php
                foreach ($customer as $result) {
                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                }
                ?>
            </select>
            <select id="status_s" onchange="rfq_searh(0)">                
                <?php
                foreach ($rfqstatus as $key => $value) {
                    echo "<option value='" . $key . "'>" . $value . "</option>";
                }
                ?>
            </select>
            <button onclick="rfq_searh(0)" class="button">Search</button>
            <?php
            if (in_array('add', $accessmenu)) {
                echo "<button onclick='rfq_add()'>Create</button>";
            }
            ?>            
        </div>
        <div id="rfqdata">
            <?php $this->load->view('rfq/search'); ?>
        </div>            
    </div>
</center>