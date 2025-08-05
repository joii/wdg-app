$(document).ready(function (){
    $('#myForm').validate({
        rules: {
            name: {
                required : true,
            },
            location: {
                required : true,
            },
            phone: {
                required : true,
            },
            latitude: {
                required : true,
            },
            longitude: {
                required : true,
            },


        },
        messages :{
            name: {
                required : 'กรุณาระบุชื่อสาขา',
            },
            location: {
                required : 'กรุณาระบุที่ตั้ง',
            },
            phone: {
                required : 'กรุณาระบุเบอร์ติดต่อ',
            },
            latitude: {
                required : 'กรุณาระบุค่าละติจูด',
            },
            longitude: {
                required : 'กรุณาระบุค่าลองจิจูด',
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