<h4>Position</h4>
<div style="width: 50%;margin-left: 3px">
    <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
        <span class="labelelement">Code :</span>
        <input type="text" size="10" id="code_s" name="codes" onkeypress="if(event.keyCode==13){position_search(0)}"/>
        <span class="labelelement">Name :</span>
        <input type="text" size="10" id="name_s" name="names" onkeypress="if(event.keyCode==13){position_search(0)}" />    
        <span class="labelelement">Description :</span>
        <input type="text" size="10" id="description_s" name="description" onkeypress="if(event.keyCode==13){position_search(0)}" />
        <button onclick="position_search(0)">Search</button>
        <button onclick="position_print()">Print</button>
        <?php
        if (in_array('add', $accessmenu)) {
            echo "<button onclick = 'position_add()'>Add</button>";
        }
        ?>
    </div>     
    <div id="positiondata" style="width: 100%;">
        <?php $this->load->view('position/search') ?>
    </div>
</div>
