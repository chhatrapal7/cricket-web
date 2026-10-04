<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/home_page.js"></script>
<div class="content-page" style="background-color: #fff;" ng-controller="homejsapicontroller">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .top_headnig {
      text-align: center;
      color: blue;
      border-style: ridge;
    }

    .carousel-item img {
      display: block;
      width: 100%;
      height: 80vh;
    }


    .profile-img {
      width: 180px;
      height: 150px;
      border-radius: 10px;
      position: relative;
      bottom: -5px;
      left: 35px;
      border: 4px solid #0f99f5ff
    }

    .testimonial-container {
      display: flex;
      justify-content: space-between;
    }

    .profile-img2 {
      width: 90px;
      height: 90px;
      border-radius: 50px;
      position: relative;
      bottom: 80px;
      left: 20%;
      margin-bottom: -50px;
      border: 4px solid #b9b8c3;
    }

    .pl_name {
      margin-top: 15px;
      text-align: center;
      color: blue;
    }

    .color-name.h3 {
      text-align: center;
    }

    .testimonial-card {
      box-shadow: 0 0 3px rgb(187, 187, 218);
      background-color: #f7f7fc;
      border-radius: 12px;
      padding-left: 15px;
      max-width: 300px;
      height: auto;
    }



    .material-icons {
      font-weight: 100;
      font-size: 28px;

    }

    .class-name {
      font-weight: 900px;
      padding-bottom: 10px;
      font-size: 20px;
      color: blue
    }

    .message {
      font-size: 18px;
      color: #2a3531;
      padding-bottom: 10px;
      padding-right: 10px;

    }

    .stars {
      padding-left: 22px;
      padding-top: 5px;
      color: rgb(255, 162, 0);

    }
  </style>

  <div class="home_page">

    <div class="text-center mb-4 ">
      <h2 class="fw-bold text-primary"> Cricket Kundali Champians</h2>
    </div>

    <div id="carouselExampleCaptions" class="carousel slide for_bg" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item">
          <img src="assets/images/indian_team.jpg" class="d-block w-100" alt="h1">
          <div class="carousel-caption d-none d-md-block">
            <h5>Indian Team</h5>
            <p>Mumbai Ground Play A Cricket.</p>
          </div>
        </div>
        <div class="carousel-item active">
          <img src="assets/images/Dhoni-Review.jpg" class="d-block w-100" alt="h2">
          <div class="carousel-caption d-none d-md-block">
            <h5>Review System </h5>
            <p>Dhoni Review System Is Very Popular.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/images/kohli_celebrat.jpg" class="d-block w-100" alt="h3">
          <div class="carousel-caption d-none d-md-block">
            <h5>Celebrat Virat</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>


    <button type="button" class="btn btn-primary m-5" ng-click="p_add()"> Click For Add player</button>
    <button type="button" class="btn btn-primary m-5" ng-click="create_match_btn()">Click For Create Match</button>
    <button type="button" class="btn btn-primary m-5" ng-click="tempp()">OPEN</button>



    <div class="row ">

      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <h1 class="header-title mb-4 mt-0 ">Top Performance Player</h1>

            <ul class="nav nav-pills navtab-bg nav-justified">
              <li class="nav-item">
                <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link bg-red">
                  <span class="d-block d-sm-none"><i class="uil-home-alt"></i></span>
                  <span class="d-none d-sm-block">Batter</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#profile1" data-toggle="tab" aria-expanded="true"
                  class="nav-link active">
                  <span class="d-block d-sm-none"><i class="uil-user"></i></span>
                  <span class="d-none d-sm-block">Bowler</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#messages1" data-toggle="tab" aria-expanded="false"
                  class="nav-link">
                  <span class="d-block d-sm-none"><i class="uil-envelope"></i></span>
                  <span class="d-none d-sm-block">All Rounder</span>
                </a>
              </li>
            </ul>

            <div class="tab-content text-muted">

              <div class="tab-pane" id="home1">

                <div class="bg5">

                  <div class="testimonial-container">

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <img src="assets/images/dhone.jpg" class="profile-img" alt="Image3">
                      </div>

                      <h3 class="pl_name"> Chhatrapal Janghel </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <img src="assets/images/dhoni2.jpg" class="profile-img" alt="Image3">
                      </div>

                      <h3 class="pl_name"> Chhatrapal Janghel </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <img src="assets/images/ab3.jpg" class="profile-img" alt="Image3">
                      </div>

                      <h3 class="pl_name"> Chhatrapal Janghel </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                  </div>

                </div>

              </div>

              <div class="tab-pane show active" id="profile1">

                <div class="bg5">

                  <div class="testimonial-container">

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <!-- <img src="assets/images/CHHATRAPAL.jpg" class="profile-img" alt="Image3"> -->
                        <img src="assets/images/malinga.jpg" class="profile-img" alt="Image3">

                      </div>

                      <h3 class="pl_name"> Malinga </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <img src="assets/images/malinga.jpg" class="profile-img" alt="Image3">
                      </div>

                      <h3 class="pl_name"> Malinga </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <!-- <img src="assets/images/CHHATRAPAL.jpg" class="profile-img" alt="Image3"> -->
                        <img src="assets/images/malinga.jpg" class="profile-img" alt="Image3">

                      </div>

                      <h3 class="pl_name"> Malinga </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                  </div>

                </div>

              </div>

              <div class="tab-pane" id="messages1">

                <div class="bg5">

                  <div class="testimonial-container">

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <img src="assets/images/hardik.jpeg" class="profile-img" alt="Image3">

                      </div>

                      <h3 class="pl_name"> Hardik </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <img src="assets/images/hardik.jpeg" class="profile-img" alt="Image3">

                      </div>

                      <h3 class="pl_name"> Hardik </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="testimonial-card">

                      <div class="icon-photo-containar">
                        <img src="assets/images/hardik.jpeg" class="profile-img" alt="Image3">

                      </div>

                      <h3 class="pl_name"> Hardik </h3>
                      <div class="message">
                        <table class="table table-bordered table-striped text-center">
                          <tbody>
                            <tr>
                              <th>Total Runs -</th>
                              <td>10839</td>
                            </tr>
                            <tr>
                              <th>Total Balls -</th>
                              <td>5038</td>
                            </tr>
                            <tr>
                              <th>Average -</th>
                              <td>198</td>
                            </tr>
                            <tr>
                              <th>Total Boundaries -</th>
                              <td>123</td>
                            </tr>
                          </tbody>
                        </table>

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





    <div class="container mt-4">
      <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="assets/images/jasprit.jpg" class="card-img-top" alt="Image 1" style="height:250px; object-fit:cover;">
            <div class="card-body">
              <h5 class="card-title text-primary">JASPRIT BUMRAH</h5>

              <p class="card-text">Indian pacer Jasprit Bumrah's celebration style is generally reserved and includes a simple, controlled fist pump and intense stare. He has, however, showcased a few different celebrations in the past, including:</p>
            </div>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="assets/images/malinga.jpg" class="card-img-top" alt="Image 2" style="height:250px; object-fit:cover;">
            <div class="card-body">
              <h5 class="card-title text-primary">LASITH MALINGA</h5>
              <p class="card-text">Malinga most often refers to Lasith Malinga, a retired Sri Lankan cricketer known for his fast-bowling, unique slingy action, and skill in bowling Yorkers</p>
            </div>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="assets/images/ab3.jpg" class="card-img-top" alt="Image 3" style="height:250px; object-fit:cover;">
            <div class="card-body">
              <h5 class="card-title text-primary">AB de Villiers</h5>
              <p class="card-text">AB de Villiers is a former South African international cricketer known as one of the greatest batsmen of his era, nicknamed "Mr. 360°" for his innovative and versatile style of play.</p>
            </div>
          </div>
        </div>
      </div>
    </div>




  </div>

</div>