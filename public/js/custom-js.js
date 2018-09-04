var customjs = {
    assignVehicle: {
        originalHtml: jQuery("#asignar_position").html(),
        init: function() {
            if($(".edit-asignar").length == 0)
                return;
            customjs.assignVehicle.setPositions();
            jQuery("#asignar_vehicle").change(function() {
                customjs.assignVehicle.initializePositions();
                customjs.assignVehicle.setPositions();
            });
        },
        setPositions: function() {
            var valueOption = jQuery("#asignar_vehicle").val();
            var positions = jQuery("option[value=" + valueOption + "]").attr("positions");
            positions = JSON.parse(positions);
            console.log(positions);
            jQuery("#asignar_position option").each(function(elem) {
                var optionText = $(this).html();
                if($.inArray(optionText, positions) != -1){
                    $(this).remove();
                }
            });
        },
        initializePositions: function() {
            jQuery("#asignar_position").html(customjs.assignVehicle.originalHtml);
        }
    },
    createEditVehicle: {
        init: function() {
            if($(".edit-vehiculo").length == 0)
                return;
            // jQuery("#vehiculo_employees").find("option")
            // jQuery("#vehiculo_employees").select2();
        }
    },
    addTireDepth: {
        init: function() {
            if($(".edit-agregarprofundidad, .edit-agregarprofundidad2").length == 0)
                return;
            $(".edit-depth-row").click(function() {
                $(this).closest("tr").find("td span").hide("fast");
                $(this).closest("tr").find("td div.form-group").show();
            });
        }
    },
    editNeumatic: {
        init: function() {
            if(jQuery(".edit-neumatico").length == 0)
                return;
            var tipo = jQuery("#neumatico_type").val();
            if(tipo != "Renovado") {
                jQuery("#neumatico_renovatedNumber").parent().hide();
            }
            jQuery("#neumatico_type").change(function() {
                var tipo = jQuery("#neumatico_type").val();
                if(tipo != "Renovado") {
                    jQuery("#neumatico_renovatedNumber").parent().hide();
                } else {
                    jQuery("#neumatico_renovatedNumber").parent().show();
                }

            });
        }
    }
};
jQuery(document).ready(function() {
    customjs.createEditVehicle.init();
    customjs.addTireDepth.init();
    customjs.editNeumatic.init();
    customjs.assignVehicle.init();

    jQuery(".app-select2").select2();

    // jQuery(".custom-date input").datepicker({
    //     language: 'es',
    //     format: 'mm/dd/yyyy'
    // });

    jQuery(".custom-datetime input").datetimepicker({
        locale: 'ru',
        sideBySide: true,
        format: 'DD/MM/YYYY H:mm',
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
        // minDate: 'now'
    });

    jQuery(".vehicle-select2").select2();
    jQuery("body").on("change", ".vehicle-select2", function() {
        let employeeId = $(this).closest("tr").attr("data-id");
        let vehicleId = $(this).val();
        let vehicleSelect = $(this).closest("tr").find(".vehicle-select select");
        let text = vehicleSelect.find("option[value=" + vehicleId + "]").html();
        let _this = this;
        $.post("/admin/custom/employee-update-vehicle", { employeeId: employeeId, vehicleId: vehicleId }, function(data) {
            $(_this).closest("tr").find(".vehicle-select").hide();
            $(_this).closest("tr").find(".vehicle-name").html(text).show();
        });
    });


    jQuery("body").on("click", ".action-employeeAsignVehicle", function() {
        $(this).closest("tr").find(".vehicle-select").show();
        $(this).closest("tr").find(".vehicle-name").hide();
    });

});
