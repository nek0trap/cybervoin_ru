const chessDict = {
    rook: '&#9814;',
    bishop: '&#9815;',
    pawn: '&#9817;'
}

const chessBoard = $("#chessBoard");
let values = chessBoard.data("field");
let lineLength = chessBoard.data("line");
const charactersArray = new Array(Math.ceil(values.length / lineLength) * 10 + lineLength).fill(0);
console.log(charactersArray.length);
const characters = [['22', chessDict['pawn']], ['33', chessDict['rook']]];

$(document).ready(function () {
    var divSquare = '<div id = "c$coord" class = "cell cell-$color"></div>';
    var divFigure = '<div id="f$coord" class ="figure">$figure</div>';
    let cnt = 0;

    for (let i = 0; i < characters.length; i++) {
        charactersArray[characters[i][0]] = characters[i][1];
    }
    let lineWidth = values.length / lineLength;
    const ground = ["dirt", "wall", "swamp", "water", "white"];
    for (let i = 1; i < lineWidth + 1; i++) {
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
    console.log(frCoord, toCoord);
    if (charactersArray[toCoord] === 0) {
        charactersArray[frCoord] = 0;
        showFigureAt(toCoord,figure);
        setDraggable();
        saveState();
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

function saveState() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            'charArray': charactersArray.toString(),
        },
        success: function(data) {
            console.log(data);
        }
    });
    //console.log('post send', myUrl);
}