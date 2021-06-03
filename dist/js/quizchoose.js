function get_val(){
    if(document.getElementById("pilihanganda").checked){
        return "pilihanganda";
    }else if(document.getElementById("essay").checked){
        return "essay";
    }else if(document.getElementById("null").checked){
        return "null";
    }
}

function click_val(){
    var pilgan_view = document.getElementById("pilihanganda_view");
    var essay_view = document.getElementById("essay_view");
    var view_quiz = document.getElementById("view_infoquis");

    if(get_val()=="essay"){
        essay_view.classList.remove("hidden");
        pilgan_view.classList.add("hidden");

        view_quiz.classList.add("hidden");
    }else if(get_val()=="pilihanganda"){
        essay_view.classList.add("hidden");
        pilgan_view.classList.remove("hidden");

        view_quiz.classList.add("hidden");
    }else if(get_val()=="null"){
        essay_view.classList.add("hidden");
        pilgan_view.classList.add("hidden");

        view_quiz.classList.remove("hidden");
    }
}

// add file pilihan ganda

function get_val_uploadfile() {
    var max_data;
    var is_data;

    max_data = document.getElementById("file_pilihanganda");
    is_data = max_data.options[max_data.selectedIndex].value;

    return is_data;
}

function clearfile(){
    for(let i=1; i<=3; i++){
        document.getElementById("file_pilihanganda_"+i).innerHTML = ""; //clear screen
    }
}

function cekfile(){
    var tem = "<input type='file' name='data_file[]' id='data_file' class='form-control-file' required>";
    var lenght;

    clearfile();
    lenght = get_val_uploadfile();

    for(let i=1; i<=lenght; i++){
        document.getElementById("file_pilihanganda_"+i).innerHTML = tem;
    }
}

//end add file pilihan ganda

//add file essay
function get_val_uploadfile_essay() {
    var max_data;
    var is_data;

    max_data = document.getElementById("file_essay");
    is_data = max_data.options[max_data.selectedIndex].value;

    return is_data;
}

function clearfile_essay(){
    for(let i=1; i<=3; i++){
        document.getElementById("file_essay_"+i).innerHTML = ""; //clear screen
    }
}

function cekfile_essay(){
    var tem = "<input type='file' name='data_file[]' id='data_file' class='form-control-file' required>";
    var lenght;

    clearfile_essay();
    lenght = get_val_uploadfile_essay();

    for(let i=1; i<=lenght; i++){
        document.getElementById("file_essay_"+i).innerHTML = tem;
    }
}