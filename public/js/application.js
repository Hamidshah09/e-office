jQuery(document).ready(function (){
    jQuery("[name=cnic]").keyup(function (){
        validateCnic(jQuery(this));
    });

    jQuery("[name=contact]").keyup(function (){
        validateContact(jQuery(this));
    });

    //console.log(jQuery("form#application-form")[0]);
    /*jQuery("form#application-form").submit(function (){
        alert("Error exist");
        if(jQuery("select.input-error, input.input-error, textarea.input-error", this).length > 0){
            return false;
        }
        window.setTimeout(function () {
            document.getElementById('application-form').reset();
        }, 2000)
        return true;

    })*/
});

function validateCnic(obj){
    var value = obj.val();
    if(isNaN(value)){
        obj.addClass('input-error');
        obj.attr("title", "Digits only");
    }
    else if(value.length != 13){
        obj.addClass('input-error');
        obj.attr("title", "Enter 13 digits");
    }
    else {
        obj.removeClass('input-error');
    }
}

function validateContact(obj){
    var value = obj.val();
    if(isNaN(value)){
        obj.addClass('input-error');
        obj.attr("title", "Digits only");
    }
    else if(value.length != 11){
        obj.addClass('input-error');
        obj.attr("title", "Enter 11 digits");
    }
    else {
        obj.removeClass('input-error');
    }
}

class Validator{

    constructor(){

    }

    name(obj){

        var value = obj.val();
        var pattern = /[^a-zA-Z\s\-]/;
        var invalid = pattern.test(value);
        if(invalid){
            this.message = "Please enter alphabets, space and dashes";
            //return false;
        }
        return !invalid;
    }

    datepicker(obj){

        //console.log(obj);
        console.log(obj.val());
        var pieces = [];
        var dateVal = obj.val();
        var selectedDate;


        //pieces = dateVal.split("/");

        //dateVal = pieces[1] + "/" + pieces[0] + "/" + pieces[2];
        //console.log(dateVal);
        selectedDate = new Date(dateVal);
        //console.log(selectedDate);
        if(selectedDate.toString() == "Invalid Date"){
            this.message = 'invalid date';
            return false;
        }
        else {
            return true;
        }

        return valid;
    }

    required(obj){
        if(obj.val() == ""){
            this.message = "This is required field";
            return false;
        }
        return true;
    }

    getMessage(){
        return this.message;
    }

    cnic(obj){
        if(isNaN(obj.val())){
            this.message = "Only digits are allowed in CNIC";
            return false;
        }
        if(obj.val().length < 13){
            this.message = "Invalid CNIC number";
            return false;
        }

        return true;
    }

    phone(obj){
        if(isNaN(obj.val())){
            this.message = "Only digits are allowed in contact number";
            return false;
        }
        if(obj.val().length < 11){
            this.message = "Invalid contact number";
            return false;
        }

        return true;
    }

    alphaNum(obj){
        var value = obj.val();
        var pattern = /^[a-zA-Z0-9\s]+$/;
        var valid = pattern.test(value);
        //console.log(invalid);
        if(!valid){
            this.message = "Please enter Alpha Numberic characters and space";
            return false;
        }
        return true;

    }

    limit(obj, range){
        let value = obj.val();

        if(value.length < range[0] || value.length > range[1]){
            this.message = "Number of characters should be between " + range[0] + " and " + range[1];
           // console.log(this.message);
            return false;
        }
        return true;
    }
}

class Application{

    constructor(elements){
        this.elements = elements;
        this.validator = new Validator();
    }

    validate(){
        var obj, rules, validated = true, errors;

        for(var element in this.elements) {
            obj = jQuery(element);

            //console.log(element + obj);

            obj.removeAttr("title");
            obj.closest('.form-group').removeClass("has-error");

            if(obj.length == 0){
                continue;
            }

           // console.log(obj.attr("name"));
          //  console.log(this.elements[element].rules);
            for(var rule in this.elements[element].rules){

                if(!this.validator[this.elements[element].rules[rule]](obj, this.elements[element].params[rule])){

                     //   console.log(this.elements[element].rules[rule]);

                    obj.closest('.form-group').addClass("has-error");
                    obj.attr("title", this.validator.getMessage());
                    validated = validated && false;
                }
            }
        }

        //console.log(validated);
        errors = jQuery('.form-group.has-error input, .form-group.has-error textarea, .form-group.has-error select');
        if(errors.length > 0){
            errors[0].focus();
        }
        return validated;
    }
}

var validation = {
    "[name=first_name]": {"rules":["name","required", "limit"], "params":[null,null,[3,60]]},
 //   "[name=last_name]": {"rules":["name","required","limit"], "params":[null,null,[3,60]]},
   // "[name=father_name]": {"rules":["name","required", "limit"], "params":[null,null,[3,60]]},
    "[name=gender_id]": {"rules":["required"], "params":[null]},
   // "[name=date_of_birth]": {"rules":["required", "datepicker"], "params":[null]},
    "[name=contact]": {"rules":["phone","required", "limit"], "params":[null,null,[11,11]]},
   // "[name=cnic]": {"rules":["cnic","required", "limit"], "params":[null,null,[13,13]]},
    //"[name=place_of_birth]": {"rules":["alphaNum","required", "limit"], "params":[null,null,[3,60]]},
    "#permanentAddress": {"rules":["required", "limit"], "params":[null,[10,180]]}
}
