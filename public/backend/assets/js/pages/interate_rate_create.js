$(document).ready(function (){
    $('#myForm').validate({
        rules: {
            branch_id: {
                required : true,
            },
            interest_rate: {
                required : true,
            },


        },
        messages :{
            branch_id: {
                required : 'กรุณาระบุสาขา',
            },
           interest_rate: {
                required : 'กรุณาระบุอัตราดอกเบี้ย',
            },


        },
        errorElement : 'span',
        errorPlacement: function (error,element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight : function(element, errorClass, validClass){
            $(element).addClass('is-invalid');
        },
        unhighlight : function(element, errorClass, validClass){
            $(element).removeClass('is-invalid');
        },
    });
});
