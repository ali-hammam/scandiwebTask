 const dvdAttributes = ['size'];
 const bookAttributes = ['weight'];
 const furnitureAttributes = ['height' , 'width' , 'length'];
 const fixedAttributes = ['sku' , 'name' , 'price'];
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
        var p = new window.formType[temp]();
        p.popUp();
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
            error: function (data, status) {
                console.log(data, status)
            }
        }).then(() => {
            window.location.href = "http://localhost/";
        })

        return false;
   })
});

function validateForm(){
    let err = 0;
    let productTypeDropDownName = $('#productType').val();

    fixedAttributes.forEach(function(type){
        selector = $('#'+type).val();
        if(!selector){
            err = errorMsg(type);
        }else{
            err = successMsg(type);
        }
    });
    
    err = getProductTypeClassInstance(productTypeDropDownName).validateInputs(err);
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
    let productTypeDropDownName = $('#productType').val();
    const obj = {};
    
    fixedAttributes.forEach(type => {
        obj[type] = $('#'+type).val();
    });
    
    obj['details'] = getProductTypeClassInstance(productTypeDropDownName).dataObj();
    obj['productTypeId'] = productTypes[productTypeDropDownName];
    console.log(obj);
    return obj;
}

function getProductTypeClassInstance(productTypeName){
    let productTypeClass = window.formType[productTypeName];
    return new productTypeClass();
}

