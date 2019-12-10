<h4>P.O Critical Outstanding Receive</h4>
<div align="left" style="margin: 1px" >
    <form id="po_critical_search_form" onsubmit="return false">
        <span class="labelelement">Search : 
            <input type="text" name="po_critical_no" placeholder="P.O No" size="8" onkeypress="if (event.keyCode === 13) {
                        po_critical_search(0);
                    }"/>    
        </span>
        <span class="labelelement">
            <input type="text" name="vendor" placeholder="Vendor/Supplier" style="width: 120px" onkeypress="if (event.keyCode === 13) {
                        po_critical_search(0);
                    }"/>
        </span>
        <span class="labelelement">
            <input type="text" size="15" placeholder="Item Code / Description" name="item_code_description" onkeypress="if (event.keyCode === 13) {
                        po_critical_search(0);
                    }"/>
            <button onclick="po_critical_search(0)" type="button">Find</button>
            <button onclick="po_critical_print()">Print</button>
            <button onclick="po_critical_excel()">Excel</button>
        </span>
    </form>
</div>
<div id="po_critical_data" style="margin: 1px;">
    <?php $po->critical_search(0); ?>
</div>



