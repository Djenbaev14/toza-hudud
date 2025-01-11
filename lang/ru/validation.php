<?php

return [

        'required' => 'Поле :attribute обязательно для заполнения.',
        'email' => 'Поле :attribute должно быть действительным адресом электронной почты.',
        'min' => [
            'string' => 'Поле :attribute должно содержать не менее :min символов.',
        ],
        'max' => [
            'string' => 'Поле :attribute не должно превышать :max символов.',
        ],
        'unique' => 'Поле :attribute уже существует.',
        'confirmed' => 'Подтверждение для поля :attribute не совпадает.',
    
        'attributes' => [
            'name' => 'название',
            'email' => 'электронная почта',
            'password' => 'пароль',
            'price'=>'цена',
            'unit_id'=>'единица',
            'supplier_id'=>'поставщик',
            'district_id'=>'район',
            'branch_id'=>'филиала',
            'car_id'=>'автомобиля',
            'car_number'=>'номер автомобиля',
            'manufacturing_year'=>'год изготовления',
            'current_mileage'=>'текущий пробег',
            'engine_number'=>'номер двигателя',
            'body_number'=>'номер кузова',
            'full_name'=>'полное имя',
            'phone'=>'телефон',
            'address'=>'адрес'
        ],
    


];
