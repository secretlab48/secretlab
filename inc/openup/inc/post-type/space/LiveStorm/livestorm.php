<?php


class LiveStormIntegration {

    static $token;
    static $client = null;

    static function init() {

        if ( ! empty( self::$client ) ) return;
        require_once('vendor/autoload.php');
        self::$token = file_get_contents( plugin_dir_path( __FILE__ ) . 'data/LiveStormToken.txt' );
        self::$client = new \GuzzleHttp\Client();

    }

    static function parseArgs( $data ) {

        $out = [];

        foreach( $data as $key => $value ) {
            if ( is_array( $value ) ) {
                foreach( $value as $subkey => $subvalue ) {
                    if ( ! is_null( $subvalue ) ) {
                        $out[] = $key . '[' . $subkey . ']=' . $subvalue;
                    }
                }
            }
            else {
                if ( ! is_null( $value ) ) {
                    $out[] = $key . '=' . $value;
                }
            }
        }

        return ( count( $out ) > 0 ) ? '?' . implode( '&', $out ) : '';

    }

    static function getEvent( $id ) {

        self::init();
        $response = self::$client->request('GET', 'https://api.livestorm.co/v1/events/' . $id, [
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
            ],
        ]);
        if ( $response->getStatusCode() == 200 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }


    static function getEvents( $data = null ) {

        /*
           $data[ 'scheduling_status' ] => (live, upcoming, on_demand, ended, not_started, draft, cancelled, not_scheduled)
        */

        $default = [
            'page' => [
                'number' => 0,
                'size' => 100
            ],
            'filter' => [
                'title' => null,
                'scheduling_status' => 'upcoming'
            ],
            'everyone_can_speak' => null
        ];

        $data = shortcode_atts( $default, $data );
        $args = self::parseArgs( $data );

        self::init();
        $response = self::$client->request('GET', 'https://api.livestorm.co/v1/events' . $args, [
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
            ],
        ]);
        if ( $response->getStatusCode() == 200 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }

    static function getEventSession ( $id ) {

        self::init();
        $response = self::$client->request('GET', 'https://api.livestorm.co/v1/sessions/' . $id, [
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
            ],
        ]);

        if ( $response->getStatusCode() == 200 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }

    static function getEventSessions ( $event_id, $data = [] ) {

        /*
            data_from, data_to : timestamp or formatted date
        */

        $default = [
            'page' => [
                'number' => 0,
                'size' => 100
            ],
            'filter' => [
                'title' => null,
                'status' => 'upcoming'
            ],
            'date_from' => null,
            'date_to' => null,
            'include_breakout_rooms' => null,

        ];

        $data = shortcode_atts( $default, $data );
        $args = self::parseArgs( $data );

        self::init();
        $response = self::$client->request('GET', 'https://api.livestorm.co/v1/events/' . $event_id . '/sessions' . $args, [
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
            ],
        ]);

        if ( $response->getStatusCode() == 200 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }

    static function createEventSession( $event_id, $estimated_started_at = '2022-07-15 10:30:00', $timezone = 'America/New_York' ) {

        $body = [
            'data' => [
                [
                    'type' => 'sessions',
                    'attributes' => [
                        'estimated_started_at' => $estimated_started_at,
                        'timezone' => $timezone
                    ]
                ]
            ]
        ];

        self::init();
        $response = self::$client->request('POST', 'https://api.livestorm.co/v1/events/' . $event_id . '/sessions', [
            'body' => $body,
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
                'Content-Type' => 'application/vnd.api+json',
            ],
        ]);

        if ( $response->getStatusCode() == 201 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }

    static function getEventPeople ( $event_id, $data ) {

        /*
            filter[ 'role' ] =>  'participant', 'team_member'
            filter[ 'email' ] => exact match
        */

        $default = [
            'page' => [
                'number' => 0,
                'size' => 100
            ],
            'filter' => [
                'role' => null,
                'email' => null
            ]
        ];

        $data = shortcode_atts( $default, $data );
        $args = self::parseArgs( $data );

        self::init();
        $response = self::$client->request('GET', 'https://api.livestorm.co/v1/events/' . $event_id . '/people' . $args, [
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
            ],
        ]);

        if ( $response->getStatusCode() == 200 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }

    static function getSessionPeople ( $session_id, $data = [] ) {

        /*
            filter[ 'role' ] =>  'participant', 'team_member'
            filter[ 'email' ] => exact match,
            filter[ 'attended' ] => true / false
        */

        $default = [
            'page' => [
                'number' => 0,
                'size' => 100
            ],
            'filter' => [
                'role' => null,
                'email' => null,
                'attended' => null
            ]
        ];

        $data = shortcode_atts( $default, $data );
        $args = self::parseArgs( $data );

        self::init();
        $response = self::$client->request('GET', 'https://api.livestorm.co/v1/sessions/' . $session_id . '/people' . $args, [
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
            ],
        ]);

        if ( $response->getStatusCode() == 200 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }

    static function registerSessionAttendee( $session_id, $fields ) {

        /*
         * $fields => [
         *      [ 'id' => 'email', 'value' => 'test@gmail.com' ],
         *      [ 'id' => 'first_name', 'value' => 'test' ],
         *      [ 'id' => 'openup_partner', 'value' => 'https://test-partner.com' ]
         * ]
         */

        $body = [
            'data' => [
                    'type' => 'people',
                    'attributes' => [
                        'fields' => $fields
                    ]
            ]
        ];
        $body = json_encode( $body );

        self::init();
        $response = self::$client->request('POST', 'https://api.livestorm.co/v1/sessions/' . $session_id . '/people', [
            'body' => $body,
            'headers' => [
                'Accept' => 'application/vnd.api+json',
                'Authorization' => self::$token,
                'Content-Type' => 'application/vnd.api+json',
            ],
        ]);

        if ( $response->getStatusCode() == 201 ) {
            $response = json_decode( $response->getBody() );
        }
        else {
            $response = false;
        }

        return $response;

    }

    //1ca98251-b60e-49fc-9da9-31ea19098e70
    //341221b3-5803-4d22-ad3b-3e2b9103beda
    //dfac4e3c-a1fe-4e0c-853e-7654c5350e60

}