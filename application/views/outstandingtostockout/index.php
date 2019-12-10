<h4>Outstanding to Stock Out</h4>    
<div style="width: 100%;">
    <div align="left" style="margin-left: 3px;margin-bottom: 5px;margin-top: 5px;">
        <form id="outstandingtostockoutdata_search_form">
            <span class="labelelement">M.W NO :</span>
            <input type="text" name="mw_no" size="10" onkeypress="if (event.keyCode == 13) {
                        outstandingtostockout_search(0)
                    }"/>
            <span class="labelelement">Item Code / Description :</span>
            <input type="text" name="item_code_desc" size="10" onkeypress="if (event.keyCode == 13) {
                        outstandingtostockout_search(0)
                    }"/> 
            <span class="labelelement">Request By :</span>
            <input type="text" name="requestby" size="10" onkeypress="if (event.keyCode == 13) {
                        outstandingtostockout_search(0)
                    }"/> 
            <button type="button" onclick="outstandingtostockout_search(0)">Search</button>
            <button type="button" onclick="outstandingtostockout_print_list()">Print</button>
        </form>
    </div>
    <div>
        <center>
            <div id="outstandingtostockoutdata" style="width: 100%;">
                <?php
//        $data['mritem'] = $mritem;
                $outstandingtostockout->search(0);
                ?>
            </div>
        </center>
    </div>
</div>


