 const dvdAttributes = ['size'];
 const bookAttributes = ['weight'];
 const furnitureAttributes = ['height' , 'width' , 'length'];
 const productTypes = {
     'DVD': 1,
     'Furniture': 2,
     'Book': 3
 };

$(function(){
  $('#dvd').hide();
  $('#furniture').hide();
  $('#book').hide();
  
  $("#productType").change(function(event){
      let temp = event.target.value;
      if(temp === 'Type Switcher'){
        $('#dvd').hide();
        $('#furniture').hide();
        $('#book').hide();
      }else{
        var p = new window.formType[temp]();
        p.popUp();
      }
   });

   $('#product_form').submit(function(event) {
        event.preventDefault();
        let validator = validateForm();
        if(validator === 1){
            return false;
        }

        $.ajax({
            url : 'http://localhost/displayProducts',
            method: 'POST',
            data: dataObj(),
            success: function (data, status) {
               
            },
            error: function (data, status) {
                console.log(data, status)
            }
        }).then(response => {
             window.location.href = "http://localhost/"
        })

        return false;
   })
});

function validateForm(){
    let err = 0;
    let dropDownVal = $('#productType').val();
    const types = ['sku' , 'name' , 'price'];

    types.forEach(function(type){
        selector = $('#'+type).val();
        if(!selector){
            err = errorMsg(type);
        }else{
            err = successMsg(type);
        }
    });


    if(dropDownVal === 'Type Switcher'){
        err = errorMsg('switch');
    }else{
        var p = new window.formType[dropDownVal]();;
        err = p.validateInputs(err);
    }

    return err;
}

function validateInputs(types){
    var err = 0;
    types.forEach(function(type){
        selector = $('#'+type).val();
        if(!selector){
            err = errorMsg(type);
        }else{
            err = successMsg(type);
        }
    });
    return err;
}

function errorMsg(type){
    let err = 1;
    $('#'+type).next().css({"visibility": "visible"}).show(250);
    return err;
}

function successMsg(type){
    let err = 0;
    $('#'+type).next().css({"visibility": "hidden"}).hide(200);
    return err;
}

function dataObj(){
    let dropDownVal = $('#productType').val();
    let sk = $('#sku').val();
    let nam = $('#name').val();
    let pric = $('#price').val();
    let obj = {sku: sk , name: nam , price : pric};

    var p = new window.formType[dropDownVal]();
    p.dataObj(obj);
    
    obj['productTypeId'] = productTypes[dropDownVal];
    return obj;
}
