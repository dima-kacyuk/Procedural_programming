$(function () {

$(".news_read").click(function() {

    var newsid = $(this).attr('id');

    console.log(newsid);

   $.ajax({

     url: 'http://localhost/ics.odessa/read_news.php',

     type: 'POST',

     dataType: "json",

     data: {

       readNewsId : newsid

     },

     success: function(response) {

       console.log(response);

       if (response.check == 1) {

        $('#modal').html(response.html);

       }

       $('#aco_info').css({"color":"red"});

       $("#aco_info").html(response.message);

     },

     error: function() {

       alert('Read News Error');

     }

 });

});

})