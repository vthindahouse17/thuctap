

//---------------scroll Menu--------------//

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
  if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {

    document.getElementById("nav").style.backgroundColor = "#fff";
    document.getElementById("nav").style.top = "0"
    document.getElementById("nav").style.padding = "16px 0px 0px 0px"
    document.getElementById("nav").style.boxShadow = "0px 2px 10px gray"
  } else {

    document.getElementById("nav").style.top = "40px"
    document.getElementById("nav").style.padding = "16px 0px 16px 0px"
    document.getElementById("nav").style.boxShadow = "0px 2px 10px gray"

  }
}


//----------------heart----------------//
document.getElementById('bxs').style.color = "black";
function addHeart() {
  var heart = document.getElementById('bxs');

  if (heart.style.color == "black") {
    heart.style.color = "#6775d6"
    alert('Added to favorites')
  } else {
    heart.style.color = "black"
    alert("Removed to favorites")
  }
}
//----------------Product---------//


// cài dặt mặc định
document.getElementById('appp').style.display = "none"
function showProduct() {
  var x = document.getElementById('appp');
  if (x.style.display == "block") {
    x.style.display = "none"
    x.style.transition=".6s";
    x.style.transform(screenX)="0"
  } else {
    x.style.display = "block"
    x.style.zIndex="100"
    x.style.transform(screenX)="100%"
  }
}

