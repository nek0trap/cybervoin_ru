const chessDict = {
    rook: '&#9814;',
    bishop: '&#9815;',
    pawn: '&#9817;'
}
//TODO Передавать массив в PHP после moveFigure
//
// Я делаю это по средсвтом POST запроса. К примеру у меня есть контролер и в
// котором описано общая логика и формирования предстовление. На стороне представления
// есть некий код JS который по итогу должен передать мне данные для записи их в БД.
// Когда JS готов передать данные он отправляет их формате JSON через POST запрос на обрабочик (выделенный метод в классе.)
//
// Ну а дальше все как обычно анализируем $request и записываем данные в БД.

const characters = [['22', chessDict['pawn']], ['33', chessDict['rook']]];
var charactersArray = new Array(10000).fill(0);

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
    console.log(charactersArray.slice(0,50));
}

function showFigureAt(coord, myFigure) {
    charactersArray[coord] = myFigure;
    let cell = $(`#c${coord}`);
    cell.append(`<div id='f${coord}' class='figure'>${myFigure}</div>`);
    setDraggable();
}

function saveState() {
    // $.post('http://localhost:8000/game/board/1', charactersArray);

    $.ajax({
        url: 'index.php',
        type: 'POST',
        dataType: 'json',
        data: {
            charArray: charactersArray,
        }
    }, {})
    console.log('post send', charactersArray);
}