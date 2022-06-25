// For the shrinking of the navbar
$(document).scroll(function() {
  if ($(this).scrollTop() > 70) { //Adjust 150
    $('#header').addClass('shrinked');
    $('.main-button').addClass('shrinked');
    $('.nav-spacer').addClass('shrinked');
    $('.sub-menu').addClass('shrinked');
    $('.log-div').addClass('shrinked');
  } else {
    $('#header').removeClass('shrinked');
    $('.main-button').removeClass('shrinked');
    $('.nav-spacer').removeClass('shrinked');
    $('.sub-menu').removeClass('shrinked');
    $('.log-div').removeClass('shrinked');
  }
});

// Some general functions
function getRandomNr(from = 1, to = 100) {
  return Math.floor(Math.random() * to) + from;
}

function titleString(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}