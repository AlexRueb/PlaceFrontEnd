function updateCanvas(data){

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
  }).done(function(data){
    if(data.error){
      alert("Error: Failed to update pixel");
    } else {
      alert("Successfully updated pixel");
    }
  });
  location.reload();
}

$(function(){
  $(".pixel").click(handlePixel);
});
