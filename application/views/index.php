<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<br>
<div class="container">
<div class="card" style="position: relative; ">

  <div class="card-body">
<section class="konten">
  <div class="container">
    <h3><center>Menu Pizza</center></h3>
    <br>

    <div class="row">
     <?php foreach ($data_menu as $produk) : ?>
      <div class="col-md-3">
        <div class="card" style="width: 11rem;">
  <img src="<?php echo base_url('img/'.$produk['gambar']); ?>" class="card-img-top">
  <div class="card-body">
    <h5 class="card-title"><?php echo $produk['namamenu']; ?></h5>
    <p><?php echo $produk['desk']; ?></p>
    <p>Rp. <?php echo number_format($produk['harga']); ?></p>
    <a hidden="" href="<?php echo base_url() ?>home/cart/?id=<?php echo $produk['idmenu']; ?>" class="btn btn-primary">Order</a>

  </div>
</div>
<br>
<br>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
  </div>
</div>
</div>
