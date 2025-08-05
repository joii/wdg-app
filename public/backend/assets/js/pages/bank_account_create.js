$(document).ready(function (){
    $('#myForm').validate({
        rules: {
            branch_id: {
                required : true,
            },
            bank_account_name: {
                required : true,
            },
            bank_account_no: {
                required : true,
            },

        },
        messages :{
            branch_id: {
                required : 'กรุณาระบุสาขา',
            },
            bank_account_name: {
                required : 'กรุณาระบุชื่อบัญชี',
            },
            bank_account_no: {
                required : 'กรุณาระบุเลขที่บัญชี',
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
