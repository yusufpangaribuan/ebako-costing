<h4>Material Receiving</h4>         
<center>
    <div style="width: 99.5%;">                       
        <div align="left" style="margin-bottom: 5px;margin-top: 5px;" >
            <form id="materialreceive_search_form" onsubmit="return false">
                <span class="labelelement">Stock out NO : 
                    <input type="text" name="stockout_no" size="8" onkeypress="if (event.keyCode == 13) {
                                materialreceive_search(0)
                            }"/>    
                </span>
                <span class="labelelement">
                    MW NO :
                    <input type="text" size="12" name="mw_no" onkeypress="if (event.keyCode === 13) {
                                materialreceive_search(0)
                            }"/>
                </span>
                <span class="labelelement">
                    Item Code / Description :
                    <input type="text" size="12" name="item_code_description" onkeypress="if (event.keyCode === 13) {
                                materialreceive_search(0)
                            }"/>
                </span>
                </span>
                <button onclick="materialreceive_search(0)" type="button">Search</button>                              
            </form>
        </div>
        <div id="materialreceive_data">
            <?php $materialreceive->search(0); ?>
        </div>
    </div>
</div>
</center>



