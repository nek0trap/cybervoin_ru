const figureDict = {
    "<i class='bi bi-person'></i>": "Rook",
    "<img src='/icons/WomanSoloFull.svg' alt='WomanFull'/>": "Woman",
}

const chessBoard = $("#chessBoard");
let values = chessBoard.data("field");
let lineLength = chessBoard.data("line");
const charactersArray = new Array(10001).fill(0);
const characters = chessBoard.data("characters").split(",");

$(document).ready(function () {
    figureSelector();
    var divSquare = '<div id = "c$coord" class = "cell cell-$color"></div>';
    var divFigure = '<div id="f$coord" class ="figure">$figure</div>';
    let cnt = 0;
    let lineWidth = values.length / lineLength;
    const ground = {
        0 :"bar-chair",
        1: "bar-wall",
        2: "window-bar",
        3: "bar-toilet",
        4: "bar-floor",
        5: 'floor-toilet',
        6: "door-toilet",
        7: "bar-door",
        8: "bar-table",
        9: "bar-divan",
        'a': "bar-stul-1",
        'b': "bar-stul-2",
        'c': "wallground",
        'd': "ground1",
        'e': "wallgraf",
        'f': "wallground2",
        'g': "wallgraf2",
        'z': 'ground2',
        'x': 'ground3',
        'v': 'ground4',
        'k': 'wallgraf3',
        'h' :'wallgraf4',
        'n' : 'trash1',
        'm':'trash2',
        'r' :'cover1',
        't' :'cover2',
        'y' :'cover3',
        'l':'city-ground',
        'p':'wallground',
        'o' :'city-wall2',
        's':'safe',
        'w' :'cityshelf1',
        'q':'cityshelf2',
        'I':'citydoor1',
        'u':'citydoor2',
        '<':'cityfloor1',
        '>':'cityfloor2',
        '@':'citytrap',
    };
    for (let i = 10; i < lineWidth + 10; i++) {
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
            let frCell = $(`#c${frCoord}`);
            if (frCell.hasClass("cell-water")) {
                console.log('obosralsya');
            }
            ui.draggable.remove();
            moveFigure(frCoord, toCoord);
        }
    });

    $('.remove-figure-box').droppable({
        drop: function (event, ui) {
            let frCoord = ui.draggable.attr('id').substring(1);
            charactersArray[frCoord] = 0;
            ui.draggable.remove();
            saveState();
        }
    })
}

function figureSelector() {
    let select = $("#figuremaker");
    let spawnbox = $(".spawn-figure-box");
    let value = select.val();
    spawnbox.html(`<div id="f10001" class ="figure">${value}</div>`);
    select.change(function () {
        let value = select.val();
        charactersArray[10001] = value;
        spawnbox.html(`<div id="f10001" class ="figure">${value}</div>`);
        setDraggable();
        console.log(value);
        console.log(figureDict[String(value)]);
    })
}

function weaponSelector() {
    let select = $("#weaponmaker");
    return [select.val(), select.find("option:selected").text()];
}

function showFigures(characters) {
    charactersArray[10001] = "&#9815";
    for (let i = 0; i < characters.length; i++) {
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
        let dmgAndText = weaponSelector();
        console.log(charactersArray[frCoord]);
        console.log(`${figureDict[charactersArray[frCoord]]}№${frCoord} attaced ${figureDict[charactersArray[toCoord]]}№${toCoord} with ${dmgAndText[1]} and deal ${dmgAndText[0]} damage`);
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