function CekArgumen(){

    if(document.getElementById("kontak_guru").checked){

        return "kontak_guru";

    }else if(document.getElementById("kontak_teman").checked){

        return "kontak_teman";

    }else if(document.getElementById("hubungi_admin").checked){

        return "hubungi_admin";

    }else if(document.getElementById("pesan_belum_terbaca").checked){

        return "pesan_belum_terbaca";

    }

}

function View(){

    var view_kontak_guru = document.getElementById("view_kontak_guru");
    var view_kontak_teman = document.getElementById("view_kontak_teman");
    var view_kontak_admin = document.getElementById("view_hubungi_admin");
    var view_pesan_terbaru = document.getElementById("view_pesan_belum_terbaca");


    var view_kontak_guruu = document.getElementById("view_kontak_guruu");
    var view_kontak_temann = document.getElementById("view_kontak_temann");
    var view_kontak_adminn = document.getElementById("view_hubungi_adminn");
    var view_pesan_terbaruu = document.getElementById("view_pesan_belum_terbacaa");

    if(CekArgumen() == "kontak_guru"){

        view_kontak_guru.classList.remove("hidden");
        view_kontak_guruu.classList.remove("hidden");

        view_kontak_teman.classList.add("hidden");
        view_kontak_admin.classList.add("hidden");
        view_pesan_terbaru.classList.add("hidden");
        view_kontak_temann.classList.add("hidden");
        view_kontak_adminn.classList.add("hidden");
        view_pesan_terbaruu.classList.add("hidden");

    }else if(CekArgumen() == "kontak_teman"){

        view_kontak_teman.classList.remove("hidden");
        view_kontak_temann.classList.remove("hidden");

        view_kontak_guru.classList.add("hidden");
        view_kontak_admin.classList.add("hidden");
        view_pesan_terbaru.classList.add("hidden");
        view_kontak_guruu.classList.add("hidden");
        view_kontak_adminn.classList.add("hidden");
        view_pesan_terbaruu.classList.add("hidden");

    }else if(CekArgumen() == "hubungi_admin"){

        view_kontak_admin.classList.remove("hidden");
        view_kontak_adminn.classList.remove("hidden");

        view_kontak_guru.classList.add("hidden");
        view_kontak_teman.classList.add("hidden");
        view_pesan_terbaru.classList.add("hidden");
        view_kontak_guruu.classList.add("hidden");
        view_kontak_temann.classList.add("hidden");
        view_pesan_terbaruu.classList.add("hidden");

    }else if(CekArgumen() == "pesan_belum_terbaca"){

        view_pesan_terbaru.classList.remove("hidden");
        view_pesan_terbaruu.classList.remove("hidden");

        view_kontak_guru.classList.add("hidden");
        view_kontak_teman.classList.add("hidden");
        view_kontak_admin.classList.add("hidden");
        view_kontak_guruu.classList.add("hidden");
        view_kontak_temann.classList.add("hidden");
        view_kontak_adminn.classList.add("hidden");

    }

}