<?php

include_once 'dbh.php';

class Bill extends Dbh {

//számla feltöltése
    public function uploadBill($billnumb, $billdate, $deadline, $paytype, $netto, $brutto, $billregdate, $partnername) {
        $partnerid = '';
        if ($partnername !== "") {

            $stmt = $this->connect()->query("SELECT partner.id from partner WHERE partner.cegnev like '$partnername'");
            while ($row = $stmt->fetch()) {
                $partnerid = $row[0];
            }
        } else {
            $partnerid = "NULL";
        }

        $sql = "INSERT INTO `szamla`( `kiallitasi_datum`, `fizetesi_hatarido`, `fizetesi_mod`, `netto_osszeg`, `brutto_osszeg`, `felrogzitesi_datum`, `szamlatulajdonos`, `szamlaszam`) VALUES ('$billdate','$deadline','$paytype','$netto','$brutto','$billregdate','$partnerid','$billnumb')";
        $stmt = $this->connect()->query($sql);
        if ($stmt) {
            echo "<div class='alert-success'>Sikeres feltöltés!</div>";
        }
    }

//számlák adatainak lekérése
    public function getAllBills($fromdate, $todate, $partnername, $conditions) {

        $sql = "SELECT `szamlasorszam`, `szamlaszam`, `kiallitasi_datum`, `fizetesi_hatarido`, `fizetesi_mod`, `netto_osszeg`, `brutto_osszeg`, `felrogzitesi_datum`, `fizetve`, `fizetett_osszeg`, `cegnev` FROM `szamla`, `partner` WHERE partner.id=szamla.szamlatulajdonos";
        $sqlDate = "";
        $sqlCondition = "";
        $sqlPartner = "";

        //Ha a dátum intervallum kitöltve
        if ($fromdate != 0 && $todate != 0) {
            $sqlDate = " and kiallitasi_datum BETWEEN '$fromdate' and '$todate' ";
        } else {
            $sqlDate = "";
        }
//ha partner meg van adva
        if ($partnername != '') {
            $sqlPartner = " and partner.cegnev like '$partnername' ";
        } else {
            $sqlPartner = "";
        }
//teljesítesi állapot
        switch ($conditions) {
            case "teljesítettek":
                $sqlCondition = " and fizetve is not null";
                break;
            case "nem teljesítettek":
                $sqlCondition = " and fizetve is null";
                break;
            default:
                $sqlCondition = "";
        }
        $sql = "$sql" . $sqlPartner . $sqlDate . $sqlCondition;
        $stmt = $this->connect()->query($sql);

        $table = "<table class='table table-dark table-striped'>"
                . "<tr>"
                . "<th>id</th>"
                . "<th>cégnév</th>"
                . "<th>számlaszám</th>"
                . "<th>kiállítási dátum</th>"
                . "<th>fizetési határidő</th>"
                . "<th>fizetési mód</th>"
                . "<th>netto összeg</th>"
                . "<th>brutto összeg</th>"
                . "<th>felrögzítési dátum</th>"
                . "<th></th>"
                . "<th>befizetési dátum</th>"
                . "<th>fizetett összeg</th>"
                . "<th>törlés</th>"
                . "</tr>";


        while ($row = $stmt->fetch()) {
            $checkbox = "";
            $brutto = $row['brutto_osszeg'];
            $paid = $row['fizetett_osszeg'];
            $payrow = "";
            $tr = "";
            if ($brutto != $paid) {
                $payrow = "<td>{$row['fizetve']}</td>";
                $tr = "<tr>";
            } else {
                $payrow = "<td></td>";
                $tr = "<tr class='bg-success'>";
            }
            if ($paid != '') {
                $checkbox = "<td><input type='checkbox' class='form-check-input' onclick='return false;' checked='checked'></td>";
            } else {
                $checkbox = "<td><input type='checkbox' class='form-check-input' onclick='return false;' ></td>";
            }
            $table .= $tr
                    . "<td>{$row['szamlasorszam']}</td>"
                    . "<td>{$row['cegnev']}</td>"
                    . "<td>{$row['szamlaszam']}</td>"
                    . "<td>{$row['kiallitasi_datum']}</td>"
                    . "<td>{$row['fizetesi_hatarido']}</td>"
                    . "<td>{$row['fizetesi_mod']}</td>"
                    . "<td>{$row['netto_osszeg']}</td>"
                    . "<td>{$row['brutto_osszeg']}</td>"
                    . "<td>{$row['felrogzitesi_datum']}</td>"
                    . $checkbox
                    . $payrow
                    . "<td>{$row['fizetett_osszeg']}</td>"
                    . "<td><button class='btn btn-danger btn-xs delete_bill' data-toggle='modal' data-target='#deleteBillModal' name='delBillRowBtn' id='$row[szamlasorszam]' value='$row[szamlasorszam]'>töröl</button></td>"
                    . "</tr>";
        }

        $table .= "</table>";
      
        return $table;
    }

    //Fizetési módok lekérése
    public function getPayType() {
        $result = '';
        $sql = "SELECT DISTINCT fizetesi_mod FROM szamla";
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            $result .= "<option name='payType'>{$row[0]}</option><br>";
        }
        return $result;
    }

//számla törlése
    public function deleteBill($billid) {
        $sql = "delete from szamla where szamlasorszam=$billid";
        $stmt = $this->connect()->query($sql);
    }

}
