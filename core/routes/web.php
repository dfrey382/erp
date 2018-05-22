<?php

Auth::routes();

Route::get('staff', 'Employee\LoginController@showLoginForm');
Route::POST('home' , 'Employee\LoginController@login')->name('employee');
Route::group(['middleware' => ['auth:employee']], function() {
    Route::post('/logout' , 'Employee\LoginController@logout')->name('employee.logout');
    Route::get('/home', 'EmployeeLoginController@index')->name('home');
    Route::get('user/task', 'TaskController@show')->name('user.task');
    Route::get('user/attendance', 'AttendanceController@create')->name('user.attendance');
    Route::get('user/award',"AwardController@userIndex" )->name('user.award');
    Route::get('user/notice','NoticeController@userIndex')->name('user.notice');
    Route::get('user/holiday','HolidayController@userIndex')->name('user.holiday');
    Route::get('user/payment','PayrollController@userIndex')->name('user.payment');

    Route::post('user/change-password','EmployeeController@saveResetPassword')->name('employee.change.password');
});

Route::get('/', 'AdminAuth\LoginController@showLoginForm')->name('login');
Route::get('/admin', 'AdminAuth\LoginController@showLoginForm')->name('login');
Route::get('admin/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login');

Route::group(['prefix' => 'admin'], function () {
    Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

    Route::get('/sale',"SalePointController@indexSale")->name('product.sale.index')->middleware('admin');
    Route::post('/get/product',"SalePointController@product_pass")->name('product.pass')->middleware('admin');
    Route::post('/get/product/detail',"SalePointController@productGet")->name('product.element.pass')->middleware('admin');
    Route::post('/sale/product',"SalePointController@saleProduct")->name('sale.product')->middleware('admin');

    Route::get('/stock/product/history', 'SalePointController@soldProductHistory')->name('sold.index')->middleware('admin');
    Route::get('/print/history/{invoice_id}', 'SalePointController@printHistory')->name('print.history.soldproduct')->middleware('admin');

    Route::get('/bank', 'BankAccountController@bankIndex')->name('bank.account.index')->middleware('admin');
    Route::post('/bank/store', 'BankAccountController@bankStore')->name('bank.account.store')->middleware('admin');
    Route::get('/bank/edit/{id}', 'BankAccountController@bankEdit')->name('edit.bank.account')->middleware('admin');
    Route::put('/bank/update/{id}', 'BankAccountController@bankUpdate')->name('bank.account.update')->middleware('admin');
    Route::get('/bank/delete/{id}', 'BankAccountController@bankDelete')->name('bank.acount.delete')->middleware('admin');

    Route::get('/bank/transaction', 'BankTransactionController@transactionIndex')->name('transaction.index')->middleware('admin');
    Route::post('/bank/balance/store', 'BankTransactionController@storeBalance')->name('save.bank.balance')->middleware('admin');
    Route::get('/transaction', 'BankTransactionController@indexTransaction')->name('expanse.transaction.index')->middleware('admin');
    Route::get('/add/transaction', 'BankTransactionController@createTransaction')->name('add.expense')->middleware('admin');
    Route::post('/expense/transaction', 'BankTransactionController@storeTransaction')->name('store.expense.transaction')->middleware('admin');
    Route::get('/expense/history', 'BankTransactionController@expenseHistory')->name('expense.history')->middleware('admin');
    Route::get('/transaction/{id}', 'BankTransactionController@transactionReport')->name('report.bank.wise.transaction')->middleware('admin');

    Route::get('/supplier', 'SupplyManagmentController@indexSupplier')->name('supplier.index')->middleware('admin');
    Route::post('/supplier/store', 'SupplyManagmentController@supplierStore')->name('store.supplier')->middleware('admin');
    Route::get('/supplier/delete/{id}', 'SupplyManagmentController@supplierDelete')->name('supplier.delete')->middleware('admin');
    Route::get('/supplier/edit/{id}', 'SupplyManagmentController@supplierEdit')->name('supplier.edit')->middleware('admin');
    Route::get('/supplier/item', 'SupplyManagmentController@supplierEditItemDelete')->name('supply.item.delete')->middleware('admin');
    Route::put('/supplier/update/{id}', 'SupplyManagmentController@supplierUpdate')->name('supplier.update')->middleware('admin');
    Route::get('/supply/management', 'SupplyManagmentController@suplyManIndex')->name('supply.management')->middleware('admin');
    Route::post('/item/pass', 'SupplyManagmentController@product_pass')->name('item.pass')->middleware('admin');
    Route::post('/supply/store', 'SupplyManagmentController@supplyStore')->name('store.supply.manage')->middleware('admin');
    Route::get('/supply/reports', 'SupplyManagmentController@supplyReports')->name('supply.reports')->middleware('admin');
    Route::get('/supply/supplier/{id}', 'SupplyManagmentController@supplyReportsWithSupplier')->name('supply.report.supplier')->middleware('admin');
    Route::get('/supply/{date}/{id}', 'SupplyManagmentController@supplyReportsWithDate')->name('supply.report.date')->middleware('admin');

    Route::get('add/personal/loan', 'PersonalManagementController@personalIndex')->name('personal.loan.index')->middleware('admin');
    Route::post('/personal/store', 'PersonalManagementController@personalLoanStore')->name('personal.loan.store')->middleware('admin');
    Route::get('/personal/loan', 'PersonalManagementController@personalLoanManage')->name('manage.loan')->middleware('admin');
    Route::get('/personal/loan/{id}', 'PersonalManagementController@personalEdit')->name('personal.loan.edit')->middleware('admin');
    Route::put('/personal/update/{id}', 'PersonalManagementController@personalUpdate')->name('update.personal.loan')->middleware('admin');

    Route::get('add/office/loan', 'OfficeLoanController@officeLoanAdd')->name('add.office.loan')->middleware('admin');
    Route::post('office/loan/store', 'OfficeLoanController@officeLoanStore')->name('office.loan.store')->middleware('admin');
    Route::get('office/loan/', 'OfficeLoanController@officeLoanIndex')->name('office.loan.manange')->middleware('admin');
    Route::get('office/loan/{id}', 'OfficeLoanController@officeLoanEdit')->name('office.loan.edit')->middleware('admin');
    Route::put('office/loan/update/{id}', 'OfficeLoanController@officeLoanUpdate')->name('update.office.loan')->middleware('admin');

    Route::get('add/purchase', 'PurchaseController@addPurchase')->name('add.purchase')->middleware('admin');
    Route::post('purchase/store', 'PurchaseController@storePurchase')->name('purchase.store')->middleware('admin');
    Route::get('purchase', 'PurchaseController@indexPurchase')->name('purchase.reports')->middleware('admin');
    Route::get('purchase/edit/{id}', 'PurchaseController@editPurchase')->name('purchase.edit')->middleware('admin');
    Route::put('purchase/update/{id}', 'PurchaseController@updatePurchase')->name('update.purchase')->middleware('admin');

    Route::get('/category',"CategoryController@indexCaregory")->name('product.catagory.index');
    Route::post('/category/store',"CategoryController@storeCaregory")->name('category.store');
    Route::put('/category/update/{id}',"CategoryController@updateCaregory")->name('category.update');
    Route::get('/category/delete/{id}',"CategoryController@deleteCaregory")->name('category.delete');

    Route::get('/customer/management', 'CutomerController@cuctomerIndex')->name('customer.index')->middleware('admin');
    Route::post('/customer/store', 'CutomerController@cuctomerStore')->name('customer.detail.store')->middleware('admin');
    Route::get('/customer/edit/{id}', 'CutomerController@cuctomerEdit')->name('customer.detail.edit')->middleware('admin');
    Route::put('/customer/update/{id}', 'CutomerController@cuctomerUpdate')->name('customer.update')->middleware('admin');
    Route::get('/customer/delete/{id}', 'CutomerController@cuctomerDelete')->name('customer.delete')->middleware('admin');

    Route::get('/customer/balance', 'CustomerBalanceController@customerBalanceIndex')->name('balance.index')->middleware('admin');
    Route::post('/customer/balance/store', 'CustomerBalanceController@customerBalanceStore')->name('customer.balance.store')->middleware('admin');

    Route::post('/store/warehouse', 'ProductController@storeWarehouse')->name('warehouse.store')->middleware('admin');
    Route::get('/delete/warehouse/{id}', 'ProductController@deleteWarehouse')->name('warehouse.delete')->middleware('admin');
    Route::put('/update/warehouse/{id}', 'ProductController@updateWarehouse')->name('warehouse.update')->middleware('admin');

    Route::post('/stock/product/store', 'ProductController@stockStoreProduct')->name('product.stock.store')->middleware('admin');
    Route::get('/stock/product/detail/{id}', 'ProductController@stockProductDetail')->name('product.detail.warehouse')->middleware('admin');

    Route::get('/products', 'ProductController@productIndex')->name('product.index')->middleware('admin');
    Route::post('/product/store', 'ProductController@productStore')->name('product.store')->middleware('admin');
    Route::get('/product/edit/{id}', 'ProductController@productEdit')->name('product.edit')->middleware('admin');
    Route::put('/product/update/{id}', 'ProductController@productUpdate')->name('product.update')->middleware('admin');
    Route::get('/product/delete/{id}', 'ProductController@productDelete')->name('product.delete')->middleware('admin');
    Route::get('/product/stock', 'ProductController@productStock')->name('product.stock')->middleware('admin');

    Route::get('office', 'OfficeDetailController@indexOffice')->name('office.index')->middleware('admin');
    Route::post('office/store', 'OfficeDetailController@storeOffice')->name('office.store')->middleware('admin');
    Route::get('office/edit/{id}', 'OfficeDetailController@editOffice')->name('office.update')->middleware('admin');
    Route::put('office/update/{id}', 'OfficeDetailController@updateOffice')->name('office.upadate')->middleware('admin');
    Route::get('office/delete/{id}', 'OfficeDetailController@destroyOffice')->name('office.delete')->middleware('admin');

    Route::get('delete/shift/{id}', 'FoodMillController@deleteShift')->name('delete.shift')->middleware('admin');

    Route::get('food/mill', 'FoodMillController@indexMill')->name('food.mill.index')->middleware('admin');
    Route::post('shift/store', 'FoodMillController@storeShift')->name('shift.store')->middleware('admin');
    Route::post('meal/store', 'FoodMillController@storeMeal')->name('meal.package.store')->middleware('admin');
    Route::get('package/edit/{id}', 'FoodMillController@editMeal')->name('meal.package.update')->middleware('admin');
    Route::put('package/update/{id}', 'FoodMillController@updateMeal')->name('package.meal.upadate')->middleware('admin');
    Route::get('package/delete/{id}', 'FoodMillController@destroyMeal')->name('meal.package.delete')->middleware('admin');
    Route::get('item/delete', 'FoodMillController@deleteItemMeal')->name('item.delete')->middleware('admin');

    Route::get('/catering/system', 'CateringController@cateringIndex')->name('catering.index')->middleware('admin');
    Route::get('/catering/view/{id}', 'CateringController@cateringEdit')->name('catering.edit')->middleware('admin');
    Route::get('/catering/add', 'CateringController@cateringCreate')->name('add.food.comapny')->middleware('admin');
    Route::put('/catering/update/{id}', 'CateringController@cateringUpdate')->name('catering.update')->middleware('admin');
    Route::get('/catering/report/{date}', 'CateringController@cateringReport')->name('show.detail.catring')->middleware('admin');

    Route::post('/send/invoice', 'CateringController@sendinvoice')->name('send.food,company')->middleware('admin');
    Route::get('/print/invoice/{id}', 'CateringController@printInvoice')->name('print.invoice')->middleware('admin');

    Route::get('account/catering', 'CateringController@officeAcountIndex')->name('catering.accounts.index')->middleware('admin');
    Route::get('account/paid/{id}', 'CateringController@officeAcountIndexPaid')->name('catering.paid')->middleware('admin');

    Route::get('payroll', 'PayrollController@index')->name('payroll.index')->middleware('admin');
    Route::post('payroll-count', 'PayrollController@count')->name('payroll.count')->middleware('admin');
    Route::get('payroll/chart', 'PayrollController@show')->name('payroll.chart')->middleware('admin');
    Route::post('payroll/salary/sheet', 'PayrollController@salarySheet')->name('salary.sheet')->middleware('admin');

    Route::post('payroll/payment-save', 'PayrollController@store')->name('payment.save')->middleware('admin');
    Route::get('payroll/payment-delete/{id}', 'PayrollController@destroy')->name('salary-chart.delete')->middleware('admin');

    Route::post('payroll/individual-salary', 'PayrollController@individualSalary')->name('individual-salary.search')->middleware('admin');

    Route::get('empployee/paid/{id}', 'PayrollController@employeePaid')->name('user.payment.get');

    Route::get('/accounts',"AccountController@index" )->name('account.index')->middleware('admin');
    Route::get('/account/income-expense',"AccountController@incomeExpense" )->name('income.expense')->middleware('admin');
    Route::post('/accounts-income-post', 'AccountController@incomeStore')->name('account.income')->middleware('admin');
    Route::post('/accounts-expense-post', 'AccountController@expenseStore')->name('account.expense')->middleware('admin');
    Route::get('/accounts/transaction', 'TransactionController@index')->name('trans.index')->middleware('admin');
    Route::post('/accounts/income-post', 'TransactionController@incomeStore')->name('income.post')->middleware('admin');
    Route::post('/accounts/expense-post', 'TransactionController@expenseStore')->name('expense.post')->middleware('admin');
    Route::put('/accounts/income-update/{id}', 'TransactionController@incomeUpdate')->name('income.update')->middleware('admin');
    Route::put('/accounts/expense/{id}', 'TransactionController@expenseUpdate')->name('expense.update')->middleware('admin');
    Route::get('/accounts/income-delete/{id}', 'TransactionController@incomeDestroy')->name('income.delete')->middleware('admin');
    Route::get('/accounts/expense-delete/{id}', 'TransactionController@expenseDestroy')->name('expense.delete')->middleware('admin');

    Route::post('/accounts/total-income', 'TransactionController@totalIncome')->name('income.search')->middleware('admin');
    Route::post('/accounts/total-expense', 'TransactionController@totalExpense')->name('expense.search')->middleware('admin');

    Route::get('/department',"DepartmentController@index" )->name('admin.department')->middleware('admin');
    Route::post('/department-post', 'DepartmentController@store')->name('department.post')->middleware('admin');
    Route::get('/department/delete/{id}', 'DepartmentController@destroy')->name('department.delete')->middleware('admin');
    Route::get('/department/edit/{id}', 'DepartmentController@edit')->name('department.edit')->middleware('admin');
    Route::put('/department/update/{id}', 'DepartmentController@update')->name('department.update')->middleware('admin');

    Route::get('department-delete', 'DepartmentController@deleteDeign')->name('dep-delete')->middleware('admin');

    Route::get('/employee','EmployeeController@index' )->name('employee.list')->middleware('admin');
    Route::get('/employee/add-employee','EmployeeController@create' )->name('employee.add')->middleware('admin');
    Route::get('/employee/edit-employee/{id}','EmployeeController@edit' )->name('employee.edit')->middleware('admin');
    Route::post('/employee/designation-pass','EmployeeController@designation_pass' )->name('designation.pass')->middleware('admin');
    Route::post('/employee-post','EmployeeController@store' )->name('employee.post')->middleware('admin');
    Route::get('/employee-delete/{id}','EmployeeController@destroy' )->name('employee.delete')->middleware('admin');
    Route::put('/employee-update/{id}','EmployeeController@personalDataUpdate' )->name('employee.update')->middleware('admin');
    Route::put('/employee-company-update/{id}','EmployeeController@companyditailUpdate' )->name('employee.company.update')->middleware('admin');
    Route::put('/employee-bank-update/{id}','EmployeeController@bankDetailUpdate' )->name('employee.bank.update')->middleware('admin');
    Route::put('/employee-document-update/{id}','EmployeeController@documentUpdate' )->name('employee.document.update')->middleware('admin');

    Route::get('/award',"AwardController@index" )->name('award.index')->middleware('admin');
    Route::get('/award/create',"AwardController@create" )->name('award.create')->middleware('admin');
    Route::get('/award/edit/{id}',"AwardController@edit" )->name('award.edit')->middleware('admin');
    Route::put('/award/update/{id}',"AwardController@update" )->name('award.update')->middleware('admin');
    Route::get('/award/delete/{id}',"AwardController@destroy" )->name('award.delete')->middleware('admin');
    Route::post('/award-post',"AwardController@store" )->name('award.post')->middleware('admin');

    Route::get('/notice',"NoticeController@index" )->name('notice.index')->middleware('admin');
    Route::get('/notice/create',"NoticeController@create" )->name('notice.add')->middleware('admin');
    Route::get('/notice/edit/{id}',"NoticeController@edit" )->name('notice.edit')->middleware('admin');
    Route::post('/notice-post',"NoticeController@store" )->name('notice.post')->middleware('admin');
    Route::put('/notice-update/{id}',"NoticeController@update" )->name('notice.update')->middleware('admin');
    Route::get('/notice-delete/{id}',"NoticeController@destroy" )->name('notice.delete')->middleware('admin');

    Route::get('/general',"GeneralController@index" )->name('general.index')->middleware('admin');
    Route::put('/general-update/{id}',"GeneralController@update" )->name('general.update')->middleware('admin');

    Route::get('/holidays', 'HolidayController@index')->name('holiday.index')->middleware('admin');
    Route::post('/holidays-post', 'HolidayController@store')->name('holiday.post')->middleware('admin');
    Route::get('/holidays-delete/{id}', 'HolidayController@destroy')->name('holiday.delete')->middleware('admin');
    Route::post('/holidays-pass', 'HolidayController@dateAjax')->name('holiday.pass');

    Route::get('employee/attendance', 'AttendanceController@index')->name('employee.attend')->middleware('admin');

    Route::post('attendance-post', 'AttendanceController@store')->name('attendance.post');
    Route::get('attendance-approve/{id}', 'AttendanceController@attendanceApprove')->name('approve.attend')->middleware('admin');
    Route::post('timezone', 'TimezoneController@changeTime')->name('timezone.pass')->middleware('admin');
    Route::post('timezone-update/{id}', 'TimezoneController@update')->name('timezone.update')->middleware('admin');

    Route::get('individual-attendance', 'AttendanceController@individualIndex')->name('employee.individual')->middleware('admin');
    Route::post('individual-attendance-search', 'AttendanceController@individualAttend')->name('attend.search')->middleware('admin');

    Route::get('employee/task', 'TaskController@index')->name('employee.task')->middleware('admin');
    Route::get('employee/task-add', 'TaskController@create')->name('task.add')->middleware('admin');
    Route::get('employee/task-delete/{id}', 'TaskController@destroy')->name('task.delete')->middleware('admin');
    Route::post('employee/task-post', 'TaskController@store')->name('task.post')->middleware('admin');
    Route::post('employee/task-employee', 'TaskController@employeeAdd')->name('employee.pass')->middleware('admin');

    Route::get('auto/attendance','CronController@autoAttendance')->name('auto.attendance')->middleware('admin');
    Route::get('/dashboard',"AdminController@index" )->name('admin.dashboard')->middleware('admin');
    Route::post('change-password','AdminController@saveResetPassword')->name('change.password');
   Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
   Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
   Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
   Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::get('pagenotfound', 'HomeController@pageNotFound')->name('pagenot.found');
