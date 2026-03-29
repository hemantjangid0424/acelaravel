<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactUs extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',

    ];

    protected function validateData(array $data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message' => 'required|string'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    public function saveRecord(array $data)
    {
        $response = ['success' => false, 'message' => ''];
        $data = $this->validateData($data);
        self::create($data);
        $response['success'] = true;
        return $response;
    }

    public function getAll($data = [])
    {
        $records = static::query()->orderBy('id','DESC');

        if (!empty($data['paginate'])) {
            return $records
                ->paginate($data['per_page'])
                ->withQueryString();
        }

        return $records->get();
    }
}
