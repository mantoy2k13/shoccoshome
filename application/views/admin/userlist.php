<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar-->
   <?php $this->load->view('admin/admin-nav');?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php $this->load->view('admin/topbar');?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-list"></i> </h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary">
                  <div class="panel-heading bg-blue">
                    <i class="fa fa-list"></i><span> User Lists</span>
                  </div>
                  <div class="table-responsive">
                      <table class="table table-striped" id="datatables">
                          <thead>
                            <tr>
                              <th scope="col">Full Name</th>
                              <th scope="col">Occupation</th>
                              <th scope="col">Mobile #</th>
                              <th scope="col">Address</th>
                              <th scope="col">Zip Code</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if($get_all_userlist){?>
                              <?php foreach($get_all_userlist as $userlist){?>
                                <tr>
                                    <td><?=$userlist->fullname; ?></td>
                                    <td><?=$userlist->occupation; ?></td>
                                    <td><?=$userlist->mobile_number; ?></td>
                                    <td><?=substr($userlist->complete_address,0,50); ?></td>
                                    <td><?=$userlist->zip_code; ?></td>
                                    <td><div class="btn-group">
                                          <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
                                          <ul class="dropdown-menu">
                                            <li><a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a></li>
                                            <li><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></li>
                                          </ul>
                                        </div>
                                  </td>
                                </tr>
                              <?php }?>
                            <?php }?>
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>
          
       
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website <?=date('Y');?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- JS File -->
  <?php $this->load->view('common/adminjs')?>
</body>

</html>
