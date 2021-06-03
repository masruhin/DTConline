function radioButton(){

    if(document.getElementById("view_siswa").checked){

        return "lihat siswa";

    }else if(document.getElementById("import_siswa").checked){

        return "import_siswa";

    }else if(document.getElementById("buat_data_siswa").checked){

        return "buat_data_siswa";

    }else if(document.getElementById("export").checked){

        return "export";

    }

}

function formKu(){

    //form show data
    var form_lihat_data = document.getElementById("view_data_siswa");
    //form import data siswa
    var import_data_siswa = document.getElementById("import_data_siswa");
    //form buat data siswa
    var buat_data_siswa = document.getElementById("siswa_buatData");
    //form export
    var export_data = document.getElementById("export_data_siswa");

    if(radioButton()=="buat_data_siswa"){

        buat_data_siswa.classList.remove("hidden");

        form_lihat_data.classList.add("hidden");
        import_data_siswa.classList.add("hidden");
        export_data.classList.add("hidden");

    }else if(radioButton()=="import_siswa"){

        import_data_siswa.classList.remove("hidden");

        form_lihat_data.classList.add("hidden");
        buat_data_siswa.classList.add("hidden");
        export_data.classList.add("hidden");

    }else if(radioButton()=="lihat siswa"){

        form_lihat_data.classList.remove("hidden");

        buat_data_siswa.classList.add("hidden");
        import_data_siswa.classList.add("hidden");
        export_data.classList.add("hidden");

    }else if(radioButton()=="export"){

        form_lihat_data.classList.add("hidden");

        buat_data_siswa.classList.add("hidden");
        import_data_siswa.classList.add("hidden");
        export_data.classList.remove("hidden");

    }

}
