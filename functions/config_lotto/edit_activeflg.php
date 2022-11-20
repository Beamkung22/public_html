<?php 
$oldflg = $_POST['oldflg'];
    if($oldflg == "Y"){
    ?>
    <option selected value="<?php echo 'Y'; ?>"><?php echo 'Y'; ?></option>
    <option value="<?php echo 'N'; ?>"><?php echo 'N'; ?></option>
    <?php
    }else{
        ?>
        <option selected value="<?php echo 'N'; ?>"><?php echo 'N'; ?></option>
        <option value="<?php echo 'Y'; ?>"><?php echo 'Y'; ?></option>
    <?php   
    }  
    ?>
