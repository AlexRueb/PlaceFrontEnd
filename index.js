function updateCanvas(){
  //Update each pixel in canvas with new DB info
  $.get({
    url: "pixel.php?a=get_canvas",
    dataType: 'json'
  }).done(function(data){
    $(".pixel").each(function(index){
      // Set each pixels color to new data
      $(this).attr('color', data.canvas[index].color);
      $(this).css('background-color', "#"+data.canvas[index].color);
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
    }
  );
}

$(function(){
  // Update canvas every 1 sec
  setInterval(updateCanvas, 1000);
  $(".pixel").click(handlePixel);
});
