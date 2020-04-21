<?php
  $userId = intval($_GET['user']);

  $ameliaUserId = \BAC\Practitioners::getById($userId);
  $user = get_userdata($ameliaUserId->externalId);
  $user->amelia_employee = $ameliaUserId;

  $userServices = \BAC\Service::getAllByPractitionerId($user->amelia_employee->id);

?>

<div class="information-wrapper">
  <div class="content">
    <h3>About session</h3>
    <div class="user-details d-flex">
      <div class="user-image"><img src="<?php echo $user->amelia_employee->pictureThumbPath ?? (get_stylesheet_directory_uri() . '/images/profile-placeholder.png'); ?>" alt=""></div>
      <div class="user-name d-flex flex-column">
        <div class="name"><?php echo $user->amelia_employee->firstName . ' ' . $user->amelia_employee->lastName ?></div>
        <div class="type"><?= implode(", ", getACFLoopValues('type', $user->ID)) ?></div>
      </div>
      <div class="user-price d-flex flex-column">
        <div class="price">$<?php echo \BAC\Practitioners::getPriceByPractitionerId($user->amelia_employee->id); ?></div>
        <div class="price-caption">session</div>
      </div>
    </div>
    <div class="extended-info">
      <div class="heading">Approach</div>
      <div class="text"><?php the_field('approach', "user_{$user->ID}"); ?></div>
    </div>
    <div class="extended-info">
      <div class="heading">How it works</div>
      <div class="text"><?php the_field('how_it_works', "user_{$user->ID}"); ?></div>
    </div>
  </div>
  <div class="info mb-5">
    Once your session has been accepted
    you will receive a confirmation email with all
    the detailed information and a link to Hangouts
    to join your meeting.
  </div>

</div>