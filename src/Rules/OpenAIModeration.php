<?php

namespace RCerljenko\LaravelOpenAIModeration\Rules;

use Closure;
use Stringable;
use Illuminate\Contracts\Validation\ValidationRule;
use RCerljenko\LaravelOpenAIModeration\Services\OpenAIHandler;

class OpenAIModeration implements Stringable, ValidationRule
{
	public function __toString(): string
	{
		return self::class;
	}

	/**
	 * Run the validation rule.
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!$value || !config('openai.enabled')) {
			return;
		}

		$openAIHandler = new OpenAIHandler;

		$value = $openAIHandler->moderations(strip_tags($value));

		if (!$value || $value['results'][0]['flagged']) {
			$fail('openai::validation.inappropriate-content')->translate(['attribute' => $attribute]);
		}
	}
}
