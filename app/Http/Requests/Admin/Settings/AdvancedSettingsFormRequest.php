<?php

namespace Shadowdactyl\Http\Requests\Admin\Settings;

use Shadowdactyl\Http\Requests\Admin\AdminFormRequest;

class AdvancedSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'recaptcha:enabled' => 'required|in:true,false',
            'recaptcha:secret_key' => 'required|string|max:191',
            'recaptcha:website_key' => 'required|string|max:191',
            'shadowdactyl:guzzle:timeout' => 'required|integer|between:1,60',
            'shadowdactyl:guzzle:connect_timeout' => 'required|integer|between:1,60',
            'shadowdactyl:client_features:allocations:enabled' => 'required|in:true,false',
            'shadowdactyl:client_features:allocations:range_start' => [
                'nullable',
                'required_if:shadowdactyl:client_features:allocations:enabled,true',
                'integer',
                'between:1024,65535',
            ],
            'shadowdactyl:client_features:allocations:range_end' => [
                'nullable',
                'required_if:shadowdactyl:client_features:allocations:enabled,true',
                'integer',
                'between:1024,65535',
                'gt:shadowdactyl:client_features:allocations:range_start',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'recaptcha:enabled' => 'reCAPTCHA Enabled',
            'recaptcha:secret_key' => 'reCAPTCHA Secret Key',
            'recaptcha:website_key' => 'reCAPTCHA Website Key',
            'shadowdactyl:guzzle:timeout' => 'HTTP Request Timeout',
            'shadowdactyl:guzzle:connect_timeout' => 'HTTP Connection Timeout',
            'shadowdactyl:client_features:allocations:enabled' => 'Auto Create Allocations Enabled',
            'shadowdactyl:client_features:allocations:range_start' => 'Starting Port',
            'shadowdactyl:client_features:allocations:range_end' => 'Ending Port',
        ];
    }
}
