function keputusan_user(){

    if(document.getElementById("edit_soal").checked){
        return "edit_soal";
    }else if(document.getElementById("edit_file").checked){
        return "edit_file";
    }

}

function klik_keputusan(){

    var form_editsoal = document.getElementById("form_edit_soal");
    var form_editfile = document.getElementById("form_edit_file");

    if(keputusan_user()=="edit_file"){
        form_editfile.classList.remove("hidden");
        form_editsoal.classList.add("hidden")
    }else if(keputusan_user()=="edit_soal"){
        form_editsoal.classList.remove("hidden");
        form_editfile.classList.add("hidden");
    }

}