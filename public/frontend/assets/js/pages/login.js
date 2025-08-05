$('.form-login').validate({
        rules: {

            user:{
                required: true,
                number: true,
                minlength:10,
            },

            password:{
                required: true,
                minlength:8,
            },

        },
        messages:{

            user:{
                required: "กรุณากรอกเบอร์โทรติดต่อ",
                number:"กรุณากรอกเบอร์โทรเป็นตัวเลขเท่านั้น!",
                minlength:'กรุณากรอกเบอร์โทรติดต่อให้ถูกต้อง!',
            },

            password:{
                required:"โปรดกรอกรหัสผ่าน",
                minlength:'รหัสผ่านความยาวอย่างน้อย 8 ตัวอักษร',
                // pwcheck:"กรุณากรอกรหัสผ่านให้ถูกต้อง!",
            },

        }
    });
