<?php

namespace App\Models;

use App\Http\Resources\NoteBookResourse;
use App\Models\NoteBook;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\AssertableJson;

class ApiService
{
    private function validate($request)
    {
        $validator = Validator::make($request->all(), [
            'fio' => 'required',
            'tel' => 'required',
            'email' => 'required',
        ]);

        $validator->setCustomMessages([
            'fio.required' => 'Поле fio обязательно для заполнения',
            'tel.required' => 'Поле tel обязательно для заполнения',
            'email.required' => 'Поле email обязательно для заполнения',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = array_merge($validator->validated(), $request->all());

        return $data;
    }

    public function index()
    {
        return NoteBookResourse::collection(NoteBook::all());
    }

    public function store($request)
    {
        $data = $this->validate($request);

        if(is_array($data)){
            NoteBook::query()->create($data);
            return response()->json(['message' => 'Создано'], 201);
        } else {
            return $data;
        }
    }

    public function show($id)
    {
        return NoteBook::query()->findOrFail($id);
    }

    public function update($request, $id)
    {
        $data = $this->validate($request);

        if(is_array($data)) {
            if(!NoteBook::query()->where('id', $id)->exists()) {
                return response()->json(['message' => 'Пользователь не найден, проверьте ключ'], 404);
            }

            NoteBook::query()->where('id', $id)
                ->first()->update($data);

            return response()->json(['message' => 'Обновлено'], 201);
        } else {
            return $data;
        }
    }

    public function destroy($id)
    {
        if(!NoteBook::query()->where('id', $id)->exists()) {
            return response()->json(['message' => 'Пользователь не найден, проверьте ключ'], 404);
        }

        NoteBook::query()->where('id', $id)
            ->first()->delete();

        return response()->json(['message' => 'Удалено'], 201);
    }
}
