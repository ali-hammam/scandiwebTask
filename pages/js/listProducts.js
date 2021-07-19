var products;
const productTypes = {
  1: 'DVD',
  2: 'Furniture',
  3: 'Book',
};


$(function(){
      $.ajax({
        url: 'http://localhost/displayProducts',
        type: "GET",
        error: function () {
             console.log("error");
        }
      }).then(response => {
        let parsedResponse = JSON.parse(response);
        products = parsedResponse['data'];
        formData(products);
      });

    $('#delete').on('click' , ()=>{
      $.ajax({
        url: 'http://localhost/deleteProducts',
        type: 'POST',
        data: {'proudcts_id' : deleteCard()},
        error: function (data, status) {
          console.log(data, status)
        }
      }).then(() => {
        formData(products);
      });
    });
});



function formData(data){
  document.getElementById('cards').innerHTML = '';
  
  for(let i = 0; i < data.length; i++){
    var div = document.createElement('div');
    div.setAttribute('class', 'col-lg-3 col-md-6 col-sm-12');
    var output  = cardInitialization(data[i]['products_id']);

    for(let row in data[i]){
      if(row == 'products_id' || row == 'products_productstype_id')
        continue;

      if(row == 'products_details'){
        let details = JSON.parse(data[i]["products_details"]);
        
        details = details.reduce(function(acc, val) {
          return Object.assign(acc, val);
        },{});

        var p = new window.formType[productTypes[data[i]['products_productstype_id']]]();
        output +=p.cardInfo(details);

        continue;
      }

      output +=`<p class="card-text text-center">${data[i][row]}`
      
      if(row == 'products_price'){
        output += '$';
      }

      output +=`</p>`;
    }
    output +=` </div>
          </div>
        </div>
        `;
    div.innerHTML = output;
    document.getElementById('cards').appendChild(div);
  }
}

function cardInitialization(id){
  return  `
  <div class="card bg-light mb-3" style="max-width: 18rem;">
    <div class="card-body">
      <div class="col-12">
        <input type="checkbox" class="form-check-input delete-checkbox" id="defaultCheck1" value = "${id}">
      </div>
      <div class="p-1">`;
}

function deleteCard(){
  let selected = new Array();
  let cards = document.getElementById("cards");
  let inputs = cards.getElementsByTagName("INPUT");
  for (let i = 0; i < inputs.length; i++) {
     if (inputs[i].checked) {
      selected.push(inputs[i].value); 
    }
   }

  deleteFromProducts(selected);
  return  selected;
}

function deleteFromProducts(selected){
  for(let i = 0; i < selected.length; i++){
    for(let j = 0; j < products.length; j++){
      if(selected[i] == products[j]['products_id']){
        products.splice(j , 1);
      }
    }
  }
}

