<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See LICENCE.md for license details.
 */

namespace AmeliaBooking\Infrastructure\Services\Zoom;

use AmeliaBooking\Domain\Services\Settings\SettingsService;
use Firebase\JWT\JWT;

/**
 * Class ZoomService
 *
 * @package AmeliaBooking\Infrastructure\Services\Zoom
 */
class ZoomService
{
    /**
     * @var SettingsService $settingsService
     */
    private $settingsService;

    /**
     * ZoomService constructor.
     *
     * @param SettingsService $settingsService
     */
    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * @param string     $requestUrl
     * @param array|null $data
     * @param string     $method
     *
     * TODO HOT FIX FOR ZOOM USERS LIMIT, SHOULD BE IMPLEMENTED OUTSIDE OF PLUGIN
     * @param array|null $getParameters
     *
     * @return mixed
     */
    public function execute($requestUrl, $data, $method, $getParameters = null)
    {
        $zoomSettings = $this->settingsService->getCategorySettings('zoom');

        $token = [
            'iss' => $zoomSettings['apiKey'],
            'exp' => time() + 3600
        ];

        /* TODO HOT FIX FOR ZOOM USERS LIMIT, SHOULD BE IMPLEMENTED OUTSIDE OF PLUGIN */
        $query = '';
        if ($getParameters) {
            $query = '?'.http_build_query($getParameters);
        }

        $ch = curl_init($requestUrl.$query);
        /* END */

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Authorization: Bearer ' . JWT::encode($token, $zoomSettings['apiSecret']),
                'Content-Type: application/json'
            ]
        );

        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        return json_decode($result, true);
    }

    /**
     *
     * @return mixed
     */
    public function getUsers()
    {
        /* TODO HOT FIX FOR ZOOM USERS LIMIT, SHOULD BE IMPLEMENTED OUTSIDE OF PLUGIN */
        return $this->execute('https://api.zoom.us/v2/users', null, 'GET', ['page_size' => 300]);
    }

    /**
     * @param int   $userId
     * @param array $data
     *
     * @return mixed
     */
    public function createMeeting($userId, $data)
    {
        return $this->execute("https://api.zoom.us/v2/users/{$userId}/meetings", $data, 'POST');
    }

    /**
     * @param int   $meetingId
     * @param array $data
     *
     * @return mixed
     */
    public function updateMeeting($meetingId, $data)
    {
        return $this->execute("https://api.zoom.us/v2/meetings/{$meetingId}", $data, 'PATCH');
    }

    /**
     * @param int   $meetingId
     *
     * @return mixed
     */
    public function deleteMeeting($meetingId)
    {
        return $this->execute("https://api.zoom.us/v2/meetings/{$meetingId}", null, 'DELETE');
    }

    /**
     * @param int $meetingId
     *
     * @return mixed
     */
    public function getMeeting($meetingId)
    {
        return $this->execute("https://api.zoom.us/v2/meetings/{$meetingId}", null, 'GET');
    }
}
