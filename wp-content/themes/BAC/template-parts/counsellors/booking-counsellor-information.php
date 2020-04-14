<?php
  $userId = intval($_GET['user']);

  global $wpdb;

  $ameliaUserId = $wpdb->get_results("
    SELECT
    externalId
    FROM
    {$wpdb->prefix}amelia_users
    WHERE
    id='{$userId}' AND
    type='provider'
  ");

  $user = get_userdata($ameliaUserId[0]->externalId);
  $user->amelia_employee = \BAC\Practitioners::getByEmail($user->user_email);
  $userServices = \BAC\Service::getAllByPractitionerId($user->amelia_employee->id);

?>

<div class="information-wrapper">
  <div class="content">
    <h3>About session</h3>
    <div class="user-details d-flex">
      <div class="user-image"><img src="<?php echo get_avatar_url($user->id); ?>" alt=""></div>
      <div class="user-name d-flex flex-column">
        <div class="name"><?php echo $user->amelia_employee->firstName . ' ' . $user->amelia_employee->lastName ?></div>
        <div class="type"><?php echo \BAC\Category::getByPractitionerId($user->amelia_employee->id)->name; ?></div>
      </div>
      <div class="user-price d-flex flex-column">
        <div class="price">&#163;<?php echo \BAC\Practitioners::getPriceByPractitionerId($user->amelia_employee->id); ?></div>
        <div class="price-caption">session</div>
      </div>
    </div>
    <div class="extended-info">
      <div class="heading">Approach</div>
      <div class="text"><?php echo $userServices[0]->description; ?></div>
    </div>
    <div class="extended-info">
      <div class="heading">How it works</div>
      <div class="text">This approach emphasizes people's capacity to make rational choices and develop to their maximum potential. Concern and respect for others are also important themes.</div>
    </div>
  </div>
  <div class="info">
    Once your session has been accepted
    you will receive a confirmation email with all
    the detailed information and a link to Hangouts
    to join your meeting.
  </div>

</div>