<div>    
    <h4>Sales Order</h4>
    <center>
        <div style="width: 99.5%;">
            <div align="left"  style="margin-top: 5px;margin-bottom: 5px;">
                <span class="labelelement">SO :</span>
                <input type="text" name="so_s" id="so_s" size="10" onkeypress="if(event.keyCode==13){so_search(0)}"/>     
                <select style="width: 100px" id="customerid_s" onchange="so_search(0)">
                    <option value="0">--Customer--</option>
                    <?php
                    foreach ($customer as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select>
                <select style="width: 100px" id="shipto_s" onchange="so_search(0)">
                    <option value="0">--Ship To--</option>
                    <?php
                    foreach ($customer as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select>
                <script type="text/javascript" >
                    $(function() {
                        $("#datefrom_s").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function() {
                            $("#datefrom_s").datepicker("show");
                        });
                        $("#dateto_s").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function() {
                            $("#dateto_s").datepicker("show");
                        });
                    });
                </script>
                <span class="labelelement">Date From :</span>
                <input type="text" id="datefrom_s" size="10" style="text-align: center;" onchange="so_search(0)"/>
                <span class="labelelement">To :</span>
                <input type="text" id="dateto_s" size="10" style="text-align: center;" onchange="so_search(0)"/>
                <select id="status_s" onchange="so_search(0)">
                    <option value='0'>--Status--</option>
                    <?php
                    if (in_array($this->session->userdata('department'), array(1))) {
                        ?>
                        <option value=' and finishbymarketing=true and finishbyrnd=false and status = 0'>On R&d</option>                        
                        <?php
                    }if (in_array($this->session->userdata('department'), array(1, 4))) {
                        ?>
                        <option value=' and finishbyrnd=true and status = 0'>On PPC</option>                        
                        <?php
                    }if (in_array($this->session->userdata('department'), array(1, 4, 2))) {
                        ?>
                        <option value=' and status=1'>Production</option>
                        <option value=' and status=2'>Finish</option>    
                        <?php
                    }
                    ?>
                </select>
                <button onclick="so_search(0)">Search</button>
                <?php
                if (in_array('add', $accessmenu)) {
                    echo "<button onclick='so_create()'>Add</button>";
                }
                ?>
            </div>
            <div id="sodata">
                <?php $this->load->view("so/search") ?>
            </div>
        </div>
    </center>
</div>
