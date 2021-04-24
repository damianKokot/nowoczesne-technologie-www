var context;
var _canvas;

class Tile {
  static get width() {
    return Math.floor(GameState.boardWidth / GameState.colsCount);
  }
  static get height() {
    return Math.floor(GameState.boardHeight / GameState.rowsCount);
  }

  static get imageWidth() {
    return Math.floor(GameState.image.width / GameState.colsCount);
  }
  static get imageHeight() {
    return Math.floor(GameState.image.height / GameState.rowsCount);
  }

  constructor(index) {
    this.isRed = false;
    this.initIndex = this.index = index;
  }

  updateIndex(newIndex) {
    this.index = newIndex;
  }

  isInBound(x, y) {
    return (
      this.startX < x &&
      x < this.startX + Tile.width &&
      this.startY < y &&
      y < this.startY + Tile.height
    );
  }

  get startX() {
    return this.column * Tile.width;
  }

  get startY() {
    return this.row * Tile.height;
  }

  get initX() {
    return this.initColumn * Tile.imageWidth;
  }

  get initY() {
    return this.initRow * Tile.imageHeight;
  }

  get row() {
    return Math.floor(this.index / GameState.colsCount);
  }

  get column() {
    return this.index % GameState.colsCount;
  }

  get initRow() {
    return Math.floor(this.initIndex / GameState.colsCount);
  }

  get initColumn() {
    return this.initIndex % GameState.colsCount;
  }
}

class GameState {
  static boardWidth;
  static boardHeight;
  static rowsCount;
  static colsCount;
  static image;

  newGame({ rows, cols, image }) {
    this.tiles = [];

    rows = rows || this.config.rows;
    cols = cols || this.config.cols;

    if (rows && cols && image) {
      this.config = { rows, cols };

      GameState.image = image;
      GameState.colsCount = cols;
      GameState.rowsCount = rows;
    }

    for (let i = 0; i < rows * cols; i++) {
      this.tiles.push(new Tile(i));
    }
  }

  getRedNeighor(tileIndex) {
    const neghborTiles = [];
    const pushNeighbor = (index) => neghborTiles.push(this.tiles[index]);

    if (tileIndex - 1 >= 0) pushNeighbor(tileIndex - 1);
    if (tileIndex - GameState.colsCount >= 0) pushNeighbor(tileIndex - GameState.colsCount);
    if (tileIndex + 1 < this.tiles.length) pushNeighbor(tileIndex + 1);
    if (tileIndex + GameState.colsCount < this.tiles.length)
      pushNeighbor(tileIndex + GameState.colsCount);

    for (const neighbor of neghborTiles) {
      if (neighbor.isRed) {
        return neighbor;
      }
    }
  }

  shuffleTiles() {
    this.shuffled = true;
    this.tiles = this.tiles
      .sort(() => Math.random() - 0.5)
      .map((tile, index) => {
        tile.updateIndex(index);
        return tile;
      });
  }

  swapTiles(index1, index2) {
    this.tiles[index1].index = index2;
    this.tiles[index2].index = index1;

    const tmp = this.tiles[index1];
    this.tiles[index1] = this.tiles[index2];
    this.tiles[index2] = tmp;
  }

  getPiece({ x, y }) {
    for (let tile of this.tiles) {
      if (tile.isInBound(x, y)) {
        return tile;
      }
    }
  }

  checkIfWin() {
    for (const tile of this.tiles) {
      if (tile.index !== tile.initIndex) {
        return false;
      }
    }
    return true;
  }
}
const gameState = new GameState();

const resizeListener = () => {
  const canvas = $('canvas')[0];

  GameState.boardWidth = canvas.offsetWidth;
  GameState.boardHeight = canvas.offsetHeight;

  if (this.shuffled) refreshView(gameState.tiles);
};

async function initGame(cols, rows, imageUrl) {
  window.removeEventListener('resize', resizeListener);
  window.addEventListener('resize', resizeListener);

  const image = await loadImage(imageUrl);

  gameState.newGame({ rows, cols, image });
  setCanvas(image);
  initPuzzle();
}

function loadImage(imageUrl) {
  return new Promise((resolve, reject) => {
    const image = new Image();
    image.addEventListener('load', () => resolve(image));
    image.addEventListener('error', (error) => reject(error));
    image.src = imageUrl;
  });
}

function setCanvas(image) {
  _canvas = document.getElementById('game-view');
  context = _canvas.getContext('2d');

  GameState.boardHeight = _canvas.offsetHeight;
  GameState.boardWidth = _canvas.offsetWidth;
  _canvas.width = GameState.boardWidth;
  _canvas.height = GameState.boardHeight;
}

function initPuzzle() {
  gameState.shuffleTiles();

  gameState.redPosition = 0;
  gameState.tiles[0].isRed = true;

  refreshView(gameState.tiles);
  _canvas.onmousedown = onPuzzleClick;
  _canvas.onmousemove = onMouseMove;
}

function refreshView(tiles, withStroke = true, highlightTileIndex) {
  context.clearRect(0, 0, GameState.boardWidth, GameState.boardHeight);
  const drawImage = (tile) => {
    context.drawImage(
      GameState.image,
      tile.initX,
      tile.initY,
      Tile.imageWidth,
      Tile.imageHeight,
      tile.startX,
      tile.startY,
      Tile.width,
      Tile.height
    );
  };

  for (const tile of tiles) {
    if (tile.index === highlightTileIndex) {
      context.save();
      context.globalAlpha = 0.5;
      drawImage(tile);
      context.restore();
      context.imageSmoothingEnabled = false;
    } else if (!tile.isRed || !withStroke) {
      drawImage(tile);
      if (withStroke) context.strokeRect(tile.startX, tile.startY, Tile.width, Tile.height);
    } else {
      context.fillStyle = '#6b2412';
      context.fillRect(tile.startX, tile.startY, Tile.width, Tile.height);
      if (withStroke) context.strokeRect(tile.startX, tile.startY, Tile.width, Tile.height);
    }
  }
}

function onPuzzleClick(e) {
  const mousePosition = { x: e.offsetX, y: e.offsetY };
  const clickedTile = gameState.getPiece(mousePosition);
  const redNeighbor = gameState.getRedNeighor(clickedTile.index);

  if (redNeighbor) {
    gameState.swapTiles(clickedTile.index, redNeighbor.index);
    refreshView(gameState.tiles);
  }

  if (gameState.checkIfWin()) {
    refreshView(gameState.tiles, false);
    setTimeout(() => {
      restartGame();
    }, 4000);
  }
}

function onMouseMove(e) {
  const mousePosition = { x: e.offsetX, y: e.offsetY };
  const tileOver = gameState.getPiece(mousePosition);
  if (!tileOver) return;

  const redNeighbor = gameState.getRedNeighor(tileOver.index);
  if (redNeighbor) {
    refreshView(gameState.tiles, true, tileOver.index);
  }
}

function restartGame() {
  _canvas.onmousedown = null;
  _canvas.onmousemove = null;
  gameState.newGame({});
  initPuzzle();
}
