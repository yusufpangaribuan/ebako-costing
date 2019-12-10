<h4>Component</h4>         
<center>
    <div style="width: 99.5%;">                       
        <div align="left" style="margin-bottom: 5px;margin-top: 5px;" >
            <span class="labelelement">Code : </span><input type="text" id="s_codes" name="s_codes" size="8" onkeypress="if(event.keyCode==13){component_search(0)}"/>    
            <span class="labelelement">Description : </span><input type="text" id="s_description" size="8"  name="s_description" onkeypress="if(event.keyCode==13){component_search(0)}"/>            
            <select id="s_groupid" style="width:100px;" onchange="component_search(0)">
                <option value="0"></option>
                <?php
                foreach ($type as $result) {
                    echo "<option value='" . $result->id . "'>" . $result->names . "</option>";
                }
                ?>
            </select>
            <button onclick="component_search(0)">Search</button>
            <?php
            if (in_array('add', $accessmenu)) {
                echo "<button onclick='component_add()'>Add</button>";
            }
            ?>                                    
        </div>
        <div id="componentdata">
            <?php $this->load->view('component/search'); ?>
        </div>
    </div>
</div>
</center>

