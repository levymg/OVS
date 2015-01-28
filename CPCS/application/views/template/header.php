<!doctype html>
<html class="no-js" lang="en">
    
  <head>
    <!-- defaults -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- dynamic -->
    <title><?php echo $title ?></title>
    <?php
    if(isset($meta))
    {
        echo $meta;
    }
    ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/foundation.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr.js"></script>
  </head>
  
  <body>
      <div class="pagebar"></div>
      <div class="splash">
      <div class="row top-banner">
          <div class="large-5 columns">
              <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="Complete Pest Control Services" />
          </div>
          <div class="large-7 columns">
              <h1>Your source for residential and commercial pest control</h1>
              <h2>INSPECTION &bull; CONTROL &bull; PREVENTION</h2>
          </div>
      </div>
    <div class="bar">
        <div class="row">
            <div class="contain-to-grid">
              <nav class="top-bar" data-topbar role="navigation">
                <section class="top-bar-section">
                  <ul class="left">
                        <li><a href="<?php echo base_url(); ?>home">Home</a></li><li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>about">About</a></li><li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>services">Services</a></li><li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>restaurants">Restaurants</a></li><li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>testimonials">Testimonials</a></li><li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>rfq">RFQ</a></li><li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>blog">Blog</a></li><li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
                  </ul>
                </section>
              </nav>
            </div>
        </div>
    </div>
      