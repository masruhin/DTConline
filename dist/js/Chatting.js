function CekMenu(){

    if(document.getElementById("mulai_obrolan").checked){

        return "mulai_obrolan";

    }else if(document.getElementById("pesan_masuk").checked){

        return "pesan_masuk";

    }else if(document.getElementById("hubungi_admin").checked){

        return "hubungi_admin";

    }

}

function Userclick(){

    var view_pesanmasuk = document.getElementById("view_pesan_masuk");
    var view_obrolan = document.getElementById("view_mulai_obrolan");
    var hubungi_admin = document.getElementById("view_hubungi_admin");

    if(CekMenu() == "mulai_obrolan"){

        hubungi_admin.classList.add("hidden");
        view_obrolan.classList.remove("hidden");
        view_pesanmasuk.classList.add("hidden");

    }else if(CekMenu() == "pesan_masuk"){

        view_pesanmasuk.classList.remove("hidden");
        view_obrolan.classList.add("hidden");
        hubungi_admin.classList.add("hidden");

    }else if(CekMenu() == "hubungi_admin"){

        hubungi_admin.classList.remove("hidden");

        view_obrolan.classList.add("hidden");
        view_pesanmasuk.classList.add("hidden");

    }


}