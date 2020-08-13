$(function() {

  function viewProfessors(searchParam) {

    $.ajax({

      url: 'http://localhost/ics.odessa/search_professors.php',

      type: 'POST',

      dataType: "json",

      data: {

        searchParameter : searchParam

      },

      success: function(response) {

        console.log(response);

        if (response.check == 1) {

          $('#view_professors').html(response.html);

        }

        $('#professors-search-info').css({"color":"red"});

        $("#professors-search-info").html(response.message);

      },

      error: function() {

        alert('Professors Search Error');

      }

    });

  }

	$("input[name=professor_search]").on("keyup change", function() {

		var professorFullNameFragment = $(this).val();

		viewProfessors(professorFullNameFragment);

	});

  $(document).ready(function() {

    viewProfessors("");

  })

})