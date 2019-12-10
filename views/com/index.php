<h4>COM (Customer Own Material)</h4>         

<div align="left" style="margin: 1px" >
    <form id="com_search_form" onsubmit="return false">
        <span class="labelelement">Search : 
            <input type="text" name="com_no" placeholder="COM NO" size="8" onkeypress="if (event.keyCode == 13) {
                        com_search(0)
                    }"/>    
        </span>
        <span class="labelelement">
            <input type="text" name="start_date" placeholder="Date Start" id="com_start_date_s" size="8" onchange="com_search(0)"/>
            <script type="text/javascript" >
                $(function () {
                    $("#com_start_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#com_start_date_s").datepicker("show");
                    });
                });
            </script>
            -
            <input type="text" name="end_date" placeholder="Date End" id="com_end_date_s" size="8" onchange="com_search(0)"/>
            <script type="text/javascript" >
                $(function () {
                    $("#com_end_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#com_end_date_s").datepicker("show");
                    });
                });
            </script>    
            <span class="labelelement">
                <input type="text" size="12" name="customer_name" placeholder="Customer" onkeypress="if (event.keyCode === 13) {
                            com_search(0)
                        }"/>
            </span>
            <span class="labelelement">
                <input type="text" size="12" placeholder="AWB NO" name="awb" onkeypress="if (event.keyCode === 13) {
                            com_search(0)
                        }"/>
            </span>
            <span class="labelelement">
                <input type="text" size="15" placeholder="Item Code / Description" name="item_code_description" onkeypress="if (event.keyCode === 13) {
                            com_search(0)
                        }"/>
            </span>
        </span>
        <button onclick="com_search(0)" type="button">Search</button>
        <?php
        if (in_array('add', $accessmenu) && $this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
            echo "<button onclick='com_add()' type='button'>Add</button>";
        }
        ?>                                    
    </form>
</div>
<div id="com_data" style="margin: 1px;">
    <?php $com->search(0); ?>
</div>



