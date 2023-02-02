<?php
ob_start();
session_start();
include "backend/1-connectDB.php";
include "backend/1-import-link.php";
require "backend/auth-auth.php";
require "backend/auth-signup.php";
$sqllg = "SELECT * FROM contact ";
$resultlg = mysqli_query($conn, $sqllg);
$lg = mysqli_fetch_array($resultlg);
extract($lg);

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $query = "SELECT * FROM forgot_password WHERE token = '$token' ";
    $r = mysqli_query($conn, $query);
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
        $email = $row['email'];
    }
} else {
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> MarketRental - user-profile</title>
    <link rel="stylesheet" href="./css/profilebar.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="./<?php echo $lg['ct_logo'] ?>" />
</head>

<body>

    <div class="profileicon prevent-select" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <p>เข้าสู่ระบบ/สมัครสมาชิก</p>
        <i id="profileicon" class='bx bxs-user-circle bx-md'></i>
    </div>

    <div class="profilebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <button type="button" id="close-profile-btn" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <!-- เข้าสู่ระบบ -->
        <div id="signIn">
            <h1>เข้าสู่ระบบ</h1>
            <form method="POST" class="was-validated">
                <div class="mb-1">ชื่อบัญชีผู้ใช้</div>
                <input class="form-control mb-2" type="text" name="username-login" placeholder="ชื่อบัญชีผู้ใช้" pattern="^[a-zA-Z0-9]+$" title="กรุณากรอกชื่อผู้ใช้ให้ถูกต้อง" required>
                <div class="mb-1">รหัสผ่าน</div>
                <input class="form-control mb-1" type="password" name="password-login" placeholder="รหัสผ่าน" pattern=".{8,}" title="กรุณากรอกรหัสผ่านให้ถูกต้อง" required>
                <div class="text-end">
                    <a href="#" onclick="showforgotpsw()" class="btn btn-link p-0">ลืมรหัสผ่าน?</a>
                </div>
                <button class="btn btn-primary w-100 mt-2" type="submit" name="login-btn">เข้าสู่ระบบ</button>
            </form>
            <hr class="mx-5 mb-0">
            <div class="center">ยังไม่ได้เป็นสมาชิก?<button href="#" onclick="showsignup()" class="btn btn-link">สมัครสมาชิก</button> </div>
        </div>

        <!-- ลืมรหัสผ่าน -->
        <div id="forgotpsw">
            <h1>ลืมรหัสผ่าน</h1>
            <div class="form-message" id="msg"></div>
            <form method="POST" class="was-validated">
                <div class="mb-1">อีเมล</div>
                <input class="form-control mb-2" type="email" name="email" id="email" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" title="กรุณากรอกอีเมลให้ถูกต้อง" required>
                <button class="btn btn-primary w-100 mt-2" onclick="sendEmail(),send_email()" type="submit" name="login-btn">ส่งรหัสผ่านไปยังอีเมล</button>
            </form>
            <hr class="mx-5 mb-0">
            <div class="center"><button href="#" onclick="showsignIn()" class="btn btn-link">ย้อนกลับไปเข้าสู่ระบบ</button> </div>
        </div>

        <!-- สมัครสมาชิก -->
        <div id="signUp">
            <h1>สมัครสมาชิก</h1>
            <form method="POST">
                <div class="mb-2 hstack gap-2">
                    <div>ประเภทผู้ใช้ :</div>
                    <input class="form-check-input mt-0" type="radio" name="type" id="flexRadioDefault1" value="1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        พ่อค้า/แม่ค้า
                    </label>
                    <input class="form-check-input mt-0" type="radio" name="type" id="flexRadioDefault2" value="2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        เจ้าของตลาด
                    </label>
                </div>
                <div class="was-validated">
                    <div class="des_input mb-1">ชื่อบัญชีผู้ใช้</div>
                    <input class="form-control mb-2" placeholder="ชื่อบัญชีผู้ใช้" type="text" name="username-reg" pattern="^[a-zA-Z0-9]+$" title="กรุณากรอกชื่อผู้ใช้เป็นภาษาอังกฤษ หรือ ตัวเลข 0-9" required>
                    <div class="mb-1">ชื่อ-นามสกุล <span class="text-secondary">(ภาษาไทย)</span></div>
                    <div class="hstack gap-2 mb-2">
                        <input class="form-control" pattern="^[ก-๏\s]+$" placeholder="ชื่อ" style="width: 48%;" type="text" name="firstName-reg" title="กรุณากรอกชื่อเป็นภาษาไทย" required>
                        <input class="form-control" pattern="^[ก-๏\s]+$" placeholder="ชื่อนามสกุล" style="width: 48%;" type="text" name="lastName-reg" title="กรุณากรอกนามสกุลเป็นภาษาไทย" required>
                    </div>
                    <div class="mb-1">อีเมล</div>
                    <input class="form-control mb-2" type="email" name="email-reg" placeholder="อีเมล" required>
                    <div class="mb-1">เบอร์โทรศัพท์</div>
                    <input class="form-control mb-2" id="tel" type="tel" name="tel-reg" placeholder="เบอร์โทรศัพท์" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" required>
                    <div class="mb-1">รหัสผ่าน</div>
                    <input class="form-control mb-2" type="password" id="password" name="password" placeholder="รหัสผ่าน" pattern=".{8,}" title="กรุณากรอกรหัสผ่านให้ถูกต้อง" required>
                    <span class="note">**กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร</span>
                    <div class="mb-1">ยืนยันรหัสผ่าน</div>
                    <input class="form-control mb-2" type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" pattern=".{8,}" title="กรุณากรอกรหัสผ่านให้ถูกต้อง" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        ฉันได้ยอมรับ
                        <u>
                            <a class="p-0 m-0 pb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                นโยบายความเป็นส่วนตัว
                            </a>
                        </u>
                    </label>
                </div>
                <button class="btn btn-primary w-100 mt-2" type="submit" name="reg-btn">สมัครสมาชิก</button>
            </form>
            <hr class="mx-5 mb-0">
            <div class="center">มีบัญชีอยู่แล้ว?<button href="#" onclick="showsignIn()" class="btn btn-link">เข้าสู่ระบบ</button> </div>
        </div>
    </div>
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">นโยบายความเป็นส่วนตัวสำหรับลูกค้า</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>เว็บแอปพลิเคชัน ระบบเช่าจองแผงค้าในตลาด ให้ความสำคัญกับการคุ้มครองข้อมูลส่วนบุคคลของคุณ โดยนโยบายความเป็นส่วนตัวฉบับนี้ได้อธิบายแนวปฏิบัติเกี่ยวกับการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคล รวมถึงสิทธิต่าง ๆ ของเจ้าของข้อมูลส่วนบุคคล ตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล</p>

                <h2>การเก็บรวบรวมข้อมูลส่วนบุคคล</h2>
                <p>
                    เราจะเก็บรวบรวมข้อมูลส่วนบุคคลที่ได้รับโดยตรงจากคุณผ่านช่องทาง ดังต่อไปนี้
                </p>
                <ul>
                    <li>การสมัครสมาชิก</li>
                    <li>โทรศัพท์</li>
                    <li>อีเมล</li>
                </ul>
                <p></p>

                <h2>ประเภทข้อมูลส่วนบุคคลที่เก็บรวบรวม</h2>
                <p><b>ข้อมูลส่วนบุคคล</b> เช่น ชื่อ นามสกุล อายุ วันเดือนปีเกิด สัญชาติ เลขประจำตัวประชาชน หนังสือเดินทาง เป็นต้น</p>
                <p><b>ข้อมูลการติดต่อ</b> เช่น ที่อยู่ หมายเลขโทรศัพท์ อีเมล เป็นต้น</p>
                <p><b>ข้อมูลบัญชี</b> เช่น บัญชีผู้ใช้งาน ประวัติการใช้งาน เป็นต้น</p>
                <p><b>หลักฐานแสดงตัวตน</b> เช่น สำเนาบัตรประจำตัวประชาชน สำเนาหนังสือเดินทาง เป็นต้น</p>
                <p><b>ข้อมูลการทำธุรกรรมและการเงิน</b> เช่น ประวัติการสั่งซื้อ รายละเอียดบัตรเครดิต บัญชีธนาคาร เป็นต้น</p>
                <p><b>ข้อมูลทางเทคนิค</b> เช่น IP address, Cookie ID, ประวัติการใช้งานเว็บไซต์ (Activity Log) เป็นต้น</p>
                <p><b>ข้อมูลอื่น ๆ</b> เช่น รูปภาพ ภาพเคลื่อนไหว และข้อมูลอื่นใดที่ถือว่าเป็นข้อมูลส่วนบุคคลตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล</p>

                <h2>ผู้เยาว์</h2>
                <p>หากคุณมีอายุต่ำกว่า 20 ปีหรือมีข้อจำกัดความสามารถตามกฎหมาย เราอาจเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เราอาจจำเป็นต้องให้พ่อแม่หรือผู้ปกครองของคุณให้ความยินยอมหรือที่กฎหมายอนุญาตให้ทำได้ หากเราทราบว่ามีการเก็บรวบรวมข้อมูลส่วนบุคคลจากผู้เยาว์โดยไม่ได้รับความยินยอมจากพ่อแม่หรือผู้ปกครอง เราจะดำเนินการลบข้อมูลนั้นออกจากเซิร์ฟเวอร์ของเรา</p>

                <h2>วิธีการเก็บรักษาข้อมูลส่วนบุคคล</h2>
                <p>เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณในรูปแบบเอกสารและรูปแบบอิเล็กทรอนิกส์</p>
                <p>เราเก็บรักษาข้อมูลส่วนบุคคลของคุณ ดังต่อไปนี้</p>
                <ul>
                    <li>ผู้ให้บริการเซิร์ฟเวอร์ในประเทศไทย</li>
                    <li>ผู้ให้บริการเซิร์ฟเวอร์ในต่างประเทศ</li>
                </ul>

                <h2>การประมวลผลข้อมูลส่วนบุคคล</h2>
                <p>เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณเพื่อวัตถุประสงค์ดังต่อไปนี้</p>
                <ul>
                    <li>เพื่อสร้างและจัดการบัญชีผู้ใช้งาน</li>
                    <li>เพื่อจัดส่งสินค้าหรือบริการ</li>
                    <li>เพื่อปรับปรุงสินค้า บริการ หรือประสบการณ์การใช้งาน</li>
                    <li>เพื่อการบริหารจัดการภายในบริษัท</li>
                    <li>เพื่อการตลาดและการส่งเสริมการขาย</li>
                    <li>เพื่อการบริการหลังการขาย</li>
                    <li>เพื่อรวบรวมข้อเสนอแนะ</li>
                    <li>เพื่อชำระค่าสินค้าหรือบริการ</li>
                    <li>เพื่อปฏิบัติตามข้อตกลงและเงื่อนไข (Terms and Conditions)</li>
                    <li>เพื่อปฏิบัติตามกฎหมายและกฎระเบียบของหน่วยงานราชการ</li>
                </ul>

                <h2>การเปิดเผยข้อมูลส่วนบุคคล</h2>
                <p>เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณให้แก่ผู้อื่นภายใต้ความยินยอมของคุณหรือที่กฎหมายอนุญาตให้เปิดเผยได้ ดังต่อไปนี้</p>

                <p><b>การบริหารจัดการภายในองค์กร</b></p>
                <p>เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณภายในบริษัทเท่าที่จำเป็นเพื่อปรับปรุงและพัฒนาสินค้าหรือบริการของเรา เราอาจรวบรวมข้อมูลภายในสำหรับสินค้าหรือบริการต่าง ๆ ภายใต้นโยบายนี้เพื่อประโยชน์ของคุณและผู้อื่นมากขึ้น</p>

                <p><b>ผู้ให้บริการ</b></p>
                <p>เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณบางอย่างให้กับผู้ให้บริการของเราเท่าที่จำเป็นเพื่อดำเนินงานในด้านต่าง ๆ เช่น การชำระเงิน การตลาด การพัฒนาสินค้าหรือบริการ เป็นต้น ทั้งนี้ ผู้ให้บริการมีนโยบายความเป็นส่วนตัวของตนเอง</p>

                <p><b>การโอนข้อมูลส่วนบุคคลไปต่างประเทศ</b></p>
                <p>เราอาจเปิดเผยหรือโอนข้อมูลส่วนบุคคลของคุณไปยังบุคคล องค์กร หรือเซิร์ฟเวอร์ (Server) ที่ตั้งอยู่ในต่างประเทศ โดยเราจะดำเนินการตามมาตรการต่าง ๆ เพื่อให้มั่นใจว่าการโอนข้อมูลส่วนบุคคลของคุณไปยังประเทศปลายทางนั้นมีมาตรฐานการคุ้มครองข้อมูลส่วนบุคคลอย่างเพียงพอ หรือกรณีอื่น ๆ ตามที่กฎหมายกำหนด</p>

                <h2>ระยะเวลาจัดเก็บข้อมูลส่วนบุคคล</h2>
                <p>เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณไว้ตามระยะเวลาที่จำเป็นในระหว่างที่คุณเป็นลูกค้าหรือมีความสัมพันธ์อยู่กับเราหรือตลอดระยะเวลาที่จำเป็นเพื่อให้บรรลุวัตถุประสงค์ที่เกี่ยวข้องกับนโยบายฉบับนี้ ซึ่งอาจจำเป็นต้องเก็บรักษาไว้ต่อไปภายหลังจากนั้น หากมีกฎหมายกำหนดไว้ เราจะลบ ทำลาย หรือทำให้เป็นข้อมูลที่ไม่สามารถระบุตัวตนของคุณได้ เมื่อหมดความจำเป็นหรือสิ้นสุดระยะเวลาดังกล่าว</p>

                <h2>สิทธิของเจ้าของข้อมูลส่วนบุคคล</h2>
                <p>ภายใต้กฎหมายคุ้มครองข้อมูลส่วนบุคคล คุณมีสิทธิในการดำเนินการดังต่อไปนี้</p>

                <p><b>สิทธิขอถอนความยินยอม (right to withdraw consent)</b> หากคุณได้ให้ความยินยอม เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ ไม่ว่าจะเป็นความยินยอมที่คุณให้ไว้ก่อนวันที่กฎหมายคุ้มครองข้อมูลส่วนบุคคลใช้บังคับหรือหลังจากนั้น คุณมีสิทธิที่จะถอนความยินยอมเมื่อใดก็ได้ตลอดเวลา</p>

                <p><b>สิทธิขอเข้าถึงข้อมูล (right to access)</b> คุณมีสิทธิขอเข้าถึงข้อมูลส่วนบุคคลของคุณที่อยู่ในความรับผิดชอบของเราและขอให้เราทำสำเนาข้อมูลดังกล่าวให้แก่คุณ รวมถึงขอให้เราเปิดเผยว่าเราได้ข้อมูลส่วนบุคคลของคุณมาได้อย่างไร</p>

                <p><b>สิทธิขอถ่ายโอนข้อมูล (right to data portability)</b> คุณมีสิทธิขอรับข้อมูลส่วนบุคคลของคุณในกรณีที่เราได้จัดทำข้อมูลส่วนบุคคลนั้นอยู่ในรูปแบบให้สามารถอ่านหรือใช้งานได้ด้วยเครื่องมือหรืออุปกรณ์ที่ทำงานได้โดยอัตโนมัติและสามารถใช้หรือเปิดเผยข้อมูลส่วนบุคคลได้ด้วยวิธีการอัตโนมัติ รวมทั้งมีสิทธิขอให้เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นเมื่อสามารถทำได้ด้วยวิธีการอัตโนมัติ และมีสิทธิขอรับข้อมูลส่วนบุคคลที่เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นโดยตรง เว้นแต่ไม่สามารถดำเนินการได้เพราะเหตุทางเทคนิค</p>

                <p><b>สิทธิขอคัดค้าน (right to object)</b> คุณมีสิทธิขอคัดค้านการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณในเวลาใดก็ได้ หากการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณที่ทำขึ้นเพื่อการดำเนินงานที่จำเป็นภายใต้ประโยชน์โดยชอบด้วยกฎหมายของเราหรือของบุคคลหรือนิติบุคคลอื่น โดยไม่เกินขอบเขตที่คุณสามารถคาดหมายได้อย่างสมเหตุสมผลหรือเพื่อดำเนินการตามภารกิจเพื่อสาธารณประโยชน์</p>

                <p><b>สิทธิขอให้ลบหรือทำลายข้อมูล (right to erasure/destruction)</b> คุณมีสิทธิขอลบหรือทำลายข้อมูลส่วนบุคคลของคุณหรือทำให้ข้อมูลส่วนบุคคลเป็นข้อมูลที่ไม่สามารถระบุตัวคุณได้ หากคุณเชื่อว่าข้อมูลส่วนบุคคลของคุณถูกเก็บรวบรวม ใช้ หรือเปิดเผยโดยไม่ชอบด้วยกฎหมายที่เกี่ยวข้องหรือเห็นว่าเราหมดความจำเป็นในการเก็บรักษาไว้ตามวัตถุประสงค์ที่เกี่ยวข้องในนโยบายฉบับนี้ หรือเมื่อคุณได้ใช้สิทธิขอถอนความยินยอมหรือใช้สิทธิขอคัดค้านตามที่แจ้งไว้ข้างต้นแล้ว</p>

                <p><b>สิทธิขอให้ระงับการใช้ข้อมูล (right to restriction of processing)</b> คุณมีสิทธิขอให้ระงับการใช้ข้อมูลส่วนบุคคลชั่วคราวในกรณีที่เราอยู่ระหว่างตรวจสอบตามคำร้องขอใช้สิทธิขอแก้ไขข้อมูลส่วนบุคคลหรือขอคัดค้านของคุณหรือกรณีอื่นใดที่เราหมดความจำเป็นและต้องลบหรือทำลายข้อมูลส่วนบุคคลของคุณตามกฎหมายที่เกี่ยวข้องแต่คุณขอให้เราระงับการใช้แทน</p>

                <p><b>สิทธิขอให้แก้ไขข้อมูล (right to rectification)</b> คุณมีสิทธิขอแก้ไขข้อมูลส่วนบุคคลของคุณให้ถูกต้อง เป็นปัจจุบัน สมบูรณ์ และไม่ก่อให้เกิดความเข้าใจผิด</p>

                <p><b>สิทธิร้องเรียน (right to lodge a complaint)</b> คุณมีสิทธิร้องเรียนต่อผู้มีอำนาจตามกฎหมายที่เกี่ยวข้อง หากคุณเชื่อว่าการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เป็นการกระทำในลักษณะที่ฝ่าฝืนหรือไม่ปฏิบัติตามกฎหมายที่เกี่ยวข้อง</p>


                <p>คุณสามารถใช้สิทธิของคุณในฐานะเจ้าของข้อมูลส่วนบุคคลข้างต้นได้ โดยติดต่อมาที่เจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคลของเราตามรายละเอียดท้ายนโยบายนี้ เราจะแจ้งผลการดำเนินการภายในระยะเวลา 30 วัน นับแต่วันที่เราได้รับคำขอใช้สิทธิจากคุณ ตามแบบฟอร์มหรือวิธีการที่เรากำหนด ทั้งนี้ หากเราปฏิเสธคำขอเราจะแจ้งเหตุผลของการปฏิเสธให้คุณทราบผ่านช่องทางต่าง ๆ เช่น ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น</p>


                <h2>การโฆษณาและการตลาด</h2>

                <p>เราอาจส่งข้อมูลหรือจดหมายข่าวไปยังอีเมลของคุณ โดยมีวัตถุประสงค์เพื่อเสนอสิ่งที่น่าสนกับคุณ หากคุณไม่ต้องการรับการติดต่อสื่อสารจากเราผ่านทางอีเมลอีกต่อไป คุณสามารถกด "ยกเลิกการติดต่อ" ในลิงก์อีเมลหรือติดต่อมายังอีเมลของเราได้</p>

                <h2>เทคโนโลยีติดตามตัวบุคคล (Cookies)</h2>
                <p>เพื่อเพิ่มประสบการณ์การใช้งานของคุณให้สมบูรณ์และมีประสิทธิภาพมากขึ้น เราใช้คุกกี้ (Cookies)หรือเทคโนโลยีที่คล้ายคลึงกัน เพื่อพัฒนาการเข้าถึงสินค้าหรือบริการ โฆษณาที่เหมาะสม และติดตามการใช้งานของคุณ เราใช้คุกกี้เพื่อระบุและติดตามผู้ใช้งานเว็บไซต์และการเข้าถึงเว็บไซต์ของเรา หากคุณไม่ต้องการให้มีคุกกี้ไว้ในคอมพิวเตอร์ของคุณ คุณสามารถตั้งค่าบราวเซอร์เพื่อปฏิเสธคุกกี้ก่อนที่จะใช้เว็บไซต์ของเราได้</p>

                <h2>การรักษาความมั่งคงปลอดภัยของข้อมูลส่วนบุคคล</h2>
                <p>เราจะรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคลของคุณไว้ตามหลักการ การรักษาความลับ (confidentiality) ความถูกต้องครบถ้วน (integrity) และสภาพพร้อมใช้งาน (availability) ทั้งนี้ เพื่อป้องกันการสูญหาย เข้าถึง ใช้ เปลี่ยนแปลง แก้ไข หรือเปิดเผย นอกจากนี้เราจะจัดให้มีมาตรการรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคล ซึ่งครอบคลุมถึงมาตรการป้องกันด้านการบริหารจัดการ (administrative safeguard) มาตรการป้องกันด้านเทคนิค (technical safeguard) และมาตรการป้องกันทางกายภาพ (physical safeguard) ในเรื่องการเข้าถึงหรือควบคุมการใช้งานข้อมูลส่วนบุคคล (access control)</p>

                <h2>การแจ้งเหตุละเมิดข้อมูลส่วนบุคคล</h2>
                <p>ในกรณีที่มีเหตุละเมิดข้อมูลส่วนบุคคลของคุณเกิดขึ้น เราจะแจ้งให้สำนักงานคณะกรรมการคุ้มครองข้อมูลส่วนบุคคลทราบโดยไม่ชักช้าภายใน 72 ชั่วโมง นับแต่ทราบเหตุเท่าที่สามารถกระทำได้ ในกรณีที่การละเมิดมีความเสี่ยงสูงที่จะมีผลกระทบต่อสิทธิและเสรีภาพของคุณ เราจะแจ้งการละเมิดให้คุณทราบพร้อมกับแนวทางการเยียวยาโดยไม่ชักช้าผ่านช่องทางต่าง ๆ เช่น เว็บไซต์ ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น</p>

                <h2>การแก้ไขเปลี่ยนแปลงนโยบายความเป็นส่วนตัว</h2>
                <p>เราอาจแก้ไขเปลี่ยนแปลงนโยบายนี้เป็นครั้งคราว โดยคุณสามารถทราบข้อกำหนดและเงื่อนไขนโยบายที่มีการแก้ไขเปลี่ยนแปลงนี้ได้ผ่านทางเว็บไซต์ของเรา</p>
                <p>นโยบายนี้แก้ไขล่าสุดและมีผลใช้บังคับตั้งแต่วันที่ 01 กุมภาพันธ์ 2566</p>

                <h2>นโยบายความเป็นส่วนตัวของเว็บไซต์อื่น</h2>
                <p>นโยบายความเป็นส่วนตัวฉบับนี้ใช้สำหรับการเสนอสินค้า บริการ และการใช้งานบนเว็บไซต์สำหรับลูกค้าของเราเท่านั้น หากคุณเข้าชมเว็บไซต์อื่นแม้จะผ่านช่องทางเว็บไซต์ของเรา การคุ้มครองข้อมูลส่วนบุคคลต่าง ๆ จะเป็นไปตามนโยบายความเป็นส่วนตัวของเว็บไซต์นั้น ซึ่งเราไม่มีส่วนเกี่ยวข้องด้วย</p>

            </div>
        </div>
    </div>
</div>

<script src="backend/script.js" type="text/javascript"></script>

<script>
    // no spaces
    $(function() {
        $(":input").on({
            keydown: function(e) {
                if (e.which === 32 && e.target.selectionStart === 0) {
                    return false;
                }
            }
        });
    })

    // tel input mask
    $(":input").inputmask();
    $("#tel").inputmask({
        "mask": "9999999999"
    });

    // sendEmail
    function sendEmail() {
        var email = $("#email");
        if (isNotEmpty(email)) {
            $.ajax({
                url: 'sendEmail.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    email: email.val()
                },
                success: function(response) {
                    $('#resetpsw')[0].reset();
                    $('.msg').text("Message send successfully");
                }
            });
        }
    }



    function isNotEmpty(caller) {
        if (caller.val() == "") {
            caller.css('border', '1px solid red');
            return false;
        } else caller.css('border', '');
        return true;
    }



    $(document).ready(function() {
        $("#resetpsw").on('submit', function(c) {
            c.preventDefault();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirmpassword = $("#confirmpassword").val();
            $.ajax({
                type: "POST",
                url: "reset-password.php",
                data: {
                    email: email,
                    password: password,
                    confirmpassword: confirmpassword
                },
                success: function(date) {
                    $(".form-message").css("display", "block");
                    $(".form-message").html(date);
                }

            });

        });



    });
</script>



</html>