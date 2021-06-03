function Result(){

    if(document.getElementById("sudah_mengumpulkan").checked){

        return "sudahkumpul";

    }else if(document.getElementById("belum_mengumpulkan").checked){

        return "belumkumpul";

    }

}

function Userclick(){

    var view_sudah_kumpul = document.getElementById("view_sudah_mengumpulkan");
    var view_belum_kumpul = document.getElementById("view_belum_mengumpulkan");

    var count_view_sudah_kumpul = document.getElementById("count_mengumpulkan");
    var count_view_belum_kumpul = document.getElementById("count_belum_mengumpulkan");

    if(Result()=="sudahkumpul"){

        view_sudah_kumpul.classList.remove("hidden");
        view_belum_kumpul.classList.add("hidden");

        count_view_sudah_kumpul.classList.remove("hidden");
        count_view_belum_kumpul.classList.add("hidden");

    }else if(Result() == "belumkumpul"){

        view_belum_kumpul.classList.remove("hidden");
        view_sudah_kumpul.classList.add("hidden");

        count_view_sudah_kumpul.classList.add("hidden");
        count_view_belum_kumpul.classList.remove("hidden");

    }

}