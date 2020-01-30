$(document).ready(function () {
    var tablerow;//törölt vagy módosítani kívánt sor
    var billid;

    //belépés
//     $(document).on("click", "#loginbtn" , function () {
//         var username=$('#username').val();
//         var password=$('#password').val();
//        $.ajax({
//            url: "controller/login_ctrl.php",
//            method: "POST",
//            data:{username:username,password:password},
//            success: function (ans) {
//                $("#loginmessage").html(ans);
//            }
//        });
//        return false;
//    }); 

//input elemek megjelenítése partner regisztrálásához
    $(document).on("click", "#partnerreg", function () {
        $.ajax({
            url: "partnerreg_view.php",
            method: "POST",
            success: function (ans) {
                $("#content").html(ans);
            }
        });
    });
    //input elemek megjelnítése számla regisztrálásához
    $(document).on("click", "#billreg", function () {
        $.ajax({
            url: "billreg_view.php",
            method: "POST",
            success: function (ans) {
                $("#content").html(ans);
            }
        });
    });
//keresőmező megjelenítése   
    $(document).on("click", "#partners", function () {
        $.ajax({
            url: "partnersearchfiled.php",
            method: "POST",
            success: function (ans) {
                $("#content").html(ans);
            }
        });
    });
    //input elemek megjelenítése számla kereséséhez
    $(document).on("click", "#bills", function () {
        $.ajax({
            url: "bills_view.php",
            method: "POST",
            success: function (ans) {
                $("#content").html(ans);
            }
        });
    });
    //számlák kilistázása szűrés alapján
    $(document).on("click", "#searchbillbtn", function () {
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var partnername = $('#partnername').val();
        var condition = $('#conditions').val();
        $.ajax({
            url: "../controller/searchBill_ctrl.php",
            method: "POST",
            data: {fromdate: fromdate, todate: todate, partnername: partnername, condition: condition},
            dataType: "text",
            success: function (ans) {
                $("#billsearch_result").html(ans);
            }
        });
        return false;
    });
    //Partnerek kilistázása
    $(document).on("click", "#partners", function () {
        var firm = '';
        $.ajax({
            url: "../controller/searchPartner_ctrl.php",
            method: "POST",
            data: {firm: firm},
            dataType: "text",
            success: function (ans) {
                $("#partners_result").html(ans);
            }
        });
    });
    //új partner felvétele
    $(document).on("click", "#partnerregbtn", function (e) {
        var firmname = $('#firmname').val();
        var adress = $('#adress').val();
        var taxnumber = $('#taxnumber').val();
        var contactname = $('#contactname').val();
        var telnumber = $('#telnumber').val();
        var comment = $('#comment').val();
        e.preventDefault();
        if (firmname === '' || adress === '' || taxnumber === '' || contactname === '' || telnumber === '') {
            $("#regmessage").html("<div class='alert-warning'>Kérem töltse ki az összes mezőt!</div>");
        } else {
            $.ajax({
                url: "../controller/partnerreg_ctrl.php",
                type: "POST",
                //data: $("#partnerinput").serialize(),
                data: {firmname: firmname, adress: adress, taxnumber: taxnumber, contactname: contactname, telnumber: telnumber, comment: comment},
                success: function (data) {
                    $('#regmessage').html(data);
                    //console.log(firmname);
                }
            });
        }
        return false;
    });
//új számla felvétele
    $(document).on("click", "#billregbtn", function () {
        var billnumb = $('#billnumb').val();
        var billdate = $('#billdate').val();
        var deadline = $('#deadline').val();
        var paytype = $('#payType').val();
        var netto = $('#netto').val();
        var billregdate = $('#billregdate').val();
        var partnername = $('#partnername').val();
        if (billnumb === '' || billdate === '' || deadline === '' || paytype === '' || netto === '' || billregdate === '' || partnername === '') {
            $("#billmessage").html("<div class='alert-warning'>Kérem töltse ki az összes mezőt!</div>");
        } else {
            $.ajax({
                url: "../controller/billreg_ctrl.php",
                type: "POST",
                data: {billnumb: billnumb, billdate: billdate, deadline: deadline, paytype: paytype, netto: netto, billregdate: billregdate, partnername: partnername},
                success: function (data) {
                    $('#billmessage').html(data);
                }
            });
        }
        return false;
    });
    //Live-search, Partner keresése

    $(document).on('keyup', '#searched_firmname', function () {
        var txt = $(this).val();
        if (txt !== '') {
            $.ajax({
                url: "../controller/searchPartner_ctrl.php",
                method: "POST",
                data: {firm: txt},
                dataType: "text",
                success: function (ans) {
                    $("#partners_result").html(ans);
                }
            });
        } else {
            var txt = '';
            $.ajax({
                url: "../controller/searchPartner_ctrl.php",
                method: "POST",
                data: {firm: txt},
                dataType: "text",
                success: function (ans) {
                    $("#partners_result").html(ans);
                }
            });
        }
    });

    //A törölni kívánt partner nevének mejelenítése a modal ablakban  
    $(document).on('click', '.delete_data', function () {
        var partnerid = $(this).attr('id');
        tablerow = $(this).closest("tr");
        $.ajax({
            url: "../controller/showPartnerName_ctrl.php",
            method: "GET",
            data: {partnerid: partnerid},
            dataType: "text",
            success: function (ans) {
                $("#delmodalcontent").html(ans);
            }
        });
        return false;
    });

    //partner törlése
    $(document).on('click', '#partnerDelBtn', function () {
        //var partnerid=$('.delete_data').val();
        var partnerid = $('#delPartnerid').val();
        $.ajax({
            url: "../controller/deletePartner_ctrl.php",
            method: "GET",
            data: {partnerid: partnerid},
            // dataType:"text",
            success: function (ans) {
                alert(ans);
                tablerow.remove();
            }
        });
        return false;
    });
    //input elemek megjelenítése a Partner módosításához, modal ablakban
    $(document).on('click', '.edit_data', function () {
        var partnerid = $(this).attr('id');
        $.ajax({
            url: "../controller/ShowEditPartnerData_ctrl.php",
            method: "GET",
            data: {partnerid: partnerid},
            dataType: "text",
            success: function (ans) {
                $("#editmodalcontent").html(ans);
            }
        });
        return false;
    });
    //Partner adatainak módosítása
    $(document).on('click', '#partnerEditBtn', function () {
        //var partnerid=$('.delete_data').val();
        var partnerid = $('#edPartnerid').val();
        var partnername = $('#edPartnername').val();
        var partneradress = $('#edPartneradress').val();
        var partnertax = $('#edPartnertax').val();
        var partnertel = $('#edPartnertel').val();
        var partnercontact = $('#edPartnercontact').val();
        var partnercomment = $('#edPartnercomment').val();
        $.ajax({
            url: "../controller/editPartner_ctrl.php",
            method: "POST",
            data: {partnerid: partnerid, partnername: partnername, partneradress: partneradress, partnertax: partnertax, partnertel: partnertel, partnercontact: partnercontact, partnercomment: partnercomment},

            success: function (ans) {
                $('#partnertable').html(ans);
             
            }
        });
        return false;
    });
    //ne frissítse az oldalt a modállis ablak megjelenése után, rákérdezés
    $(document).on('click', '.delete_bill', function (e) {
        billid = $(this).attr('id');
        tablerow = $(this).closest("tr");
        e.preventDefault();
    });

    //számla törlése
    $(document).on('click', '#billDelBtn', function () {
        var delBillId = billid;
        $.ajax({
            url: "../controller/deleteBill_ctrl.php",
            method: "GET",
            data: {delBillId: delBillId},
            success: function (ans) {

                tablerow.remove();
            }
        });
        return false;
    });
});


