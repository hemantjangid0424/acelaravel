<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Service extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'image',
        'menu_name',
        'title',
        'slug',
        'description',
        'documents_required',
        'fees_and_charges',
        'status'
    ];

    public function saveRecord(array $data)
    {
        $id = $data['id'] ?? null;

        $data = $data;

        $data['slug'] = $this->generateSlug($data['title'], $id);

        return self::updateOrCreate(
            ['id' => $id],
            collect($data)->except('id')->toArray()
        );
    }

    public function findById($id)
    {
        return self::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return self::where('slug','=',$slug)->first();
    }

    public function getAll()
    {
        return self::where('status','=',1)->latest()->get();
    }

    public function deleteById($id)
    {
        return self::where('id', $id)->delete();
    }

    protected function validateData(array $data)
    {
        $rules = [
            'menu_name'=> 'required|string|max:255',
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'description' => 'required|string',
            'documents_required' => 'nullable|string',
            'fees_and_charges' => 'nullable|string',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    protected function generateSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (
            self::where('slug', $slug)
                ->when($id, fn ($q) => $q->where('id', '!=', $id))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}