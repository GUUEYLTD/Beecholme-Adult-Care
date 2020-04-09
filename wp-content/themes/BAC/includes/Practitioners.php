<?php

namespace BAC;

class Practitioners
{
    /**
     * Practitioners constructor.
     */
    public function __construct()
    {
        $this->hooks();
    }

    /**
     *
     */
    public function hooks()
    {
        add_action('bac_list_counsellors', array($this, 'listCatalogue'));
    }

    /**
     * @return array|object|null
     */
    public function all()
    {
        global $wpdb;

        return $wpdb->get_results(
            "SELECT 
                    *
                 FROM {$wpdb->prefix}amelia_users
                 WHERE status='visible'");
    }

    /**
     *
     */
    public function listCatalogue()
    {
        foreach ($this->all() as $user) {
            $this->show($this->getUserInfo($user));
        }
    }

    /**
     * @param $user
     */
    public function show($user)
    {
        set_query_var('listingUser', $user);
        get_template_part('template-parts/counsellors/single', 'listing');
    }

    protected function getUserInfo($user)
    {
        $user->wp_user  = get_user_by_email($user->email);
        $user->category = Category::getByPractitionerId($user->id);
        $user->services = Service::getAllByPractitionerId($user->id);

        return $user;
    }
}