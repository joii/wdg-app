<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BankAccountController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\FacebookPixelController;
use App\Http\Controllers\Backend\FAQCategoryController;
use App\Http\Controllers\Backend\FaqsController;
use App\Http\Controllers\Backend\GoldPriceController;
use App\Http\Controllers\Backend\GoogleAnalyticController;
use App\Http\Controllers\Backend\GoogleTagManagerController;
use App\Http\Controllers\Backend\InterestRateController;
use App\Http\Controllers\Backend\MemberManagementController;
use App\Http\Controllers\Backend\OpenGraphMetaTagsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MetaTagController;
use App\Http\Controllers\Backend\PawnAddController;
use App\Http\Controllers\Backend\PawnOnlineTransactionController;
use App\Http\Controllers\Backend\PawnTransactionController;
use App\Http\Controllers\Backend\PromotionManagementController;
use App\Http\Controllers\Backend\ReportsController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\BranchController as FrontendBranchController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PawnOnlineController;
use App\Http\Controllers\Frontend\PromotionsController;
use App\Http\Controllers\Frontend\SimulatorController;
use App\Http\Controllers\Frontend\FAQController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\WebAPI\PawnInterestController;
use App\Http\Controllers\WebAPI\GoldPriceAPIController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Artisan;
// Route::get('/', function () {
//     return view('frontend.home');

// });

// Frontend : Homepage Route
Route::get('/', [HomeController::class, 'Index'])->name('homepage');

// All Member/Customer Route

Route::middleware('member')->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'memberDashboard'])->name('member.member_dashboard');
    Route::post('/member/check_pawn_transaction', [MemberController::class, 'checkPawnTransaction'])->name('member.check_pawn_transaction');
    Route::post('/member/confirm-customer', [MemberController::class, 'customerConfirmation'])->name('member.customer_confirmation');
    Route::get('/member/profile', [MemberController::class, 'memberProfile'])->name('member.member_profile');
});

// Frontend : Contract Route
Route::middleware('member')->group(function () {
    Route::get('/customer/contract/{pawn_barcode}', [FrontendCustomerController::class, 'Contract'])->name('customer.contract');
    Route::get('/customer/consignment_detail/{pawn_barcode}', [FrontendCustomerController::class, 'consignmentDetail'])->name('customer.consignment_detail');

});


// Frontend : Customer Transaction Route
Route::middleware('member')->group(function () {
    Route::get('/customer/transaction', [PawnOnlineController::class, 'TransactionHistory'])->name('customer.transaction_history');
    Route::get('/customer/transaction_history/{transaction_type}', [PawnOnlineController::class, 'FilterTransactionHistory'])->name('customer.transaction_history.filter');
    // Route::get('/customer/transaction/detail/{transaction_id}', [PawnOnlineController::class, 'TransactionDetail'])->name('customer.transaction_detail');
    // Route::get('/customer/transaction/cancel/{transaction_id}', [PawnOnlineController::class, 'CancelPawnTransaction'])->name('customer.transaction.cancel');

});

// Frontend : Pawn Interest Route
Route::middleware('member')->group(function () {
    Route::get('/customer/interest/{pawn_barcode}', [PawnOnlineController::class, 'PawnInterest'])->name('customer.pawn_interest');
    Route::post('/customer/interest/pay_interest/payment', [PawnOnlineController::class, 'PayInterest'])->name('customer.interest.pay_interest');
    Route::post('/customer/interest/pay_interest/store_payment', [PawnOnlineController::class, 'StorePayInterest'])->name('customer.interest.payment.store');
});

// Frontend : Pawn Add (Increase) Route
Route::middleware('member')->group(function () {
    Route::get('/customer/pawn_add/{pawn_barcode}', [PawnOnlineController::class, 'PawnAdd'])->name('customer.pawn_add');
    Route::post('/customer/pawn_add/check_outstanding_interest', [PawnOnlineController::class, 'PawnAddCheckOutstandingInterest'])->name('customer.pawn_add.check_outstanding');
    Route::post('/customer/interest/pay_outstanding', [PawnOnlineController::class, 'PayOutstandingInterest'])->name('customer.interest.pay_outstanding');
    Route::post('/customer/interest/pay_outstanding/confirm_payment', [PawnOnlineController::class, 'ConfirmPayOutstandingInterest'])->name('customer.outstanding-interest.comfirm_payment');
    Route::post('/customer/interest/pay_outstanding/store_payment', [PawnOnlineController::class, 'StorePayOutstandingInterest'])->name('customer.outstanding-interest.payment.store');
    Route::post('/customer/interest/confirm_increase_principle', [PawnOnlineController::class, 'ConfirmIncreasePrinciple'])->name('customer.interest.comfirm_increase_principle');
    Route::post('/customer/pawn_add/increase_principle', [PawnOnlineController::class, 'IncreasePrinciple'])->name('customer.increase_principle');

});

// Frontend : Pawn Decrease Route
Route::middleware('member')->group(function () {
    Route::get('/customer/pawn_decrease/{pawn_barcode}', [PawnOnlineController::class, 'PawnDecrease'])->name('customer.pawn_decrease');
    Route::post('/customer/decrease/pay_outstanding', [PawnOnlineController::class, 'PayOutstandingInterest2'])->name('customer.decrease_principle.pay_outstanding');
     Route::post('/customer/decrease/confirm_decrease_principle', [PawnOnlineController::class, 'ConfirmDecreasePrinciple'])->name('customer.decrease_principle.confirm_decrease_principle');
    Route::post('/customer/decrease/decrease_principle', [PawnOnlineController::class, 'DecreasePrinciple'])->name('customer.decrease_principle');
    Route::post('/customer/decrease/decrease_principle_payment', [PawnOnlineController::class, 'PayDecreasePrinciple'])->name('customer.pay_decrease_principle');
});

// Frontend : Auth Route
Route::get('/member/login', [AuthController::class, 'showLoginForm'])->name('member.login');
Route::post('/member/login', [AuthController::class, 'Login'])->name('member.login.attempt');
Route::get('/member/logout', [AuthController::class, 'Logout'])->name('member.logout');
Route::get('/member/register', [AuthController::class, 'showRegisterForm'])->name('member.register');
Route::post('/member/register-submit', [AuthController::class, 'Register'])->name('member.register.submit');

// All Frontend Route
//Route::get('/estimate_price/simulator', [AuthController::class, 'showLoginForm'])->name('member.login');
// Route::get('/estimate_price/simulator', function () {
//     return view('frontend.estimate_price_simulator');
// });

// Simulator Routes
Route::get('/estimate_price/simulator', [SimulatorController::class, 'Index'])->name('simulator.index');

Route::get('/faqs', [FAQController::class, 'FaqList'])->name('frontend.faq_list');

Route::get('/contactus', function () {
    return view('frontend.contact');
});

Route::get('/policy', function () {
    return view('frontend.policy');
});

Route::get('/branch', [FrontendBranchController::class, 'BranchList'])->name('frontend.branch_list');

Route::get('/promotions', [PromotionsController::class, 'PromotionsList'])->name('frontend.promotions');
Route::get('/promotions/detail/{id}/{slug}', [PromotionsController::class, 'PromotionDetail'])->name('frontend.promotion.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::middleware('auth','role:admin')->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
// });


Route::get('/export/pawn_interest', [PawnInterestController::class, 'exportPawnInterestData'])->name('export.pawn_interest');


// Admin Route
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'AdminLoginSubmit'])->name('admin.login_submit');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('admin.forget_password');
Route::post('/admin/password_submit', [AdminController::class, 'AdminPasswordSubmit'])->name('admin.password_submit');
Route::get('/admin/reset_password/{token}/{email}', [AdminController::class, 'AdminResetPassword'])->name('admin.reset_password');
Route::post('/admin/reset_password_submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('admin.reset_password_submit');


// Admin Middleware
Route::middleware('admin')->group(function () {

    // Admin Dashboard Route
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    // Backend : Meta Tags Route
    Route::get('/backend/metatags', [MetaTagController::class, 'Index'])->name('backend.metatags.index');
    Route::post('/backend/metatags_store', [MetaTagController::class, 'MetaTagStore'])->name('backend.metatags.store');

    // Backend : GTM Route
    Route::get('/backend/gtm', [GoogleTagManagerController::class, 'Index'])->name('backend.gtm.index');
    Route::post('/backend/gtm_store', [GoogleTagManagerController::class, 'GTMStore'])->name('backend.gtm.store');

    // Backend : GA Route
    Route::get('/backend/ga', [GoogleAnalyticController::class, 'Index'])->name('backend.ga.index');
    Route::post('/backend/ga_store', [GoogleAnalyticController::class, 'GAStore'])->name('backend.ga.store');

    // Backend : FacebookPixel Route
    Route::get('/backend/facebook_pixel',[FacebookPixelController::class,'Index'])->name('backend.facebook_pixel.index');
    Route::get('/backend/facebook_pixel/create',[FacebookPixelController::class,'Create'])->name('backend.facebook_pixel.create');
    Route::post('/backend/facebook_pixel/store', [FacebookPixelController::class, 'Store'])->name('backend.facebook_pixel.store');
    Route::get('/backend/facebook_pixel/edit/{id}',[FacebookPixelController::class,'Edit'])->name('backend.facebook_pixel.edit');
    Route::post('/backend/facebook_pixel/update', [FacebookPixelController::class, 'Update'])->name('backend.facebook_pixel.update');
    Route::get('/backend/facebook_pixel/destroy/{id}',[FacebookPixelController::class,'Destroy'])->name('backend.facebook_pixel.destroy');


    // Backend : Open Graph Meta Tags Route
    Route::get('/backend/og_meta_tag',[OpenGraphMetaTagsController::class,'Index'])->name('backend.og_meta_tag.index');
    Route::get('/backend/og_meta_tag/create',[OpenGraphMetaTagsController::class,'Create'])->name('backend.og_meta_tag.create');
    Route::post('/backend/og_meta_tag/store', [OpenGraphMetaTagsController::class, 'Store'])->name('backend.og_meta_tag.store');
    Route::get('/backend/og_meta_tag/edit/{id}',[OpenGraphMetaTagsController::class,'Edit'])->name('backend.og_meta_tag.edit');
    Route::post('/backend/og_meta_tag/update', [OpenGraphMetaTagsController::class, 'Update'])->name('backend.og_meta_tag.update');
    Route::get('/backend/og_meta_tag/destroy/{id}',[OpenGraphMetaTagsController::class,'Destroy'])->name('backend.og_meta_tag.destroy');


    // Backend : Branch Route
    Route::get('/backend/branch',[BranchController::class,'Index'])->name('backend.branch.index');
    Route::get('/backend/branch/create',[BranchController::class,'Create'])->name('backend.branch.create');
    Route::post('/backend/branch/store', [BranchController::class, 'Store'])->name('backend.branch.store');
    Route::get('/backend/branch/edit/{id}',[BranchController::class,'Edit'])->name('backend.branch.edit');
    Route::post('/backend/branch/update', [BranchController::class, 'Update'])->name('backend.branch.update');
    Route::get('/backend/branch/destroy/{id}',[BranchController::class,'Destroy'])->name('backend.branch.destroy');

    // Backend : Interest Rate Route
    Route::get('/backend/interest_rate',[InterestRateController::class,'Index'])->name('backend.interest_rate.index');
    Route::get('/backend/interest_rate/create',[InterestRateController::class,'Create'])->name('backend.interest_rate.create');
    Route::post('/backend/interest_rate/store', [InterestRateController::class, 'Store'])->name('backend.interest_rate.store');
    Route::get('/backend/interest_rate/edit/{id}',[InterestRateController::class,'Edit'])->name('backend.interest_rate.edit');
    Route::post('/backend/interest_rate/update', [InterestRateController::class, 'Update'])->name('backend.interest_rate.update');
    Route::get('/backend/interest_rate/destroy/{id}',[InterestRateController::class,'Destroy'])->name('backend.interest_rate.destroy');


    // Backend : Bank Account Route
    Route::get('/backend/bank_account',[BankAccountController::class,'Index'])->name('backend.bank_account.index');
    Route::get('/backend/bank_account/create',[BankAccountController::class,'Create'])->name('backend.bank_account.create');
    Route::post('/backend/bank_account/store', [BankAccountController::class, 'Store'])->name('backend.bank_account.store');
    Route::get('/backend/bank_account/edit/{id}',[BankAccountController::class,'Edit'])->name('backend.bank_account.edit');
    Route::post('/backend/bank_account/update', [BankAccountController::class, 'Update'])->name('backend.bank_account.update');
    Route::get('/backend/bank_account/destroy/{id}',[BankAccountController::class,'Destroy'])->name('backend.bank_account.destroy');

    // Backend : FAQ Category Route
    Route::get('/backend/faq_category',[FAQCategoryController::class,'Index'])->name('backend.faq_category.index');
    Route::get('/backend/faq_category/create',[FAQCategoryController::class,'Create'])->name('backend.faq_category.create');
    Route::post('/backend/faq_category/store', [FAQCategoryController::class, 'Store'])->name('backend.faq_category.store');
    Route::get('/backend/faq_category/edit/{id}',[FAQCategoryController::class,'Edit'])->name('backend.faq_category.edit');
    Route::post('/backend/faq_category/update', [FAQCategoryController::class, 'Update'])->name('backend.faq_category.update');
    Route::get('/backend/faq_category/destroy/{id}',[FAQCategoryController::class,'Destroy'])->name('backend.faq_category.destroy');

    // Backend : FAQ Route
    Route::get('/backend/faqs',[FaqsController::class,'Index'])->name('backend.faqs.index');
    Route::get('/backend/faqs/create',[FaqsController::class,'Create'])->name('backend.faqs.create');
    Route::post('/backend/faqs/store', [FaqsController::class, 'Store'])->name('backend.faqs.store');
    Route::get('/backend/faqs/edit/{id}',[FaqsController::class,'Edit'])->name('backend.faqs.edit');
    Route::post('/backend/faqsy/update', [FaqsController::class, 'Update'])->name('backend.faqs.update');
    Route::get('/backend/faqs/destroy/{id}',[FaqsController::class,'Destroy'])->name('backend.faqs.destroy');

    // Backend : Banner Route
    Route::get('/backend/banner',[BannerController::class,'Index'])->name('backend.banner.index');
    Route::get('/backend/banner/create',[BannerController::class,'Create'])->name('backend.banner.create');
    Route::post('/backend/banner/store', [BannerController::class, 'Store'])->name('backend.banner.store');
    Route::get('/backend/banner/edit/{id}',[BannerController::class,'Edit'])->name('backend.banner.edit');
    Route::post('/backend/banner/update', [BannerController::class, 'Update'])->name('backend.banner.update');
    Route::get('/backend/banner/destroy/{id}',[BannerController::class,'Destroy'])->name('backend.banner.destroy');


    // Backend : Promotion Route
    Route::get('/backend/promotions',[PromotionManagementController::class,'Index'])->name('backend.promotion.index');
    Route::get('/backend/promotion/create',[PromotionManagementController::class,'Create'])->name('backend.promotion.create');
    Route::post('/backend/promotion/store', [PromotionManagementController::class, 'Store'])->name('backend.promotion.store');
    Route::get('/backend/promotion/edit/{id}',[PromotionManagementController::class,'Edit'])->name('backend.promotion.edit');
    Route::post('/backend/promotion/update', [PromotionManagementController::class, 'Update'])->name('backend.promotion.update');
    Route::get('/backend/promotion/destroy/{id}',[PromotionManagementController::class,'Destroy'])->name('backend.promotion.destroy');


    // Backend : Gold Price Route
    Route::get('/backend/gold_price',[GoldPriceController::class,'Index'])->name('backend.gold_price.index');
    Route::get('/backend/gold_price/feed',[GoldPriceAPIController::class,'getGoldPriceFromThaiAPI'])->name('backend.gold_price.feed');


    // Backend : Pawn Transaction Route
    Route::get('/backend/pawn_transaction',[PawnTransactionController::class,'Index'])->name('backend.pawn_transaction.index');
    Route::get('/backend/pawn_transaction/latest',[PawnTransactionController::class,'Latest'])->name('backend.pawn_transaction.latest');
    Route::get('/backend/pawn_transaction/contract/{id}',[PawnTransactionController::class,'Contract'])->name('backend.pawn_transaction.contract');
    Route::get('/backend/pawn_transaction/print/{id}',[PawnTransactionController::class,'Print'])->name('backend.pawn_transaction.print');
    Route::get('/backend/pawn_transaction/detail/{id}',[PawnTransactionController::class,'Detail'])->name('backend.pawn_transaction.detail');
    Route::get('/backend/pawn_transaction/edit/{id}',[PawnTransactionController::class,'Edit'])->name('backend.pawn_transaction.edit');
    Route::post('/backend/pawn_transaction/update', [PawnTransactionController::class, 'Update'])->name('backend.pawn_transaction.update');
    Route::get('/backend/pawn_transaction/interest/{id}',[PawnTransactionController::class,'Interest'])->name('backend.pawn_transaction.pawn_interest');


    // Backend : Pawn Add Data Route
    Route::get('/backend/pawn_add',[PawnAddController::class,'Index'])->name('backend.pawn_add.index');
    Route::get('/backend/pawn_add_list/{pawn_barcode}',[PawnAddController::class,'PawnAddList'])->name('backend.pawn_add.pawn_add_list');


    // Backend : Report Route
    Route::get('/report/overview',[ReportsController::class,'OverviewReport'])->name('backend.reports.overview_report');
    Route::get('/report/pawn',[ReportsController::class,'PawnReport'])->name('backend.reports.pawn_report');
    Route::get('/report/send_interest',[ReportsController::class,'SendInterestReport'])->name('backend.reports.interest_report');
    Route::get('/report/outstanding_interest',[ReportsController::class,'OutstandingInterestReport'])->name('backend.reports.outstanding_interest_report');
    Route::get('/report/increase_principle',[ReportsController::class,'IncreasePrincipleReport'])->name('backend.reports.increase_principle_report');
    Route::get('/report/decrease_principle',[ReportsController::class,'DecreasePrincipleReport'])->name('backend.reports.decrease_principle_report');

    // Backend : Customers Route
    Route::get('/backend/customer',[CustomerController::class,'Index'])->name('backend.customer.index');
    Route::get('/backend/customer/latest',[CustomerController::class,'Latest'])->name('backend.customer.latest');
    Route::get('/backend/customer/detail/{id}',[CustomerController::class,'Detail'])->name('backend.customer.detail');


    // Backend : Interest Transaction Route
    Route::get('/backend/online_transaction/interest_list',[PawnOnlineTransactionController::class,'InterestTransactionList'])->name('backend.online_transaction.interest_list');
    Route::get('/backend/online_transaction/interest_contract/{pawn_barcode}',[PawnOnlineTransactionController::class,'InterestTransactionContract'])->name('backend.online_transaction.interest.contract');
    Route::get('/backend/online_transaction/interest_print/{pawn_barcode}',[PawnOnlineTransactionController::class,'InterestTransactionPrint'])->name('backend.online_transaction.interest.print');
    Route::get('/backend/online_transaction/interest_detail/{token_id}',[PawnOnlineTransactionController::class,'InterestTransactionDetail'])->name('backend.online_transaction.interest.detail');
    Route::get('/backend/online_transaction/interest_edit/{token_id}',[PawnOnlineTransactionController::class,'InterestTransactionEdit'])->name('backend.online_transaction.interest.edit');
    Route::post('/backend/online_transaction/interest_update', [PawnOnlineTransactionController::class, 'InterestTransactionUpdate'])->name('backend.online_transaction.interest.update');


    // Backend :  Redemption / Accrued Interest Transaction Route
    Route::get('/backend/online_transaction/accrued_interest_list',[PawnOnlineTransactionController::class,'AccruedInterestTransactionList'])->name('backend.online_transaction.accrued_interest_list');
    Route::get('/backend/online_transaction/accrued_contract/{pawn_barcode}',[PawnOnlineTransactionController::class,'AccruedInterestTransactionContract'])->name('backend.online_transaction.accrued_interest.contract');
    Route::get('/backend/online_transaction/accrued_print/{pawn_barcode}',[PawnOnlineTransactionController::class,'AccruedInterestTransactionPrint'])->name('backend.online_transaction.accrued_interest.print');
    Route::get('/backend/online_transaction/accrued_detail/{token_id}',[PawnOnlineTransactionController::class,'AccruedInterestTransactionDetail'])->name('backend.online_transaction.accrued_interest.detail');
    Route::get('/backend/online_transaction/accrued_edit/{token_id}',[PawnOnlineTransactionController::class,'AccruedInterestTransactionEdit'])->name('backend.online_transaction.accrued_interest.edit');
    Route::post('/backend/online_transaction/accrued_update', [PawnOnlineTransactionController::class, 'AccruedInterestTransactionUpdate'])->name('backend.online_transaction.accrued_interest.update');


    // Backend :  Increase Principle Transaction Route
    Route::get('/backend/online_transaction/increase_list',[PawnOnlineTransactionController::class,'IncreasePrincipleTransactionList'])->name('backend.online_transaction.increase_principle_list');
    Route::get('/backend/online_transaction/increase_contract/{pawn_barcode}',[PawnOnlineTransactionController::class,'IncreasePrincipleTransactionContract'])->name('backend.online_transaction.increase_principle.contract');
    Route::get('/backend/online_transaction/increase_print/{pawn_barcode}',[PawnOnlineTransactionController::class,'IncreasePrincipleTransactionPrint'])->name('backend.online_transaction.increase_principle.print');
    Route::get('/backend/online_transaction/increase_detail/{token_id}',[PawnOnlineTransactionController::class,'IncreasePrincipleTransactionDetail'])->name('backend.online_transaction.increase_principle.detail');
    Route::get('/backend/online_transaction/increase_edit/{token_id}',[PawnOnlineTransactionController::class,'IncreasePrincipleTransactionEdit'])->name('backend.online_transaction.increase_principle.edit');
    Route::post('/backend/online_transaction/increase_update', [PawnOnlineTransactionController::class, 'IncreasePrincipleTransactionUpdate'])->name('backend.online_transaction.increase_principle.update');

    // Backend :  Decrease Principle Transaction Route
    Route::get('/backend/online_transaction/decrease_list',[PawnOnlineTransactionController::class,'DecreasePrincipleTransactionList'])->name('backend.online_transaction.decrease_principle_list');
    Route::get('/backend/online_transaction/decrease_contract/{pawn_barcode}',[PawnOnlineTransactionController::class,'DecreasePrincipleTransactionContract'])->name('backend.online_transaction.decrease_principle.contract');
    Route::get('/backend/online_transaction/decrease_print/{pawn_barcode}',[PawnOnlineTransactionController::class,'DecreasePrincipleTransactionPrint'])->name('backend.online_transaction.decrease_principle.print');
    Route::get('/backend/online_transaction/decrease_detail/{token_id}',[PawnOnlineTransactionController::class,'DecreasePrincipleTransactionDetail'])->name('backend.online_transaction.decrease_principle.detail');
    Route::get('/backend/online_transaction/decrease_edit/{token_id}',[PawnOnlineTransactionController::class,'DecreasePrincipleTransactionEdit'])->name('backend.online_transaction.decrease_principle.edit');
    Route::post('/backend/online_transaction/decrease_update', [PawnOnlineTransactionController::class, 'DecreasePrincipleTransactionUpdate'])->name('backend.online_transaction.decrease_principle.update');

    // Backend :  Redemption Transaction Route
    Route::get('/backend/online_transaction/redemption_list',[PawnOnlineTransactionController::class,'RedemptionTransactionList'])->name('backend.online_transaction.redemption_list');
    Route::get('/backend/online_transaction/redemption_contract/{pawn_barcode}',[PawnOnlineTransactionController::class,'RedemptionTransactionContract'])->name('backend.online_transaction.redemption.contract');
    Route::get('/backend/online_transaction/redemption_print/{pawn_barcode}',[PawnOnlineTransactionController::class,'RedemptionTransactionPrint'])->name('backend.online_transaction.redemption.print');
    Route::get('/backend/online_transaction/redemption_detail/{token_id}',[PawnOnlineTransactionController::class,'RedemptionTransactionDetail'])->name('backend.online_transaction.redemption.detail');
    Route::get('/backend/online_transaction/redemption_edit/{token_id}',[PawnOnlineTransactionController::class,'RedemptionTransactionEdit'])->name('backend.online_transaction.redemption.edit');
    Route::post('/backend/online_transaction/redemption_update', [PawnOnlineTransactionController::class, 'RedemptionTransactionUpdate'])->name('backend.online_transaction.redemption.update');


     // Backend : Member Route
    Route::get('/backend/member',[MemberManagementController::class,'Index'])->name('backend.member.index');
    Route::get('/backend/member/latest',[MemberManagementController::class,'Latest'])->name('backend.member.latest');
    Route::get('/backend/member/detail/{id}',[MemberManagementController::class,'Detail'])->name('backend.member.detail');
    Route::get('/backend/member_register',[MemberManagementController::class,'Register'])->name('backend.member.register');
    Route::post('/backend/member_register/store',[MemberManagementController::class,'Store'])->name('backend.member.store');


    // Backend : Permission Route
    Route::get('/backend/authen/permission',[RoleController::class,'AllPermission'])->name('backend.authen.permission.all_permission');
    Route::get('/backend/authen/permission/create',[RoleController::class,'CreatePermission'])->name('backend.authen.permission.create');
    Route::post('/backend/authen/permission/store',[RoleController::class,'StorePermission'])->name('backend.authen.permission.store');
    Route::get('/backend/authen/permission/edit/{id}',[RoleController::class,'EditPermission'])->name('backend.authen.permission.edit');
    Route::post('/backend/authen/permission/update',[RoleController::class,'UpdatePermission'])->name('backend.authen.permission.update');
    Route::get('/backend/authen/permission/delete/{id}',[RoleController::class,'DestroyPermission'])->name('backend.authen.permission.destroy');
    //Route::get('/backend/authen/admins',[RoleController::class,'AllAdmins'])->name('backend.authen.all_admins');


     // Backend : Role Route
    Route::get('/backend/authen/role',[RoleController::class,'AllRole'])->name('backend.authen.role.all_role');
    Route::get('/backend/authen/role/create',[RoleController::class,'CreateRole'])->name('backend.authen.role.create');
    Route::post('/backend/authen/role/store',[RoleController::class,'StoreRole'])->name('backend.authen.role.store');
    Route::get('/backend/authen/role/edit/{id}',[RoleController::class,'EditRole'])->name('backend.authen.role.edit');
    Route::post('/backend/authen/role/update',[RoleController::class,'UpdateRole'])->name('backend.authen.role.update');
    Route::get('/backend/authen/role/delete/{id}',[RoleController::class,'DestroyRole'])->name('backend.authen.role.destroy');

      // Backend : Role Base Access Control Route : RBAC
    Route::get('/backend/authen/rbac',[RoleController::class,'AllRolePermission'])->name('backend.authen.rbac.all_rbac');
    Route::get('/backend/authen/rbac/create',[RoleController::class,'CreateRolePermission'])->name('backend.authen.rbac.create');
    Route::post('/backend/authen/rbac/store',[RoleController::class,'StoreRolePermission'])->name('backend.authen.rbac.store');
    Route::get('/backend/authen/rbac/edit/{id}',[RoleController::class,'EditRolePermission'])->name('backend.authen.rbac.edit');
    Route::post('/backend/authen/rbac/update',[RoleController::class,'UpdateRolePermission'])->name('backend.authen.rbac.update');
    Route::get('/backend/authen/rbac/delete/{id}',[RoleController::class,'DestroyRolePermission'])->name('backend.authen.rbac.destroy');


    // Backend : Admin Route :
    Route::get('/backend/authen/admin',[RoleController::class,'AllAdmins'])->name('backend.authen.admin.index');
    Route::get('/backend/authen/admin/create',[RoleController::class,'CreatAdmin'])->name('backend.authen.admin.create');
    Route::post('/backend/authen/admin/store',[RoleController::class,'StoreAdmin'])->name('backend.authen.admin.store');
    Route::get('/backend/authen/admin/edit/{id}',[RoleController::class,'EditAdmin'])->name('backend.authen.admin.edit');
    Route::post('/backend/authen/admin/update',[RoleController::class,'UpdateAdmin'])->name('backend.authen.admin.update');
    Route::get('/backend/authen/admin/delete/{id}',[RoleController::class,'DestroyAdmin'])->name('backend.authen.admin.destroy');

}); // End Admin Middleware



 // Batch : Feed Gold Price Route
Route::get('/backend/gold_price/feed',[GoldPriceAPIController::class,'getGoldPriceFromThaiAPI'])->name('backend.gold_price.feed');


// PHP Info Route (For Debugging Purpose)
 Route::get('/phpinfo', function () {
    phpinfo();
});

// Artisan Commands
Route::get('/clear-cache', function () {
   Artisan::call('cache:clear');
   Artisan::call('route:clear');

   return "Cache cleared successfully";
});

Route::get('/optimize', function () {
   Artisan::call('optimize');

   return "Optimize cleared successfully";
});




