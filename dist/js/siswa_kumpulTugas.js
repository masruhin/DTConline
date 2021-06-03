function result(){

    if(document.getElementById("add_file").checked){

        return "add_file";

    }else if(document.getElementById("edit_file").checked){

        return "edit file";

    }

}

function get_pjgfile(){

    var jumlah_file = document.getElementById("banyak_file").value;

    return jumlah_file;
}

function tambah_file(){

    var lenght = document.getElementById("tot_tgs_terkumpul").value;
    var tem_file = "<input type='file' name='data_file[]' id='data_file' class='form-control-file' required>";

    var pjg = 3-lenght; //max boleh input

    var pjg_inputan_siswa = get_pjgfile();

    clear_screen();

 

    if(pjg == 3){
 
        clear_screen();
        for(let i=1; i<=pjg_inputan_siswa; i++){

            document.getElementById("file_input_"+i).innerHTML = tem_file;
    
        }
       

    }else if(pjg == 2){

        if(pjg_inputan_siswa == 3){
            alert("maximum upload 2 file");

            document.getElementById("form_add_file").reset();

            return false;
            
        }

        clear_screen();
        for(let i=1; i<=pjg_inputan_siswa; i++){

            document.getElementById("file_input_"+i).innerHTML = tem_file;
    
        }

        

    }else if(pjg == 1){

        if(pjg_inputan_siswa == 2 || pjg_inputan_siswa == 3){
            document.getElementById("form_add_file").reset();

            alert("maximum upload 1 file");
            return false;
        }

        clear_screen();
        for(let i=1; i<=pjg_inputan_siswa; i++){

            document.getElementById("file_input_"+i).innerHTML = tem_file;
    
        }
        

    }else if(pjg == 0){

        if(pjg_inputan_siswa == 1 ||pjg_inputan_siswa == 2 || pjg_inputan_siswa == 3){
            document.getElementById("form_add_file").reset();

            alert("total submitted 3 file");
            return false;
        }

    }

}



function clear_screen(){

    for(let i=1; i<=3; i++){

        document.getElementById("file_input_"+i).innerHTML = "";

    }

}


function home(){

    var add_file = document.getElementById("form_add_file");
    var edit_file = document.getElementById("form_edit_file");

    if(result() == "add_file"){

        //hiddens view
        add_file.classList.remove("hidden");
        edit_file.classList.add("hidden");

        

    }else if(result() == "edit file"){

        //hiddens file
        add_file.classList.add("hidden");
        edit_file.classList.remove("hidden");

    }


}