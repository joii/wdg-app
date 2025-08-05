$('#customer_confirm').click(function() {
    $.ajax({
        url: '/member/confirm-customer',
        method: 'POST',
        data: {
            id: '{{ $profileData->id }}',
            key: '{{ $key }}',
            _token: '{{ csrf_token() }}' // สำคัญมาก!
        },
        success: function(response) {
            alert(response.message);
        },
        error: function(err) {
            alert('เกิดข้อผิดพลาด');
        }
    });
});
