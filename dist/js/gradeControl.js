function Sudahquiz(){

    var viewSudahquiz = document.getElementById("view_sudahquiz");
    var viewBelumquiz = document.getElementById("view_belumquiz");

    var view_sudahquizz = document.getElementById("tampilsudahquiz");
    var view_belumquizz = document.getElementById("tampilbelumquiz");

    var infosudahquiz = document.getElementById("infosudahquiz");
    var infobelumquiz = document.getElementById("infobelumquiz");

    viewSudahquiz.classList.remove("hidden");
    viewBelumquiz.classList.add("hidden");

    view_sudahquizz.classList.add("btn-info");
    view_sudahquizz.classList.remove("btn-outline-info");

    view_belumquizz.classList.add("btn-outline-danger");
    view_belumquizz.classList.remove("btn-danger");

    infosudahquiz.classList.remove("hidden");
    infobelumquiz.classList.add("hidden");

}

function Belumquiz(){

    var viewSudahquiz = document.getElementById("view_sudahquiz");
    var viewBelumquiz = document.getElementById("view_belumquiz");

    var view_sudahquizz = document.getElementById("tampilsudahquiz");
    var view_belumquizz = document.getElementById("tampilbelumquiz");

    var infosudahquiz = document.getElementById("infosudahquiz");
    var infobelumquiz = document.getElementById("infobelumquiz");

    viewBelumquiz.classList.remove("hidden");
    viewSudahquiz.classList.add("hidden");

    view_sudahquizz.classList.add("btn-outline-info");
    view_sudahquizz.classList.remove("btn-info");

    view_belumquizz.classList.add("btn-danger");
    view_belumquizz.classList.remove("btn-outline-danger");

    infosudahquiz.classList.add("hidden");
    infobelumquiz.classList.remove("hidden");

}
