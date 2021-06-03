function Configuration_quiz(){
    var day_deadline = document.getElementById("day_deadline").value;
    var time_deadline = document.getElementById("time_deadline").value;

    var deadline_day = day_deadline.toString();
    var deadline_time = time_deadline.toString();

    var countDownDate = new Date(""+deadline_day+" "+deadline_time ).getTime();

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
    document.getElementById("waktu_tunggu").innerHTML = days + " days " + hours + " hours "
    + minutes + " minuts " + seconds + " seconds ";
  
    // If the count down is finished, write some text
    if (distance < 0) {
      alert("waktu habis");
      clearInterval(x);
      document.getElementById("waktu_tunggu").innerHTML = "Time Expired";
      document.getElementById("tombol_submit_otomatis").click();

    }
  }, 1000);

}