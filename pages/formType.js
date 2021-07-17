function DVD () {

  this.validateInputs = function(){
      return validateInputs(dvdAttributes);
  }

  this.popUp = function(){
      $('#dvd').show(200);
      hideBook();
      hideFurniture();
  }

  this.dataObj = function(obj){
      obj['size'] = $('#size').val();
  }

  this.cardInfo = function(details){
    console.log(`${details['size']}`);
    return `<p class="card-text text-center">size: `+ `${details['size']}` +`MB`;
  }

}

function Book() {

  this.validateInputs = function(){
      return validateInputs(bookAttributes);
  }

  this.popUp = function(){
      $('#book').show(200);
      hideDvd();
      hideFurniture();
  }

  this.dataObj = function(obj){
      obj['weight'] = $('#weight').val();
  }

  this.cardInfo = function(details){
    return `<p class="card-text text-center">weight: ${details['weight']}KG`;
  }
}

function Furniture(){

  this.validateInputs = function(){
      return validateInputs(furnitureAttributes);
  }

  this.popUp = function(){
      $('#furniture').show(200);
      hideDvd();
      hideBook();
  }

  this.dataObj = function(obj){
      obj['height'] = $('#height').val();
      obj['width'] = $('#width').val();
      obj['length'] = $('#length').val();
  }

  this.cardInfo = function(details){
      return `<p class="card-text text-center">dimensions: ${details['height']}*${details['width']}*${details['length']}`;
  }
}

function hideBook(){
  $('#book').hide();
  $("#weight").val('');
}

function hideDvd(){
  $('#dvd').hide();
  $("#size").val('');
}

function hideFurniture(){
  $('#furniture').hide();
  $("#height").val('');
  $("#width").val('');
  $("#length").val('');
}

window.formType = {
  DVD, Book, Furniture
}