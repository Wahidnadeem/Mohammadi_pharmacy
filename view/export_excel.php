<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">

    <title>خروجی اکسل</title>
  </head>
  <body>
      <style>
          body {
          font-family: vazir;
          background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
        }
      </style>
    <h1 class="ms-5 me-5 rounded mt-4 p-3 bg-dark text-white" style="font-family:lalezar">خروجی اکسل</h1>

    <div class="container">
        <div class="row">

        
            <div class="col-xl-12 mt-4">
                    <div class="shadow rounded bg-white p-4">
                        
                        <div class="row mt-2">
                            <h5 class="text-start lalezar text-muted mb-3 ms-3">گزارش </h5>
                            <div class="col-12">
                                <form method="post" action="" class="row" enctype="multipart/form-data">
                                    <input type="hidden" name="search" value="1">
                                   
                                    <div class="col-xs-12 col-md-6 col-lg-2 mb-3">
                                        <label for="exampleInputPassword1" class="form-label text-muted">از پول</label>
                                        <select class="form-control" name="search_currecny_from_id" data-placeholder="انتخاب ارز">
                                            <option  value="" >پول را انتخاب کنید</option>
                                                <option value="1"> 2 </option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-2 mb-3">
                                        <label for="exampleInputPassword1" class="form-label text-muted">به پول</label>
                                        <select class="form-control" name="search_currecny_to_id" data-placeholder="انتخاب ارز">
                                    <option  value="" >پول را انتخاب کنید</option>
                                        <option value="1"> 2 </option>
                                </select>                              </div>
                                    <div class="col-xs-12 col-md-6 col-lg-3 mb-3">
                                        <label for="exampleInputPassword1" class="form-label text-muted">از تاریخ</label>
                                        <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control date">
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-3 mb-3">
                                        <label for="exampleInputPassword1" class="form-label text-muted">الی تاریخ</label>
                                        <input type="text" name="end_date" id="end_date" autocomplete="off" class="form-control date">
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-2 mb-3">
                                        <div class="text-white pt-2 ">s</div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-info btn-block border p-2"> جستجو</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                    </div>
            </div>
         </div>
    </div>
         <!--  -->
         <div class="container pt-5">
    	<div class="card">
    		<div class="card-header">
    			<div class="row">
                    <div class="col col-md-6">تیبل اطلاعات</div>
    				<div class="col col-md-6 text-end">
    					<button type="button" id="export_button" class="btn btn-success btn-sm">خروجی ایکسل</button>
    				</div>
    			</div>
    		</div>
    		<div class="card-body">
    			<table id="employee_data" class="table table-striped table-bordered ">
                    <tr>
                        <th>شماره</th>
                        <th>اسم</th>
                        <th>ساخت</th>
                        <th>قیمت</th>
                        <th>تاریخ</th>
                    </tr>
                
                        <tr>
                            <td>1</td>
                            <td>پاراسیتامل</td>
                            <td>هند</td>
                            <td>20</td>
                            <td>22/10/03</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>پاراسیتامل</td>
                            <td>ایران</td>
                            <td>30</td>
                            <td>22/10/03</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>پارا</td>
                            <td>ترکیه</td>
                            <td>40</td>
                            <td>22/10/03</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>سیتامل</td>
                            <td>هند</td>
                            <td>50</td>
                            <td>22/10/03</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>پاراسیتامل</td>
                            <td>هند</td>
                            <td>60</td>
                            <td>22/10/03</td>
                        </tr>
                       
                  
                </table>
    		</div>
    	</div>
    </div>

  <script src="../assets/xlsx.js"></script>
  <script>
    
        function html_table_to_excel(type)
        {
            var data = document.getElementById('employee_data');

            var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

            XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

            XLSX.writeFile(file, 'file.' + type);
        }

        const export_button = document.getElementById('export_button');

        export_button.addEventListener('click', () =>  {
            html_table_to_excel('xlsx');
    });

    </script>
</body>

</html>
