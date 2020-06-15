jQuery(document).ready(function() {
    customws.init();
});
var customws = {
    init: function() {
        console.log("en init del customws");
        // web sockets code
        var options = {
            secure: false,
            hostname: '187.217.220.34',
            // hostname: 'localhost',
            port: 3007
        };
        var socket = socketCluster.connect(options);
        // $localStorage.socket = socket;
        var apiChannel = socket.subscribe("bridgeSocket");
        apiChannel.watch(function(data) {
console.log(data);
            data.rfids = eval(data.rfids);
            localVehicleCheckId = $('#vehicleCheckId').val();
            socketVehicleCheckId = data.vehicleCheckId;
            console.log(localVehicleCheckId + ", " + socketVehicleCheckId);
            if(localVehicleCheckId != socketVehicleCheckId) {
                //abrir el modal

                $('#antena-modal-revisar-button').attr('href', $('#antena-modal-revisar-button').attr('href').replace('none',data.vehicleCheckId));
                $('#antena-modal').modal();
            }
            else {//cambiar colores de los neumaticos ke llegan nuevos
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
            // visualTire = $('.'+rfidArray[i]);
            visualTire = $("div=[rfid*='" + rfidArray[i] + "']");
            if(visualTire.length > 0){
                visualTire.removeClass('ti-tagNoExist');
                visualTire.addClass('ti-tagExist ti-setVisible');
            }
        }
    }
}