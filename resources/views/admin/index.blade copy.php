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
                                    <span class="counter-value" data-target="120000.00">0</span>
                                </h4>
                            </div>

                            <div class="col-6">
                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge bg-warning-subtle text-warning">-12,850</span>
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
                            <span class="badge bg-success-subtle text-success">+2,850</span>
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
                                    <span class="counter-value" data-target="350000.00">0</span>
                                </h4>
                            </div>
                            <div class="col-6">
                                <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge bg-success-subtle text-success">+12,850</span>
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
                                    <span class="counter-value" data-target="45600.00">0</span>
                                </h4>
                            </div>
                            <div class="col-6">
                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge bg-success-subtle text-success">+12,850</span>
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
                        <h4 class="card-title mb-0 flex-grow-1">รายการล่าสุด</h4>
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

                                <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                        <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2021, 17:30:00</h5>
                                                <p class="text-truncate text-muted font-size-13">สัญญาเลขที่ :	68300870</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end me-3">
                                                <h6 class="mb-1">รหัสบาร์โค้ด : AHEWGJ971 </h6>
                                                <div class="font-size-13">12,000.00</div>
                                                <div class="font-size-13">อนุสรา  ภูชื่นแสง</div>
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
                                            <i class="fas fa-file-invoice-dollar font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                <p class="text-truncate text-muted font-size-13">สัญญาเลขที่ :	68300872</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end me-3">
                                                <h6 class="mb-1">รหัสบาร์โค้ด : AHEWGJ973 </h6>
                                                <div class="font-size-13">170.00</div>
                                                <div class="font-size-13">ปิยเทพ สวัสดี</div>
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
                                        <i class="bx bx-sort-up font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                <p class="text-truncate text-muted font-size-13">สัญญาเลขที่ :	6700003</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end me-3">
                                                <h6 class="mb-1">รหัสบาร์โค้ด : BGTEKBDUMM </h6>
                                                <div class="font-size-13">10,000.00</div>
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
                                        <i class="bx bx-sort-down font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                <p class="text-truncate text-muted font-size-13">สัญญาเลขที่ :	6700004</p>

                                            </div>
                                            <div class="flex-shrink-0 text-end me-3">
                                                <h6 class="mb-1">รหัสบาร์โค้ด : BGTEKBDUMM </h6>
                                                <div class="font-size-13">5,000.00</div>
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
                                        <i class="fas fa-file-invoice-dollar font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                <p class="text-truncate text-muted font-size-13">สัญญาเลขที่ :	6700005</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end me-3">
                                                <h6 class="mb-1">รหัสบาร์โค้ด : BGTEKBDUMM </h6>
                                                <div class="font-size-13">200.00</div>
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
                                        <i class="fas fa-file-invoice-dollar font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                <p class="text-truncate text-muted font-size-13">สัญญาเลขที่ :	6700006</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end me-3">
                                                <h6 class="mb-1">รหัสบาร์โค้ด : BGTEKBDUMM </h6>
                                                <div class="font-size-13">200.00</div>
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
                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>แจ้งปัญหา</b></h4>
                                        <p class="text-white-50 font-size-13">ต่อดอกไม่ได้ </p>
                                        <button type="button" class="btn btn-light btn-sm">View details <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>แจ้งปัญหา</b></h4>
                                        <p class="text-white-50 font-size-13">ไม่ได้รับเงินโอน </p>
                                        <button type="button" class="btn btn-light btn-sm">View details <i class="mdi mdi-arrow-right ms-1"></i></button>
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
                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>แจ้งปัญหา</b></h4>
                                        <p class="text-white-50 font-size-13">โอนเงินชำระดอกเบี้ยไม่ได้</p>
                                        <button type="button" class="btn btn-light btn-sm">View details <i class="mdi mdi-arrow-right ms-1"></i></button>
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