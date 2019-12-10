<h4>Stock Opname</h4>
<div style="margin: 4px;width: 100%">
    <form id="stockopname_search_form" onsubmit="return false">
        <span class="labelelement">Search : 
            <input type="text" name="stockopname_no" placeholder="ID" size="8" onkeypress="if (event.keyCode === 13) {
                        stockopname_search(0)
                    }"/>    
        </span>
        <span class="labelelement">
            <input type="text" name="start_date" placeholder="Date Start" id="stockopname_start_date_s" size="8" onchange="stockopname_search(0)"/>
            <script type="text/javascript" >
                $(function () {
                    $("#stockopname_start_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#stockopname_start_date_s").datepicker("show");
                    });
                });
            </script>
            -
            <input type="text" name="end_date" placeholder="Date End" id="stockopname_end_date_s" size="8" onchange="stockopname_search(0)"/>
            <script type="text/javascript" >
                $(function () {
                    $("#stockopname_end_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#stockopname_end_date_s").datepicker("show");
                    });
                });
            </script>   
        </span>
        <button onclick="stockopname_search(0)" type="button">Search</button>
        <?php
        //if (in_array('add', $accessmenu) && $this->session->userdata('department') == 10) {
        ?>
        <button onclick="stockopname_add(0)" type="button">Add</button>
        <?php
        //}
        ?>                                    
    </form>
</div>
<div id="stockopnamedata" style="width: 100%;margin: 2px;">
    <?php $stockopname->search(0) ?>
</div>
<script type="text/javascript" src="<?php echo base_url("js/stockopname.js") ?>"></script>