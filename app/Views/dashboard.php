<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
<section class="py-3" style="background-image: url('<?php echo base_url('asset-pelanggan') ?>/images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="banner-blocks d-flex">
          <!-- Kolom Kiri -->
          <div class="swiper main-swiper w-100">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="row banner-content p-5">
                  <div class="content-wrapper col-md-7">
                    <div class="categories my-3">Peralatan Rumah Tangga Lengkap</div>
                    <h3 class="display-4">Toko Mala</h3>
                    <p>Menyediakan berbagai peralatan rumah tangga yang membantu anda.</p>
                    <a href="<?= site_url('/pelangganctrl/databarang2') ?>" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Shop Now</a>
                  </div>
                  <div class="img-wrapper col-md-5">
                    <img src="<?php echo base_url('asset-pelanggan') ?>/images/pro1.png" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-lg-13 d-flex flex-column gap-4">
          <div class="d-flex gap-4 flex-column flex-lg-row">
            <!-- Gambar 1 -->
            <div class="banner-ad bg-success-subtle block-2" style="background:url('<?php echo base_url('asset-pelanggan') ?>/images/PRO17.png') no-repeat;background-position: center;background-size: cover; height: 250px; flex: 1;">
              <div class="banner-content p-4" style="position: absolute; bottom: 10px;">
                <h3 class="banner-title">Peralatan Dapur</h3>
                <a href="#" class="d-flex align-items-center nav-link">Belanja Sekarang <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
              </div>
            </div>

            <!-- Gambar 2 -->
            <div class="banner-ad bg-success-subtle block-3" style="background:url('<?php echo base_url('asset-pelanggan') ?>/images/PRO5.png') no-repeat;background-position: center;background-size: cover; height: 250px; flex: 1;">
              <div class="banner-content p-4" style="position: absolute; bottom: 10px;">
                <h3 class="banner-title">Fruits & Vegetables</h3>
                <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
              </div>
            </div>

            <!-- Gambar 3 -->
            <div class="banner-ad bg-danger block-4" style="background:url('<?php echo base_url('asset-pelanggan') ?>/images/pro6.png') no-repeat;background-position: center;background-size: cover; height: 250px; flex: 1;">
              <div class="banner-content p-4" style="position: absolute; bottom: 10px;">
                <h3 class="item-title">Baked Products</h3>
                <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
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
<!-- You can add your content here -->
<?= $this->endSection('isi')?>
