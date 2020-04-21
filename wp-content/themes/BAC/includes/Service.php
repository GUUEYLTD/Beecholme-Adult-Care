<?php


namespace BAC;


class Service
{
    /**
     * @param $practitionerId
     *
     * @return array|object|null
     */
    public static function getAllByPractitionerId($practitionerId)
    {
        global $wpdb;

        return $wpdb->get_results("
            SELECT 
                s.id,
                s.name,
                s.description,
                s.price,
                s.status,
                s.categoryId,
                s.duration
              FROM {$wpdb->prefix}amelia_providers_to_services as ps
            LEFT JOIN {$wpdb->prefix}amelia_services as s
            ON s.id=ps.serviceId
            WHERE ps.userId={$practitionerId}
        ");
    }

    /**
     * Get all existing service names
     *
     * @return array|object|null
     */
    public static function all()
    {
        global $wpdb;

        return $wpdb->get_results("
            SELECT
                name,
                description,
                duration
            FROM {$wpdb->prefix}amelia_services
        ");
    }

    public static function getServiceNames($category = '')
    {
        global $wpdb;

        $serviceNames = [];
        foreach (
            $wpdb->get_results("
            SELECT s.name
            FROM {$wpdb->prefix}amelia_services as s
            LEfT JOIN {$wpdb->prefix}amelia_categories as c
            ON c.id=s.categoryId
            WHERE c.name LIKE '%{$category}%'
        ") as $service
        ) {
            $serviceNames[] = $service->name;
        }

        return $serviceNames;
    }
}