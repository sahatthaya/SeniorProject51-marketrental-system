<?php
require "../backend/manage-complain.php";
?>

<div id="bannerdataModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form method="POST" enctype="multipart/form-data" class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">การตอบกลับการร้องเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bannerdetail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="save-data" name="submit">ส่ง</button>
                </div>
            </div>
        </form>
    </div>
</div>