$("#news_search").change(function() {

    var fioFrag = $("#news_search").val();

   $.ajax({

     // url: 'http://localhost/wordpresslocal/wp-admin/admin-ajax.php',
     url: 'http://localhost/ics.odessa/find_news.php',

     type: 'POST',

     dataType: "json",

     data: {

       searchParam : fioFrag

     },

     success: function(response) {

       console.log(response);

       if (response.check == 1) {

         $('#view_news').html(response.html);

       }

       $('#aco_info').css({"color":"red"});

       $("#aco_info").html(response.message);

       defineProfessors();

     },

     error: function() {

       alert('Professor Search Error');

     }

 });

});