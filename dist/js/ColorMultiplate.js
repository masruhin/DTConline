function mouse_click(id){

    var total_soal = document.getElementById("total_soal").value;
    var looping = total_soal * 4;

    for(let i=1; i<=looping; i++){

        if(id == "pil_a"+i){

            document.getElementById("pil_a"+i).style.background="#33adff";
            document.getElementById("pil_b"+i).style.background="white";
            document.getElementById("pil_c"+i).style.background="white";
            document.getElementById("pil_d"+i).style.background="white";
            document.getElementById("pil_e"+i).style.background="white";

        }else if(id == "pil_b"+i){

            document.getElementById("pil_a"+i).style.background="white";
            document.getElementById("pil_b"+i).style.background="#33adff";
            document.getElementById("pil_c"+i).style.background="white";
            document.getElementById("pil_d"+i).style.background="white";
            document.getElementById("pil_e"+i).style.background="white";

        }else if(id == "pil_c"+i){

            document.getElementById("pil_a"+i).style.background="white";
            document.getElementById("pil_b"+i).style.background="white";
            document.getElementById("pil_c"+i).style.background="#33adff";
            document.getElementById("pil_d"+i).style.background="white";
            document.getElementById("pil_e"+i).style.background="white";

        }else if(id == "pil_d"+i){

            document.getElementById("pil_a"+i).style.background="white";
            document.getElementById("pil_b"+i).style.background="white";
            document.getElementById("pil_c"+i).style.background="white";
            document.getElementById("pil_d"+i).style.background="#33adff";
            document.getElementById("pil_e"+i).style.background="white";

        }else if(id == "pil_e"+i){

            document.getElementById("pil_a"+i).style.background="white";
            document.getElementById("pil_b"+i).style.background="white";
            document.getElementById("pil_c"+i).style.background="white";
            document.getElementById("pil_e"+i).style.background="#33adff";
            document.getElementById("pil_d"+i).style.background="white";

        }

    }

}

function hidden_answer_pilgan(user){

    var tot_pilgan = document.getElementById("tot_pilgan").value;

    for(let i=1; i<=tot_pilgan; i++){

        if(user == "nav_pilgan"+i){

            document.getElementById("nav_pilgann"+i).classList.remove("hidden");
            document.getElementById("nav_pilgan"+i).style.background=' #009966';

        }else{

            document.getElementById("nav_pilgann"+i).classList.add("hidden");
            document.getElementById("nav_pilgan"+i).style.background=' #a3a375';

        }

    }

}

function hidden_answer_essay(user){

    var tot_essay = document.getElementById("tot_essay").value;


    for(let i=1; i<=tot_essay; i++){

        if(user == "nav_essay"+i){

            document.getElementById("nav_essayy"+i).classList.remove("hidden");
            document.getElementById("nav_essay"+i).style.background=' #009966';

        }else{

            document.getElementById("nav_essayy"+i).classList.add("hidden");
            document.getElementById("nav_essay"+i).style.background=' #a3a375';

        }

    }

}

function click_nav(val){

    hidden_answer_essay(val);
    hidden_answer_pilgan(val);


}

function view_all_pilgan(){

    var tot_pilgan = document.getElementById("tot_pilgan").value;

    for(let i=1; i<=tot_pilgan; i++){

        document.getElementById("nav_pilgann"+i).classList.remove("hidden");
        document.getElementById("nav_pilgan"+i).style.background=' #009966';

    }
    hidden_essay();

}

function hidden_pilgan(){

    var tot_pilgan = document.getElementById("tot_pilgan").value;

    for(let i=1; i<=tot_pilgan; i++){

        document.getElementById("nav_pilgann"+i).classList.add("hidden");
        document.getElementById("nav_pilgan"+i).style.background=' #009966';

    }

}

function hidden_essay(){

    var tot_essay = document.getElementById("tot_essay").value;

    for(let i=1; i<=tot_essay; i++){

        document.getElementById("nav_essayy"+i).classList.add("hidden");
        document.getElementById("nav_essay"+i).style.background=' #009966';

    }

}

function view_all_essay(){

    var tot_essay = document.getElementById("tot_essay").value;


    for(let i=1; i<=tot_essay; i++){

        document.getElementById("nav_essayy"+i).classList.remove("hidden");
        document.getElementById("nav_essay"+i).style.background=' #009966';

    }

    hidden_pilgan()

}


