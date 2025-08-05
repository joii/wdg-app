$('.form-register').validate({
        rules: {
            firstname:{
                required: true,
            },
            lastname:{
                required: true,
            },
            phone:{
                required: true,
                number: true,
                minlength:10,
            },
            // email:{
            //     required: true,
            //     email: true
            // },
            password:{
                required: true,
                minlength:8,
            },
            password2:{
                required: true,
                equalTo: "#password1"
            },
            conditions:{
                required: true,
            }
        },
        messages:{
            firstname:{
                required:"กรุณากรอกชื่อ(ตามบัตรประชาชน)",
            },
            lastname:{
                required: "กรุณากรอกนามสกุล(ตามบัตรประชาชน)",
            },
            phone:{
                required: "กรุณากรอกเบอร์โทรติดต่อ",
                number:"กรุณากรอกเบอร์โทรเป็นตัวเลขเท่านั้น!",
                minlength:'กรุณากรอกเบอร์โทรติดต่อให้ถูกต้อง!',
            },
            // email:{
            //     required: "กรุณากรอกอีเมล์",
            //     email: "กรุณากรอกอีเมล์ให้ถูกต้อง!",
            // },
            password:{
                required:"โปรดกรอกรหัสผ่าน",
                minlength:'รหัสผ่านความยาวอย่างน้อย 8 ตัวอักษร',
                // pwcheck:"กรุณากรอกรหัสผ่านให้ถูกต้อง!",
            },
            password2:{
                required:"โปรดยืนยันรหัสผ่าน",
                equalTo:"รหัสผ่านไม่ตรงกัน",
            },
            conditions:{
                required:"",
            }
        }
    });
