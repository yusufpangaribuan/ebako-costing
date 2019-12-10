<h4>Group Item</h4>
<center>
    <div style="width: 99.5%;">
        <div style="width: 100%;margin-left: 3px">
            <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
                <span class="labelelement">Code :</span>
                <input type="text" size="10" id="code_s" name="code_s" onkeypress="if (event.keyCode == 13) {
                            groups_search(0)
                        }"/>
                <span class="labelelement">Name :</span>
                <input type="text" size="10" id="name_s" name="name_s" onkeypress="if (event.keyCode == 13) {
                            groups_search(0)
                        }" />    
                <span class="labelelement">Description :</span>
                <input type="text" size="10" id="description_s" name="description_s" onkeypress="if (event.keyCode == 13) {
                            groups_search(0)
                        }" />
                <button onclick="groups_search(0)">Search</button>
                <button onclick="groups_print()">Print</button>
                <?php
                if (in_array('add', $accessmenu)) {
                    echo "<button onclick = 'groups_add()'>Add</button>";
                }
                ?>
            </div>     
            <div id="groupsdata" style="width: 100%;">
                <?php $this->load->view('groups/search') ?>
            </div>
        </div>
    </div>
</center>

