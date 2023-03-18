<form id="applyform" method="post" enctype="multipart/form-data" class="was-validated">

    <div class="form-outer form-group " style="overflow: visible;">

        <!-- form--1 -->

        <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

            <h4 class="p-0"><span class="text-secondary">ขั้นที่ 1</span> กรอกข้อมูลส่วนตัว</h4>

            <div class="progress p-0 my-2">

                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">1/2 </div>

            </div>

            <div class="des_input">ชื่อ</div>

            <input class="form-control col-6" type="text" placeholder="ชื่อ" name="firstName" id="fname" onchange="checkapp()" pattern="[^0-9]+" value="<?php echo $row['firstName']; ?>" required autofocus>

            <div class="des_input">นามสกุล</div>

            <input class="form-control col-6" type="text" placeholder="นามสกุล" name="lastName" id="lname" onchange="checkapp()" pattern="[^0-9]+" value="<?php echo $row['lastName']; ?>" required>

            <div class="des_input">อีเมล</div>

            <input class="sqr-input col-12 form-control " type="email" placeholder="อีเมล" name="email" id="email" onchange="checkapp()" value="<?php echo $row['email']; ?>" required>

            <div class="des_input">เบอร์โทรศัพท์</div>

            <input name="tel" id="tel" class="sqr-input col-12 form-control" type="text" placeholder="เบอร์โทรศัพท์" name="name" pattern="[0-9]{10}" value="<?php echo $row['tel']; ?>" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" required>

            <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>

            <input class="sqr-input col-12 form-control" type="file" aria-label="อัปโหลดเอกสาร" name="cardIDcpy" id="doc" onchange="checkapp()" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" required>

            <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="nextbtn()" id="next" disabled>

        </div>

        <!-- form--2 -->

        <div id="stepTwo" class="row border shadow-sm p-5 mt-3 mb-3 rounded">



            <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 2</span> กรอกข้อมูลตลาด</h4>

            <div class="progress p-0 my-2">

                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">2/2 </div>

            </div>

            <div class="des_input">ชื่อตลาด</div>

            <input class=" col-12 form-control" type="text" placeholder="ชื่อตลาด" name="mkrName" id="mkname" onchange="checkapp2()" required>

            <div id="mkrtype" class="mb-3">

                <div class="des_input">ประเภทตลาด</div>

                <div class="search_select_box">

                    <select class="selectpicker " title="เลือกประเภท" name="mkrtype" id="mktype" onchange="checkapp2()" data-width="100%" data-size="5" required>

                        <?php while ($row1 = mysqli_fetch_array($result_mkrType)) :; ?>

                            <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>

                        <?php endwhile; ?>

                    </select>

                </div>

            </div>

            <div class="des_input mt-3">สถานที่ตั้ง</div>

            <div class="row p-0 m-0 mt-2">

                <div class="col-md-2 pt-2">บ้านเลขที่ :</div>

                <div class="col-md-4 p-0">

                    <input class="form-control" type="text" placeholder="บ้านเลขที่" name="HouseNo" id="houseno" onchange="checkapp2()" required>

                </div>

                <div class="col-md-2 pt-2">ซอย :</div>

                <div class="col-md-4 p-0">

                    <input class="form-control" type="text" placeholder="ซอย" name="Soi" id="soi" onchange="checkapp2()" required>

                </div>

            </div>

            <div class="row p-0 m-0">

                <div class="col-md-2 pt-2">หมู่ :</div>

                <div class="col-md-4 p-0">

                    <input class="form-control" type="text" placeholder="หมู่" name="Moo" id="moo" onchange="checkapp2()" required>

                </div>

                <div class="col-md-2 pt-2">ถนน :</div>

                <div class="col-md-4 p-0">

                    <input class="form-control" type="text" placeholder="ถนน" name="Road" id="road" onchange="checkapp2()" required>

                </div>

            </div>

            <div class="row p-0 m-0 mt-2">

                <div class="col-md-2 pt-2">จังหวัด :</div>

                <div class="col-md-4 p-0">

                    <select name="province_id" id="province" onchange="checkapp2()" class="form-control selectpicker" data-live-search="true" data-width="100%" data-size="5" title="เลือกจังหวัด" required>

                        <?php while ($result = mysqli_fetch_assoc($result_province)) : ?>

                            <option value="<?php echo $result['id'] ?>"><?php echo $result['province_name'] ?></option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="col-md-2 pt-2">อำเภอ/เขต :</div>

                <div class="col-md-4 p-0">

                    <select name="amphure_id" id="amphure" onchange="checkapp2()" class="form-control selectpicker" data-live-search="true" data-width="100%" data-size="5" title="เลือกอำเภอ/เขต" required>

                    </select>

                </div>

            </div>

            <div class="row p-0 m-0 mt-2">

                <div class="col-md-2 pt-2">ตำบล/แขวง :</div>

                <div class="col-md-4 p-0 mt-1 ">

                    <select name="district_id" id="district" onchange="checkapp2()" class="form-control selectpicker" data-live-search="true" data-width="100%" data-size="5" title="เลือกตำบล/แขวง" required>

                    </select>

                </div>

                <div class="col-md-2 pt-2">รหัสไปรษณีย์ :</div>

                <div class="col-md-4 p-0">

                    <input name="PostalCode" id="zipcode" onchange="checkapp2()" class="form-control" placeholder="รหัสไปรษณีย์" required>

                </div>

            </div>



            <div class="des_input hstack gap-2">วันที่เปิดทำการ</div>

            <select class="form-select" id="open" name="opening" aria-label="Default select example">
                <option value="เปิดทำการเป็นรอบ">เปิดทำการเป็นรอบ</option>
                <option value="เปิดทำการทุกวัน">เปิดทำการทุกวัน</option>
            </select>

            <div class="des_input hstack gap-2">รายละเอียดตลาดโดยสังเขป

                <div data-toggle="tooltip" title="เช่น ตลาดค้าส่ง ทำเลดี ติดถนนใหญ่ใกล้สี่แยกไฟแดง" class="mt-1">

                    <i class='bx bx-info-circle'></i>

                </div>

            </div>

            <input class="form-control col-12" type="text" placeholder="กรอกข้อมูลตลาดโดยสังเขป" name="mkrDes" id="des" onchange="checkapp2()" required>

            <div class="des_input hstack gap-2">อัปโหลดรูปภาพตลาด

            </div>

            <input class="sqr-input col-12 form-control" type="file" id="file" onchange="checkapp2()" placeholder="เช่น ตลาดขายปลีก ใจกลางเมือง ทำเลดี ติดถนนใหญ่" name="mkrFile" accept="image/jpeg,image/gif,image/png" required>

            <input type="button" name="previous" class="btn btn-primary action-button" value="ย้อนกลับ" onclick="previousbtn()" id="back">

            <input type="submit" name="submit-apply" class="btn btn-success submitBtn" id="submit" value="ยืนยันการส่งคำร้อง">

        </div>

    </div>

</form>