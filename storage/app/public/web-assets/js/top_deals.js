$(document).ready(function() {
  (function() {
    if (deal_type == 2) {
      var dealstartdate = new Date(current_date + " " + start_time).getTime();

      var countDownDate = new Date(current_date + " " + end_time).getTime();
    } else {
      var dealstartdate = new Date(start_date + " " + start_time).getTime();

      var countDownDate = new Date(end_date + " " + end_time).getTime();
    }

    // Update the count down every 1 second

    var x = setInterval(function() {
      var nowdate = new Date().toLocaleString("en-US", { timeZone: time_zone });

      now = new Date(nowdate).getTime();

      // Time to the date

      var timeToDate = countDownDate - now;

      if (timeToDate > 0 && now >= dealstartdate) {
        // Time calculations for days, hours, minutes and seconds

        var days = Math.floor(timeToDate / (1000 * 60 * 60 * 24));

        var hours = Math.floor(
          timeToDate % (1000 * 60 * 60 * 24) / (1000 * 60 * 60)
        );

        var minutes = Math.floor(timeToDate % (1000 * 60 * 60) / (1000 * 60));

        var seconds = Math.floor(timeToDate % (1000 * 60) / 1000);

        // Display the result in the element with id="counter"

        if (topdeals == 1) {
          var html =
            "<ul class='m-0 p-3'><li class='px-md-3'><span class='topdeals-text'>" +
            days +
            '</span><p class="topdeals-text border-primary border-top">Days</p></li>  <li class="px-md-3"><span class="topdeals-text">' +
            hours +
            '</span><p class="topdeals-text border-primary border-top">Hours</p></li> <li class="px-md-3"><span class="topdeals-text">' +
            minutes +
            '</span><p class="topdeals-text border-primary border-top">Minutes</p></li> <li class="px-md-3"><span class="topdeals-text">' +
            seconds +
            '</span><p class="topdeals-text border-primary border-top">Seconds</p></li></ul>';

          document.getElementById("countdown").innerHTML = html;
        }
      } else {
        var nowdate = new Date().toLocaleString("en-US", {
          timeZone: time_zone
        });
        var now = new Date(nowdate);
        var month = now.getMonth() + 1;
        var date = now.getDate();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        if (date < 10) {
          date = "0" + date;
        }
        if (month < 10) {
          month = "0" + month;
        }
        if (hours < 10) {
          hours = "0" + hours;
        }
        if (minutes < 10) {
          minutes = "0" + minutes;
        }
        if (seconds < 10) {
          seconds = "0" + seconds;
        }
        var current_date = now.getFullYear() + "-" + month + "-" + date;
        var current_time = hours + ":" + minutes + ":" + seconds;
        if (deal_type == 1) {
          if (current_date == enddate) {
            if (current_time == endtime) {
              window.location.href = siteurl;
            }
          }
        } else {
          if (current_time == endtime) {
            window.location.href = siteurl;
          }
        }
      }
    }, 1000);
  })();
});
