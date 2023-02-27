# Laravel OpenAI Moderation Rule

Laravel validation Rule using [OpenAI Moderation API](https://platform.openai.com/docs/guides/moderation).
Gives you a way to validate your form requests for inappropriate content.

## Installation

Standard [Composer](https://getcomposer.org/download) package installation:

```sh
composer require rcerljenko/laravel-openai-moderation
```

## Usage

1. Publish config and translation files.

```sh
php artisan vendor:publish --provider="RCerljenko\LaravelOpenAIModeration\ServiceProvider"
```

2. Set your OpenAI API key and enable package via newly created config file => `config/openai.php`

3. Use provided rule with your validation rules.

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RCerljenko\LaravelOpenAIModeration\Rules\OpenAIModeration;

class StoreText extends FormRequest
{
 /**
  * Determine if the user is authorized to make this request.
  */
 public function authorize(): bool
 {
  return true;
 }

 /**
  * Get the validation rules that apply to the request.
  */
 public function rules(): array
 {
  return [
   'text' => ['required', 'string', new OpenAIModeration],
  ];
 }
}
```
