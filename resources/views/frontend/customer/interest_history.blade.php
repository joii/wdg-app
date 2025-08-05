@extends('frontend.master')
@section('content')
    <div class="section section-form pt-0">
        <div class="container">
<div class="card">
                <div class="boxed" style="--width:500px">
                    <div class="d-block pt-md-2 mt-md-2">
                        <h3>ประวัติการทำรายการ</h3>
                    </div>

                    <div class="buttons interest py-4 my-sm-2">
                        <a href="{{ route('customer.transaction_history.filter','add') }}" class="btn " >
                            ต่อดอก
                        </a>
                        <a href="{{ route('customer.transaction_history.filter','acc') }}" class="btn ">
                            ส่งดอก
                        </a>
                        <a href="{{ route('customer.transaction_history.filter','inc') }}"  class="btn ">
                            ลดเงินต้น
                        </a>
                        <a href="{{ route('customer.transaction_history.filter','dec') }}" class="btn ">
                           เพิ่มเงินต้น
                        </a>
                    </div>


                    <div class="row gy-3 pt-2">
                        @foreach ($transactions as $item )
                         @php
                            switch ($item->payment_status) {
                                case 'pending':
                                    $status = 'รอดำเนินการ';
                                    $status_class = 'status text-yellow';
                                    break;
                                case 'approved':
                                    $status = 'อนุมัติแล้ว';
                                    $status_class = 'status text-green';
                                    break;
                                case 'rejected':
                                    $status = 'ไม่อนุมัติ';
                                    $status_class = 'status text-red';
                                    break;
                                default:
                                    $status = 'รอดำเนินการ';
                                    $status_class = 'status text-yellow';
                                    break;
                            }

                            switch ($item->transaction_type) {
                                case 'add':
                                    $transaction_type = 'ต่อดอก';
                                    break;
                                case 'inc':
                                     $transaction_type = 'เพิ่มเงินต้น';
                                    break;
                                case 'dec':
                                    $transaction_type = 'ลดเงินต้น';
                                    break;
                                case 'acc':
                                    $transaction_type = 'ส่งดอก';
                                    break;
                                case 'wdr':
                                    $transaction_type = 'ไถ่ถอน';
                                    break;
                                default:
                                    $transaction_type = '-';
                                    break;
                            }
                        @endphp
                         <div class="col-12">
                            <div class="card card-border p-3 p-sm-4">
                                <div class="card-header d-flex">
                                    <h3>
                                        ลำดับที่ : {{ \Carbon\Carbon::parse($item->transition_date)->thaidate('y') }}{{sprintf('%05d', $item->id) }}
                                    </h3>

                                    <div class="{{ $status_class }}">
                                       {{$status}} <span class="circle"></span>
                                    </div>
                                </div>
                                <table class="table-data">
                                    <tr>
                                        <th style="width: 45%;">ประเภทธุรกรรม :</th>
                                        <td>{{ $transaction_type }}</td>
                                    </tr>

                                    <tr>
                                        <th>วันที่ทำรายการ :</th>
                                        <td>{{ \Carbon\Carbon::parse($item->transaction_date)->thaidate('j F Y') }}</td>
                                    </tr>

                                    <tr>
                                        <th>รหัสเอกสาร : </th>
                                        <td> {{ $item->transaction_code }}</td>
                                    </tr>

                                    <tr>
                                        <th>สัญญาเลขที่ : </th>
                                        <td>{{ \Carbon\Carbon::parse($item->transition_date)->thaidate('y') }}{{sprintf('%05d', $item->pawn_id) }}</td>
                                    </tr>

                                    <tr>
                                        <th>รหัสบาร์โค้ด : </th>
                                        <td> {{ $item->pawn_barcode }}</td>
                                    </tr>

                                    <tr>
                                        <th>จำนวนเงิน :</th>
                                        <td>{{ number_format($item->payment_amount) }} บาท</td>
                                    </tr>
                                </table>
                            </div><!--card-->
                        </div>
                        @endforeach

                    </div><!--row-->

                    <div class="p-0 p-lg-5"></div>
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
