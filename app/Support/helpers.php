<?php


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

if (!function_exists('app_name')) {
    /**
     * Get the application name.
     *
     * @return string
     */
    function app_name()
    {
        if (!file_exists(storage_path('installed'))) {
            return config('app.name', 'Laravel');
        }
        return Settings::locale()
            ->get('name', config('app.name', 'Laravel'))
            ?: config('app.name', 'Laravel');
    }
}

if (!function_exists('app_logo')) {
    /**
     * Get the application logo url.
     *
     * @return string
     */
    function app_logo()
    {
        // if (!file_exists(storage_path('installed'))) {
        //     return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        // }

        if (($model = Settings::instance('logo')) && $file = $model->getFirstMediaUrl('logo')) {
            return $file;
        }

        return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
    }
}

if (!function_exists('app_favicon')) {
    /**
     * Get the application favicon url.
     *
     * @return string
     */
    function app_favicon()
    {
        // if (!file_exists(storage_path('installed'))) {
        //     return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        // }
        if (($model = Settings::instance('favicon')) && $file = $model->getFirstMediaUrl('favicon')) {
            return $file;
        }

        return '/favicon.ico';
    }
}

if (!function_exists('app_login_logo')) {
    /**
     * Get the application login logo url.
     *
     * @return string
     */
    function app_login_logo()
    {
        // if (!file_exists(storage_path('installed'))) {
        //     return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        // }
        if (($model = Settings::instance('loginLogo')) && $file = $model->getFirstMediaUrl('loginLogo')) {
            return $file;
        }

        return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
    }
}

if (!function_exists('app_login_background')) {
    /**
     * Get the application login background url.
     *
     * @return string
     */
    function app_login_background()
    {
        // if (!file_exists(storage_path('installed'))) {
        //     return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        // }
        if (($model = Settings::instance('loginBackground')) && $file = $model->getFirstMediaUrl('loginBackground')) {
            return $file;
        }

        return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
    }
}

if (!function_exists('calculateDistance')) {
    function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km')
    {
        try {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }
}

if (!function_exists('user')) {
    function user()
    {
        try {
            [$id, $token] = explode('|', request()->header('Authorization'), 2);
            return (PersonalAccessToken::findToken($token)->tokenable);
        } catch (Exception $e) {
            return false;
        }
    }
}


if (!function_exists('get_model_auth_type')) {
    function get_model_auth_type($model)
    {
        if (request()->has('auth_type')) {

            $validator = Validator::make(request()->only('auth_type'), [
                'auth_type' => 'sometimes|in:phone,email'
            ]);

            if ($validator->fails()) {

                $response = [
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ];
                throw new HttpResponseException(response()->json($response, 400));
            }

            return request()->get('auth_type');
        }

        $model = is_object($model) ? get_class($model) : $model;
        return defined("{$model}::VerificationType") ? $model::VerificationType : 'phone';
    }
}

