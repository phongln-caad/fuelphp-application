/**
 * Created by dt0343 on 3/13/17.
 */
$(document).ready(function() {
    if($("#form_default_parent_id").is(":checked")) {
        $("#form_parent_id").hide();
    } else {
        $("#form_parent_id").show();
    }

    $("#form_default_parent_id").change(function () {
        if($(this).is(":checked")) {
            $("#form_parent_id").hide();
        } else {
            $("#form_parent_id").show();
        }
    });
});
