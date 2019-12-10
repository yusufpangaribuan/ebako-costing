<div style="min-height:600px;" id="">    
    <h4>Employee</h4>
    <center>
        <div style="width: 99.9%;">
            <div align="left" style="padding-top: 5px;padding-bottom: 5px;">
                <span class="labelelement">ID :</span><input type="text" id="id_s" name="id_s" size="9" onkeypress="if (event.keyCode == 13) {
                            employee_search(0)
                        }"/>
                <span class="labelelement">Name :</span><input type="text" id="name_s" name="name_s" size="9" onkeypress="if (event.keyCode == 13) {
                            employee_search(0)
                        }"/>
                <span class="labelelement">Address :</span>
                <input type="text" id="address_s" name="address_s" size="9" onkeypress="if (event.keyCode == 13) {
                            employee_search(0)
                        }"/>
                <span class="labelelement">City :</span>
                <input type="text" id="city_s" name="city_s" size="9" onkeypress="if (event.keyCode == 13) {
                            employee_search(0)
                        }"/>
                <button onclick="employee_search(0)">Search</button>
                <?php
                if (in_array('edit', $accessmenu)) {
                    echo "<button onclick=employee_add()>Add</button>";
                }
                ?>
            </div>
            <div id="dataemployee">
                <?php $employee->search(0) ?>
            </div>
        </div>
    </center>
    <br/>
    <br/>
</div>
<script type="text/javascript" src="<?php echo base_url('js/employee.js') ?>"></script>


