<h4>Currency</h4>    
<div style="width: 100%;margin-left: 3px;">
    <div align="left" style="margin-bottom: 5px;margin-top: 5px;">
        <form id="currency_search_form" onsubmit="return false;">
            <span class="labelelement">Search</span>
            <input type="text" name="code_or_description" placeholder="Serial No" style="width: 120px"
                   onkeypress="if (event.keyCode === 13)
                               (currency_search(0))"/>            
            <button  type="button" onclick="currency_search(0)">Find</button>
            <?php
            if (in_array('add', $accessmenu)) {
                echo "<button type='button' onclick = 'currency_add()'>Add</button>";
            }
            ?>
        </form>
    </div>
    <div id="currencydata" style="width: 50%">
        <?php $currency->search(0) ?>
    </div>
</div>


