<h4>Model Type</h4>
<center>
    <div style="width: 99%;">
        <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
            <span class="labelelement">Code :</span>
            <input type="text" size="10" id="code_s" name="code_s" onkeypress="if (event.keyCode == 13) {
                        modeltype_search(0)
                    }"/>        
            <span class="labelelement">Description :</span>
            <input type="text" size="10" id="description_s" name="description_s" onkeypress="if (event.keyCode == 13) {
                        modeltype_search(0)
                    }" />
            <button onclick="modeltype_search(0)">Search</button>
            <button onclick="modeltype_print()">Print</button>
            <?php
            if (in_array('add', $accessmenu)) {
                echo "<button onclick = 'modeltype_add()'>Add</button>";
            }
            ?>
        </div>     
        <div id="modeltypedata" style="width: 100%;">
            <?php $this->load->view('modeltype/search') ?>
        </div>
    </div>
</center>
