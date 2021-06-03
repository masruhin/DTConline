function selected(){
    
    if(document.getElementById("yesadd").checked){
        return "yes_add_file";
    }else if(document.getElementById("noadd").checked){
        return "no_add_file";
    }

}

function clear_screen(){

    var jum_file = document.getElementById("jum_file").value;
    var remove = 3-jum_file;

    for(let i=1; i<=remove; i++){
        document.getElementById("file_add_"+i).innerHTML=""; //clear 
    }

}

function show_file(){

    clear_screen();
    var jum_file = document.getElementById("jum_file").value;
    var file = "<input type='file' name='data_file_add[]' id='data_file' class='form-control-file' required>";
    var result = 3 - jum_file;

    for(let i=1; i<=result; i++){
        document.getElementById("file_add_"+i).innerHTML="<input type='file' name='data_file_add[]' id='data_file_'"+i+" class='form-control-file' required>";
    }


}

function edit_file(){
    var table_view = document.getElementById("table_view");

    //bawah 
    if(selected()=="yes_add_file"){
        var jum_file = document.getElementById("jum_file").value;
        show_file();
        table_view.classList.add("hidden");
        
        for(let i=1; i<=jum_file; i++){
            document.getElementById("data_edits_"+i).required=false;
        }

    
    }else if(selected()=="no_add_file"){
        var jum_file = document.getElementById("jum_file").value;
        
        for(let i=1; i<=jum_file; i++){
            document.getElementById("data_edits_"+i).required=true;
        }
        table_view.classList.remove("hidden");
        clear_screen();
    }
}



