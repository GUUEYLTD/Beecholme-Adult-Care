<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See LICENCE.md for license details.
 */

?>

<script>
  var bookingEntitiesIds = (typeof bookingEntitiesIds === 'undefined') ? [] : bookingEntitiesIds
  bookingEntitiesIds.push(
    {
      'counter': '<?php echo $atts['counter']; ?>',
      'appointments': '<?php echo $atts['appointments']; ?>',
      'events': '<?php echo $atts['events']; ?>'
    }
  )
</script>

<div id="amelia-app-booking<?php echo $atts['counter']; ?>" class="amelia-cabinet amelia-frontend amelia-app-booking">
  <cabinet></cabinet>
</div>
