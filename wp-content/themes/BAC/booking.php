<?php /*Template Name: Booking */
 get_header();
?>

<div class="booking-page mid-container d-flex">
  <div class="booking-form">
      <div class="text-block-800 text-block-800-consellors">
          <p style="font-family: InterSemiBold, sans-serif; font-size:18px">
              BAC PROMO
          </p>
          <p>
              Book 5 sessions and save 5% using Coupon Code "<strong>SAVE5</strong>".
          </p>
          <p>
              Book 10 sessions and save 10% using Coupon Code "<strong>SAVE10</strong>"
          </p>
          <p>
              If you don't know how to book multiple sessions, please watch <br>
              <a href="#" id="ytClick" style="font-family: InterSemiBold, sans-serif; color: #5AB9AC">
                  this video tutorial
              </a>
          </p>
      </div>

      <!-- The Modal -->
      <div id="ytModal" class="youtube-modal">
          <!-- Modal content -->
          <div class="youtube-modal-content">
              <span class="youtube-close">&times;</span>
              <div id="ytplayer"></div>
          </div>
      </div>
      
    <?php
        $userId = $_GET['user'];
        $service = \BAC\Service::getAllByPractitionerId($userId);
        $shortcode = '[ameliabooking employee='.$userId.' service=' . $service[0]->id . ']';
    ?>
    <?php echo do_shortcode($shortcode); ?>

  </div>
  <div class="about-info">
    <?php get_template_part('template-parts/counsellors/single', 'booking'); ?>
  </div>
</div>
<?php get_footer(); ?>

<script>
    jQuery(document).ready(function($) {
        if( ($('.type').html() == 'Life coach, Therapist') || ($('.type').html() == 'Therapist, Life coach') ){
            console.log('2:'+$('.type').html());
        } else {
            var style = document.createElement('style');
            style.innerHTML =
                '.am-custom-fields .el-row .el-col:nth-last-of-type(2){' +
                'display:none;' +
                '}';
            var ref = document.querySelector('script');
            ref.parentNode.insertBefore(style, ref);
            console.log('1:'+$('.type').html());
        }
    });
</script>
<script>
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    var videoId = 'PwQCVv39MJQ';

    jQuery(function($) {
        $(document).on('click', '#ytClick', function(){
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        });
    });

    var player;
    function onYouTubePlayerAPIReady() {
        player = new YT.Player('ytplayer', {
            height: '100%',
            width: '100%',
            autoplay: 'true',
            videoId: videoId,
            events: {
                'onReady': onPlayerReady
            }
        });
    }
    function onPlayerReady(event) {
        event.target.playVideo();
    }
</script>
<script>
    jQuery(function($) {
        var modal = document.getElementById("ytModal");
        var btn = document.getElementById("ytClick");
        var span = document.getElementsByClassName("youtube-close")[0];
        $(btn).click(function(){
            modal.style.display = "block";
        });
        $(span).click(function(){
            modal.style.display = "none";
        });
    });
</script>
