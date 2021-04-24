$(document).ready(function () {
  $('#imageInput img').on('click', function () {
    $('.active').toggleClass('active');
    $(this).toggleClass('active');
  });
});

function parseParams() {
  const cols = $('#columnsInput')[0].value;
  const rows = $('#rowsInput')[0].value;
  const imgSrc = $('img.active')[0].currentSrc;

  return [parseInt(cols), parseInt(rows), imgSrc];
}

function openOptions() {
  $('.main').toggleClass('invisible');
  $('#game').toggleClass('invisible');
}

function startGame() {
  $('.main').toggleClass('invisible');
  $('#game').toggleClass('invisible');

  initGame(...parseParams());
}
