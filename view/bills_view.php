<?php
include_once '../model/partner.php';
?>
<form id="searchbill">
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 form-group" >
                <label>-tól</label>
                <input id="fromdate" type="date" class="form-control" name="from">
            </div>
            <div class="col-lg-6">
                <label>-ig</label>
                <input id="todate" type="date" class="form-control" name="to">
            </div>
        </div>
        <div class="row">
            <div class="col form-group">
                <label>partner neve:</label>
                <select name="partnername" id="partnername" class="custom-select"> 
                    <?php
                    echo "<option name='partnername'></option>";
                    $partner = new Partner;
                    echo $partner->getPartnerNames();
                    ?>
                </select>
                <br><br>
                <label>teljesítési állapot:</label>
                <select name="conditions" id="conditions" class="custom-select"> 
                    <option name='con-all'>minden</option>
                    <option name='con-performed'>teljesítettek</option>
                    <option name='con-notperform'>nem teljesítettek</option>
                </select>
                <div class="form-group">
                    <br>
                    <button id="searchbillbtn" name="billregbtn" class="btn btn-success" type="submit" >Keresés</button>
                </div>
                <br>
                <div id="billsearch_result" class="form-group">
                </div>

            </div>
        </div>
    </div>
</form>
