<?php
include_once '../model/bill.php';
include_once '../model/partner.php';
?>
<br>
<form id="billreginput" >
    <div class="container">
        <div class="form-group">
            <label>számlaszám:</label>
            <input  type="text" class="form-control" name="billnumb" id="billnumb" placeholder="számlaszám" required>
        </div>
        <div class="form-group">
            <label>kiállítási dátum:</label>
            <input id="billdate" type="date" class="form-control" name="billdate" required>
        </div>
        <label>fizetési határidő:</label>
        <div class="form-group"> 
            <input id="deadline" type="date" class="form-control" name="deadline"  required>
        </div>
        <div class="form-group ">
            <label>fizetési mód:</label>
            <select name="payType" id="payType" class="custom-select">
                <?php
                $bill = new Bill;
                echo $bill->getPayType();
                ?>
            </select> 
        </div>
        <div class="form-group">
            <label>netto összeg:</label>
            <input id="netto" type="text" class="form-control" name="netto" id="netto" placeholder="netto összeg" required>
        </div>
        <div class="form-group">
            <label>felrögzítés dátuma:</label>
            <input id="billregdate" type="date" id="billregdate" class="form-control" name="billdate" required>
        </div>
        <div class="form-group">
            <label>partner neve:</label>
            <select name="partnername" id="partnername" class="custom-select"> 
                <?php
                echo "<option name='partnername'></option>";
                $partner = new Partner;
                echo $partner->getPartnerNames();
                ?>
            </select>
        </div>
        <div class="form-group">
            <button id="billregbtn" name="billregbtn" class="btn btn-success" type="submit" >Feltölt</button>
        </div>
        <div id="billmessage" class="form-group">

        </div>
    </div>
</form> 