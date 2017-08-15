 <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">

      <!-- Note: For this slider example, you'll need some additional styles not included with Ratchet -->
      <style>

        .slider .slide img {
          display: block;
          width: 100%;
          height: 570px;
        }

        .slider .slide-group .slide-text {
          position: absolute;
          top: 45%;
          left: 0;
          width: 100%;
          font-size: 24px;
          color: #fff;
          text-align: center;
          text-shadow: 0 0 10px rgba(0,0,0,.5);
        }

      </style>

      <div class="slider">
        <div class="slide-group">
          <div class="slide">
            <img src="<?php echo theme_img('avatar1.jpg')?>">
            <span class="slide-text">
              <span class="icon icon-left-nav"></span>
              Slide me
            </span>
          </div>
          <div class="slide">
            <img src="<?php echo theme_img('avatar2.jpg')?>">
          </div>
          <div class="slide">
            <img src="<?php echo theme_img('avatar3.jpg')?>">
          </div>
        </div>
      </div>

    </div>