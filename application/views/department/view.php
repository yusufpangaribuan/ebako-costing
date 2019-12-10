<h4>Department</h4>    
<div style="width: 60%;">
    <div align="left" style="margin-left: 3px;margin-bottom: 5px;margin-top: 5px;">
        <span class="labelelement">Code :</span>
        <input type="text" id="code_s" size="10" name="code" onkeypress="if (event.keyCode === 13) {
                    department_search(0)
                }"/>
        <span class="labelelement">Name :</span>
        <input type="text" id="name_s" size="10" name="name" onkeypress="if (event.keyCode === 13) {
                    department_search(0)
                }" />    
        <span class="labelelement">Description :</span>
        <input type="text" id="description_s" name="description"  size="10" onkeypress="if (event.keyCode === 13) {
                    department_search(0)
                }"/>    
        <button onclick="department_search(0)">Search</button>
        <button onclick="department_print()">Print</button>
        <?php
        if (in_array('add', $accessmenu)) {
            ?>
            <button onclick = 'department_add()'>Add</button>
            <?php
        }
        ?>        
    </div>
    <div id="departmentdata" style="margin-left: 3px;">
        <?php $this->load->view('department/search'); ?>
    </div>
</div>


