const chessDict = {
    rook: '&#9814;',
    bishop: '&#9815;',
    pawn: '&#9817;'
}

const chessBoard = $("#chessBoard");
let values = chessBoard.data("field");
let lineLength = chessBoard.data("line");
const charactersArray = new Array(10001).fill(0);
const characters = chessBoard.data("characters").split(",");
console.log(characters);

$(document).ready(function () {
    selectFigure();
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

function selectFigure() {
    let select = $("#figuremaker");
    let spawnbox = $(".spawn-figure-box");
    spawnbox.html(`<div id="f10001" class ="figure">${select.val()}</div>`);
    let ss = $("");
    select.change(function () {
        let value = select.val();
        charactersArray[10001] = value;
        spawnbox.html(`<div id="f10001" class ="figure">${value}</div>`);
        setDraggable();
        console.log(value);
    })

}

function showFigures(characters) {
    charactersArray[10001] = "&#9815";
    for (let i = 10; i < characters.length+10; i++) {
        if (characters[i] !== "0") {
            showFigureAt(i, characters[i]);
        }
    }
}

function moveFigure(frCoord, toCoord) {
    let figuremaker = $("#figuremaker");
    $(".spawn-figure-box").html(`<div id="f10001" class ="figure">${figuremaker.val()}</div>`);
    charactersArray[10001] = figuremaker.val();
    let figure = charactersArray[frCoord];
    console.log(frCoord, toCoord);
    if (charactersArray[toCoord] === 0) {
        charactersArray[frCoord] = 0;
        showFigureAt(toCoord,figure);
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