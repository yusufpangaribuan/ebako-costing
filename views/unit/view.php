<h4>Unit</h4>    
<div style="width: 100%;">
    <div align="left" style="margin-left: 3px;margin-bottom: 5px;margin-top: 5px;">
        <span class="labelelement">Code :</span>
        <input type="text" id="code_s" name="code_s" size="10" onkeypress="if(event.keyCode==13){unit_search(0)}"/>
        <span class="labelelement">Name :</span>
        <input type="text" id="name_s" name="name_s" size="10" onkeypress="if(event.keyCode==13){unit_search(0)}"/>            
        <input type="hidden" id="remark_s" name="remark_s" onkeypress="if(event.keyCode==13){unit_search(0)}"/>    
        <button onclick="unit_search(0)">Search</button>
        <button onclick="unit_print()">Print</button>
        <?php
        if (in_array('add', $accessmenu)) {
            echo "<button onclick = 'unit_add()'>Add</button>";
        }
        ?>
    </div>
    <div id="unitdata" style="width: 500px;margin-left: 3px;">
        <?php $this->load->view('unit/search'); ?>
    </div>
</div>


