function showFaq(e){
    var elem = this.parentElement.lastElementChild;
    var currentDis = elem.style.display;
    if(currentDis == "none"){
        e.target.src = "/img/arrow_up.png";
        elem.style.display = "block";
    }else{
        e.target.src = "/img/arrow_down.png";
        elem.style.display = "none";
    }
};

function connectListeners(){
    var arrows = document.querySelectorAll(".faq_arrow");

    for (let arrow of arrows){
        arrow.addEventListener("click", showFaq);
    };
}

window.addEventListener("load", connectListeners);
