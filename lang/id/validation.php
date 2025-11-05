<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Isian :attribute harus diterima',
    'accepted_if' => 'Isian :attribute harus diterima jika :other adalah :value',
    'active_url' => 'Isian :attribute harus berupa URL yang valid',
    'after' => 'Isian :attribute harus berupa tanggal setelah :date',
    'after_or_equal' => 'Isian :attribute harus berupa tanggal setelah atau sama dengan :date',
    'alpha' => 'Isian :attribute hanya boleh berisi huruf',
    'alpha_dash' => 'Isian :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah',
    'alpha_num' => 'Isian :attribute hanya boleh berisi huruf dan angka',
    'array' => 'Isian :attribute harus berupa array',
    'ascii' => 'Isian :attribute hanya boleh berisi karakter dan simbol alfanumerik satu-byte',
    'before' => 'Isian :attribute harus berupa tanggal sebelum :date',
    'before_or_equal' => 'Isian :attribute harus berupa tanggal sebelum atau sama dengan :date',
    'between' => [
        'array' => 'Isian :attribute harus memiliki item antara :min dan :max',
        'file' => 'Isian :attribute harus berada di antara :min dan :max kilobyte',
        'numeric' => 'Isian :attribute harus berada di antara :min dan :max',
        'string' => 'Isian :attribute harus berada di antara :min dan :max karakter',
    ],
    'boolean' => 'Isian :attribute harus bernilai benar atau salah',
    'can' => 'Isian :attribute berisi nilai yang tidak sah',
    'confirmed' => 'Isian konfirmasi :attribute tidak sesuai',
    'contains' => 'Isian :attribute tidak memiliki nilai yang harus diisi',
    'current_password' => 'Kata sandi salah',
    'date' => 'Isian :attribute harus berupa tanggal yang valid',
    'date_equals' => 'Isian :attribute harus berupa   tanggal yang sama dengan :date',
    'date_format' => 'Isian :attribute harus sesuai dengan format :format',
    'decimal' => 'Isian :attribute harus memiliki tempat desimal :decimal',
    'declined' => 'Isian :attribute harus ditolak',
    'declined_if' => 'Isian :attribute harus ditolak jika :other adalah :value',
    'different' => 'Isian :attribute dan :other harus berbeda',
    'digits' => 'Isian :attribute harus berupa :digits angka',
    'digits_between' => 'Isian :attribute harus berada di antara :min dan :max digit',
    'dimensions' => 'Isian :attribute memiliki dimensi gambar yang tidak valid',
    'distinct' => 'Isian :attribute memiliki nilai duplikat',
    'doesnt_end_with' => 'Isian :attribute tidak boleh diakhiri dengan salah satu dari yang berikut ini: :values',
    'doesnt_start_with' => 'Isian :attribute tidak boleh dimulai dengan salah satu dari berikut ini: :values',
    'email' => 'Isian :attribute harus berupa alamat email yang valid',
    'ends_with' => 'Isian :attribute harus diakhiri dengan salah satu dari berikut ini: :values',
    'enum' => ':attribute yang dipilih tidak valid',
    'exists' => ':attribute yang dipilih tidak valid',
    'extensions' => 'Isian :attribute harus memiliki salah satu ekstensi berikut: :values',
    'file' => 'Isian :attribute harus berupa file',
    'filled' => 'Isian :attribute harus memiliki nilai',
    'gt' => [
        'array' => 'Isian :attribute harus memiliki lebih dari :value item',
        'file' => 'Isian :attribute harus lebih besar dari :value kilobyte',
        'numeric' => 'Isian :attribute harus lebih besar dari :value',
        'string' => 'Isian :attribute harus lebih besar dari :value karakter',
    ],
    'gte' => [
        'array' => 'Isian :attribute harus memiliki :value item atau lebih',
        'file' => 'Isian :attribute harus lebih besar dari atau sama dengan :value kilobyte',
        'numeric' => 'Isian :attribute harus lebih besar dari atau sama dengan :value',
        'string' => 'Isian :attribute harus lebih besar dari atau sama dengan :value karakter',
    ],
    'hex_color' => 'Isian :attribute harus berupa warna heksadesimal yang valid',
    'image' => 'Isian :attribute harus berupa gambar',
    'in' => ':attribute yang dipilih tidak valid',
    'in_array' => 'Isian :attribute harus ada dalam :other',
    'integer' => 'Isian :attribute harus berupa bilangan bulat',
    'ip' => 'Isian :attribute harus berupa alamat IP yang valid',
    'ipv4' => 'Isian :attribute harus berupa alamat IPv4 yang valid',
    'ipv6' => 'Isian :attribute harus berupa alamat IPv6 yang valid',
    'json' => 'Isian :attribute harus berupa string JSON yang valid',
    'list' => 'Isian :attribute harus berupa daftar',
    'lowercase' => 'Isian :attribute harus berupa huruf kecil',
    'lt' => [
        'array' => 'Isian :attribute harus memiliki item kurang dari :value',
        'file' => 'Isian :attribute harus kurang dari :value kilobyte',
        'numeric' => 'Isian :attribute harus kurang dari :value',
        'string' => 'Isian :attribute harus kurang dari :value karakter',
    ],
    'lte' => [
        'array' => 'Isian :attribute tidak boleh memiliki lebih dari :value item',
        'file' => 'Isian :attribute nilai harus kurang dari atau sama dengan :value kilobyte',
        'numeric' => 'Isian :attribute nilai harus kurang dari atau sama dengan :value',
        'string' => 'Isian :attribute harus kurang dari atau sama dengan :value karakter',
    ],
    'mac_address' => 'Isian :attribute attribute harus berupa alamat MAC yang valid',
    'max' => [
        'array' => 'Isian :attribute tidak boleh memiliki lebih dari :max item',
        'file' => 'Isian :attribute tidak boleh lebih besar dari :max kilobyte',
        'numeric' => 'Isian :attribute tidak boleh lebih besar dari :max',
        'string' => 'Isian :attribute tidak boleh lebih besar dari :max karakter',
    ],
    'max_digits' => 'Isian :attribute tidak boleh lebih dari :max digit',
    'mimes' => 'Isian :attribute harus berupa file bertipe: :values',
    'mimetypes' => 'Isian :attribute harus berupa file bertipe: :values',
    'min' => [
        'array' => 'Isian :attribute harus memiliki setidaknya :min item',
        'file' => 'Isian :attribute harus memiliki setidaknya :min kilobyte',
        'numeric' => 'Isian :attribute harus minimal :min',
        'string' => 'Isian :attribute harus memiliki setidaknya :min karakter',
    ],
    'min_digits' => 'Isian :attribute harus memiliki setidaknya :min digit',
    'missing' => 'Isian :attribute tidak boleh kosong',
    'missing_if' => 'Isian :attribute harus hilang ketika :other adalah :value',
    'missing_unless' => 'Isian :attribute harus tidak ada kecuali :other adalah :value',
    'missing_with' => 'Isian :attribute harus tidak ada jika :values ada',
    'missing_with_all' => 'Isian :attribute harus tidak ada jika :values ada',
    'multiple_of' => 'Isian :attribute harus merupakan kelipatan dari :value',
    'not_in' => ':attribute yang dipilih tidak valid',
    'not_regex' => 'Format isian :attribute tidak valid',
    'numeric' => 'Isian :attribute harus berupa angka',
    'password' => [
        'letters' => 'Isian :attribute harus berisi setidaknya satu huruf',
        'mixed' => 'Isian :attribute harus berisi setidaknya satu huruf besar dan satu huruf kecil',
        'numbers' => 'Isian :attribute harus berisi setidaknya satu angka',
        'symbols' => 'Isian :attribute harus berisi setidaknya satu simbol',
        'uncompromised' => ':attribute yang diberikan telah muncul dalam kebocoran data. Pilihlah :attribute yang berbeda',
    ],
    'present' => 'Isian :attribute harus ada',
    'present_if' => 'Isian :attribute harus ada ketika :other adalah :value',
    'present_unless' => 'Isian :attribute harus ada kecuali :other adalah :value',
    'present_with' => 'Isian :attribute harus ada jika :value ada',
    'present_with_all' => 'Isian :attribute harus ada jika :value ada',
    'prohibited' => 'Isian :attribute dilarang',
    'prohibited_if' => 'Isian :attribute dilarang ketika :other adalah :value',
    'prohibited_unless' => 'Isian :attribute dilarang kecuali :other ada di dalam :values',
    'prohibits' => 'Isian :attribute melarang :other untuk tampil',
    'regex' => 'Format isian :attribute tidak valid',
    'required' => 'Isian :attribute wajib diisi',
    'required_array_keys' => 'Isian :attribute harus berisi entri untuk: :values',
    'required_if' => 'Isian :attribute wajib diisi ketika :other adalah :value',
    'required_if_accepted' => 'Isian :attribute wajib diisi ketika :other diterima',
    'required_if_declined' => 'Isian :attribute diperlukan ketika :other ditolak',
    'required_unless' => 'Isian :attribute wajib diisi kecuali :other dalam :values',
    'required_with' => 'Isian :attribute wajib diisi jika :values ada',
    'required_with_all' => 'Isian :attribute wajib diisi jika :values ada',
    'required_without' => 'Isian :attribute harus diisi ketika :values tidak ada',
    'required_without_all' => 'Isian :attribute harus ada ketika tidak ada :values yang ada',
    'same' => 'Isian :attribute harus sama dengan :other',
    'size' => [
        'array' => 'Isian :attribute harus berisi item :size',
        'file' => 'Isian :attribute ukuran harus berupa :size kilobyte',
        'numeric' => 'Isian :attribute harus berupa :size',
        'string' => 'Isian :attribute harus berupa :size karakter',
    ],
    'starts_with' => 'Isian :attribute harus dimulai dengan salah satu dari yang berikut ini: :values',
    'string' => 'Isian :attribute harus berupa string',
    'timezone' => 'Isian :attribute harus berupa zona waktu yang valid',
    'unique' => ':attribute telah diambil',
    'uploaded' => ':attribute gagal diunggah',
    'uppercase' => 'Isian :attribute harus berupa huruf besar',
    'url' => 'Isian :attribute attribute harus berupa URL yang valid',
    'ulid' => 'Isian :attribute harus berupa ULID yang valid',
    'uuid' => 'Isian :attribute harus berupa UUID yang valid',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
