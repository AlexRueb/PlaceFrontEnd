function updateCanvas(){
  //Update each pixel in canvas with new DB info
  $.get({
    url: "pixel.php?a=get_canvas",
    dataType: 'json'
  }).done(function(data){
    var i = 0;
    $(".pixel").each(function(index){
      // Set each pixels color to new data
      $(this).attr('color', data.canvas[i].color);
      $(this).css('background-color', "#"+data.canvas[i].color);
      i++;
    });
  });
}

function handlePixel(e){
  e.preventDefault();
  e.stopPropagation();
  e.stopImmediatePropagation();

  var color;
  color = $("#colorChoice").val().substr(1);

  $.post({
    url: "pixel.php?a=update_pixel",
    data: {
      id: $(e.target).attr("db_id"),
      color: color
    },
    dataType: 'json'
  }).done(
    function(data){
      updateCanvas();
    //   if(data.error){
    //     alert("Error: Failed to update pixel");
    //   } else {
    //     alert("Successfully updated pixel");
    //   }
    }
  );
}

$(function(){
  $(".pixel").click(handlePixel);
});
