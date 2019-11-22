var last_update = Math.floor(Date.now() / 1000);
var last_pixel = 0;

function updateCanvas(){
  //Update each pixel in canvas with new DB info
  $.get({
    url: "pixel.php?a=get_canvas&last_update="+(last_update - 1),
    dataType: 'json'
  }).done(function(data){
    last_update = Math.floor(Date.now() / 1000);
    if(data.canvas.length > 0)
    {
      // alert(JSON.stringify(data.canvas));
      jQuery.each(data.canvas, function(k, v){
        $(".pixel[x="+v['x']+"][y="+v['y']+"]").attr('color', v['color']).css('background-color', v['color']);
      });
    }
  });
}

function handlePixel(e){
  e.preventDefault();
  e.stopPropagation();
  e.stopImmediatePropagation();

  console.log("Updating pixel ("+$(e.target).attr('x')+", "+$(e.target).attr('y')+")");

  // If last pixel placed was greater than 10 seconds ago or no pixel placed
  if(Math.floor(Date.now() / 1000) > (last_pixel + 10) || last_pixel == 0)
  {
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
          last_pixel = Math.floor(Date.now() / 1000);
          updateCanvas();
        }
      }
    );
  }
  else
  {
    alert("Error: you must wait 10 seconds to place another pixel");
  }
}

const inv = (hex) => '#' + hex.match(/[a-f0-9]{2}/ig).map(e => (255 - parseInt(e, 16) | 0).toString(16).replace(/^([a-f0-9])$/, '0$1')).join('');

$(function(){
  $(".pixel").hover(function(e){
      // On pixel hoverIn, change color to selected color
      // On hover, set color to inverted color
      // $(this).css("background-color", $("#colorChoice").val());
      $(this).css("border", "2px solid "+inv($(this).attr("color")));
    },
    function(e){
      // On pixel hoverOut, change color back to previous color
      $(this).css("border", "none");
    }
  );

  // On load, hide loading spinner and show pixel canvas
  $(".loading_spinner").addClass("slideOutDown").css("display", "none");
  $(".pixelCanvas").addClass("animated fadeIn slow");

  // Update canvas every 1 sec
  setInterval(updateCanvas, 5000);
  $(".pixel").click(handlePixel);
});
