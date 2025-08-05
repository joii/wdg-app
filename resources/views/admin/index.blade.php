@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ภาพรวม</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">ภาพรวม</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">ฝากขายทอง</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $pawn_amount }}">0</span>
                                </h4>
                            </div>

                            <div class="col-6">
                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge {{ $pawn_difference <0?'bg-warning-subtle text-warning':'bg-success-subtle text-success' }}">{{ $pawn_difference }}</span>
                            <span class="ms-1 text-muted font-size-13">เดือนพฤษภาคม</span>
                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">ต่อดอก</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="62580">0</span>
                                </h4>
                            </div>
                            <div class="col-6">
                                <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge {{ $interest_difference <0?'bg-warning-subtle text-warning':'bg-success-subtle text-success' }}">{{ $interest_difference }}</span>
                            <span class="ms-1 text-muted font-size-13">เดือนพฤษภาคม</span>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col-->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">เพิ่มเงินต้น</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $increase_amount }}">0</span>
                                </h4>
                            </div>
                            <div class="col-6">
                                <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            {{-- <span class="badge bg-success-subtle text-success">{{ $increase_amount }}</span> --}}
                            <span class="ms-1 text-muted font-size-13">เดือนพฤษภาคม</span>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">ลดเงินต้น</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $decrease_amount }}">0</span>
                                </h4>
                            </div>
                            <div class="col-6">
                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            {{-- <span class="badge bg-success-subtle text-success">{{ $decrease_amount }}</span> --}}
                            <span class="ms-1 text-muted font-size-13">เดือนพฤษภาคม</span>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row-->



        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">รายการฝากขายล่าสุด</h4>
                        <div class="flex-shrink-0">
                            <select class="form-select form-select-sm mb-0 my-n1">
                                <option value="Today" selected="">วันนี้</option>
                                <option value="Yesterday">เมื่อวาน</option>
                                <option value="Week">สัปดาห์ล่าสุด</option>
                                <option value="Month">เดือนล่าสุด</option>
                            </select>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body px-0">
                        <div class="px-3" data-simplebar style="max-height: 352px;">
                            <ul class="list-unstyled activity-wid mb-0">

                                @foreach ($pawn_data as $item )
                                <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                        <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">{{ \Carbon\Carbon::parse($item->pawn_date)->thaidate('j F Y') }}</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68{{ $item->pawn_id }}</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : {{ $item->pawn_barcode }}</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <h6 class="mb-1">{{ $item->remarks }} หนัก {{ $item->total_weight }} กรัม</h6>
                                                <div class="font-size-13">{{ number_format($item->total_pawn_amount) }}</div>
                                                <div class="font-size-13">{{ $item->customer_name }}</div>
                                            </div>

                                            <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('backend.pawn_transaction.contract',$item->id) }}" target="_blank">หนังสือสัญญา</a>
                                                        <a class="dropdown-item" href="#">ลูกค้า</a>
                                                        <a class="dropdown-item" href="#">รายการที่เกี่ยวข้อง</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{ route('backend.pawn_transaction.detail',$item->id) }}">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach



                                {{-- <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title  bg-primary-subtle text-primary rounded-circle">
                                            <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2568, 17:30:00</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68300871</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : AHEWGJ972</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <h6 class="mb-1">คาร์เทียร์ หนัก 15.17 กรัม</h6>
                                                <div class="font-size-13">39,500.00</div>
                                                <div class="font-size-13">เมธา โภควรรณวิทย์</div>
                                            </div>

                                            <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">หนังสือสัญญา</a>
                                                        <a class="dropdown-item" href="#">ลูกค้า</a>
                                                        <a class="dropdown-item" href="#">รายการที่เกี่ยวข้อง</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                            <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2568, 17:30:0</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68300872</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : AHEWGJ973</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <h6 class="mb-1">*โซ่กล่องตัน* หนัก 7.59 กรัม</h6>
                                                <div class="font-size-13">15,000.00</div>
                                                <div class="font-size-13">นาย กณิศนันท์ สัมภาวะผล</div>
                                            </div>

                                            <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">หนังสือสัญญา</a>
                                                        <a class="dropdown-item" href="#">ลูกค้า</a>
                                                        <a class="dropdown-item" href="#">รายการที่เกี่ยวข้อง</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title  bg-primary-subtle text-primary rounded-circle">
                                            <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2568, 17:30:0</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68300873</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : AHEWGJ974</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <h6 class="mb-1">*เบนซ์ทรงเครื่องลงยาแดง/หักลงยา 0.4G.* หนัก 7.6 กรัม</h6>
                                                <div class="font-size-13">18,000.00</div>
                                                <div class="font-size-13">น.ส.เบญจวรรณ  คงคาพันธ์</div>
                                            </div>



                                            <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">หนังสือสัญญา</a>
                                                        <a class="dropdown-item" href="#">ลูกค้า</a>
                                                        <a class="dropdown-item" href="#">รายการที่เกี่ยวข้อง</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                            <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2568, 17:30:0</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68300874</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : AHEWGJ975</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <h6 class="mb-1">แฟนซีหัวใจก้านคู่  **บุบ เบี้ยว** Ausiris หนัก 15.2 กรัม</h6>
                                                <div class="font-size-13">39,500.00</div>
                                                <div class="font-size-13">นาย ปรีชา รัตนกุล</div>
                                            </div>

                                            <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">หนังสือสัญญา</a>
                                                        <a class="dropdown-item" href="#">ลูกค้า</a>
                                                        <a class="dropdown-item" href="#">รายการที่เกี่ยวข้อง</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="activity-list">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title  bg-primary-subtle text-primary rounded-circle">
                                            <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2568, 17:30:0</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68300875</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : AHEWGJ976</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <h6 class="mb-1">*เปียโบว์/เบี้ยว อมแป้ง* หนัก 7.6 กรัม</h6>
                                                <div class="font-size-13">8,000.00</div>
                                                <div class="font-size-13">นาย กิตติพจน์  คำผุย</div>
                                            </div>

                                            <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">หนังสือสัญญา</a>
                                                        <a class="dropdown-item" href="#">ลูกค้า</a>
                                                        <a class="dropdown-item" href="#">รายการที่เกี่ยวข้อง</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                <!-- card -->
                <div class="card bg-primary text-white shadow-primary card-h-100">
                    <!-- card body -->
                    <div class="card-body p-0">
                        <div id="carouselExampleCaptions" class="carousel slide text-center widget-carousel" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item">
                                    <div class="text-center p-4">
                                        <div class="avatar-md m-auto">
                                            <span class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                                                <i class="fas fa-question-circle"></i>
                                            </span>
                                        </div>
                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>รับแจ้งปัญหาหรือร้องเรียน</b></h4>
                                        <p>ต่อดอกไม่ได้ </p>
                                        <p class="text-white-50 font-size-13">ธนพล  คงสกุล</p>
                                        <p class="text-white-50 font-size-13">1 นาทีที่แล้ว</p>
                                        <button type="button" class="btn btn-light btn-sm">ดูรายละเอียด <i class="mdi mdi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                                <!-- end carousel-item -->
                                <div class="carousel-item">
                                    <div class="text-center p-4">
                                        <div class="avatar-md m-auto">
                                            <span class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                                                <i class="fas fa-question-circle"></i>
                                            </span>
                                        </div>
                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>รับแจ้งปัญหาหรือร้องเรียน</b></h4>
                                        <p>ยังไม่ได้รับเงินโอน</p>
                                        <p class="text-white-50 font-size-13">อภิชัย ภูเหล่าม่วง</p>
                                        <p class="text-white-50 font-size-13">2 ชั่วโมงที่แล้ว</p>
                                        <button type="button" class="btn btn-light btn-sm">ดูรายละเอียด <i class="mdi mdi-arrow-right ms-1"></i></button>
                         </div>
                                </div>
                                <!-- end carousel-item -->
                                <div class="carousel-item active">
                                    <div class="text-center p-4">
                                        <div class="avatar-md m-auto">
                                            <span class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                                                <i class="fas fa-question-circle"></i>
                                            </span>
                                        </div>
                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>รับแจ้งปัญหาหรือร้องเรียน</b></h4>
                                        <p>จะไถ่ถอนต้องทำยังไง</p>
                                        <p class="text-white-50 font-size-13">ปวีณา พูดเพราะ</p>
                                        <p class="text-white-50 font-size-13">1 พฤษภาคม 2568</p>
                                        <button type="button" class="btn btn-light btn-sm">ดูรายละเอียด <i class="mdi mdi-arrow-right ms-1"></i></button>
                         </div>
                                </div>
                                <!-- end carousel-item -->
                            </div>
                            <!-- end carousel-inner -->

                            <div class="carousel-indicators carousel-indicators-rounded">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
                            </div>
                            <!-- end carousel-indicators -->
                        </div>
                        <!-- end carousel -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div><!-- end row -->


    </div>
    <!-- container-fluid -->
</div>
@endsection
