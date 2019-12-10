<h4>Return Material</h4>
<div align="left" style="margin: 1px" >
    <form id="returnproduction_search_form" onsubmit="return false">
        <span class="labelelement">Search : 
            <input type="text" name="returnproduction_no" placeholder="RTP NO" size="8" onkeypress="if (event.keyCode == 13) {
                        returnproduction_search(0)
                    }"/>    
        </span>
        <span class="labelelement">
            <input type="text" name="start_date" placeholder="Date Start" id="returnproduction_start_date_s" size="8" onchange="returnproduction_search(0)"/>
            <script type="text/javascript" >
                $(function () {
                    $("#returnproduction_start_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#returnproduction_start_date_s").datepicker("show");
                    });
                });
            </script>
            -
            <input type="text" name="end_date" placeholder="Date End" id="returnproduction_end_date_s" size="8" onchange="returnproduction_search(0)"/>
            <script type="text/javascript" >
                $(function () {
                    $("#returnproduction_end_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#returnproduction_end_date_s").datepicker("show");
                    });
                });
            </script>
            <span class="labelelement">
                <input type="text" size="15" placeholder="Return By" name="return_by" onkeypress="if (event.keyCode === 13) {
                            returnproduction_search(0)
                        }"/>
            </span>
            <span class="labelelement">
                <input type="text" size="15" placeholder="Department" name="department_name" onkeypress="if (event.keyCode === 13) {
                            returnproduction_search(0)
                        }"/>
            </span>
            <span class="labelelement">
                <input type="text" size="15" placeholder="Item Code / Description" name="item_code_description" onkeypress="if (event.keyCode === 13) {
                            returnproduction_search(0)
                        }"/>
            </span>
        </span>
        <button onclick="returnproduction_search(0)" type="button">Search</button>
        <button onclick='returnproduction_add()' type='button'>Add</button>
    </form>
</div>
<div id="returnproduction_data" style="margin: 1px;">
    <?php $returnproduction->search(0); ?>
</div>



