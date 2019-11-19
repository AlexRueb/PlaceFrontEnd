var last_update = Math.floor(Date.now() / 1000);

function updateCanvas(){
  //Update each pixel in canvas with new DB info
  $.get({
    url: "pixel.php?a=get_canvas&last_update="+last_update,
    dataType: 'json'
  }).done(function(data){
    last_update = Math.floor(Date.now() / 1000);
    if(data.canvas.length > 0)
    {
      // alert(JSON.stringify(data.canvas));
      jQuery.each(data.canvas, function(k, v){
        $(".pixel[x="+v['x']+"][y="+v['y']+"]").attr('color', v['color']).css('background-color', "#"+v['color']);
      });
    }
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
      x: $(e.target).attr("x"),
      y: $(e.target).attr("y"),
      last_update: Math.floor(Date.now() / 1000),
      color: color
    },
    dataType: 'json'
  }).done(function(data){
      if(data.error == 1)
      {
        alert("Error: "+data.msg);
        updateCanvas();
      }
      else
      {
        updateCanvas();
      }
    }
  );
}

$(function(){
  // Update canvas every 1 sec
  setInterval(updateCanvas, 15000);
  $(".pixel").click(handlePixel);
});
