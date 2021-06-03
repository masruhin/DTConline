function event_keputusan(){
    var isi;

    if(document.getElementById("yes").checked){

        isi = document.getElementById("yes").value;

    }else if(document.getElementById("no").checked){

        isi = document.getElementById("no").value;

    }

    return isi;
}

function show_file(){

    //jmlh inputan file
    var jmlh_inputan = document.getElementById("jmlh").value;
    var ulang = 3-jmlh_inputan;

    var file = "<input type='file' name='data_file[]' id='data_file' class='form-control-file' required>";

    for(let i=1; i<=ulang; i++){

        document.getElementById("file_add_"+i).innerHTML = file;

    }
    
}

function remove_file(){

    //jmlh inputan file
    var jmlh_inputan = document.getElementById("jmlh").value;
    var ulang = 3-jmlh_inputan;

    for(let i=1; i<=ulang; i++){

        document.getElementById("file_add_"+i).innerHTML = "";

    }

}

function hidden_file(){

    var keputusan = document.getElementById("table");

    if(event_keputusan() == "yes"){

        //jmlh inputan file
        var jmlh_inputan = document.getElementById("jmlh").value;
    
        for(let i=1; i<=jmlh_inputan; i++){
            document.getElementById("data_edit_edit_"+i).required = false;
        }

        keputusan.classList.add("hidden");
        show_file();

    }else if(event_keputusan() == "no"){

        //jmlh inputan file
        var jmlh_inputan = document.getElementById("jmlh").value;

        for(let i=1; i<=jmlh_inputan; i++){
            document.getElementById("data_edit_edit_"+i).required = true;
        }

        keputusan.classList.remove("hidden");
        remove_file();

    }

}