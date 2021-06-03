
// Selected event

function put_data(){
    var max_data;
    var is_data;

    max_data = document.getElementById("tot_kls");
    is_data = max_data.options[max_data.selectedIndex].value;

    return is_data;
}

function clear_div(){
    for(let i=1; i<=3; i++){
        document.getElementById("file_input_"+i).innerHTML = ""; //clear screen
    }
}

function result(){
    var tem = "<input type='file' name='data_file[]' id='data_file' class='form-control-file' required>";
    var lenght;

    clear_div();
    lenght = put_data();

    for(let i=1; i<=lenght; i++){
        document.getElementById("file_input_"+i).innerHTML = tem;
    }
}

// end selected event

// Radio button event

function konfirmasi_tgs(){
    var isi;

    if(document.getElementById("yes").checked){
        isi = document.getElementById("yes").value;
    }
    else if(document.getElementById("no").checked){
        isi = document.getElementById("no").value;
    }

    return isi;
}

function event_konfirmasi(){

    //reomove class
    var keputusan = document.getElementById("keputusan");

    keputusan.classList.remove("hidden");

    if(konfirmasi_tgs() == "yes"){
        keputusan.style.display = "block";
        
        document.getElementById("tgl").required = true;
        document.getElementById("time").required = true;


    }else{
        keputusan.style.display = "none";

        document.getElementById("tgl").required = false;
        document.getElementById("time").required = false;
    }

}

// end Radio button event
