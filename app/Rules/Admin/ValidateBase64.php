<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;

class ValidateBase64 implements Rule
{
    protected $taste, $level;

    /**
     * Create a new rule instance.
     *
     * @param array $taste
     * @param array $tasteLevel
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // strip out data uri scheme information (see RFC 2397)
        if (strpos($value, ';base64') !== false) {
            list(, $value) = explode(';', $value);
            list(, $value) = explode(',', $value);
        }

        // strict mode filters for non-base64 alphabet characters
        if (base64_decode($value, true) === false) {
            return false;
        }

        // decoding and then reeconding should not change the data
        if (base64_encode(base64_decode($value)) !== $value) {
            return false;
        }

        $binaryData = base64_decode($value);

        $tmpFile = tempnam(sys_get_temp_dir(), 'medialibrary');
        file_put_contents($tmpFile, $binaryData);

        // guard Against Invalid MimeType
        $allowedMime = array_flatten(['png', 'jpg', 'jpeg', 'gif']);

        // Check the MimeTypes
        $validation = Validator::make(
            ['file' => new File($tmpFile)],
            ['file' => 'mimes:' . implode(',', $allowedMime) . '|max:10000']
        );

        return !$validation->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The taste or taste level does not exists.';
    }
}
