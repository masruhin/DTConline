function get_value(){

    if(document.getElementById("filesisip").checked){

        return "filesisip";

    }else if(document.getElementById("filesubmit").checked){

        return "filesubmit";

    }else if(document.getElementById("quiz").checked){

        return "quiz";

    }
}


function Clickfirst(){

    var filesisip =  document.getElementById("filesisip_act");
    var tempatsubmit = document.getElementById("filesubmit_act");
    var quiz = document.getElementById("add_quiz");

    if(get_value() == "filesisip"){
        filesisip.classList.remove("hidden");

        quiz.classList.add("hidden");
        tempatsubmit.classList.add("hidden");

    }else if(get_value() == "filesubmit"){
        filesisip.classList.add("hidden");
        quiz.classList.add("hidden");
        
        tempatsubmit.classList.remove("hidden");
    }else if(get_value() == "quiz"){
        quiz.classList.remove("hidden");

        filesisip.classList.add("hidden");
        tempatsubmit.classList.add("hidden");
    }

}


// fungsi add file event

function filesisip_getVal(){

    var batas = document.getElementById("tot_file");
    var totBatas = batas.options[batas.selectedIndex].value;

    return totBatas;
}

function filesisip_Clear(){

    var lenght = filesisip_getVal();

    for(let i=1; i<=3; i++){

        document.getElementById("filesisip_"+i).innerHTML="";

    }

}

function filesisip_Listener(){  //main function
    
    filesisip_Clear();
    var lenght = filesisip_getVal();

    var temp = "<input type='file' name='data_file[]' id='data_file' class='form-control-file' required>";

    for(let i=1; i<=lenght; i++){

        document.getElementById("filesisip_"+i).innerHTML = temp;

    }

}

// akhir fungsi add file event

