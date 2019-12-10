<?php
foreach ($comment as $result) {
    echo $result->name . " Said :"
    ?>   
    <p><?php echo nl2br($result->content) ?></p><br/>
    <?php
}
?>