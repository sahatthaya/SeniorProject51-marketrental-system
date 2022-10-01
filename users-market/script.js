$('.selectpicker').selectpicker({
    noneResultsText: 'ไม่พบข้อมูล'
});

$(function () {
    // element selector
    var provinceObject = $('#province');
    var amphureObject = $('#amphure');
    var districtObject = $('#district');
    var zipObject = $('#zipcode');


    // on change province
    provinceObject.on('change', function () {
        var provinceId = $(this).val();

        amphureObject.empty();
        districtObject.empty();
        zipObject.val('');


        $.get('get_amphure.php?province_id=' + provinceId, function (data) {
            var result = JSON.parse(data);
            $.each(result, function (index, item) {
                amphureObject.append(
                    $('<option></option>').val(item.id).html(item.amphure_name)
                );
            });
            $('.selectpicker').selectpicker('refresh');
        });
    });

    // on change amphure
    amphureObject.on('change', function () {
        var amphureId = $(this).val();

        districtObject.empty();
        zipObject.val('');



        $.get('get_district.php?amphure_id=' + amphureId, function (data) {
            var result = JSON.parse(data);
            $.each(result, function (index, item) {
                districtObject.append(
                    $('<option></option>').val(item.id).html(item.district_name)
                );
            });
            $('.selectpicker').selectpicker('refresh');
        });
    });

    // on change district

    districtObject.on('change', function () {
        var districtId = $(this).val();

        zipObject.val('');

        $.get('get_zip.php?district_id=' + districtId, function (data) {
            var result = JSON.parse(data);
            $.each(result, function (index, item) {
                zipObject.val(item.zip_code).html(item.zip_code)
            });
        });
    });
});