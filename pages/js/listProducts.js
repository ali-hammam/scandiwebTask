var glob;
const productTypes = {
  1: 'DVD',
  2: 'Furniture',
  3: 'Book',
};


$(function(){
      $.ajax({
        url: 'http://localhost/displayProducts',
        type: "GET",
        success: function (result) {
           
        },
        error: function () {
             console.log("error");
        }
      }).then(response => {
        glob = JSON.parse(response);
        formData(JSON.parse(response));
      });

    $('#delete').on('click' , ()=>{
      $.ajax({
        url: 'http://localhost/deleteProducts',
        type: 'POST',
        data: {'proudcts_id' : deleteCard()},
        success: function (result) {
          
        },
        error: function (data, status) {
          console.log(data, status)
        }
      }).then(response => {
        formData(glob);
      });
    });
});



function formData(resp){
  let data = resp["data"];
  document.getElementById('posts').innerHTML = '';
  
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
    document.getElementById('posts').appendChild(div);
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
  var selected = new Array();
  var tblFruits = document.getElementById("posts");
  var chks = tblFruits.getElementsByTagName("INPUT");
  for (var i = 0; i < chks.length; i++) {
    if (chks[i].checked) {
      selected.push(chks[i].value);
    }
  }

  deleteFromGlob(selected);
  return  selected;
}

function deleteFromGlob(selected){
  let data = glob['data'];
  for(let i = 0; i < selected.length; i++){
    for(let j = 0; j < data.length; j++){
      if(selected[i] == data[j]['products_id']){
        data.splice(j , 1);
      }
    }
  }
  glob['data'] = data;
}

