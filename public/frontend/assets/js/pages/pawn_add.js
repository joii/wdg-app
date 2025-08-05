function checkAccruedInterest(){
      $.ajax({
        url: '/customer/pawn_add/increase_principle',
        method: 'POST',
        data: {
            barcode: '{{ $pawn_data->pawn_barcode }}',
            amount_request: $('#amount_request').val(),
            _token: '{{ csrf_token() }}' // สำคัญมาก!
        },
        success: function(response) {
            alert(response.message);
        },
        error: function(err) {
            alert('เกิดข้อผิดพลาด');
        }
    });


}

function payOutstanding()
{

    $('#pay_outstanding').submit();
}

function updateAddAmount(val)
{
    $('#add_amount').val(val);
}

$(document).ready(function() {
    $("#amount_request").change(function() {
      var selectedValue = $(this).val();
      $("#add_amount").val(selectedValue);
    });
  });
