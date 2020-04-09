<?php


namespace BAC;


class Service
{
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
                s.categoryId
              FROM {$wpdb->prefix}amelia_providers_to_services as ps
            LEFT JOIN {$wpdb->prefix}amelia_services as s
            ON s.id=ps.serviceId
            WHERE ps.userId={$practitionerId}
        ");
    }
}