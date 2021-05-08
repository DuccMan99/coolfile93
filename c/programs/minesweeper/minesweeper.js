// Return the WIDTH of the MineSweeper game window to be created.
function calcWidth(maxX) {
  // icons are 16pixels wide.  20 for graphic border.
  // Extra 22 is for window border (required).
  return (maxX + 1) * 16 + 20 + 22 + 8;
}

// Return the HEIGHT of the MineSweeper game window to be created.
function calcHeight(maxY) {
  // icons are 16 high, time & bombs are 23 high, and extra 23 for borders.
  // 30 for 3 10-pixel border components.  10 for menu bar.
  // 35 is for top/bottom margin.
  statusbarExtra = 16;
  try {
    if (window.statusbar.visible) {
      statusbarExtra = 28;
    }
  } catch (e) {}
  // 12 extra because Firefox defaults to not allowing toolbar to be suppressed, and doesn't report it properly! (can't check window.toolbar).
  return (maxY + 1) * 16 + 23 + 23 + 30 + 35 + 12 + statusbarExtra;
} // }

//
// Variable and document setup stuff:
//

// Read in the board dimensions cookies
//gameFormat = getCookie("gameFormat");

function initGame(gameFormat, x, y, b) {
  // Set additional params based on cookies or size defaults.
  // Roll-your-own (custom)
  if (gameFormat == "Custom") {
    maxX = x; //parseInt(getCookie("maxX"));
    maxY = y; //parseInt(getCookie("maxY"));
    maxNumBombs = b; //parseInt(getCookie("maxNumBombs"));
  }
  // Intermediate
  else {
    if (gameFormat == "Intermediate") {
      maxX = 15;
      maxY = 15;
      maxNumBombs = 40;
    }
    // Expert
    else {
      if (gameFormat == "Expert") {
        maxX = 30;
        maxY = 15;
        maxNumBombs = 99;
      }
      // Beginner (also the default)
      else {
        maxX = 7;
        maxY = 7;
        maxNumBombs = 10;
        gameFormat = "Beginner";
      }
    }
  }

  // This pre-calc just makes the next "if" easier to handle.
  maxLegalBombs = Math.round((maxX + 1) * (maxY + 1) / 3) // Max 1/3 of all cells

  // Make sure all values are numbers and are within range
  if ((isNaN(maxX)) || (maxX < 7) || (maxX > 31) || (isNaN(maxY)) || (maxY < 7) || (maxY > 24) || (isNaN(maxNumBombs)) || (maxNumBombs < 1) || (maxNumBombs > maxLegalBombs)) {
    //Not in range: Fancy alert screen
    parent.$alert("Minesweeper dimensions invalid:\n\tWidth: From 8 to 32\n\tHeight: from 8 to 24\n\tBoms: 1 to 1/3 of squares");
    maxX = 7;
    maxY = 7;
    maxNumBombs = 10;
    gameFormat = "Beginner";
  }

  //setCookie("gameFormat", gameFormat);
  //window.resizeTo(calcWidth(maxX), calcHeight(maxY));

  // Read the other param vars set by the intro page
  // Note how the double negative will force missing to default to true
  useQuestionMarks = !true; //!(getCookie("useQuestionMarks") == 'false');
  useMacroOpen = true; //!(getCookie("useMacroOpen") == 'false');
  useFirstClickUseful = true; //!(getCookie("useFirstClickUseful") == 'false');
  openRemaining = true; //(getCookie("openRemaining") == 'true');

  // Set global constants
  maxCells = (maxX + 1) * (maxY + 1) - 1; // Constant: # of cells on board
  topImages = 7; //19; // 7 on game menu, 8 on opt menu, 3 bomb #s, smile face, 3 time #s
  maxStackHeight = 300; // For recursive cell opening stack
  smileMargin = (((maxX + 1) * 16 - (13 * 6 + 26)) / 2) - 2; // To center smile & rt jstfy time

  // Global Arrays (created once)
  cellArray = new Array(maxCells); // One per cell on the board
  for (l = 0; l <= maxCells; l++) {
    cellArray[l] = new constructCell()
  }
  markedArray = new Array(maxStackHeight); // For recursive cell opening stack

  markedCount = -1; // For recursive cell opening stack
  highestStackHeight = -1; // For recursive cell opening stack
}


// Variables used & reset during play
dead = false; // Hit a bomb?
win = false; // All cells open?
bombsFlagged = 0; // How many bombs marked so far?
cellsOpen = 0; // How many cells open so far?
markedCount = -1; // For recursive cell opening stack
highestStackHeight = -1; // For recursive cell opening stack
pointingAtX = -1; // Current cell being pointed at.
pointingAtY = -1; // Used for space bar bomb flagging
numMoves = 0; // Count the number of clicks
openRemainingUsed = false; // Was openRemaining used by the player?
lastClickOnMenu = false; // Used to control smooth menu closing

// Vars for the clock time
clockMoving = false; // Is it moving?
clockActive = false; // Should it be moving?
killLastClock = false; // To start new time w/ old still running
clockCurrent = -1; // Current time

// preload images: all time/#bombs images, including the negative
timeDigits = new Array(10);
for (l = 0; l <= 9; l++) {
  timeDigits[l] = new Image(23, 13);
  tstr = "images/time" + l + ".gif";
  timeDigits[l].src = tstr;
}
timeNeg = new Image(23, 13);
timeNeg.src = "images/time-.gif";

// preload moves counter images
movesDigits0 = new Image(23, 13);
movesDigits0.src = "images/moves0.gif";

// preload images: 9 open tiles (0..8)
cellOpenIm = new Array(9);
for (l = 0; l <= 8; l++) {
  cellOpenIm[l] = new Image(16, 16);
  tstr = "images/open" + l + ".gif";
  cellOpenIm[l].src = tstr;
}

// preload images: the many faces of bombs and bomb markers
bombFlagged = new Image(16, 16);
bombFlagged.src = "images/bombflagged.gif";
bombRevealed = new Image(16, 16);
bombRevealed.src = "images/bombrevealed.gif";
bombMisFlagged = new Image(16, 16);
bombMisFlagged.src = "images/bombmisflagged.gif";
bombDeath = new Image(16, 16);
bombDeath.src = "images/bombdeath.gif";
bombQuestion = new Image(16, 16);
bombQuestion.src = "images/bombquestion.gif";
blankCell = new Image(16, 16);
blankCell.src = "images/blank.gif";

// preload images: the 3 faces (can't use "oh" w/o mouseUp/Down methods)
faceDead = new Image(26, 26);
faceDead.src = "images/facedead.gif";
faceSmile = new Image(26, 26);
faceSmile.src = "images/facesmile.gif";
faceWin = new Image(26, 26);
faceWin.src = "images/facewin.gif";
faceWait = new Image(26, 26);
faceWait.src = "images/faceclock.gif";
faceOoh = new Image(26, 26);
faceOoh.src = "images/faceooh.gif";
facePirate = new Image(26, 26);
facePirate.src = "images/facepirate.gif";

// preload images: two images used in the menus for check marks and place holders
checked = new Image(10, 10);
checked.src = "images/checked.gif";
notchecked = new Image(10, 10);
notchecked.src = "images/notchecked.gif";




// Creates the internal cells (as opposed to the image cells).  Called once
// per cell upon creation of the window (see above).
function constructCell() {
  this.isBomb = false; // Is the cell a bomb?
  this.isExposed = false; // Is it open?
  this.isFlagged = false; // Does it have a bomb flag on it?
  this.isQuestion = false; // Question mark (if its used)
  this.isMarked = false; // Used for recursive macro opening
  this.neighborBombs = 0;
} // # surrounding bombs.  Set for all cells.




//
// General-purpose routines called from throughout the game
//


// Returns the index of the internal playing board cellArray at given
// x,y coords (on 0..n-1 scale).  Very useful fn.
function arrayIndexOf(x, y) {
  return x + y * (maxX + 1);
}


// Returns the index of the documents image pointing to cell at given
// x,y coords (on 0..n-1 scale).  Very useful fn.
// Notes: topImages are the 3 bomb digits, the face, & the 3 time digits.
//        Uses maxX+2 (not maxX+1) to include borderRight images.
function imageIndexOf(x, y) {
  return x + (y + 2) * (maxX + 3) + topImages + 3;
} // This is the simplified version
// return x+y*(maxX+2)+topImages+(maxX+1)*2+(y+1)+6; }


// Makes sure x,y coords are within the board.  Returns true or false.
function checkBounds(x, y) {
  return ((0 <= x) && (x <= maxX) && (0 <= y) && (y <= maxY));
}

// Saves the current pointing location of the mouse.  Called w/ onMouseOver
// for each cell.
function cursorHoldLoc(x, y) {
  pointingAtX = x;
  pointingAtY = y;
}

// Clears the saved location.  Needed when user points outside the grid.
// Note: I check that I'm clearing the correct cell, just in case events
// occur out of order.
function cursorClearLoc(x, y) {
  if ((pointingAtX == x) && (pointingAtY == y)) {
    pointingAtX = -1;
    pointingAtY = -1;
  }
}


// Complete the Win process. Save the cookies, and call the winning window.
function winShowWindow() {
  win = true;
  //setCookie("gameTime", clockCurrent);
  //setCookie("numMoves", numMoves);
  //setCookie("openRemainingUsed", openRemainingUsed);
  document.face.src = faceWin.src;
  //window.open('highscores/minewin.html', 'MinesweeperWin', 'toolbar=0,directories=0,menubar=0,scrollbars=1,resizable=0,width=400,height=420');
}



//
// Associated w/ opening cells & cell clicking
//


// You're dead.  Open the board of bombs.  Assumes death bomb is already
// displayed (and isExposed is set to true).
function deathShowBombs() {
  for (i = 0; i <= maxX; i++) {
    for (j = 0; j <= maxY; j++) {
      with(cellArray[arrayIndexOf(i, j)]) {
        if (!isExposed) {
          if ((isBomb) && (!isFlagged)) {
            document.images[imageIndexOf(i, j)].src = bombRevealed.src;
          } else {
            if ((!isBomb) && (isFlagged)) {
              document.images[imageIndexOf(i, j)].src = bombMisFlagged.src;
            }
          }
        }
      }
    }
  }
}


// You've won.  Mark any remaining cells as flags.
function winShowFlags() {
  for (i = 0; i <= maxX; i++) {
    for (j = 0; j <= maxY; j++) {
      with(cellArray[arrayIndexOf(i, j)]) {
        if ((!isExposed) && (!isFlagged)) {
          isFlagged = true;
          document.images[imageIndexOf(i, j)].src = bombFlagged.src;
        }
      }
    }
  }
}

// Open all remaining cells. Returns True if the player has won.
function openAll() {
  allOK = true;
  for (i = 0; i <= maxX; i++) {
    for (j = 0; j <= maxY; j++) {
      with(cellArray[arrayIndexOf(i, j)]) {
        if (!isExposed) {
          if ((isBomb) && (!isFlagged)) {
            document.images[imageIndexOf(i, j)].src = bombDeath.src;
            allOK = false;
          } else if ((!isBomb) && (isFlagged)) {
            document.images[imageIndexOf(i, j)].src = bombMisFlagged.src;
          } else if (!isBomb) {
            document.images[imageIndexOf(i, j)].src = cellOpenIm[neighborBombs].src;
          }
        }
      }
    }
  }
  return allOK;
}



// Actually opens the cell.  Works for bombs & free cells.  Can handle
// recursive calls (through markMatrixToOpen), death (if bomb), and win.
// (should probably be broken up a bit)
function openCell(x, y) {
  // Normal cell opening processing begins here
  with(cellArray[arrayIndexOf(x, y)]) {
    if (isBomb) {
      // death
      clockStop();
      document.images[imageIndexOf(x, y)].src = bombDeath.src;
      document.face.src = faceDead.src;
      isExposed = true;
      dead = true;
      updateNumBombs();
      deathShowBombs();
    } else {
      document.images[imageIndexOf(x, y)].src = cellOpenIm[neighborBombs].src;
      isExposed = true;
      isMarked = false;
      ++cellsOpen;
      if ((neighborBombs == 0) && (!isBomb)) {
        markMatrixToOpen(x, y);
      }
      if (cellsOpen + maxNumBombs - 1 == maxCells) {
        clockStop();
        winShowFlags();
        winShowWindow();
      }
    }
  }
}


// Cells on stack marked to be open.  Called on an as-needed baisis.
// See the markCellToOpen fn below.
function constructMarkedCell() {
  this.x = -1;
  this.y = -1;
}


// Although Netscapes JavaScript 1.1 documentation says JavaScript is
// recursive, it doesn't actually maintain a stack of local vars!
// So these functions turned out to be a real pain to rewrite with my
// own stack structures.
// Adds an element to the manual stack.  Lengthens the stack if necessary.
function markCellToOpen(x, y) {
  ++markedCount;
  if (highestStackHeight < markedCount) {
    ++highestStackHeight;
    markedArray[markedCount] = new constructMarkedCell()
  }
  markedArray[markedCount].x = x;
  markedArray[markedCount].y = y;
  cellArray[arrayIndexOf(x, y)].isMarked = true;
}


// When you open a cell w/ 0 neighbors or click on a completely flagged
// cell, open all neighbors (not flagged).  Creates recursive calls through
// markCellToOpen
function markMatrixToOpen(x, y) {
  for (i = x - 1; i <= x + 1; i++) {
    for (j = y - 1; j <= y + 1; j++) {
      if (checkBounds(i, j)) {
        with(cellArray[arrayIndexOf(i, j)]) {
          if ((!isExposed) && (!isMarked) && (!isFlagged)) {
            markCellToOpen(i, j);
          }
        }
      }
    }
  }
}


// Open all cells (usually one) marked for opening.  See markMatrixToOpen
// to see how multiple cells are marked.
function openAllMarked() {
  while (markedCount >= 0) {
    markedCount--; // Decrement first, in case a matrix is to be open
    with(markedArray[markedCount + 1]) {
      openCell(x, y);
    }
  }
}

// Returns 1 if a cell is flagged, and 0 otherwise.  Used in determining
// if a cell has complete surrounding cells flagged.  See below
function checkFlagged(x, y) {
  if (checkBounds(x, y))
    return (cellArray[arrayIndexOf(x, y)].isFlagged) ? (1) : (0);
  else
    return 0;
}


// Count the # of neighbors flagged.  Called for matrix opening.
function checkFlaggedMatrix(x, y) {
  count = 0;
  for (i = x - 1; i <= x + 1; i++) {
    for (j = y - 1; j <= y + 1; j++) {
      if ((i != x) || (j != y)) { //Don't check center point
        count = count + checkFlagged(i, j);
      }
    }
  }
  return count;
}


// Called for first click only.  Starts the clock, and makes sure there is
// no bomb for the first open cell (or matrix).
function firstClick(x, y) {
  if (!useFirstClickUseful) {
    if (cellArray[arrayIndexOf(x, y)].isBomb) {
      placeBombRandomLoc(); // Place first to insure different loc
      removeBomb(x, y);
    }
  } else if (troll) {
    placeBomb(x, y);
  } else {
    var i = 0; // Make local
    var j = 0;
    // Set each cell of the matrix to open to prevent bomb placement.
    for (i = x - 1; i <= x + 1; i++) {
      for (j = y - 1; j <= y + 1; j++) {
        if (checkBounds(i, j)) {
          cellArray[arrayIndexOf(i, j)].isExposed = true;
        }
      }
    }
    // Remove any bombs in the matrix and place elsewhere
    for (i = x - 1; i <= x + 1; i++) {
      for (j = y - 1; j <= y + 1; j++) {
        if (checkBounds(i, j)) {
          if (cellArray[arrayIndexOf(i, j)].isBomb) {
            removeBomb(i, j);
            placeBombRandomLoc();
          }
        }
      }
    }
    // Set each cell back to normal.  (Let cellClick take it from here).
    for (i = x - 1; i <= x + 1; i++) {
      for (j = y - 1; j <= y + 1; j++) {
        if (checkBounds(i, j)) {
          cellArray[arrayIndexOf(i, j)].isExposed = false;
        }
      }
    }
  }
  clockStart();
}


// Main click function.  Called whenever a cell is clicked.  Based on mode,
// determines what to do about the click. Handles both left and right.
function cellClick(x, y, e) {
  //   alert("Clicked cell " + x + "," + y);  //Useful diagnostic line
  //   alert("Button pressed = " + e.button) //Useful diagnostic line
  //closeAllMenus();
  if ((!dead) && (!win)) {
    document.face.src = faceSmile.src;
    numMoves++;
    // Count the moves
    if ((e != null) && (e.button != 2)) {
      if (!clockMoving)
        firstClick(x, y);
      with(cellArray[arrayIndexOf(x, y)]) {
        // Is it already open?  If so, we may need to do a matrix (macro) open
        if (isExposed) {
          if ((useMacroOpen) && (checkFlaggedMatrix(x, y) == neighborBombs)) {
            markMatrixToOpen(x, y);
            openAllMarked();
          }
        } else {
          if (!isFlagged) {
            markCellToOpen(x, y);
            openAllMarked();
          }
        }
      }
      if (win) {
        bombsFlagged = maxNumBombs;
        updateNumBombs();
      }
    } else {
      if (x > -1) {
        with(cellArray[arrayIndexOf(x, y)]) {
          if (!isExposed) {
            // There are 3 possibilities: blank, flagged, and question
            // First deal with flagged going to either blank or question
            if (isFlagged) {
              bombsFlagged--;
              isFlagged = false;
              if (!useQuestionMarks)
                document.images[imageIndexOf(x, y)].src = blankCell.src;
              else {
                isQuestion = true;
                document.images[imageIndexOf(x, y)].src = (bombQuestion.src);
              }
            }
            // Now deal w/ question going to blank
            else {
              if (isQuestion) {
                isQuestion = false;
                document.images[imageIndexOf(x, y)].src = blankCell.src;
              }
              // Finally, blank going to flagged
              else {
                isFlagged = true;
                ++bombsFlagged;
                document.images[imageIndexOf(x, y)].src = bombFlagged.src;
              }
            }
            updateNumBombs();
          }
        }
      }
    }
  }
}


// Mark a bomb with the space bar (what would be the spacebar).  Called
// whenever the value of the check box is toggled.  (Replaces old fn which
// altered "mode").
function cellRightClick() {
  cellClick(pointingAtX, pointingAtY, null);
}


// Disable the right click button's menu.
function pressRightClick() {
  return false;
}
document.oncontextmenu = pressRightClick;


// Special routine to ignore dragging starts.
// Allows the mouse to be in motion when the user clicks.
// Only works in IE because there is no onDrag handler in Mozilla
function ignoreDragging() {
  try {
    window.event.returnValue = false;
  } catch (e) {}
  return false;
}


// Show or remove the "Ooh" face when the mouse is clicked.
function showMouseDown(e) {
  if ((!dead) && (!win)) {
    //closeAllMenus();
    document.face.src = faceOoh.src;
  }
}



// Check for F2. If pressed, restart the game. Two versions: for FF & IE
document.onkeydown = checkKeyDown; // Uses global onkeypress.
function checkKeyDown(e) {
  try {
    if (e.keyCode == 113) {
      faceClick();
    }
  } catch (e) {}
  try {
    if (window.event.keyCode == 113) {
      faceClick();
    }
  } catch (e) {}
}


// When all bombs are marked, user can open all remaining cells.
function bombCountClick() {
  //closeAllMenus();
  if ((!dead) && (!win) && (openRemaining) && ((maxNumBombs - bombsFlagged) == 0)) {
    clockStop();
    numMoves++;
    openRemainingUsed = true;
    if (openAll()) {
      winShowWindow();
      updateNumBombs();
    } else {
      dead = true;
      updateNumBombs();
      document.face.src = faceDead.src;
    }
  }
  return false;
}




//
// Board creation, re-initialization, bomb placement, etc.
//


// Support function for makeBoard.  Adds 1 to the neighborBombs property.
// Does a bounds check and a check for not being a bomb. (no change if
// either condition fails)
function addNeighbor(x, y) {
  if (checkBounds(x, y)) {
    with(cellArray[arrayIndexOf(x, y)]) {
      ++neighborBombs;
    }
  }
}


// Called only w/ removal of bomb when 1st click is on a bomb.
function removeNeighbor(x, y) {
  if (checkBounds(x, y)) {
    with(cellArray[arrayIndexOf(x, y)]) {
      neighborBombs--;
    }
  }
}


// Support function for makeBoard, and also called externally if first
// click is on a bomb.  Places a bomb at x,y loc and updates neighbor
// counts.  returns true upon success, failure if bomb is already there
// or if the square is open. (note: isExposed is set temporarily to true
// during first click to avoid bombs being placed in bomb-free zone.)
function placeBomb(x, y) {
  with(cellArray[arrayIndexOf(x, y)]) {
    if ((!isBomb) && (!isExposed)) {
      isBomb = true;
      for (i = x - 1; i <= x + 1; i++) {
        for (j = y - 1; j <= y + 1; j++) {
          addNeighbor(i, j);
        }
      }
      return true;
    } else
      return false;
  }
}


// Only called when user's 1st click is on a bomb.
// NOTE: This fn caused an "internal error: Stack underflow" for a while,
// and then stopped.  I still can't find the cause, but if I split the
// cellArray reference out into a higher "with" statement, it comes back.
// It seems to work fine now, but be careful!
function removeBomb(x, y) {
  if (cellArray[arrayIndexOf(x, y)].isBomb) {
    for (i = x - 1; i <= x + 1; i++) {
      for (j = y - 1; j <= y + 1; j++) {
        removeNeighbor(i, j);
      }
    }
    cellArray[arrayIndexOf(x, y)].isBomb = false;
    return true;
  } else
    return false;
}


// Pixed a random stop w/o a bomb already there and places a bomb there.
// Since it works w/ random locs and tests compliance, this fn is only
// suitable for up to ~50% coverage. (I've limited the program to 33%).
function placeBombRandomLoc() {
  bombPlaced = false;
  while (!bombPlaced) {
    with(Math) {
      i = floor(random() * (maxX + 1));
      j = floor(random() * (maxY + 1));
    }
    bombPlaced = (placeBomb(i, j))
  }
}


// Does a complete clear of the internal board cell objects.
function clearBoard() {
  for (i = 0; i <= maxX; i++) {
    for (j = 0; j <= maxY; j++) {
      with(cellArray[arrayIndexOf(i, j)]) {
        isExposed = false;
        isBomb = false;
        isFlagged = false;
        isMarked = false;
        isQuestion = false;
        neighborBombs = 0;
      }
    }
  }
}


// Puts the original image on each image cell.
function clearBoardImages() {
  for (j = 0; j <= maxY; j++) {
    for (i = 0; i <= maxX; i++) {
      with(cellArray[arrayIndexOf(i, j)]) {
        if (document.images[imageIndexOf(i, j)].src != blankCell.src) {
          document.images[imageIndexOf(i, j)].src = blankCell.src;
        }
      }
    }
  }
}


// Core fn for creating a board.  Does not reset time or clear images.
function makeBoard() {
  clearBoard();
  bombsFlagged = 0;
  cellsOpen = 0;
  updateNumBombs();
  // Now place the bombs on the board
  bombsToPlace = troll ? maxNumBombs-1 : maxNumBombs;
  while (bombsToPlace != 0) {
    placeBombRandomLoc();
    bombsToPlace--;
  }
}


// Resets clock, makes board, clears images, and prepares for next game.
// First time doesn't do a parent reload.
function faceClick_first() {
  document.face.src = faceWait.src;
  numMoves = 0;
  //closeAllMenus();
  clockStop();
  clockClear();
  makeBoard();
  clearBoardImages();
  dead = false;
  win = false;
  openRemainingUsed = false;
  document.face.src = faceSmile.src;
  return false;
}

function faceClick() {
  faceClick_first();
  return false;
}


// Internal testing fns
function timetestStart() {
  timetestStartDt = new Date();
}

function timetestStop() {
  timetestEndDt = new Date();
  alert('Diagnostic Timer: ' + (timetestEndDt - timetestStartDt) + 'ms');
}




//
// Numerical displays (clock and num bomb) updated here
//


// Set the clock images to the current time.  Called by ticClock
function updateClock() {
  tempClock = clockCurrent;
  if (tempClock == -1) {
    tempClock = 0;
  }
  digit = tempClock % 10;
  document.time1s.src = timeDigits[digit].src;
  digit = Math.floor(tempClock / 10 % 10);
  document.time10s.src = timeDigits[digit].src;
  digit = Math.floor(tempClock / 100 % 10);
  document.time100s.src = timeDigits[digit].src;
}


// Updates the display w/ the current number of bombs left.
function updateNumBombs() {
  if ((!dead) && (!win) && (openRemaining) && ((maxNumBombs - bombsFlagged) == 0)) {
    document.bomb1s.src = movesDigits0.src;
    document.bomb10s.src = movesDigits0.src;
    document.bomb100s.src = movesDigits0.src;
  } else {
    digit = Math.abs(maxNumBombs - bombsFlagged) % 10;
    document.bomb1s.src = timeDigits[digit].src;
    digit = Math.floor(Math.abs(maxNumBombs - bombsFlagged) / 10 % 10);
    document.bomb10s.src = timeDigits[digit].src;
    digit = Math.floor(Math.abs(maxNumBombs - bombsFlagged) / 100 % 10);
    document.bomb100s.src = timeDigits[digit].src;
    if (maxNumBombs < bombsFlagged)
      document.bomb100s.src = timeNeg.src;
  }
}




//
// TIME functions begin here...
//

// Clock tic.  Called once, then it repeats every 1 second.
function ticClock() {
  if (!killLastClock) {
    if (clockMoving) {
      ++clockCurrent;
    }
    if ((clockMoving) && (clockCurrent < 1000)) // Max out display at 999
      updateClock();
    clockActive = clockMoving;
    if (clockActive) { // Always do the recursive call last
      id = setTimeout("ticClock()", 1000)
    }
  }
  killLastClock = false;
}


// Stops the clock
//   SPECIAL NOTE: This function doesn't actually stop the clock: it
//   directs the ticClock fn to stop ticking upon its next recusrive call.
function clockStop() {
  clockMoving = false;
}


// Stop and clear the clock.  See specal note in clockStop above.
function clockClear() {
  // If we're currently moving, we need to first stop it
  if ((!clockMoving) && (clockCurrent != 0)) {
    clockCurrent = 0;
    updateClock();
  }
  clockCurrent = -1;
  clockMoving = false;
}


// Starts the clock.  Able to start a clear clock or restart a paused
// clock (a feature I'm not using here).
function clockStart() {
  // Stop the clock (sets a temp variable for later interigation)
  clockWasActive = clockActive;
  clockMoving = true;
  ticClock();
  // harder part: We're still running.  Tells ticClock to kill old clock.
  if (clockWasActive) {
    killLastClock = true;
  }
}