$(document).ready(function () {
    var x = 4;
    var y = 4;

    var cnt = 0;
    var chessBoard = document.getElementById("chessBoard");
    values = '1111111111100000000110000000011011000001100000000110000000011000002201100000220110000000011111111111';

    for (var i = 0; i < y; i++) {
        var row = chessBoard.appendChild(document.createElement("div"));
        for (var j = 0; j < x; j++) {
            var sp = row.appendChild(document.createElement("span"));
            if (values[cnt] == '1') {
                sp.classList.add('red');
            } else {
                sp.classList.add('black');
            }
            cnt = cnt + 1;
        }
    }
});