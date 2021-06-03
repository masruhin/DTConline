function cek(){

    if(document.getElementById("import_pilihanganda").checked){

        return "upload_pilgan";

    }else if(document.getElementById("import_essay").checked){

        return "upload_essay";

    }

}

function control_import(){

    var form_pilgan = document.getElementById("import_pilgan");
    var form_essay = document.getElementById("import_essay_essay");

    if(cek()=="upload_pilgan"){

        form_pilgan.classList.remove("hidden");
        form_essay.classList.add("hidden");

    }else if(cek()=="upload_essay"){

        form_essay.classList.remove("hidden");
        form_pilgan.classList.add("hidden");

    }


}