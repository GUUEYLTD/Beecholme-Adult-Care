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
//        add_action('bac_list_counsellors', array($this, 'listCatalogue'), 10, 1);
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
    public function all($args = [])
    {
        global $wpdb;

        $results = $wpdb->get_results("
            SELECT 
                *
            FROM 
                {$wpdb->prefix}amelia_users as u
            WHERE 
                status='visible' AND 
                type='provider'
        ");

        if ( ! empty($args)) {
            $results = $this->filterUsers($results, $args);
        }

        return $results;
    }

    /**
     * @param $practitionerId
     * @param $serviceName
     *
     * @return bool
     */
    public static function offersService($practitionerId, $serviceName)
    {
        global $wpdb;

        return ! empty($wpdb->get_results("
            SELECT DISTINCT(ps.serviceId)
            FROM {$wpdb->prefix}amelia_providers_to_services as ps
            LEFT JOIN {$wpdb->prefix}amelia_services as s
            ON ps.serviceId=s.id
            WHERE ps.userId={$practitionerId}
            AND s.name='{$serviceName}'
        "));
    }

    /**
     * @param $practitionerId
     * @param $category
     *
     * @return bool
     */
    public function belongsToCategory($practitionerId, $category)
    {
        global $wpdb;

        return ! empty($wpdb->get_results("
            SELECT distinct(s.id)
            FROM {$wpdb->prefix}amelia_providers_to_services as ps
            LEFT JOIN {$wpdb->prefix}amelia_services as s
            ON ps.serviceId=s.id
            LEFT JOIN {$wpdb->prefix}amelia_categories as c
            ON c.id=s.categoryId 
            WHERE c.name LIKE '%{$category}%'
            AND ps.userId={$practitionerId}
        "));
    }

    /**
     * @param $practitionerId
     *
     * @return mixed
     */
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
     *
     * @param $counsellors
     */
    public function listCatalogue($counsellors)
    {
        foreach ($counsellors as $user) {
            self::show(self::getUserInfo($user));
        }
    }

    /**
     * Show single practitioner
     *
     * @param $user
     */
    public static function show($user)
    {
        set_query_var('listingUser', $user);
        get_template_part('template-parts/counsellors/single', 'listing');
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    protected static function getUserInfo($user)
    {
        $user->wp_user  = get_user_by_email($user->email);
        $user->category = Category::getByPractitionerId($user->id);
        $user->services = Service::getAllByPractitionerId($user->id);

        return $user;
    }

    /**
     * @param  array  $results
     * @param  array  $args
     *
     * @return array
     */
    private function filterUsers(array $results, array $args)
    {
        if (isset($args['type']) && in_array($args['type'], array('therap', 'coach'))) {
            $results = array_filter($results, function ($user) use ($args) {
                return self::belongsToCategory($user->id, $args['type']);
            });
        }

        if (isset($args['therapy']) && in_array($args['therapy'], Service::getServiceNames('therap'))) {
            $results = array_filter($results, function ($user) use ($args) {
                return self::offersService($user->id, $args['therapy']);
            });
        }

        if (isset($args['coaching']) && in_array($args['coaching'], Service::getServiceNames('coach'))) {
            $results = array_filter($results, function ($user) use ($args) {
                return self::offersService($user->id, $args['coaching']);
            });
        }

        return $results;
    }

}