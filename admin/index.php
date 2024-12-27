<?php
include_once 'components/header.php';
include_once 'components/navbar.php';
include_once 'components/sidebar.php';
?>

<div class="content-body">
  <!-- row -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="card dashboardCard">
          <div class="stat-widget-two card-body">
            <div class="stat-content">
              <div class="stat-text">Today Expenses</div>
              <div class="stat-digit"><i class="fa fa-usd"></i>8500</div>
            </div>
            <div class="progress">
              <div
                class="progress-bar progress-bar-success w-85"
                role="progressbar"
                aria-valuenow="85"
                aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card dashboardCard">
          <div class="stat-widget-two card-body">
            <div class="stat-content">
              <div class="stat-text">Income Detail</div>
              <div class="stat-digit"><i class="fa fa-usd"></i>7800</div>
            </div>
            <div class="progress">
              <div
                class="progress-bar progress-bar-primary w-75"
                role="progressbar"
                aria-valuenow="78"
                aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card dashboardCard">
          <div class="stat-widget-two card-body">
            <div class="stat-content">
              <div class="stat-text">Task Completed</div>
              <div class="stat-digit"><i class="fa fa-usd"></i> 500</div>
            </div>
            <div class="progress">
              <div
                class="progress-bar progress-bar-warning w-50"
                role="progressbar"
                aria-valuenow="50"
                aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card dashboardCard">
          <div class="stat-widget-two card-body">
            <div class="stat-content">
              <div class="stat-text">Task Completed</div>
              <div class="stat-digit"><i class="fa fa-usd"></i>650</div>
            </div>
            <div class="progress">
              <div
                class="progress-bar progress-bar-danger w-65"
                role="progressbar"
                aria-valuenow="65"
                aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <!-- /# card -->
      </div>
      <!-- /# column -->
    </div>
    <div class="row">
      <div class="col-xl-8 col-lg-8 col-md-8">
        <div class="card dashboardCard">
          <div class="card-header">
            <h4 class="card-title">Sales Overview</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-12 col-lg-8">
                <div id="morris-bar-chart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4">
        <div class="card dashboardCard">
          <div class="card-body text-center">
            <div class="m-t-10">
              <h4 class="card-title">Customer Feedback</h4>
              <h2 class="mt-3">385749</h2>
            </div>
            <div
              class="widget-card-circle mt-5 mb-5"
              id="info-circle-card">
              <i class="ti-control-shuffle pa"></i>
            </div>
            <ul class="widget-line-list m-b-15">
              <li class="border-right">
                92% <br /><span class="text-success"><i class="ti-hand-point-up"></i> Positive</span>
              </li>
              <li>
                8% <br /><span class="text-danger"><i class="ti-hand-point-down"></i>Negative</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card dashboardCard">
          <div class="card-header">
            <h4 class="card-title">Country</h4>
          </div>
          <div class="card-body">
            <div id="vmap13" class="vmap"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card dashboardCard">
          <div class="card-header">
            <h4 class="card-title">New Orders</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>quantity</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="round-img">
                        <a href=""><img
                            width="35"
                            src="./images/avatar/1.png"
                            alt="" /></a>
                      </div>
                    </td>
                    <td>Lew Shawon</td>
                    <td><span>Dell-985</span></td>
                    <td><span>456 pcs</span></td>
                    <td><span class="badge badge-success">Done</span></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="round-img">
                        <a href=""><img
                            width="35"
                            src="./images/avatar/1.png"
                            alt="" /></a>
                      </div>
                    </td>
                    <td>Lew Shawon</td>
                    <td><span>Asus-565</span></td>
                    <td><span>456 pcs</span></td>
                    <td>
                      <span class="badge badge-warning">Pending</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="round-img">
                        <a href=""><img
                            width="35"
                            src="./images/avatar/1.png"
                            alt="" /></a>
                      </div>
                    </td>
                    <td>lew Shawon</td>
                    <td><span>Dell-985</span></td>
                    <td><span>456 pcs</span></td>
                    <td><span class="badge badge-success">Done</span></td>
                  </tr>

                  <tr>
                    <td>
                      <div class="round-img">
                        <a href=""><img
                            width="35"
                            src="./images/avatar/1.png"
                            alt="" /></a>
                      </div>
                    </td>
                    <td>Lew Shawon</td>
                    <td><span>Asus-565</span></td>
                    <td><span>456 pcs</span></td>
                    <td>
                      <span class="badge badge-warning">Pending</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="round-img">
                        <a href=""><img
                            width="35"
                            src="./images/avatar/1.png"
                            alt="" /></a>
                      </div>
                    </td>
                    <td>lew Shawon</td>
                    <td><span>Dell-985</span></td>
                    <td><span>456 pcs</span></td>
                    <td><span class="badge badge-success">Done</span></td>
                  </tr>

                  <tr>
                    <td>
                      <div class="round-img">
                        <a href=""><img
                            width="35"
                            src="./images/avatar/1.png"
                            alt="" /></a>
                      </div>
                    </td>
                    <td>Lew Shawon</td>
                    <td><span>Asus-565</span></td>
                    <td><span>456 pcs</span></td>
                    <td>
                      <span class="badge badge-warning">Pending</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xxl-6 col-xl-4 col-lg-6">
        <div class="card dashboardCard">
          <div class="card-header">
            <h4 class="card-title">Product Sold</h4>
            <div class="card-action">
              <div class="dropdown custom-dropdown">
                <div data-toggle="dropdown">
                  <i class="ti-more-alt"></i>
                </div>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">Option 1</a>
                  <a class="dropdown-item" href="#">Option 2</a>
                  <a class="dropdown-item" href="#">Option 3</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart py-4">
              <canvas id="sold-product"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12 col-xxl-6 col-lg-6 col-md-12">
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
            <div class="card dashboardCard">
              <div class="social-graph-wrapper widget-facebook">
                <span class="s-icon"><i class="fa-brands fa-facebook"></i></span>
              </div>
              <div class="row">
                <div class="col-6 border-right">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1"><span class="counter">89</span> k</h4>
                    <p class="m-0">Friends</p>
                  </div>
                </div>
                <div class="col-6">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1">
                      <span class="counter">119</span> k
                    </h4>
                    <p class="m-0">Followers</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
            <div class="card dashboardCard">
              <div class="social-graph-wrapper widget-linkedin">
                <span class="s-icon"><i class="fa-brands fa-linkedin"></i></span>
              </div>
              <div class="row">
                <div class="col-6 border-right">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1"><span class="counter">89</span> k</h4>
                    <p class="m-0">Friends</p>
                  </div>
                </div>
                <div class="col-6">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1">
                      <span class="counter">119</span> k
                    </h4>
                    <p class="m-0">Followers</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
            <div class="card dashboardCard">
              <div class="social-graph-wrapper widget-googleplus">
                <span class="s-icon"><i class="fa-brands fa-google"></i></span>
              </div>
              <div class="row">
                <div class="col-6 border-right">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1"><span class="counter">89</span> k</h4>
                    <p class="m-0">Friends</p>
                  </div>
                </div>
                <div class="col-6">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1">
                      <span class="counter">119</span> k
                    </h4>
                    <p class="m-0">Followers</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
            <div class="card dashboardCard">
              <div class="social-graph-wrapper widget-twitter">
                <span class="s-icon"><i class="fa-brands fa-twitter"></i></span>
              </div>
              <div class="row">
                <div class="col-6 border-right">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1"><span class="counter">89</span> k</h4>
                    <p class="m-0">Friends</p>
                  </div>
                </div>
                <div class="col-6">
                  <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                    <h4 class="m-1">
                      <span class="counter">119</span> k
                    </h4>
                    <p class="m-0">Followers</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'components/footer.php';
?>



<?php
include_once 'components/scripts.php';
?>

</body>

</html>