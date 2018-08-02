jQuery(document).ready(function() {
    jQuery(".custom-date input").datepicker({
        language: 'es',
        format: 'mm/dd/yyyy'
    });

    jQuery(".vehicle-select2").select2();
    jQuery("body").on("change", ".vehicle-select2", function() {
        let employeeId = $(this).closest("tr").attr("data-id");
        let vehicleId = $(this).val();
        $.post("/admin/custom/employee-update-vehicle", { employeeId: employeeId, vehicleId: vehicleId }, function(data) {
            console.log(data);
        });
    });

    jQuery(".employee-select2").select2();
});