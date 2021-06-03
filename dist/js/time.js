//========================================
//configurate time for edit task <view> 
//========================================

function get_time(){

    var day_new = document.getElementById("date_new").value;
    var time_new = document.getElementById("time_new").value;

    var day = day_new.toString();
    var time = time_new.toString();

    var countDownDate = new Date(""+day+" "+time ).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
  
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
    // Display the result in the element with id="demo"
    document.getElementById("remaining").innerHTML = days + "days " + hours + "hours "
    + minutes + "minuts " + seconds + "seconds ";
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("remaining").innerHTML = "Time Expired";
    }
  }, 1000);

}

function ChekNull(){

    var day = document.getElementById("date_new");
    var time = document.getElementById("time_new");

    if(day.value == "" && time.value == ""){

        document.getElementById("remaining").innerHTML = "Time Expired";

    }else{

        get_time();

    }

}


function remainingChek(){

    var keputusan = document.getElementById("customCheck1");
    var remaining = document.getElementById("remaining");

    if(keputusan.checked == true){

        remaining.classList.remove("hidden");
        ChekNull();

    }else if(keputusan.checked == false){

        remaining.classList.add("hidden");

    }

}

//========================================
// end configurate time for edit task <view> 
//========================================


//========================================
//configurate time for add task <add menus>
//========================================
function get_times(){

    var day_new = document.getElementById("day_add_task").value;
    var time_new = document.getElementById("time_add_task").value;

    var day = day_new.toString();
    var time = time_new.toString();

    var countDownDate = new Date(""+day+" "+time ).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
  
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
    // Display the result in the element with id="demo"
    document.getElementById("remaining_addtask_view").innerHTML = days + "days " + hours + "hours "
    + minutes + "minuts " + seconds + "seconds ";
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("remaining_addtask_view").innerHTML = "Time Expired";
    }
  }, 1000);

}

function ChekNulls(){

    var day = document.getElementById("day_add_task");
    var time = document.getElementById("time_add_task");

    if(day.value == "" && time.value == ""){

        document.getElementById("remaining_addtask_view").innerHTML = "Time Expired";

    }else{

        get_times();

    }

}

function remainingCheks(){


    var chektime_add = document.getElementById("chektime_add");
    var remaining_addtime = document.getElementById("remaining_addtask");

    if(chektime_add.checked == true){

        remaining_addtime.classList.remove("hidden");
        ChekNulls();

    }else if(chektime_add.checked == false){

        remaining_addtime.classList.add("hidden");

    }

}

//=============================================
//end configurate time for add task <add menus>
//=============================================




//=============================================
//configurate time for add quiz <add menus>
//==============================================
function get_timesss(){

    var day_new = document.getElementById("tgl_mulai_quiz").value;
    var time_new = document.getElementById("waktu_mulai_quiz").value;

    var day_finish = document.getElementById("tgl_selesai_quiz").value;
    var time_finish = document.getElementById("waktu_selesai_quiz").value;

    var day = day_new.toString();
    var time = time_new.toString();

    var countDownDate = new Date(""+day+" "+time ).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
  
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
    // Display the result in the element with id="demo"
    document.getElementById("remainingtime_quiz_view").innerHTML = "Quiz will be opened : "+ days + " days " + hours + " hours "
    + minutes + " minuts " + seconds + " seconds ";
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("remainingtime_quiz_view").innerHTML = "Quiz will be opened : "+"Time Expired";
    }
  }, 1000);




  var startTime = new Date(""+day_new+" "+time_new); 
  var endTime = new Date(""+day_finish+" "+time_finish);
  var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
  var resultInMinutes = Math.round(difference / 60000);

  if(resultInMinutes<=0){
    document.getElementById("lamaquiz_view").innerHTML = "Quiz is open during : "+"Time Expired";
  }else{
      document.getElementById("lamaquiz_view").innerHTML = "Quiz is open during : "+resultInMinutes+" minuts";
  }

}


function ChekNullsss(){

    var day = document.getElementById("tgl_mulai_quiz");
    var time = document.getElementById("waktu_mulai_quiz");

    var day_finish = document.getElementById("tgl_selesai_quiz").value;
    var time_finish = document.getElementById("waktu_selesai_quiz").value;

    if(day.value == "" && time.value == "" &&day_finish.value == "" &&time_finish.value == ""){

        document.getElementById("remainingtime_quiz_view").innerHTML = "Quiz will be opened : "+"Time Expired";

    }else{

        get_timesss();

    }

}

function remainingCheksss(){


    var chektime_add = document.getElementById("chekquiz_time"); //cheklist
    var remaining_addtime = document.getElementById("remainingtime_quiz");//div e
    var lama_chat = document.getElementById("lama_quiz");

    if(chektime_add.checked == true){

        remaining_addtime.classList.remove("hidden");
        lama_chat.classList.remove("hidden");
        ChekNullsss();

    }else if(chektime_add.checked == false){

        remaining_addtime.classList.add("hidden");
        lama_chat.classList.add("hidden");

    }

}

//=============================================
// end configurate time for add quiz <add menus>
//==============================================