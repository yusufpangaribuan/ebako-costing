<h4>Customer</h4>
<div align="left" style="margin-bottom: 5px;margin-top: 5px;"> 
    <form id="customer_search_form" onsubmit="return false;">
        <span class="labelelement">Name :</span><input type="text" id="name_s" name="name_s" onkeypress="if (event.keyCode == 13) {
                    customer_search(0)
                }"/>                
        <button onclick="customer_search(0)">Search</button>
        <button onclick="customer_print()">Print</button>
        <?php
        if (in_array('add', $accessmenu)) {
            echo "<button onclick = 'customer_add()'>Add</button>";
        }
        ?>
    </form>
</div>
<div id="datacustomer" style="margin: 1px;">
    <?php $customer->search(0); ?>
</div>


