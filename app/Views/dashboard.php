<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
<section class="py-3" style="background-image: url('<?php echo base_url('asset-pelanggan') ?>/images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="banner-blocks d-flex">
          <!-- Kolom Kiri -->
          <div class="banner-ad large bg-info block-1 col-lg-8 d-flex align-items-center">
            <div class="swiper main-swiper w-100">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="row banner-content p-5">
                    <div class="content-wrapper col-md-7">
                      <div class="categories my-3">New Arrived with 20% OFF</div>
                      <h3 class="display-4">Drink Jar Pink Special For You</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                      <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Shop Now</a>
                    </div>
                    <div class="img-wrapper col-md-5">
                      <img src="<?php echo base_url('asset-pelanggan') ?>/images/pro1.png" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="row banner-content p-5">
                    <div class="content-wrapper col-md-7">
                      <div class="categories mb-3 pb-3">New Arrived with 20% OFF</div>
                      <h3 class="banner-title">Cute Bear Saving Box</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                      <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                    </div>
                    <div class="img-wrapper col-md-5">
                      <img src="<?php echo base_url('asset-pelanggan') ?>/images/pro2.png" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="row banner-content p-5">
                    <div class="content-wrapper col-md-7">
                      <div class="categories mb-3 pb-3">New Arrived with 20% OFF</div>
                      <h3 class="banner-title">Blue Melody Shopping Basket</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                      <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                    </div>
                    <div class="img-wrapper col-md-5">
                      <img src="<?php echo base_url('asset-pelanggan') ?>/images/pro3.png" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>


<?= $this->endSection('isi')?>