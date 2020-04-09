<?php

namespace BAC;

class Category
{
    public static function getByPractitionerId($practitionerId)
    {
        global $wpdb;
        return end($wpdb->get_results("
            SELECT 
                c.id, 
                c.status, 
                c.name, 
                c.position 
              FROM {$wpdb->prefix}amelia_providers_to_services as ps
            LEFT JOIN {$wpdb->prefix}amelia_services as s
            ON s.id=ps.serviceId
            LEFT JOIN {$wpdb->prefix}amelia_categories as c
            ON c.id=s.categoryId
            WHERE ps.userId={$practitionerId}
        "));
    }

    public function getByServiceId($serviceId)
    {
        global $wpdb;
        return end($wpdb->get_results("
            SELECT 
                c.id, 
                c.status, 
                c.name, 
                c.position 
            FROM {$wpdb->prefix}amelia_services as s
            LEFT JOIN {$wpdb->prefix}amelia_categories as c
            ON c.id=s.categoryId
            WHERE ps.userId={$serviceId}
        "));
    }
}