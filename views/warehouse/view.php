<h4>Warehouse</h4>
<div style="width: 50%;margin-left: 3px">
    <div align="left" style="margin-top: 5px;margin-bottom: 5px;">                
        <span class="labelelement">Name :</span>
        <input type="text" size="10" id="names_s" name="names" onkeypress="if(event.keyCode==13){warehouse_search(0)}" />    
        <span class="labelelement">Description :</span>
        <input type="text" size="10" id="description_s" name="description" onkeypress="if(event.keyCode==13){warehouse_search(0)}" />
        <button onclick="warehouse_search(0)">Search</button>
        <?php
        if (in_array('add', $accessmenu)) {
            echo "<button onclick = 'warehouse_add()'>Add</button>";
        }
        ?>
    </div>     
    <div id="warehousedata" style="width: 100%;">
        <?php $this->load->view('warehouse/search') ?>
    </div>
</div>
