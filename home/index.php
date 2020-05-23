<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('../global/header.php'); ?>
</head>

<body>
  <?php include('../global/navbar.php'); ?>
  <div class="container">
    <div id="carouselExampleControls" class="carousel slide mb-3" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleControls" data-slide-to="1"></li>
        <li data-target="#carouselExampleControls" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block img-fluid" src="https://placehold.it/1920x800" alt="First slide">
          <div class="carousel-caption d-none d-md-block">
            <h5>Item 1 Heading</h5>
            <p>Item 1 Description</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="https://placehold.it/1920x800" alt="Second slide">
          <div class="carousel-caption d-none d-md-block">
            <h5>Item 2 Heading</h5>
            <p>Item 2 Description</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="https://placehold.it/1920x800" alt="Third slide">
          <div class="carousel-caption d-none d-md-block">
            <h5>Item 3 Heading</h5>
            <p>Item 3 Description</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-12">
        <div class="card mb-3">
          <div class="card-header dusty-grass-gradient">
            <h5 align="center" class="font-weight-bold">คำสั่งและประกาศ <i class="fas fa-scroll"></h5></i>
          </div>
          <div class="card-body">
            <div class="card-text">
              <a href="#"><li>text1</li></a>
              <a href="#"><li>text2</li></a>
              <a href="#"><li>text3</li></a>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-header dusty-grass-gradient">
            <h5 align="center" class="font-weight-bold">ระเบียบและแนวทางปฏิบัติ <i class="fas fa-scroll"></h5></i>
          </div>
          <div class="card-body">
            <div class="card-text">
              <a href="#"><li>text1</li></a>
              <a href="#"><li>text2</li></a>
              <a href="#"><li>text3</li></a>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-header dusty-grass-gradient">
            <h5 align="center" class="font-weight-bold">คู่มือการใช้ยา <i class="fas fa-scroll"></h5></i>
          </div>
          <div class="card-body">
            <div class="card-text">
              <a href="#"><li>text1</li></a>
              <a href="#"><li>text2</li></a>
              <a href="#"><li>text3</li></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-12">
      </div>
      <div class="col-md-2 col-12">
        <div class="row">
        <div class="col-12">
        <div class="card mb-3">
          <div class="card-header dusty-grass-gradient">
            <h5 align="center" class="font-weight-bold">หัวหน้างานเภสัชกรรม <i class="fas fa-scroll"></h5></i>
          </div>
          <div class="card-body">
            <div class="card-text">
              <img src="https://placehold.it/300x400" class="img-fluid mb-3">
              <h5 align="center" class="font-weight-bold text-dark">ภญ.รัชฎาพร สุนทรภาส</h5>
            </div>
          </div>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>