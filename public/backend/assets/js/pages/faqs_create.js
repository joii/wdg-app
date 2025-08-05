$(document).ready(function (){
    $('#myForm').validate({
        rules: {
            category_id: {
                required : true,
            },
            question: {
                required : true,
            },
            answer: {
                required : true,
            },


        },
        messages :{
            category_id: {
                required : 'กรุณาระบุหมวดหมู่',
            },
            question: {
                required : 'กรุณาระบุคำถาม',
            },
            answer: {
                required : 'กรุณาระบุคำตอบ',
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
