const chessDict = {
    rook: '&#9814;',
    bishop: '&#9815;',
    pawn: '&#9817;'
}

const characters = [['22', chessDict['pawn']], ['33', chessDict['rook']]];
var charactersArray = new Array(1000000);

$(document).ready(function () {
    var divSquare = '<div id = "c$coord" class = "cell cell-$color"></div>';
    var divFigure = '<div id="f$coord" class ="figure">$figure</div>';
    let cnt = 0;
    let chessBoard = $("#chessBoard");
    let values = "111111033110331100311223112231112311123111111";
    let lineLength = 5;
    for (let i = 0; i < characters.length; i++) {
        charactersArray[characters[i][0]] = characters[i][1];
    }
    let lineWidth = values.length / lineLength;
    const ground = ["dirt", "wall", "swamp","water"];
    for (let i = 0; i < lineWidth; i++) {
        chessBoard.append("<br>");
        for (let j = 0; j < lineLength; j++) {
            chessBoard.append(divSquare
                .replace('$coord', String(i) + String(j))
                .replace("$color", ground[values[cnt]]));
            cnt = cnt + 1;
        }
    }
    showFigures(characters);
    setDroppable();
});

function setDraggable() {
    $('.figure').draggable();
}

function setDroppable() {
    $('.cell').droppable({
        drop: function (event, ui) {
            let frCoord = ui.draggable.attr('id').substring(1);
            let toCoord = this.id.substring(1);
            ui.draggable.remove();
            moveFigure(frCoord, toCoord);
        }
    });
}

function showFigures(characters) {
    for (let i = 0; i < characters.length; i++) {
        showFigureAt(String(characters[i][0]), characters[i][1]);
    }
}

function moveFigure(frCoord, toCoord){
    let figure = charactersArray[frCoord];
    if (charactersArray[toCoord] === undefined) {
        console.log('move from ' + frCoord + ' to ' + toCoord);
        charactersArray[frCoord] = undefined;
        showFigureAt(toCoord,figure);
        setDraggable();
    } else {
        showFigureAt(frCoord,figure);
    }

}

function showFigureAt(coord, myFigure) {
    charactersArray[coord] = myFigure;
    let cell = $(`#c${coord}`);
    cell.append(`<div id='f${coord}' class='figure'>${myFigure}</div>`);
    setDraggable();
}