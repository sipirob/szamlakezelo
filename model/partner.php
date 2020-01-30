<?php

include_once 'dbh.php';

class Partner extends Dbh {

    //Új partner felvétele
    public function partnerreg($firmname, $adress, $taxnumber, $contactname, $telnumber, $comment) {
        $stmt = $this->connect()->query("INSERT INTO `partner`( `cegnev`, `cim`, `adoszam`, `kapcsolattarto`, `telefonszam`, `megjegyzes`) VALUES ('$firmname','$adress','$taxnumber','$contactname','$telnumber','$comment')");

        if ($stmt) {
            echo "<div class='alert-success'>Sikeres feltöltés!</div>";
        } else {
            echo 'Sikertelen feltöltés!';
        }
    }

    public function getAllPartners($sql) {
        //$sql="SELECT * from partner where cegnev LIKE '$firmname%'";
        $stmt = $this->connect()->query($sql);
        $table = "<table class='table table-dark table-striped' id='partnertable'>"
                . "<thead>"
                . "<th>id</th>"
                . "<th>cégnév</th>"
                . "<th>cím</th>"
                . "<th>adószám</th>"
                . "<th>kapcsolattartó</th>"
                . "<th>telefonszám</th>"
                . "<th>megjegyzés</th>"
                . "<th>módosítás</th>"
                . "<th>törlés</th>"
                . "</thead>";
        while ($row = $stmt->fetch()) {
            $table .= "<tbody>"
                    . "<tr>"
                    . "<td>{$row['id']}</td>"
                    . "<td>{$row['cegnev']}</td>"
                    . "<td>{$row['cim']}</td>"
                    . "<td>{$row['adoszam']}</td>"
                    . "<td>{$row['kapcsolattarto']}</td>"
                    . "<td>{$row['telefonszam']}</td>"
                    . "<td>{$row['megjegyzes']}</td>"
                    . "<td><button class='btn btn-warning btn-xs edit_data' data-toggle='modal' data-target='#editModal' id='$row[id]'>módosít</button></td>"
                    . "<td><button class='btn btn-danger btn-xs delete_data' data-toggle='modal' data-target='#deleteModal' id='$row[id]' value='$row[id]'>töröl</button></td>"
                    . "</tr>"
                    . "</tbody>";
        }
        $table .= "</table>";
        echo $table;
    }

//partner nevének lekérése id alapján
    public function getPartnerName($partnerid) {
        $sql = "select * from partner where id='$partnerid'";
        $stmt = $this->connect()->query($sql);
        $row = $stmt->fetch();
        $partnername = $row['cegnev'];
        $input = "<input type='hidden' id='delPartnerid' value='$partnerid'></input>";
        return 'Biztosan törli a ' . $partnername . ' nevű partnert?' . $input;
    }

    //partner törlése
    public function deletePartner($partnerid) {
        $sqlbill = "DELETE FROM `szamla` WHERE szamlatulajdonos like $partnerid";
        $sqlpartner = "delete from partner where id=$partnerid";
        $stmtB = $this->connect()->query($sqlbill);
        $stmt = $this->connect()->query($sqlpartner);
        if ($stmt) {
            echo "A partner törlésre került a hozzátartozó számlákkal együtt!";
        } else {
            echo "Nem sikerült a törlés!";
        }
    }

    //partner adatanak lekérése id alapján majd input meezőkben történő megjelenítése
    public function getPartnerData($partnerid) {
        $sql = "select * from partner where id='$partnerid'";
        $stmt = $this->connect()->query($sql);
        $row = $stmt->fetch();

        $partnername = $row['cegnev'];
        $partneradress = $row['cim'];
        $partnertaxnumb = $row['adoszam'];
        $partnercontact = $row['kapcsolattarto'];
        $partnertel = $row['telefonszam'];
        $partnercomment = $row['megjegyzes'];

        $inputid = "<input type='hidden' id='edPartnerid' value='$partnerid'></input><br>";
        $inputname = "<input  class='form-control' id='edPartnername' value='$partnername'></input><br>";
        $inputadress = "<input  class='form-control' id='edPartneradress' value='$partneradress'></input><br>";
        $inputtax = "<input  class='form-control' id='edPartnertax' value='$partnertaxnumb'></input><br>";
        $inputcontact = "<input  class='form-control' id='edPartnercontact' value='$partnercontact'></input><br>";
        $inputtel = "<input  class='form-control' id='edPartnertel' value='$partnertel'></input><br>";
        $inputcomm = "<textarea  class='form-control' id='edPartnercomment' >$partnercomment</textarea>";
        return $inputid . $inputname . $inputadress . $inputtax . $inputcontact . $inputtel . $inputcomm;
    }

//Partner adatainak módosítása
    public function editPartner($partnerid, $partnername, $partneradress, $partnertax, $partnercontact, $partnertel, $partnercomment) {
        $sql = "UPDATE `partner` SET `cegnev`='$partnername',`cim`='$partneradress',`adoszam`='$partnertax',`kapcsolattarto`='$partnercontact',`telefonszam`='$partnertel',`megjegyzes`='$partnercomment' WHERE id=$partnerid";
        $stmt = $this->connect()->query($sql);
        $sqlresult = "select * from partner";
        $partner = new Partner();

        return $partner->getAllPartners($sqlresult);
    }

    //Partnerek neveinek lekérése
    public function getPartnerNames() {
        $result = '';
        $sql = "SELECT DISTINCT cegnev FROM partner where cegnev is not null";
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            $result .= "<option name='partnername'>{$row[0]}</option><br>";
        }
        return $result;
    }

}
