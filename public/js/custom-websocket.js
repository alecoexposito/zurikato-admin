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
            port: 3007
        };
        var socket = socketCluster.connect(options);
        // $localStorage.socket = socket;
        var apiChannel = socket.subscribe("bridgeSocket");
        apiChannel.watch(function(data) {
            console.log("recibido del websocket", data);
        });
        socket.on('connect', function () {
            console.log("conectado al socket");
        });
    }
}