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
     * Get single user by email from Amelia table
     *
     * @param $email
     *
     * @return mixed
     */
    public static function getByEmail($email)
    {
        global $wpdb;

        return end($wpdb->get_results("
            SELECT 
                *
            FROM 
                {$wpdb->prefix}amelia_users
            WHERE
                email='{$email}' AND
                type='provider'
        "));
    }

    /**
     * Get all practitioners from Amelia table
     *
     * @return array|object|null
     */
    public function all()
    {
        global $wpdb;

        return $wpdb->get_results("
            SELECT 
                *
            FROM 
                {$wpdb->prefix}amelia_users
            WHERE 
                status='visible' AND 
                type='provider'
        ");
    }

    public static function getPriceByPractitionerId($practitionerId)
    {
        global $wpdb;

        return $wpdb->get_results("
            SELECT 
                price
            FROM 
                {$wpdb->prefix}amelia_providers_to_services
            WHERE 
                userId={$practitionerId}
            LIMIT 1
        ")[0]->price;
    }

    /**
     * List practitioners
     */
    public function listCatalogue()
    {
        foreach ($this->all() as $user) {
            $this->show($this->getUserInfo($user));
        }
    }

    /**
     * Show single practitioner
     *
     * @param $user
     */
    public function show($user)
    {
        set_query_var('listingUser', $user);
        get_template_part('template-parts/counsellors/single', 'listing');
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    protected function getUserInfo($user)
    {
        $user->wp_user  = get_user_by_email($user->email);
        $user->category = Category::getByPractitionerId($user->id);
        $user->services = Service::getAllByPractitionerId($user->id);

        return $user;
    }
}