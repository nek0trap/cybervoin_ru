const figureDict = {
    "<img src='/icons/WomanSolo.svg' alt='WomanFull'/>": "(Solo)",
    "<img src='/icons/Mechanic.svg' alt='Mechanic'/>": "(Mechanic)",
    "<img src='/icons/Netrunner.svg' alt='Netrunner'/>": "(Netrunner)",
    "<img src='/icons/Nomad.svg' alt='Nomad'/>": "(Nomad)",
}

const armorDict = {
    "<img src='/icons/WomanSolo.svg' alt='WomanFull'/>": 3,
    "<img src='/icons/Mechanic.svg' alt='Mechanic'/>": 9,
    "<img src='/icons/Netrunner.svg' alt='Netrunner'/>": 12,
    "<img src='/icons/Nomad.svg' alt='Nomad'/>": 16,
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

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min; //Максимум не включается, минимум включается
}

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
    if (frCoord !== toCoord) {
        if (charactersArray[toCoord] === 0) {
            charactersArray[frCoord] = 0;
            showFigureAt(toCoord, figure);
            saveState();
        } else {
            let shooter = charactersArray[frCoord];
            let enemy = charactersArray[toCoord];
            tryToKill(frCoord, toCoord);
            let dmgAndText = weaponSelector();
            console.log(`${figureDict[shooter]} attaced ${figureDict[enemy]} with ${dmgAndText[1]}`);
            showFigureAt(frCoord, figure);
        }
    } else {
        showFigureAt(frCoord, figure);
    }
}

function showFigureAt(coord, myFigure) {
    charactersArray[coord] = myFigure;
    let cell = $(`#c${coord}`);
    cell.append(`<div id='f${coord}' class='figure'>${myFigure}</div>`);
    setDraggable();
}

function tryToKill(frCoord, toCoord) {
    let damage = $("#weaponmaker").val();
    let randomInt = getRandomInt(1, damage);
    console.log(randomInt);
    let killContainer = $(`#c${toCoord}`);
    if (armorDict[charactersArray[toCoord]] < randomInt) {
        console.log("kill");
        charactersArray[toCoord] = 0;
        saveState();
        killContainer.empty();
    }
}

function saveState() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            'charArray': charactersArray.toString(),
        },
        success: function(data) {
        }
    });
    //console.log('post send', myUrl);
}