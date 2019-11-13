//I'm not sure if we would do the serverside calls here or in a php file. 
window.addEventListener("DOMContentLoaded", domLoaded);

let currentStatus = {
    "rows": 100,
    "columns": 100,
    
}

let choice = "white";

//Event handler for when the table is clicked
function tableClicked(e) {
    //If is a colorable pixel
    if () {
        const pixel = e.target;

        const row = pixel.rowIndex;
        const column = pixel.columnIndex;

        clickPixel(row, column);
    }
}

//Called by tableClicked when a pixel is clicked and after it finds the indices
function clickPixel(row, column) {
    //Change the pixels color and send data to server
}

//Called when DOM is loaded, adds click event listeners to grid and loads the colors from database(?)
function domLoaded() {
    const choiceClicked = document.getElementById("colorChoice");
    choiceClicked.addEventListener("input", updateColor);
    choiceClicked.addEventListener("change", updateColor);
}

function updateColor(event) {
    document.querySelectorAll("p").forEach(function (p) {
        p.style.color = event.target.value;
    })
}