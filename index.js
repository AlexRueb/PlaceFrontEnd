function updateCanvas(data){

}

function handlePixel(e){
  e.preventDefault();
  e.stopPropagation();
  e.stopImmediatePropagation();

  $.post({
    url: "pixel.php?a=update_pixel",
    data: {
      id: $(e.target).attr("db_id"),
      color: $(e.target).attr("color")
    },
    dataType: 'json'
  }).done(function(data){
    if(data.error){
      alert("Error: Failed to update pixel");
    } else {
      alert("Successfully updated pixel");
    }
  });
}

$(function(){
  $(".pixel").click(handlePixel);
});
