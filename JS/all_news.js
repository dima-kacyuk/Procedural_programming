$(function() {

    function viewNews(searchParam) {
  
      $.ajax({
  
        url: 'http://localhost/ics.odessa/search_news.php',
  
        type: 'POST',
  
        dataType: "json",
  
        data: {
  
          searchParameter : searchParam
  
        },
  
        success: function(response) {
  
          console.log(response);
  
          if (response.check == 1) {
  
            $('#view_news').html(response.html);
  
          }
  
          $('#news-search-info').css({"color":"red"});
  
          $("#news-search-info").html(response.message);
  
        },
  
        error: function() {
  
          alert('News Search Error');
  
        }
  
      });
  
    }
  
      $("#news_search").on("keyup change", function() {
  
          var newsTitleFragment = $("#news_search").val();
  
          viewNews(newsTitleFragment);
  
      });
  
    $(document).ready(function() {
  
      viewNews("");
  
    })
  
  })