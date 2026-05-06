function enviarPedido() {
    document.getElementById("enviar-pedido").style.display = "block";
    document.getElementById("opacity-background").classList.add('opacity-25');
}

function pedidoEnviado() {
    document.getElementById("enviar-pedido").style.display = "none";
    document.getElementById("opacity-background").classList.remove('opacity-25');
}

function pedidoNaoEnviado() {
    document.getElementById("enviar-pedido").style.display = "none";
    document.getElementById("opacity-background").classList.remove('opacity-25');
}

function makeCode() {
  var input = document.getElementById("input");
  qrcode.makeCode(input.value);
}

var qrcode = new QRCode(document.getElementById("qrcode"), {
  text: "makeCode()",
  width: 300,
  height: 300,
  colorDark: "#000000",
  colorLight: "#ffffff",
  correctLevel: QRCode.CorrectLevel.H
});