jQuery(document).ready(function() {
    customws.init();
});
var customws = {
    init: function() {
        console.log("en init del customws");
        // web sockets code
        var options = {
            secure: false,
            hostname: '187.162.125.161',
            //hostname: 'localhost',
            port: 3007
        };
        var socket = socketCluster.connect(options);
        var apiChannel = socket.subscribe("bridgeSocket");
        apiChannel.watch(function(data) {
//console.log(data);
            data.rfids = eval(data.rfids);
            localVehicleCheckId = $('#vehicleCheckId').val();
            socketVehicleCheckId = data.vehicleCheckId;
          //  console.log(localVehicleCheckId + ", " + socketVehicleCheckId);
            if(localVehicleCheckId == undefined || localVehicleCheckId != socketVehicleCheckId) {
                var href = $('#antena-modal-revisar-button').attr('href');
                var n = href.lastIndexOf('/');
                s = href.substring(0, n != -1 ? n : s.length);

                $('#antena-modal-revisar-button').attr('href',s + "/" + socketVehicleCheckId);
                $('#antena-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
            else {//cambiar colores de los neumaticos ke llegan nuevos tambien cambiar campo resultado
                //cambiar campo resultado
                if($('.ti-tagNoExist').length > 0 && $('.ti-setVisible').length > 0)
                    $('#ti-resultado-revision').text('Faltan Tags');
                else ($('#ti-resultado-revision').text('OK'));
                //console.log(data)
                customws.setNewTiresTags(data.rfids);
                $("vehicleCheckId").val(data.vehicleCheckId);
            }
        });
        socket.on('connect', function () {
            console.log("conectado al socket");
        });
    }
    ,
    setNewTiresTags: function(rfidArray){
        if(rfidArray == undefined) return;
        for (i = 0 ; i < rfidArray.length ; i++)
        {
            visualTire = $('.'+rfidArray[i].replace(/\s+/g, ''));
            console.log(visualTire);
            //if(visualTire.length > 0){
                visualTire.removeClass('ti-tagNoExist');
                visualTire.addClass('ti-tagExist ti-setVisible');
            //}
        }
    }
}