//profilebar--------------------------------------------------------------------------------------------------------------

// เปิดหน้าโปรไฟล์บาร์
function signIn() {
    document.getElementById("profilebar").style.right = "0";
    document.getElementById("signIn").style.display = "block";
    document.getElementById("forgotpsw").style.display = "none";
    document.getElementById("signUp").style.display = "none";

    document.getElementById("profilebar").style.transition = "0.5s ease";
    document.getElementById("resetpsw").style.display = "none";
}
// ปิดหน้าโปรไฟล์บาร์
function closeprofilebar() {
    document.getElementById("profilebar").style.right = "-450px";
}
// เปิดหน้าลืมรหัสผ่าน
function showforgotpsw() {
    document.getElementById("signIn").style.display = "none";
    document.getElementById("forgotpsw").style.display = "block";
    document.getElementById("signUp").style.display = "none";
    document.getElementById("resetpsw").style.display = "none";
}
// เปิดหน้าเข้าสู่ระบบ
function showsignIn() {
    document.getElementById("signIn").style.display = "block";
    document.getElementById("forgotpsw").style.display = "none";
    document.getElementById("signUp").style.display = "none";
    document.getElementById("resetpsw").style.display = "none";
}
// เปิดหน้าลงทะเบียน
function showsignup() {
    document.getElementById("signIn").style.display = "none";
    document.getElementById("forgotpsw").style.display = "none";
    document.getElementById("signUp").style.display = "block";
    document.getElementById("resetpsw").style.display = "none";
}
// เปิดหน้ารีเซตรหัสผ่าน
function showresetpsw() {
    document.getElementById("signIn").style.display = "none";
    document.getElementById("forgotpsw").style.display = "none";
    document.getElementById("signUp").style.display = "none";
    document.getElementById("resetpsw").style.display = "block";
}

// เชครหัสตรงกัน
var password = document.getElementById("password"),
    confirm_password = document.getElementById("confirm_password");

function validatePassword() {
    if (password.value == confirm_password.value) {
        return true;
    } else {
        alert("กรุณากรอกรหัสผ่านให้ตรงกัน");
        return false;
    }
}
//applicant--------------------------------------------------------------------------------------------------------------

// nextbtn
function nextbtn() {
    document.getElementById("stepOne").style.display = "none";
    document.getElementById("stepTwo").style.display = "block";
    document.getElementById("stepThree").style.display = "none";
    // document.getElementById("stepFour").style.display = "none";
}
// previousbtn
function previousbtn() {
    document.getElementById("stepOne").style.display = "block";
    document.getElementById("stepTwo").style.display = "none";
    document.getElementById("stepThree").style.display = "none";
}
function gotostep3() {
    document.getElementById("stepOne").style.display = "none";
    document.getElementById("stepTwo").style.display = "none";
    document.getElementById("stepThree").style.display = "block";
}
function backtostep2() {
    document.getElementById("stepOne").style.display = "none";
    document.getElementById("stepTwo").style.display = "block";
    document.getElementById("stepThree").style.display = "none";

}
function checkform1() {
    var datestart = document.getElementById("datestart").value;
    var dateend = document.getElementById("dateend").value;

    if (datestart != "") {
        if (dateend != "") {
            document.getElementById("next1").disabled = false;
        } else {
            document.getElementById("next1").disabled = true;
        }
    } else {
        document.getElementById("next1").disabled = true;
    }
}

function checkform2() {
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var myemail = document.getElementById("myemail").value;
    var mytel = document.getElementById("mytel").value;
    var imgInp = document.getElementById("imgInp").value;
    var stallName = document.getElementById("stallName").value;
    var Infomrk = document.getElementById("Infomrk").value;

    if (firstname != "") {
        if (lastname != "") {
            if (myemail != "") {
                if (mytel != "") {
                    if (imgInp != "") {
                        if (stallName != "") {
                            if (Infomrk != "") {
                                document.getElementById("next2").disabled = false;
                            } else {
                                document.getElementById("next2").disabled = true;
                            }
                        } else {
                            document.getElementById("next2").disabled = true;
                        }
                    } else {
                        document.getElementById("next2").disabled = true;
                    }
                } else {
                    document.getElementById("next2").disabled = true;
                }
            } else {
                document.getElementById("next2").disabled = true;
            }
        } else {
            document.getElementById("next2").disabled = true;
        }
    } else {
        document.getElementById("next2").disabled = true;
    }
}

function checkapp() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var doc = document.getElementById("doc").value;


    if (fname != "") {
        if (lname != "") {
            if (email != "") {
                if (doc != "") {
                    document.getElementById("next").disabled = false;
                } else {
                    document.getElementById("next").disabled = true;
                }
            } else {
                document.getElementById("next").disabled = true;
            }
        } else {
            document.getElementById("next").disabled = true;
        }
    } else {
        document.getElementById("next").disabled = true;
    }
}

function checkapp2() {
    var mkname = document.getElementById("mkname").value;
    var mktype = document.getElementById("mktype").value;
    var houseno = document.getElementById("houseno").value;
    var soi = document.getElementById("soi").value;
    var moo = document.getElementById("moo").value;
    var road = document.getElementById("road").value;
    var province = document.getElementById("province").value;
    var amphure = document.getElementById("amphure").value;
    var district = document.getElementById("district").value;
    var zipcode = document.getElementById("zipcode").value;
    var open = document.getElementById("open").value;
    var des = document.getElementById("des").value;
    var file = document.getElementById("file").value;
    var min = document.getElementById("min").value;

    if (mkname != "") {
        if (mktype != "") {
            if (houseno != "") {
                if (soi != "") {
                    if (moo != "") {
                        if (road != "") {
                            if (province != "") {
                                if (amphure != "") {
                                    if (district != "") {
                                        if (zipcode != "") {
                                            if (open != "") {
                                                if (des != "") {
                                                    if (file != "") {
                                                        if (min != "") {
                                                            document.getElementById("submit").disabled = false;
                                                        } else {
                                                            document.getElementById("submit").disabled = true;
                                                        }
                                                    } else {
                                                        document.getElementById("submit").disabled = true;
                                                    }
                                                } else {
                                                    document.getElementById("submit").disabled = true;
                                                }
                                            } else {
                                                document.getElementById("submit").disabled = true;
                                            }
                                        } else {
                                            document.getElementById("submit").disabled = true;
                                        }
                                    } else {
                                        document.getElementById("submit").disabled = true;
                                    }
                                } else {
                                    document.getElementById("submit").disabled = true;
                                }
                            } else {
                                document.getElementById("submit").disabled = true;
                            }
                        } else {
                            document.getElementById("submit").disabled = true;
                        }
                    } else {
                        document.getElementById("submit").disabled = true;
                    }
                } else {
                    document.getElementById("submit").disabled = true;
                }
            } else {
                document.getElementById("submit").disabled = true;
            }
        } else {
            document.getElementById("submit").disabled = true;
        }
    } else {
        document.getElementById("submit").disabled = true;
    }
}

// check booking info-------------------------------------------------------------------------------------------------------
function checkInfo1() {
    var firstname = document.getElementById("firstname").value;
    document.getElementById("demofirstname").value = firstname;

    var lastname = document.getElementById("lastname").value;
    document.getElementById("demolastname").value = lastname;

    var myemail = document.getElementById("myemail").value;
    document.getElementById("demoemail").value = myemail;

    var mytel = document.getElementById("mytel").value;
    document.getElementById("demotel").value = mytel;

    var stallName = document.getElementById("stallName").value;
    document.getElementById("demostallName").value = stallName;

    var Infomrk = document.getElementById("Infomrk").value;
    document.getElementById("demoInfomrk").value = Infomrk;

    var imgInp = document.getElementById("imgInp").value;
    var filename = imgInp.replace(/^.*[\\\/]/, '')
    document.getElementById("demoimg").value = filename;

    var datestart = document.getElementById("datestart").value;
    document.getElementById("demodatestart").value = datestart;

    var dateend = document.getElementById("dateend").value;
    document.getElementById("demodateend").value = dateend;

}
function checkInfo2() {
    var firstname = document.getElementById("firstname").value;
    document.getElementById("demofirstname").value = firstname;

    var lastname = document.getElementById("lastname").value;
    document.getElementById("demolastname").value = lastname;

    var myemail = document.getElementById("myemail").value;
    document.getElementById("demoemail").value = myemail;

    var mytel = document.getElementById("mytel").value;
    document.getElementById("demotel").value = mytel;

    var stallName = document.getElementById("stallName").value;
    document.getElementById("demostallName").value = stallName;

    var Infomrk = document.getElementById("Infomrk").value;
    document.getElementById("demoInfomrk").value = Infomrk;

    var imgInp = document.getElementById("imgInp").value;
    var filename = imgInp.replace(/^.*[\\\/]/, '')
    document.getElementById("demoimg").value = filename;

    var e = document.getElementById("daterangerent");
    document.getElementById("daterange").value = e.options[e.selectedIndex].text;

}


//banner--------------------------------------------------------------------------------------------------------------  
$(document).ready(function () {
    $("#myTable").DataTable({
        scrollCollapse: true,
        paging: true,
        lengthChange: false,
        "language": {
            "search": "ค้นหา :",
            "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
            "info": "แสดงผลลัพธ์ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบตารางที่ค้นหา",
            "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ ตาราง)",
            "paginate": {
                "previous": "ก่อนหน้า",
                "next": "หน้าถัดไป",

            }
        },
        "bDestroy": true
    });

});



$(document).ready(function () {
    $("#myTable_nosort").DataTable({
        scrollCollapse: true,
        paging: true,
        lengthChange: false,
        "language": {
            "search": "ค้นหา :",
            "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
            "info": "แสดงผลลัพธ์ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบตารางที่ค้นหา",
            "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ ตาราง)",
            "paginate": {
                "previous": "ก่อนหน้า",
                "next": "หน้าถัดไป",

            }
        },
        "bDestroy": true,
        "columnDefs": [
            { "targets": [0], "searchable": false, "orderable": false, "visible": true }
        ]
    });

});








